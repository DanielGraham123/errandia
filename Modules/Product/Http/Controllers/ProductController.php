<?php

namespace Modules\Product\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Product\Http\Requests\AddProductRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Modules\Product\Services\ProductService;
use Modules\Product\Services\ProductReviewService;
use Modules\Product\Services\ProductEnquiryService;
use Modules\Product\Services\ProductReplyService;
use Modules\ProductCategory\Entities\SubCategory;
use Modules\ProductCategory\Services\CategoryService;
use Modules\Shop\Entities\Shop;
use Modules\Shop\Services\ShopService;
use Modules\User\Services\Interfaces\UserServiceInterface;
use Modules\Utility\Services\ImageUploadService;
use Modules\Utility\Services\UtilityService;
use Modules\User\Services\UserService;
use Modules\Product\Services\ProductQuoteService;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    private $productService;
    private $utilityService;
    private $ProductQuoteService;
    private $SubCategory;

    public function __construct(ProductService $productService, UtilityService $utilityService, ProductQuoteService $ProductQuoteService,SubCategory $SubCategory)
    {
        $this->productService = $productService;
        $this->utilityService = $utilityService;
        $this->ProductQuoteService = $ProductQuoteService;
        $this->SubCategory = $SubCategory;
    }

    public function showAddProductPage(CategoryService $categoryService)
    {

        $data['categories'] = $this->SubCategory->getAllSubCategories();
        $data['currencies'] = $this->utilityService->getCurrencies();
        return view('product::create')->with($data);
    }

    public function addProduct(AddProductRequest $request, ImageUploadService $imageUploadService)
    {
        $shop_id = $this->utilityService->getCurrentUserShop()->id;
        $add_product_dto = $request->getProductDTO();
        $add_product_dto["shop_id"] = $shop_id;
        $add_product_dto['status'] = 1;
        $add_product_dto['discount'] = 0;
        $add_product_dto['slug'] = $this->utilityService->generateRandSlug();
        //save product
        DB::transaction(function () use ($request, $add_product_dto, $imageUploadService) {
            $product = $this->productService->saveProduct($add_product_dto);
            if ($product) {
                if ($request->image){
                    $this->saveImage($product,$request->image);
                }
                $this->utilityService->indexProduct($product->id);
            }
        });

        $request->session()->flash('message', trans('vendor.add_product_success_msg'));
        return redirect()->route('products')
            ->with(['success' => trans('vendor.add_product_success_msg')]);
    }
    public function saveImage($product,$images=[]){
        if (count($images) >0){
            foreach ($images as $k=>$image){
                if(isset($image)){
                    // $folderPath = storage_path("app/public/products/");
                    $name = $this->utilityService->generateRandSlug() . "_" . time() . '.png';
                    $folderPath = config("filesystems.disks.public.root") . "/products/";
                    $image_parts = explode(";base64,", $image);
                    $image_base64 = base64_decode($image_parts[1]);
                    $file = $folderPath . $name;
                    $path =  "products/" . $name;
                    file_put_contents($file, $image_base64);
                    if($product->featured_image_path == 'default.jpg'){
                        $product->featured_image_path = $path;
                        $product->save();
                    }
                    $this->productService->saveProductImages($product->id, ['image_path' => $path, 'product_id' => $product->id]);
                }
            }
        }

    }

    public
    function showEditProductPage($slug, CategoryService $categoryService)
    {
        $productExist = $this->productService->findProductBySlug($slug);
        if (!$productExist) {
            return redirect()->back()->withErrors([trans('vendor.show_product_not_exist_msg')]);
        }
        $data['product'] = $productExist;
        $data['categories'] = $categoryService->getActiveCategories();
        $data['currencies'] = $this->utilityService->getCurrencies();;
        return view('product::edit')->with($data);
    }

    public
    function updateProduct(UpdateProductRequest $request, $slug, ImageUploadService $imageUploadService)
    {
        $productExist = $this->productService->findProductBySlug($slug);
        if (!$productExist) {
            return redirect()->back()->withErrors([trans('vendor.show_product_not_exist_msg')]);
        }
        $update_product_dto = $request->getProductDTO();
        //update product
        DB::transaction(function () use ($request, $productExist, $update_product_dto, $imageUploadService) {
            $product = $this->productService->updateProduct($update_product_dto, $productExist->id);


            if ($product) {
                //update the extra images for product if exist
                $extraProductImages = $request->getExtraProductImages();
                if (count($extraProductImages) > 0) {
                    foreach ($extraProductImages as $image) {
                        //upload image then save to db
                        $imagePath = $imageUploadService->uploadFile($image, key($image), "products");
                        $counter = 1;
                        foreach ($productExist->images->sortDesc() as $image_exist) {
                            if ('product-' . $counter == key($image)) {
                                $this->productService->updateProductImage($image_exist->id, ['image_path' => $imagePath]);
                                //delete the previous file from file system
                                $imageUploadService->deleteFile($image_exist->image_path);
                            }
                            $counter++;
                        }
                    }
                }

                if ($request->image){
                    $this->saveImage($productExist,$request->image);
                }
                $this->utilityService->indexProduct($productExist->id);
            }
        });
        $request->session()->flash('message', trans('vendor.update_product_success_msg'));
        return redirect()->route('products')->with(['success' => trans('vendor.update_product_success_msg')]);
    }

    public
    function showUserProducts(ShopService $shopService)
    {
        $user_shop = $this->utilityService->getCurrentUserShop();
        $products = $shopService->getProductsByShop($user_shop->id);
        $data['products'] = $products;
        $data['currencies'] = $this->utilityService->getCurrencies();
        $data['shop'] = $user_shop;
        return view("product::index")->with($data);
    }

    public function showProductDetails($slug, ShopService $shopService, CategoryService $categoryService, ProductReviewService $ProductReviewService, UserService $UserService, ProductEnquiryService $ProductEnquiryService, ProductReplyService $ProductReplyService)
    {
        $productExist = $this->productService->findProductBySlug($slug);
        if (!$productExist) {
            return redirect()->back()->withErrors([trans('vendor.show_product_not_exist_msg')]);
        }
        $shopProducts = $shopService->getProductsByShop($productExist->shop->id);
        //filter out products not in current selected
        $shopOtherProducts = $shopProducts->filter(function ($product) use ($productExist) {
            return $product->id != $productExist->id;
        });
        //get products from same category
        $otherProductsByCategory = $categoryService->findProductsBySubCategory($productExist->sub_category_id);
        $otherProductsByCategoryFiltered = $otherProductsByCategory->filter(function ($product) use ($productExist) {
            return $product->shop_id != $productExist->shop_id;
        });
        $data['product'] = $productExist;
        $data['otherShopProducts'] = $shopOtherProducts;
        $data['otherProductsCategory'] = $otherProductsByCategoryFiltered;
        $currencies = $this->utilityService->getCurrencies();
        $data['currency'] = $currencies->where('id', $productExist->currency_id)->first();

        // FOR PRODUCT REVIEW
        $data['ReviewData'] = $ProductReviewService->findReviewByProductId($data['product']->id);
        $reviewData = array();
        $reviewImages = array();
        $userid = auth()->id();
        $data['CommentEligible'] = 0;
        $count = 0;
        $totalrating = 0;
        $star[1] = 0;
        $star[2] = 0;
        $star[3] = 0;
        $star[4] = 0;
        $star[5] = 0;
        foreach ($data['ReviewData'] as $review) {
            $userDetails = $UserService->findUserByID($review->buyer_id);
            $reviewData[$review->buyer_id]['user_name'] = $userDetails->name;
            $reviewImages[$review->id]['images'] = $ProductReviewService->getReviewImages($review->id);
            $count++;
            $totalrating = $totalrating + $review->rating;
            $star[$review->rating] = $star[$review->rating] + 1;
            if ($userid == $review->buyer_id) {
                $data['CommentEligible'] = 1;
            }
        }
        if ($count != 0)
            $avg = number_format($totalrating / $count, 1);
        else
            $avg = 0;

        $data['UserName'] = $reviewData;
        $data['reviewImages'] = $reviewImages;
        $data['avgRating'] = $avg;

        // FOR ENQUIRY AND REPLY
        $data['EnquiryData'] = $ProductEnquiryService->findUserDetailsByProductId($data['product']->id);

        $i = 0;
        foreach ($data['EnquiryData'] as $enquiry) {
            $data['conversation'][$enquiry->id][$i]['mode'] = 'enquiry';
            $data['conversation'][$enquiry->id][$i]['title'] = $enquiry->title;
            $data['conversation'][$enquiry->id][$i]['description'] = $enquiry->description;
            $data['conversation'][$enquiry->id][$i]['created_at'] = $enquiry->created_at;
            $data['conversation'][$i]['images'] = $ProductEnquiryService->getEnquiryImages($enquiry->id);

            $replyData = $ProductReplyService->findByEnquiryId($enquiry->id);
            foreach ($replyData as $reply) {
                ++$i;
                $data['conversation'][$enquiry->id][$i]['mode'] = 'reply';
                $data['conversation'][$enquiry->id][$i]['reply'] = $reply->reply;
                $data['conversation'][$enquiry->id][$i]['created_at'] = $enquiry->created_at;
            }
        }

        return view("product::show")->with($data);
    }

    /**
     * Post enquiry action
     */
    public function postReply(ProductReplyService $ProductReplyService)
    {
        $userid = auth()->id();
        $replyData['reply'] = $_POST['reply'];
        $replyData['enquiry_id'] = $_POST['enquiry_id'];
        $replyData['shopowner_id'] = $userid;
        $replyData['created_at'] = date("Y-m-d h:i:s");

        $user_account = $ProductReplyService->saveEnquiryReply($replyData);
        session()->flash('message', trans('Reply successfully sent !'));
        return redirect()->route('show_product', ['id' => $_POST['slug']])->with(['success' => trans('Reply successfully sent !')]);
    }

    public function postReplyFromEnquiryDetails(ProductReplyService $ProductReplyService)
    {
        $userid = auth()->id();
        $replyData['reply'] = $_POST['reply'];
        $replyData['enquiry_id'] = $_POST['enquiry_id'];
        $replyData['shopowner_id'] = $userid;
        $replyData['created_at'] = date("Y-m-d h:i:s");

        $user_account = $ProductReplyService->saveEnquiryReply($replyData);
        session()->flash('message', trans('Reply successfully sent !'));
        return redirect()->route('product_enquiry_details', ['id' => $_POST['enquiry_id']])->with(['success' => trans('Reply successfully sent !')]);
    }

    public function deleteProduct($product_slug, ImageUploadService $imageUploadService)
    {
        $productExist = $this->productService->findProductBySlug($product_slug);
        if (!$productExist) {
            return redirect()->back()->withErrors([trans('vendor.show_product_not_exist_msg')]);
        }
        //check if product has reviews if yes, can't delete
        if (!$productExist->reviews->isEmpty()) return redirect()->back()->withErrors([trans('vendor.delete_product_review_exist_msg')]);
        //check if product got an order request before

        DB::transaction(function () use ($productExist) {
            //delete product images
            $this->productService->deleteProduct($productExist->id);
        });
        //delete product featured image
        $imageUploadService->deleteFile($productExist->featured_image_path);

        //delete product extra images
        foreach ($productExist->images as $image) {
            $imageUploadService->deleteFile($image->image_path);
        }
        session()->flash('message', trans('vendor.delete_product_success_msg'));
        return redirect()->route('products')->with(['success' => trans('vendor.delete_product_success_msg')]);
    }

    // FOR PRODUCT QUOTES
    public function showProductQuotes(ProductQuoteService $ProductQuoteService)
    {
        $shop_id =  $this->utilityService->getCurrentUserShop()->id;

        $shop = Shop::find($shop_id);
        $data['quotes'] = $shop->quotes()->paginate(20);
        $ProductQuoteService->getAllShopProductQuotes($shop_id);
        return view("product::show_quotes")->with($data);
    }

    public function showProductQuoteDetails($QuoteID, ProductQuoteService $ProductQuoteService)
    {

        $quote = $ProductQuoteService->findQuoteById($QuoteID);
        $data['quote']  = $quote;
        $data['quoteImages'] = $ProductQuoteService->getQuoteImages($QuoteID);
        $quote->read_status = 1;
        $quote->save();

        return view("product::show_quote_details")->with($data);
    }

    public function deleteQuote($QuoteID, ProductQuoteService $ProductQuoteService){
        $quote = $ProductQuoteService->findQuoteById($QuoteID);
        $quote->delete();
        return redirect()->route('product_quote_list');
    }

    // FOR PRODUCT ENQUIRIES
    public function showProductEnquiries(ProductEnquiryService $ProductEnquiryService)
    {
        $shop_id = $this->utilityService->getCurrentUserShop()->id;
        $data['enquiries'] = $ProductEnquiryService->getPaginatedShopEnquiries($shop_id);
        return view("product::show_enquiries")->with($data);
    }

    public function showProductEnquiryDetails($EnquiryID, ProductEnquiryService $ProductEnquiryService, ProductReplyService $ProductReplyService)
    {
        $data['enquiry'] = $ProductEnquiryService->findEnquiryById($EnquiryID);
        $data['enquiryImages'] = $ProductEnquiryService->getEnquiryImages($EnquiryID);

        // FOR ENQUIRY AND REPLY
        $data['EnquiryData'] = $ProductEnquiryService->findUserDetailsByProductId($data['enquiry']->product_id);

        $i = 0;
        foreach ($data['EnquiryData'] as $enquiry) {
            $data['conversation'][$enquiry->id][$i]['mode'] = 'enquiry';
            $data['conversation'][$enquiry->id][$i]['title'] = $enquiry->title;
            $data['conversation'][$enquiry->id][$i]['description'] = $enquiry->description;
            $data['conversation'][$enquiry->id][$i]['created_at'] = $enquiry->created_at;
            $data['conversation'][$i]['images'] = $ProductEnquiryService->getEnquiryImages($enquiry->id);

            $replyData = $ProductReplyService->findByEnquiryId($enquiry->id);
            foreach ($replyData as $reply) {
                ++$i;
                $data['conversation'][$enquiry->id][$i]['mode'] = 'reply';
                $data['conversation'][$enquiry->id][$i]['reply'] = $reply->reply;
                $data['conversation'][$enquiry->id][$i]['created_at'] = $enquiry->created_at;
            }
        }

        return view("product::show_enquiry_details")->with($data);
    }

    // FOR PRODUCT REVIEWS
    public function showProductReviews(ProductReviewService $ProductReviewService)
    {
        $shop_id = $this->utilityService->getCurrentUserShop()->id;
        $data['reviews'] = $ProductReviewService->getPaginatedReviewsForShop($shop_id);
        return view("product::show_reviews")->with($data);
    }

    public function showProductReviewDetails($ReviewID, ProductReviewService $ProductReviewService)
    {
        $data['review'] = $ProductReviewService->findReviewById($ReviewID);
        $data['reviewImages'] = $ProductReviewService->getReviewImages($ReviewID);
        return view("product::show_review_details")->with($data);
    }

    public function showProductList(shopService $shopService)
    {
        $user_shop = $this->utilityService->getCurrentUserShop();
        $products = $shopService->getProductsByShop($user_shop->id);
        $data['products'] = $products;
        $data['currencies'] = $this->utilityService->getCurrencies();
        $data['shop'] = $user_shop;
        return view("product::show_product_list")->with($data);
    }

    public function hideProductReview(Request $request,ProductReviewService $productReviewService)
    {
        $review_id = $request->get('id');
        $data = array('status'=>0);
        $productReviewService->updateReview($data,$review_id);
        return redirect()->back()->with('success',trans('vendor.hide_user_review_success'));
    }
}
