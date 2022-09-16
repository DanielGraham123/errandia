<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 2/22/2021
 * Time: 9:26 PM
 */

namespace Modules\ProductCategory\Repositories;


use Modules\ProductCategory\Entities\SubCategory;

class ProductSubCategoryRepository
{
    public $model;

    public function __construct(SubCategory $category)
    {
        $this->model = $category;
    }

    public function create(array $category)
    {
        return $this->model->create($category);
    }

    public function findById($sub_category_id)
    {
        return $this->model->find($sub_category_id);
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->with('category')->first();
    }

    public function update(array $category, $sub_category_id)
    {
        return $this->model->find($sub_category_id)->update($category);
    }

    public function delete($sub_category_id)
    {
        return $this->model->find($sub_category_id)->delete();
    }

    public function getAllSubCategories()
    {
        return $this->model->get();
    }

    public function getActiveCategories()
    {
        return $this->model->where('status', 1)->orderBy('name','asc')->get();
    }

    public function getProductsBySubCategory($sub_category_id)
    {
        return $this->model->find($sub_category_id)->products()->paginate(24);
    }

    public function getFeaturedCollections()
    {
        return $this->model->where('status', 1)->inRandomOrder()->limit(12)->get();
    }

    public function getFeaturedCategoryProducts()
    {
        $cats = $this->model->where('status', 1)->inRandomOrder()->limit(12)->with('products')->get();
        $product_category = null;
        foreach ($cats as $productCategory) {
            if ($productCategory->products->count() > 4) {
                $product_category = $productCategory;
            }
        }
        return $product_category;
    }

    public function getSubCategoriesByIds(array $categories)
    {
        return $this->model->whereIn('id', $categories)->where('status', 1)->with('category')->get();
    }
}
