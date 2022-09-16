<?php


namespace Modules\Product\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\ProductEnquiryImage;
use Modules\Product\Entities\ProductEnquiry;

class ProductEnquiryRepository
{
    protected $enquiryModel;
    protected $productEnquiryImageModel;

    public function __construct(ProductEnquiry $model, ProductEnquiryImage $modelImage)
    {
        $this->enquiryModel = $model;
        $this->productEnquiryImageModel = $modelImage;
    }

    public function create(array $enquiry)
    {
        return $this->enquiryModel->create($enquiry);
    }

    public function saveEnquiryImage($enquiry_id, array $enquiry_image)
    {
        return $this->enquiryModel->find($enquiry_id)->images()->create($enquiry_image);
    }

    public function findById($enquiry_id)
    {
        return $this->enquiryModel->where('id', $enquiry_id)->with('product', 'user')->first();
    }

    public function update(array $enquiry, $enquiry_id)
    {
        return $this->enquiryModel->find($enquiry_id)->update($enquiry);
    }

    public function delete($enquiry_id)
    {
        return $this->enquiryModel->find($enquiry_id)->delete();
    }

    public function findByProductId($product_id)
    {
        return $this->enquiryModel->all()->where('product_id', $product_id);
        //return $this->reviewModel->where('product_id', $product_id)->with('product', 'user')->first();
    }

    public function findUserDetailsByProductId($product_id)
    {
        $UserDetails = $this->enquiryModel::select('product_enquiry.*', 'users.name')
            ->join('users', 'users.id', '=', 'product_enquiry.buyer_id')
            ->where('product_enquiry.product_id', "=", $product_id)
            ->get();

        return $UserDetails;
    }

    public function getEnquiryImages($enquiry_id)
    {
        $allImages = $this->productEnquiryImageModel::select('product_enquiry_images.*')
            ->where('product_enquiry_images.enquiry_id', "=", $enquiry_id)
            ->get();

        return $allImages;
    }

    public function getAll()
    {
        //return  $this->enquiryModel->all();
        $EnquiriesDetails = $this->enquiryModel::select('product_enquiry.*', 'users.name as UserName', 'products.name as ProductName')
            ->join('users', 'users.id', '=', 'product_enquiry.buyer_id')
            ->join('products', 'product_enquiry.product_id', "=", 'products.id')
            ->get();
        //print_r($EnquiriesDetails);die;
        return $EnquiriesDetails;
    }

    public function getAllEnquiriesForShopOwner($UserID)
    {
        $EnquiriesDetails = $this->enquiryModel::select('product_enquiry.*', 'users.name as UserName', 'products.name as ProductName')
            ->join('users', 'users.id', '=', 'product_enquiry.buyer_id')
            ->join('products', 'product_enquiry.product_id', "=", 'products.id')
            ->join('shops', 'shops.id', "=", 'products.shop_id')
            ->where('shops.user_id', '=', $UserID)
            ->get();
        return $EnquiriesDetails;
    }

    public function getPaginatedShopEnquiries($shopId)
    {
        $query = DB::table('product_enquiry')
            ->join('users', 'users.id', '=', 'product_enquiry.buyer_id')
            ->join('products', 'product_enquiry.product_id', "=", 'products.id')
            ->join('shops', 'shops.id', "=", 'products.shop_id')
            ->select('product_enquiry.*', 'users.name as UserName', 'products.name as ProductName')
            ->where('products.shop_id', $shopId)
            ->paginate(20);
        return $query;
    }
    public function getPaginatedUserEnquiries($userId)
    {
        $query = DB::table('product_enquiry')
            ->join('users', 'users.id', '=', 'product_enquiry.buyer_id')
            ->join('products', 'product_enquiry.product_id', "=", 'products.id')
            ->join('shops', 'shops.id', "=", 'products.shop_id')
            ->select('product_enquiry.*', 'users.name as UserName',
                'products.name as ProductName','product_enquiry.created_at as date','shops.name as shop_name')
            ->where('buyer_id', $userId)
            ->paginate(20);
        return $query;
    }
}
