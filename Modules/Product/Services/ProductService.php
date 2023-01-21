<?php
/**
 * Author: Dieudonne Takougang
 * Date: 11/10/2020
 * @Description:
 */

namespace Modules\Product\Services;

use Modules\Product\Repositories\Interfaces\ProductRepositoryInterface;
use Modules\Product\Repositories\ProductRepository;
use Modules\Product\Services\Interfaces\ProductServiceInterface;
use Modules\Utility\Services\ImageUploadService;

class ProductService implements ProductServiceInterface
{
    private $productRepository;
    private $imageUploadService;

    public function __construct(ProductRepository $productRepository, ImageUploadService $imageUploadService)
    {
        $this->productRepository = $productRepository;
        $this->imageUploadService = $imageUploadService;
    }

    public function saveProduct(array $product)
    {
        //upload and save product image
        //$product['featured_image_path'] = $this->imageUploadService->uploadFile($product, "featured_image_path", "products");
        return $this->productRepository->create($product);
    }

    public function saveProductImages($product_id, $product_image)
    {
        return $this->productRepository->saveProductExtraImage($product_id, $product_image);
    }

    public function updateProductImage($image_id, $image_path)
    {
        return $this->productRepository->updateProductExtraImage($image_id, $image_path);
    }

    public function findProductById($product)
    {
        return $this->productRepository->findById($product);
    }

    public function findProductBySlug($slug)
    {
        return $this->productRepository->findBySlug($slug);
    }

    public function updateProduct(array $product, $product_id)
    {
        $product_image = $product['featured_image_path'] === "" ? "" : $this->imageUploadService->uploadFile($product, "featured_image_path", "products");
        if ($product_image === "") {
            //unset the featured_image_path
            unset($product['featured_image_path']);
        } else {
            $product['featured_image_path'] = $product_image;
            //delete previous file from filesystem
            $product_feature_image_path = $this->productRepository->findById($product_id)->featured_image_path;
            $this->imageUploadService->deleteFile($product_feature_image_path);
        }
        return $this->productRepository->update($product, $product_id);
    }

    public function deleteProduct($product_id)
    {
        //delete product image
        $this->productRepository->deleteProductImages($product_id);
        //delete product details
        return $this->productRepository->delete($product_id);
    }

    public function getShopsByProductCategory($subCategoryId)
    {
        return $this->productRepository->getShopsByProductCategory($subCategoryId);
    }

    public function getShopsBySubCategory($subCategoryId,$useShopCategoriesTable)
    {
//        return $this->productRepository->getShopsBySubCategory($subCategoryId);//
        return $this->productRepository->geterrandShops($subCategoryId,$useShopCategoriesTable);
    }
}
