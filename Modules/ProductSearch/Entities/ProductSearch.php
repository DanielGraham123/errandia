<?php

namespace Modules\ProductSearch\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSearch extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\ProductSearch\Database\factories\ProductSearchFactory::new();
    }

	public function getAllSearchProduct($keyword)
	{
		return  ProductSearch::select("*")->from('products')
		->where('products.search_index', 'LIKE', "%{$keyword}%")
		->paginate(20);
	}

	public function getTotalSearchProduct($keyword)
	{
		return  ProductSearch::select("*")->from('products')
		->where('products.search_index', 'LIKE', "%{$keyword}%")
		->get();
	}

	public function getAllSortProduct($keyword,$keywords)
	{
		//print_r($keywords);die;
		$result=ProductSearch::select("*")->from('products')
			->when(!empty($keywords['sub_category']) , function ($query) use($keywords){
				return $query->where('products.sub_category_id',$keywords['sub_category']);
			})
			->when($keywords['MinPrice']!=0 and $keywords['MaxPrice']!=0 , function ($query) use($keywords){
				return $query->whereBetween('products.unit_price', [$keywords['MinPrice'], $keywords['MaxPrice']]) ;
			})
			->when(!empty($keyword), function ($query) use ($keyword){
				return $query->where(function($q) use($keyword) {
				 $q	->where('products.search_index', 'LIKE', "%{$keyword}%");
			 });
		 })
		 ->paginate(20);
		 //->toSql();
		//dd($result);die;
		return $result;
	}


	public function getTotalSortProduct($keyword,$keywords)
	{
		$result=ProductSearch::select("*")->from('products')
			->when(!empty($keywords['sub_category']) , function ($query) use($keywords){
				return $query->where('products.sub_category_id',$keywords['sub_category']);
			})
			->when($keywords['MinPrice']!=0 and $keywords['MaxPrice']!=0 , function ($query) use($keywords){
				return $query->whereBetween('products.unit_price', [$keywords['MinPrice'], $keywords['MaxPrice']]) ;
			})
			->when(!empty($keyword), function ($query) use ($keyword){
				return $query->where(function($q) use($keyword) {
				 $q->where('products.search_index', 'LIKE', "%{$keyword}%");
			 });
		 })->get();
		 return $result;
	}

}
