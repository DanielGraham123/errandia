<?php


namespace Modules\Product\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\ProductQuoteImage;
use Modules\Product\Entities\ProductQuote;

class ProductQuoteRepository
{
    protected $quoteModel;
    protected $productQuoteImageModel;

    public function __construct(ProductQuote $model, ProductQuoteImage $modelImage)
    {
        $this->quoteModel = $model;
        $this->productQuoteImageModel = $modelImage;
    }

    public function create(array $quote)
    {
        return $this->quoteModel->create($quote);
    }

    public function saveQuoteImage($quote_id, array $quote_image)
    {
        dd( $this->quoteModel->find($quote_id));
//        return $this->quoteModel->find($quote_id)->images()->create($quote_image);
    }

    public function findById($quote_id)
    {
        return $this->quoteModel->where('id', $quote_id)->with('product', 'user')->first();
    }
    public function findDeletedById($quote_id)
    {
        return $this->quoteModel->where('id', $quote_id)->withTrashed()->with('product', 'user')->first();
    }

    public function findQuoteBySlugUrl($slug)
    {

        return $this->quoteModel->where('slug', $slug)->with('category.category', 'images')->first();
    }

    public function update(array $quote, $quote_id)
    {
        return $this->quoteModel->find($quote_id)->update($quote);
    }

    public function delete($quote_id)
    {
        return $this->quoteModel->find($quote_id)->delete();
    }

    public function findByProductId($product_id)
    {
        return $this->quoteModel->all()->where('product_id', $product_id);
        //return $this->reviewModel->where('product_id', $product_id)->with('product', 'user')->first();
    }

    public function getAll()
    {
        return $this->quoteModel->all();
        //return $this->reviewModel->where('product_id', $product_id)->with('product', 'user')->first();
    }

    public function findUserDetailsByProductId($product_id)
    {
        $UserDetails = $this->quoteModel::select('product_quote.*', 'users.name')
            ->join('users', 'users.id', '=', 'product_quote.buyer_id')
            ->where('product_quote.product_id', "=", $product_id)
            ->get();

        return $UserDetails;
    }

    public function getQuoteImages($quote_id)
    {
        $allImages = $this->productQuoteImageModel::select('product_quote_images.*')
            ->where('product_quote_images.quote_id', "=", $quote_id)
            ->get();

        return $allImages;
    }

    public function getAllQuotesForShopOwner($UserID)
    {
        //return  $this->enquiryModel->all();
        $QuotesDetails = $this->quoteModel::select('product_quote.*')
            ->join('products', 'product_quote.sub_category_id', "=", 'products.sub_category_id')
            ->join('shops', 'shops.id', "=", 'products.shop_id')
            ->where('shops.user_id', '=', $UserID)
            //->groupBy('product_quote.id')
            //->havingRaw('count(product_quote.title) > ?', [1])
            ->get();
        //print_r($EnquiriesDetails);die;
        return $QuotesDetails;
    }

    public function getAllShopProductQuotes($shopId)
    {
//'LIKE', "%{$searchFilters['search']}%",
        $query = DB::table('product_quote')
            ->join('shops', 'product_quote.categories', 'LIKE', 'shops.category_id')
            ->select('product_quote.*','product_quote.id as id', 'title', 'phone_number', 'product_quote.description as description')
            ->where('shops.id', $shopId)
            ->paginate(20);
        return $query;
    }

    public function getPaginatedUserProductQuotes($userId)
    {
        $query = DB::table('product_quote')
            ->select('product_quote.id as id', 'title', 'phone_number', 'product_quote.description as description', 'created_at as date')
            ->where('UserID', $userId)
            ->paginate(20);
        return $query;
    }
}
