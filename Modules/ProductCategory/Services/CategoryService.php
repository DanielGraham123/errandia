<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 2/9/2021
 * Time: 8:44 PM
 */

namespace Modules\ProductCategory\Services;


use Illuminate\Support\Str;
use Modules\ProductCategory\Repositories\ProductCategoryRepository;
use Modules\ProductCategory\Repositories\ProductSubCategoryRepository;
use Modules\Utility\Services\ImageUploadService;

class CategoryService
{
    protected $productCategoryRepository;
    protected $subCatgoryRepository;
    protected $uploadService;

    public function __construct(ProductCategoryRepository $repository, ProductSubCategoryRepository $productSubCategoryRepository, ImageUploadService $uploaderService)
    {
        $this->productCategoryRepository = $repository;
        $this->subCatgoryRepository = $productSubCategoryRepository;
        $this->uploadService = $uploaderService;
    }

    public function saveCategory(array $category)
    {
        //upload category  image if set
        $category['image_path'] = $this->uploadService->uploadFile($category, "image_path", "category");
        return $this->productCategoryRepository->create($category);
    }

    public function saveSubCategory(array $sub_category)
    {
        $sub_category['image_path'] = $this->uploadService->uploadFile($sub_category, "image_path", "category/sub");
        return $this->subCatgoryRepository->create($sub_category);
    }

    public function findCategoryById($category_id)
    {
        return $this->productCategoryRepository->findById($category_id);
    }

    public function findSubCategoryById($sub_category_id)
    {
        return $this->subCatgoryRepository->findById($sub_category_id);
    }

    public function findCategoryBySlug($slug)
    {
        return $this->productCategoryRepository->findBySlug($slug);
    }

    public function findSubCategoryBySlug($slug)
    {
        return $this->subCatgoryRepository->findBySlug($slug);
    }

    public function updateCategory($category_id, array $category)
    {
        //check if user wants to update image
        $category_image = $category['image_path'] === "" ? "" : $this->uploadService->uploadFile($category, "image_path", "category");
        if ($category_image === "") {
            //unset the image path
            unset($category['image_path']);
        } else {
            $category["image_path"] = $category_image;
            //delete previous image
            $category_image_path = $this->productCategoryRepository->findById($category_id)->image_path;
            //delete image from filesystem
            $this->uploadService->deleteFile($category_image_path);
        }
        return $this->productCategoryRepository->update($category, $category_id);
    }

    public function updateSubCategory($sub_category_id, array $sub_category)
    {
        //check if user wants to update image
        $category_image = $sub_category['image_path'] === "" ? "" : $this->uploadService->uploadFile($sub_category, "image_path", "category/sub");
        if ($category_image === "") {
            //unset the image path
            unset($sub_category['image_path']);
        } else {
            $sub_category["image_path"] = $category_image;
            //delete previous image
            $category_image_path = $this->productCategoryRepository->findById($sub_category_id)->image_path;
            //delete image from filesystem
            $this->uploadService->deleteFile($category_image_path);
        }
        return $this->subCatgoryRepository->update($sub_category, $sub_category_id);
    }

    public function getAllCategories()
    {
        return $this->productCategoryRepository->getAllCategories();
    }

    public function getAllSubCategories()
    {
        return $this->subCatgoryRepository->getAllSubCategories();
    }

    public function getActiveCategories()
    {
        return $this->productCategoryRepository->getActiveCategories();
    }

    public function getActiveSubCategories()
    {
        return $this->subCatgoryRepository->getActiveCategories();
    }

    public function findProductsByCategory($category_id)
    {
        return $this->productCategoryRepository->getProductsByCategory($category_id);
    }

    public function findProductsBySubCategory($sub_category_id)
    {
        return $this->subCatgoryRepository->getProductsBySubCategory($sub_category_id);
    }

    public function deleteCategory($category_id)
    {
        return $this->productCategoryRepository->delete($category_id);
    }

    public function deleteSubCategory($sub_category_id)
    {
        return $this->subCatgoryRepository->delete($sub_category_id);
    }

    public function searchCategoryByName($query)
    {
        return $this->productCategoryRepository->searchCategoryByName($query);
    }

    public function getSubCategoriesByCategory($category_id)
    {
        return $this->productCategoryRepository->getSubCategoriesByCategory($category_id);
    }

    public function getSubCategoriesByCategoryOptions($category_id)
    {
        $categories = $this->getSubCategoriesByCategory($category_id);
        $data = "<option>" . trans('vendor.add_product_sub_category_label') . "</option>";
        foreach ($categories as $category) {
            $data .= "<option value='" . $category->id . "'>" . $category->name . "</option>";
        }
        return $data;
    }

    public function getCategoryProductsBySlug($slug)
    {
        return $this->productCategoryRepository->getCategoryProductsBySlug($slug);
    }

    public function getSubCategoriesByIds(array $ids)
    {
        return $this->subCatgoryRepository->getSubCategoriesByIds($ids);
    }

    public function extractProductsByCategoryList($categoryList)
    {
        $products = $categoryList->map(function ($category) {
            return $category->products;
        })->reject(function ($products) {
            return $products->count() <= 0;
        });
        $product_list = [];
        foreach ($products as $collection) {
            foreach ($collection as $product) {
                array_push($product_list, $product);
            }
        }
        return collect($product_list);
    }

}
