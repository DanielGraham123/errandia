<?php

namespace Modules\ProductCategory\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Entities\Product;

class SubCategory extends Model
{

    protected $table = "product_sub_categories";
    protected $fillable = ['name', 'description', 'image_path', 'slug', 'status', 'category_id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'sub_category_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public static function getTableName()
    {
        return "product_sub_categories";
    }

	public function getAllSubCategories()
	{
		return  SubCategory::orderBy('name','asc')->get();
	}
}
