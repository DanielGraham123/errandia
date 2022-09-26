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
        return ProductSearch::select("*")->from('products')
            ->where('products.search_index', 'LIKE', "%{$keyword}%")
            ->paginate(20);
    }

    public function getTotalSearchProduct($keyword)
    {
        return ProductSearch::select("*")->from('products')
            ->where('products.search_index', 'LIKE', "%{$keyword}%")
            ->get();
    }

    public function getAllSortProduct($keyword, $keywords)
    {
        $result = ProductSearch::select("*")->from('products')
            ->when(!empty($keywords['sub_category']), function ($query) use ($keywords) {
                return $query->where('products.sub_category_id', $keywords['sub_category']);
            })
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where(function ($q) use ($keyword) {
                    $q->where('products.search_index', 'LIKE', "%{$keyword}%");
                });
            })
            ->paginate(20);
        //->toSql();
        return $result;
    }

    public function getSearchProducts($searchFilters, $results = false)
    {
        $query = DB::table('products')
            ->join('shops', 'products.shop_id', '=', 'shops.id')
            ->join('currencies', 'products.currency_id', '=', 'currencies.id')
            ->join('users', 'shops.user_id', '=', 'users.id')
            ->join('shop_contact_info', 'shops.id', '=', 'shop_contact_info.shop_id')
            ->join('streets', 'shop_contact_info.street_id', '=', 'streets.id')
            ->join('towns', 'streets.town_id', '=', 'towns.id')
            ->join('regions', 'towns.region_id', '=', 'regions.id');
        $query->where('products.name', "!=", '');
        $query->when(!empty($searchFilters['search']), function ($query) use ($searchFilters) {
            return $query->where(function ($q) use ($searchFilters) {
                $q->where('products.name', 'LIKE', "%{$searchFilters['search']}%")
                    ->orWhere('products.description', 'LIKE', "%{$searchFilters['search']}%");

            });
        });
        $this->extracted($query, $searchFilters);

        $query->select('products.*',
            'users.name as store_owner_name',
            'users.email as store_owner_email',
            'shops.name as shop_name',
            'shops.slug as shop_slug',
            'shop_contact_info.tel as shop_tel',
            'shop_contact_info.address as shop_address',
            'regions.name as region_name',
            'currencies.name as currency'

        );
        $products = $query->paginate(20);
        $queryCollection = collect($products);
        $queryCollection = collect($queryCollection['data']);
        $shopIds = $queryCollection->pluck('shop_id')->groupBy('shop_id')->flatMap(function ($val) {
            return $val;
        })->toArray();
        $total = $query->count();
        return [
            'products' => $products,
            'total' => $total,
            'shop_ids' => $shopIds ?? []
        ];
    }

    public function getRelatedShops($searchFilters)
    {
        $query = DB::table('shops')
            ->join('products', 'shops.id', '=', 'products.shop_id')
            ->join('users', 'shops.user_id', '=', 'users.id')
            ->join('shop_contact_info', 'shops.id', '=', 'shop_contact_info.shop_id')
            ->join('streets', 'shop_contact_info.street_id', '=', 'streets.id')
            ->join('towns', 'streets.town_id', '=', 'towns.id')
            ->join('regions', 'towns.region_id', '=', 'regions.id');
        $query->where('shops.name', "!=", '');
        $query->whereNotIn('shops.id',$searchFilters['shop_ids'] );
        $query->when(!empty($searchFilters['search']), function ($query) use ($searchFilters) {
            return $query->where(function ($q) use ($searchFilters) {
                $q->where('products.search_index', 'LIKE', "%{$searchFilters['search']}%", 'OR');
            });
        });
        $this->extracted($query, $searchFilters, 'OR');

        return $query->select('shops.*','shop_contact_info.tel as shop_tel')->distinct()->take(8)->get();
    }

    public function getTotalSortProduct($keyword, $keywords)
    {
        $result = ProductSearch::select("*")->from('products')
            ->when(!empty($keywords['sub_category']), function ($query) use ($keywords) {
                return $query->where('products.sub_category_id', $keywords['sub_category']);
            })
            ->when($keywords['MinPrice'] != 0 and $keywords['MaxPrice'] != 0, function ($query) use ($keywords) {
                return $query->whereBetween('products.unit_price', [$keywords['MinPrice'], $keywords['MaxPrice']]);
            })
            ->when(!empty($keyword), function ($query) use ($keyword) {
                return $query->where(function ($q) use ($keyword) {
                    $q->where('products.search_index', 'LIKE', "%{$keyword}%");
                });
            })->get();
        return $result;
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param $searchFilters
     * @return void
     */
    public function extracted(\Illuminate\Database\Query\Builder $query, $searchFilters, $boolean = 'AND'): void
    {
        $query->when(!empty($searchFilters['region']), function ($query) use ($searchFilters, $boolean) {
            return $query->where(function ($q) use ($searchFilters, $boolean) {
                $q->where('regions.id', '=', "{$searchFilters['region']}", $boolean);
            });
        });
        $query->when(!empty($searchFilters['town']), function ($query) use ($searchFilters, $boolean) {
            return $query->where(function ($q) use ($searchFilters, $boolean) {
                $q->where('towns.id', '=', "{$searchFilters['town']}", $boolean);
            });
        });
        $query->when(!empty($searchFilters['street']), function ($query) use ($searchFilters, $boolean) {
            return $query->where(function ($q) use ($searchFilters, $boolean) {
                $q->where('streets.id', '=', "{$searchFilters['street']}", $boolean);
            });
        });
    }

}
