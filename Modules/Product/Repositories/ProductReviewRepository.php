<?php


namespace Modules\Product\Repositories;

use Modules\Product\Entities\ProductReviewImage;
use Modules\Product\Entities\ProductReview;
use DB;

class ProductReviewRepository
{
    protected $reviewModel;
    protected $productReviewImageModel;

    public function __construct(ProductReview $model, ProductReviewImage $modelImage)
    {
        $this->reviewModel = $model;
        $this->productReviewImageModel = $modelImage;
    }

    public function create(array $review)
    {
        return $this->reviewModel->create($review);
    }

    public function saveReviewImage($review_id, array $review_image)
    {
        return $this->reviewModel->find($review_id)->images()->create($review_image);
    }

    public function findById($review_id)
    {
        return $this->reviewModel->where('id', $review_id)->with('product', 'user')->first();
    }

    public function update(array $review, $review_id)
    {
        return $this->reviewModel->find($review_id)->update($review);
    }

    public function delete($review_id)
    {
        $status = false;
        DB::transaction(function () use ($review_id, $status) {
            $model = $this->reviewModel->find($review_id)->with('images')->first();
            $model->images()->delete();
            $status = $model->delete();
        });
        return $status;
    }

    public function findByProductId($product_id)
    {
        //return  $this->reviewModel->all()->where('product_id', $product_id)->orderByRaw('id', 'desc');
        //return $this->reviewModel->where('product_id', $product_id)->with('product', 'user')->first();
        $allReviews = $this->reviewModel::select('product_reviews.*')
            ->where('product_reviews.product_id', "=", $product_id)
            ->orderBy('id', 'desc')
            ->get();

        return $allReviews;
    }

    public function getReviewImages($review_id)
    {
        $allImages = $this->productReviewImageModel::select('product_review_images.*')
            ->where('product_review_images.review_id', "=", $review_id)
            ->get();

        return $allImages;
    }

    public function getAll()
    {
        //return  $this->enquiryModel->all();
        $ReviewDetails = $this->reviewModel::select('product_reviews.*', 'users.name as UserName', 'products.name as ProductName', 'products.slug as slug')
            ->join('users', 'users.id', '=', 'product_reviews.buyer_id')
            ->join('products', 'product_reviews.product_id', "=", 'products.id')
            ->get();
        //print_r($EnquiriesDetails);die;
        return $ReviewDetails;
    }

    public function getAllReviewForShopOwner($UserID)
    {
        //return  $this->enquiryModel->all();
        $ReviewDetails = $this->reviewModel::select('product_reviews.*', 'users.name as UserName', 'products.name as ProductName', 'products.slug as slug')
            ->join('users', 'users.id', '=', 'product_reviews.buyer_id')
            ->join('products', 'product_reviews.product_id', "=", 'products.id')
            ->join('shops', 'shops.id', "=", 'products.shop_id')
            ->where('shops.user_id', '=', $UserID)
            ->get();
        return $ReviewDetails;
    }

    public function getPaginatedReviewsForShop($shopId)
    {
        $reviews = DB::table("product_reviews")
            ->join('users', 'buyer_id', '=', 'users.id')
            ->join('products', 'products.id', '=', 'product_reviews.product_id')
            ->join('shops', 'shops.id', '=', 'products.shop_id')
            ->where('products.shop_id', $shopId)
            ->select('product_reviews.id as review_id', 'rating', 'review',
                'product_reviews.created_at as review_date', 'users.name as user_name', 'product_reviews.status as review_status',
                'products.featured_image_path as product_image', 'products.name as product_name', 'products.slug as slug')
            ->paginate(25);
        return $reviews;
    }

    public function getPaginatedReviewsForUser($userId)
    {
        $reviews = DB::table("product_reviews")
            ->join('users', 'buyer_id', '=', 'users.id')
            ->join('products', 'products.id', '=', 'product_reviews.product_id')
            ->where('buyer_id', $userId)
            ->select('product_reviews.id as review_id', 'rating', 'review',
                'product_reviews.created_at as review_date', 'users.name as user_name', 'product_reviews.status as review_status',
                'products.featured_image_path as product_image', 'products.name as product_name',
                'products.slug as slug', 'product_reviews.created_at as date')
            ->paginate(25);
        return $reviews;
    }

    public function getProductReviewImagesByIds($reviewIds)
    {
        $reviewImages = DB::table("product_review_images")
            ->whereIn('review_id', $reviewIds)
            ->get();
        return collect($reviewImages);
    }
}
