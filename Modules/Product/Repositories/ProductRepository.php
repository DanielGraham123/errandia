<?php
/**
 * User: Dieudonne Takougang
 * Date: 11/10/2020
 * Description: An implementation for the Product Repository interface
 */

namespace Modules\Product\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Product;
use Modules\BaseRepository;
use Modules\Product\Entities\ProductImage;
use Modules\Product\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected $productModel;

    public function __construct(Product $model)
    {
        $this->productModel = $model;
    }

    public function create(array $product)
    {
        return $this->productModel->create($product);
    }

    public function findById($product_id)
    {
        return $this->productModel->where('id', $product_id)->with('images')->first();
    }

    public function findBySlug($slug)
    {
        return $this->productModel->where('slug', $slug)->with('shop', 'reviews', 'images', 'subCategory.category')->first();
    }

    public function update(array $product, $product_id)
    {
        return $this->productModel->find($product_id)->update($product);
    }

    public function delete($product_id)
    {
        return $this->productModel->find($product_id)->delete();
    }

    public function saveProductExtraImage($product_id, array $product_image)
    {
        return $this->productModel->find($product_id)->images()->create($product_image);
    }

    public function updateProductExtraImage($image_id, array $image_path)
    {
        return ProductImage::find($image_id)->update($image_path);
    }

    public function deleteProductImages($product_id)
    {
        return $this->productModel->find($product_id)->images()->delete();
    }

    public function getProductExtraImages($product_id)
    {
        return $this->productModel->find($product_id)->images;
    }

    public function getTrendingProducts($limit = 6)
    {
        return $this->productModel->where('status', 1)->inRandomOrder()->limit($limit)->paginate(24);
    }

    public function getShopsByProductCategory($subCategoryId)
    {
        $query = DB::table(Product::getTableName())
            ->join('shop_contact_info', Product::getTableName() . '.shop_id', '=', 'shop_contact_info.shop_id')
            ->where('sub_category_id', $subCategoryId)
            ->select('tel')
            ->groupBy('tel')
            ->get();
        return collect($query);
    }

    public function getShopsBySubCategory($searchCriteria)
    {
        $subCategoryId = $searchCriteria['subCategory'];
        $regionFilter = $searchCriteria['region'];
        $townFilter = $searchCriteria['town'];
        $streetFilter = $searchCriteria['street'];
        if ($regionFilter) {
            if ($townFilter) {
                if ($streetFilter) {
                    //get all streets for a given street id
                    $query = DB::table('shops')
                        ->join('users', 'shops.user_id', '=', 'users.id')
                        ->join('shop_contact_info', 'shops.id', '=', 'shop_contact_info.shop_id')
                        ->where('category_id', $subCategoryId)
                        ->where('street_id', $streetFilter)
                        ->select('shop_contact_info.tel', 'users.email', 'shops.id')
                        // ->groupBy('tel')
                        ->get();
                } else {
                    //get all shops for a given town
                    $query = DB::table('shops')
                        ->join('users', 'shops.user_id', '=', 'users.id')
                        ->join('shop_contact_info', 'shops.id', '=', 'shop_contact_info.shop_id')
                        ->join('streets', 'shop_contact_info.street_id', '=', 'streets.id')
                        ->join('towns', 'streets.town_id', '=', 'towns.id')
                        ->where('category_id', $subCategoryId)
                        ->where('towns.id', $townFilter)
                        ->select('shop_contact_info.tel', 'users.email', 'shops.id')
                        //->groupBy('tel')
                        ->get();
                }
            } else {
                //get all shops for a given region
                $query = DB::table('shops')
                    ->join('users', 'shops.user_id', '=', 'users.id')
                    ->join('shop_contact_info', 'shops.id', '=', 'shop_contact_info.shop_id')
                    ->join('streets', 'shop_contact_info.street_id', '=', 'streets.id')
                    ->join('towns', 'streets.town_id', '=', 'towns.id')
                    ->join('regions', 'towns.region_id', '=', 'regions.id')
                    ->where('shops.category_id', $subCategoryId)
                    ->where('towns.region_id', $regionFilter)
                    ->select('shop_contact_info.tel', 'users.email', 'shops.id as shop_id')
                    //->groupBy('tel')
                    ->get();
            }
        } else {
            $query = DB::table('shops')
                ->where('category_id', $subCategoryId)
                ->join('users', 'shops.user_id', '=', 'users.id')
                ->join('shop_contact_info', 'shops.id', '=', 'shop_contact_info.shop_id')
                ->select('shop_contact_info.tel', 'users.email', 'shops.id')
                // ->groupBy('tel')
                ->get();
        }
        $queryCollection = collect($query);
        $shopIds = $queryCollection->pluck('shop_id')->groupBy('shop_id')->flatMap(function ($val) {
            return $val;
        })->toArray();
        //find all shops from the filtered list with those subscriptions
        $premiumShopIds = $this->findShopsActiveSubscription($shopIds)->pluck('shop_id')->toArray();
        $tels = $queryCollection->whereIn('shop_id', $premiumShopIds)->pluck('tel')->groupBy('tel')->flatMap(function ($val) {
            return $val;
        });
        $emails = $queryCollection->pluck('email')->groupBy('email')->flatMap(function ($val) {
            return $val;
        });
        //find all shops with an active subscriptions
        $response = array("tel" => $tels, "email" => $emails);
        return $response;
    }

    private function findShopsActiveSubscription($shopIds)
    {
        $query = DB::table("shop_subscriptions")
            ->whereIn('shop_id', $shopIds)
            ->where('end_date', '>=', Carbon::now())
            ->select('shop_id')
            ->get();
        return collect($query);
    }
}
