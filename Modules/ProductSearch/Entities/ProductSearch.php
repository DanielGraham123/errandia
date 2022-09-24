<?php

namespace Modules\ProductSearch\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

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
		$result = ProductSearch::select("*")->from('products')
			->when(!empty($keywords['sub_category']) , function ($query) use($keywords){
				return $query->where('products.sub_category_id',$keywords['sub_category']);
			})
			->when(!empty($keyword), function ($query) use ($keyword){
				return $query->where(function($q) use($keyword) {
				 $q->where('products.search_index', 'LIKE', "%{$keyword}%");
			 });
		 })
		 ->paginate(20);
		 //->toSql();
		return $result;
	}

    public function getSearchProducts($searchFilters){
        $query = DB::table('products')
            ->join('shops', 'products.shop_id', '=', 'shops.id')
            ->join('currencies', 'products.currency_id', '=', 'currencies.id')
            ->join('users', 'shops.user_id', '=', 'users.id')
            ->join('shop_contact_info', 'shops.id', '=', 'shop_contact_info.shop_id')
            ->join('streets', 'shop_contact_info.street_id', '=', 'streets.id')
            ->join('towns', 'streets.town_id', '=', 'towns.id')
            ->join('regions', 'towns.region_id', '=', 'regions.id');
        $query->when(!empty($searchFilters['search']), function ($query) use ($searchFilters){
            return $query->where(function($q) use($searchFilters) {
                $q->where('products.search_index', 'LIKE', "%{$searchFilters['search']}%");
            });
        });
        $query->when(!empty($searchFilters['region']), function ($query) use ($searchFilters){
            return $query->where(function($q) use($searchFilters) {
                $q->where('regions.id', '=', "{$searchFilters['region']}");
            });
        });
        $query->when(!empty($searchFilters['town']), function ($query) use ($searchFilters){
            return $query->where(function($q) use($searchFilters) {
                $q->where('towns.id', '=', "{$searchFilters['town']}");
            });
        });
        $query->when(!empty($searchFilters['street']), function ($query) use ($searchFilters){
            return $query->where(function($q) use($searchFilters) {
                $q->where('streets.id', '=', "%{$searchFilters['street']}%");
            });
        });
            return $query->select('products.*',
                'users.name as store_owner_name',
                'users.email as store_owner_email',
                'shops.name as shop_name',
                'shops.slug as shop_slug',
                'shop_contact_info.tel as shop_tel',
                'shop_contact_info.address as shop_address',
                'regions.name as region_name',
                'currencies.name as currency'

            )->get();
    }

	public function getTotalSortProduct($keyword,$keywords)
	{
		$result = ProductSearch::select("*")->from('products')
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
