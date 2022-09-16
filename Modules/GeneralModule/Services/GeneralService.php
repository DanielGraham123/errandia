<?php


namespace Modules\GeneralModule\Services;
/*
 * @Author:Dieudonne Dengun
 * @Date: 09/04/2021
 */

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Modules\Product\Repositories\ProductRepository;
use Modules\ProductCategory\Repositories\ProductCategoryRepository;
use Modules\ProductCategory\Repositories\ProductSubCategoryRepository;
use Modules\Shop\Repositories\ShopRepository;
use Modules\Slider\Entities\Slider;

class GeneralService
{
    private $productRepository;
    private $categoryRepository;
    private $productCategoryRepository;
    private $shopRepository;
	private $Slider;
    public function __construct(ProductRepository $productRepository,
                                ProductSubCategoryRepository $productSubCategoryRepository,
                                ProductCategoryRepository $productCategoryRepository,
                                ShopRepository $shopRepository,Slider $Slider)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $productSubCategoryRepository;
        $this->productCategoryRepository = $productCategoryRepository;
        $this->shopRepository = $shopRepository;
		$this->Slider = $Slider; 
    }

    /*
     * get trending products
     * Trending products are recently bought or viewed products. current implementation should take
     */
    public function getTrendingProducts()
    {
        $products = $this->productRepository->getTrendingProducts();
        $tredningProducts = View::make('product::partials.scrollable_product_list', ['shopProducts' => $products, 'product_route_name' => "general_product_details", 'title' => trans('general.components_trending_products_title')]);
        return $tredningProducts;
    }

    /*
     * Popular shops are shops with more product requests, reviews, and active subscriptions
     */
    public function getPopularShops()
    {
        $shopList = $this->shopRepository->getRandomActiveShops();
        $shopListView = View::make('helep.general.components.shop_list', ['shops' => $shopList]);
        return $shopListView;
    }

    /*
     * Popular categories are those with more products, product requests and reviews
     */
    public function getPopularCategories()
    {
        return $this->productCategoryRepository->getPopularCategories();
    }

    /*
     * @Author:Dieudonne Dengun
     * popular sub categories
     */
    public function getFeatureCollection()
    {
        return $this->categoryRepository->getFeaturedCollections();
    }
	
    /*
     * Hot deals are products which have been given a discount for a said period
     */
    public function getHotDeals()
    {

    }

    /*
     * Select a random sub category with at least 4 products
     */
    public function getRandomFeatureCategoryProducts()
    {
        $products = $this->categoryRepository->getFeaturedCategoryProducts();
        $catProducts = View::make('helep.general.components.category_product_list', ['products' => $products]);
        return $catProducts;
    }

    public function generateProductViewListByData($title, $products)
    {
        $productView = View::make('helep.general.components.category_product_list', ['products' => $products, 'category' => $title]);
        return $productView;
    }

    public function getRandShopsByIds(array $shop_ids)
    {
        return $this->shopRepository->getShopsByIds($shop_ids);
    }

    public function generateFeaturedShopsByIds(Collection $shops, $title)
    {
        $shopListView = View::make('helep.general.components.shop_card_list_grid', ['shops' => $shops, 'title' => $title]);
        return $shopListView;
    }

    //get randomly trending products
    public function getRandomProducts($limit = 10)
    {
        return $this->productRepository->getTrendingProducts($limit);
    }
	
	public function getAllSlider()
    {
		return $this->Slider->getAllSlider();
	}
}
