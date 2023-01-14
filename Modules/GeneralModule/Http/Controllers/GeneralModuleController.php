<?php

namespace Modules\GeneralModule\Http\Controllers;

/*
 * @Author:Dieudonne Dengun
 * @Date: 09/04/2021
 * @Description: Handle general public application pages
 */

use App\Mail\accountCreated;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\GeneralModule\Services\GeneralService;
use Modules\Product\Services\ProductService;
use Modules\Product\Services\ProductReviewService;
use Modules\Product\Services\ProductEnquiryService;
use Modules\Product\Services\ProductReplyService;
use Modules\Product\Http\Requests\AddReviewRequest;
use Modules\Product\Http\Requests\AddEnquiryRequest;
use Modules\User\Services\UserService;
use Modules\ProductCategory\Services\CategoryService;
use Modules\Shop\Services\ShopService;
use Modules\Utility\Services\UtilityService;
use Modules\Utility\Services\ImageUploadService;

class GeneralModuleController extends Controller
{

    private $generalService;
    private $utilityService;

    public function __construct(GeneralService $generalService, UtilityService $utilityService)
    {
        $this->generalService = $generalService;
        $this->utilityService = $utilityService;

    }

    public function showAppHomePage()
    {
        $data['collections'] = $this->generalService->getFeatureCollection();
        $data['categories'] = $this->generalService->getPopularCategories();
        $data['featuredShops'] = $this->generalService->getPopularShops();
        $data['sliders'] = $this->generalService->getAllSlider();

        // uncomment the function call below to clear cached data.
        // $this->clearCache();
        return view('generalmodule::index')->with($data);
    }
    public function clearCache(){

        $clearcache = Artisan::call('cache:clear');
        echo "Cache cleared<br>";
        $clearview = Artisan::call('view:clear');
        echo "View cleared<br>";
        $clearconfig = Artisan::call('config:cache');
        echo "Config cleared<br>";
        $clearRoute= Artisan::call('route:cache');
        echo "Route cleared<br>";
        echo $clearRoute;
    }
    public function showProductDetailsPage($product_slug, ProductService $productService, ProductReviewService $ProductReviewService, UserService $UserService, ShopService $shopService, CategoryService $categoryService, ProductEnquiryService $ProductEnquiryService, ProductReplyService $ProductReplyService)
    {
        $productExist = $productService->findProductBySlug($product_slug);
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
        $data['shopLocation'] = $this->utilityService->getShopAddressByShopContactId($productExist->shop->shopContactInfo->street_id);
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

        //For Enquiry
        if (isset($userid)) {
            $user_type = $this->utilityService->getCurrentUserType();
            $data['user_type'] = $user_type;
        }
        $data['EnquiryData'] = $ProductEnquiryService->findUserDetailsByProductId($data['product']->id);
        $i = 0;

        $data['conversation'] = array();
        foreach ($data['EnquiryData'] as $enquiry) {
            $data['conversation'][$i]['name'] = $enquiry->name;
            $data['conversation'][$i]['mode'] = 'enquiry';
            $data['conversation'][$i]['title'] = $enquiry->title;
            $data['conversation'][$i]['description'] = $enquiry->description;
            $data['conversation'][$i]['created_at'] = $enquiry->created_at;
            $data['conversation'][$i]['images'] = $ProductEnquiryService->getEnquiryImages($enquiry->id);

            $replyData = $ProductReplyService->findByEnquiryId($enquiry->id);
            foreach ($replyData as $reply) {
                ++$i;
                $data['conversation'][$i]['mode'] = 'reply';
                $data['conversation'][$i]['reply'] = $reply->reply;
                $data['conversation'][$i]['created_at'] = $enquiry->created_at;
            }
            $i++;
        }
        //print_r($data['conversation']);die;
        return view('generalmodule::product_details')->with($data);
    }

    /**
     * Post review action
     */
    public function postReview(ProductReviewService $ProductReviewService, ImageUploadService $imageUploadService, AddReviewRequest $request)
    {
        $userid = auth()->id();
        $reviewData['rating'] = $_POST['rating'];
        $reviewData['review'] = $_POST['Comments'];
        $reviewData['product_id'] = $_POST['product_id'];
        $reviewData['buyer_id'] = $userid;
        $reviewData['created_at'] = date("Y-m-d h:i:s");
        $reviewData['updated_at'] = date("Y-m-d h:i:s");
        $reviewData['status'] = 1;
        $reviewID = $ProductReviewService->saveProductReview($reviewData);


        //upload the extra images for product if exist
        $extraProductImages = $request->getReviewImages();
        // FOR REVIEW IMAGE
        if ($reviewID) {
            foreach ($request->image as $image) {
                if ($image) {
                    $imagePath = $imageUploadService->uploadFile(['image' => $image], 'image', "reviews");
                    $ProductReviewService->saveReviewImages($reviewID->id, ['image_path' => $imagePath, 'review_id' => $reviewID->id]);
                }
            }

        }

        session()->flash('message', trans('Review successfully saved !'));
        return redirect()->route('general_product_details', ['id' => $_POST['slug']])->with(['success' => trans('Review successfully saved !')]);
    }

    /**
     * Post enquiry action
     */
    public function postEnquiry(ProductEnquiryService $ProductEnquiryService, UserService $UserService, AddEnquiryRequest $request, ImageUploadService $imageUploadService)
    {
        $userid = auth()->id();
        $enquiryData['title'] = $_POST['Title'];
        $enquiryData['description'] = $_POST['Description'];
        $enquiryData['product_id'] = $_POST['product_id'];
        $enquiryData['buyer_id'] = $userid;
        $enquiryData['created_at'] = date("Y-m-d h:i:s");
        $enquiryData['updated_at'] = date("Y-m-d h:i:s");
        $enquiryID = $ProductEnquiryService->saveProductEnquiry($enquiryData);

        // FOR ENQUIRY IMAGE
        if ($enquiryID) {
            foreach ($request->image as $image) {
                if ($image) {
                    $imagePath = $imageUploadService->uploadFile(['image' => $image], 'image', "enquiry");
                    $ProductEnquiryService->saveEnquiryImages($enquiryID->id, ['image_path' => $imagePath, 'enquiry_id' => $enquiryID->id]);

                }
            }
        }


        $UserDetails = $UserService->findUserByID($userid);
        $ShopOwnerDetails = $UserService->findUserByID($_POST['ShopOwnerID']);
        // FOR MAIL
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // More headers
        $headers .= "From: <$UserDetails->email>" . "\r\n";
        //$headers .= 'Cc: myboss@example.com' . "\r\n";
        $to = $ShopOwnerDetails->email;
        $subject = "Inquiry from Helep";
        $message = "Title : " . $enquiryData['title'] . "\r\n";
        $message .= "Enquiry : " . $enquiryData['description'] . "\r\n";

        @mail($to, $subject, $message, $headers);

        session()->flash('message', trans('Enquiry successfully sent !'));
        return redirect()->route('general_product_details', ['id' => $_POST['slug']])->with(['success' => trans('Enquiry successfully sent !')]);
    }

    /*
     * @Description: show list of products under a category and associated sub categories
     */
    public function showCategoryProducts($categoryId, CategoryService $categoryService)
    {
        $categoryProducts = $categoryService->getCategoryProductsBySlug($categoryId);
        if (empty($categoryProducts)) {
            return redirect()->back()
                ->withErrors([trans('admin.category_not_found')]);
        }
        $categoryExist = $categoryService->findCategoryBySlug($categoryId);
        $data['category'] = $categoryExist;
        $data['products'] = $categoryProducts;
        return view('generalmodule::category_product_list')->with($data);
    }

    /*
     * @Description: get products for a sub category
     */
    public function showSubCategoryProducts($slug, CategoryService $categoryService)
    {
        $categoryExist = $categoryService->findSubCategoryBySlug($slug);
        if (empty($categoryExist)) {
            return redirect()->back()
                ->withErrors([trans('admin.category_not_found')]);
        }
        //get category products
        $categoryProducts = $categoryService->findProductsBySubCategory($categoryExist->id);
        //get related sub categories for host category
        $relatedSubCategories = $categoryService->getSubCategoriesByCategory($categoryExist->category_id);
        $filteredRelatedSubCategories = $relatedSubCategories->filter(function ($category) use ($categoryExist) {
            return $category->id != $categoryExist->id;
        });
        //get random shops having products under this sub category
//        $getCategoryFeaturedShops = $categoryProducts->isEmpty() ? collect([]) : $this->generalService->getRandShopsByIds($categoryProducts->keyBy('shop_id')->keys()->toArray());
//        $data['featuredCategoryShops'] = $this->generalService->generateFeaturedShopsByIds($getCategoryFeaturedShops, $title);
        $data['relatedSubCategories'] = $filteredRelatedSubCategories;
        $data['subCategoryProducts'] = $categoryProducts;
        $data['category'] = $categoryExist;
        $data['subCategories'] = $relatedSubCategories;
        $title = trans('general.product_category_shop_list_heading', ['title' => $categoryExist->name]);
        return view('generalmodule::sub_category_product_list')->with($data);
    }

    /**
     * @Description : Show list of categories available and their associated products
     *
     */
    public function showCategoryList(CategoryService $categoryService)
    {
        $data['categories'] = $this->generalService->getPopularCategories();
        $data['products'] = $this->generalService->getRandomProducts();
        $productSubCategoryIds = $data['products']->map(function ($category) {
            return $category->sub_category_id;
        })->toArray();
        $data['subCategories'] = $categoryService->getSubCategoriesByIds($productSubCategoryIds);
        return view('generalmodule::categories')->with($data);
    }

    /**
     * Show a shop details page or custom business profile
     */
    public function showShopProfilePage($shop_slug, ShopService $shopService, ProductReviewService $productReviewService)
    {
        // SHOP DETAILS
        $shopExist = $shopService->findShopBySlug($shop_slug);
        if (empty($shopExist)) {
            return redirect()->route('general_home')
                ->withErrors([trans('shop.shop_not_found')]);
        }
        //check if shop profile has been blocked from public view
        if ($shopExist->status == 0) {
            return redirect()->back()
                ->withErrors([trans('shop.shop_suspend_public_profile')]);
        }
        $reviews = $productReviewService->getPaginatedReviewsForShop($shopExist->id);
        $reviewIds = $reviews->pluck('review_id')->toArray();
        $reviewsImage = $productReviewService->getProductReviewImagesByIds($reviewIds);
        $data['reviews'] = $reviews;
        $data['reviewImages'] = $reviewsImage;
        $data['shopDetails'] = $shopExist;
        $data['address'] = $this->utilityService->getShopAddressByShopContactId($shopExist->shopContactInfo->street_id);
        $data['products'] = $shopService->getPaginatedProductsByShop($shopExist->id);

        return view('generalmodule::shop_details')->with($data);
    }

    /**
     * Subscribe to a shop by user
     */
    public function subscribeUserToShop(Request $request, ShopService $shopService)
    {
        $user_id = $request->get('user');
        $shop_id = $request->get('shop');
        $shopExist = $shopService->findShopById($shop_id);
        if (empty($shopExist)) {
            return redirect()->back()
                ->withErrors([trans('shop.shop_not_found')]);
        }
        $data = array('user_id' => $user_id, 'shop_id' => $shop_id);
        if (!empty($shopService->subscribeShopNotification($data))) {
            $message = trans('general.shop_user_subscribe_success', ['shop' => $shopExist->name]);
            session()->flash('message', $message);
            return redirect()->back()->with('message', $message);
        } else {
            $message = trans('general.shop_user_subscribe_error', ['shop' => $shopExist->name]);
            return redirect()->back()->withErrors([$message]);
        }
    }

    public function unSubscribeUserToShop(Request $request, ShopService $shopService)
    {
        $user_id = $request->get('user');
        $shop_id = $request->get('shop');
        $shopExist = $shopService->findShopById($shop_id);
        if (empty($shopExist)) {
            return redirect()->back()
                ->withErrors([trans('shop.shop_not_found')]);
        }
        if ($shopService->unSubscribeToShopNotification($user_id, $shop_id)) {
            $message = trans('general.shop_user_unsubscribe_success', ['shop' => $shopExist->name]);
            session()->flash('message', $message);
            return redirect()->back()->with('message', $message);
        } else {
            $message = trans('general.shop_user_unsubscribe_error', ['shop' => $shopExist->name]);
            return redirect()->back()->withErrors([$message]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('generalmodule::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
