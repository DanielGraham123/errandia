<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 2/9/2021
 * Time: 8:47 PM
 */

namespace Modules\ProductCategory\Repositories;


use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Product;
use Modules\ProductCategory\Entities\ProductCategory;

class ProductCategoryRepository
{
    public $model;

    public function __construct(ProductCategory $category)
    {
        $this->model = $category;
    }

    public function create(array $category)
    {
        return $this->model->create($category);
    }

    public function findById($category_id)
    {
        return $this->model->find($category_id);
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->with('subCategories')->first();
    }

    public function getCategoryProductsBySlug($slug)
    {
        $query = DB::table('product_categories')
            ->where('product_categories.slug', $slug)
            ->join('product_sub_categories', 'product_categories.id', '=', 'product_sub_categories.category_id')
            ->join('products', 'product_sub_categories.id', '=', 'products.sub_category_id')
            ->orderBy('products.id', 'desc')
            ->paginate(24);
        return $query;
        //return $this->model->where('slug', $slug)->with('subCategories.products')->first();
    }

    public function update(array $category, $category_id)
    {
        return $this->model->find($category_id)->update($category);
    }

    public function delete($category_id)
    {
        return $this->model->find($category_id)->delete();
    }

    public function getAllCategories()
    {
        return $this->model->orderBy('name','asc')->get();
    }

    public function getActiveCategories()
    {
        return $this->model->where('status', 1)->with('subCategories')->get();
    }

    public function getProductsByCategory($category_id)
    {
        $sub_category_ids = collect($this->getSubCategoriesByCategory($category_id))->keyBy('category_id')->keys();
        $products = DB::table(Product::getTableName())
            ->whereIn('sub_category_id', $sub_category_ids)
            ->get();
        return collect($products);
    }

    public function getSubCategoriesByCategory($category_id)
    {
        return $this->model->find($category_id)->subCategories;
    }

    public function searchCategoryByName($query)
    {
        return $this->model->where('name', 'LIKE', "%" . $query . "%")->get();
    }

    public function getPopularCategories()
    {
        return $this->model->where('status', 1)->orderBy('name','asc')->inRandomOrder()->with('subCategories')->limit(12)->get();
    }

}
