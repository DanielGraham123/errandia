<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Product\Services\ProductEnquiryService;
use Modules\Product\Services\ProductQuoteService;
use Modules\Product\Services\ProductReviewService;
use Modules\Shop\Services\ShopService;
use Modules\User\Http\Requests\UpdateCustomerProfileRequest;
use Modules\User\Services\Interfaces\UserServiceInterface;
use Modules\Utility\Services\Interfaces\UtilityServiceInterface;

class BuyerController extends Controller
{
    private $userService;
    private $utilityService;

    public function __construct(UserServiceInterface $userService, UtilityServiceInterface $utilityService)
    {
        $this->userService = $userService;
        $this->utilityService = $utilityService;
    }

    public function showUserEnquiryHistoryPage(ProductEnquiryService $productEnquiryService)
    {
        $data['enquiries'] = $productEnquiryService->getPaginatedUserEnquiries(get_user_id());
        return view('user::buyer.user_enquiry')->with($data);
    }

    public function showUserProductQuoteHistoryPage(ProductQuoteService $productQuoteService)
    {
        $data['quotes'] = $productQuoteService->getPaginatedUserProductQuotes(get_user_id());
        return view("user::buyer.user_product_quote")->with($data);
    }

    public function showUserProductReviewsPage(ProductReviewService $productReviewService)
    {
        $data['reviews'] = $productReviewService->getPaginatedReviewsForUser(get_user_id());
        return view("user::buyer.user_reviews")->with($data);
    }

    public function showUserShopSubscriptionPage(ShopService $shopService)
    {
        $data['subscriptions'] = $shopService->getPaginatedUserShopSubscription(get_user_id());
        return view("user::buyer.user_shop_subscription")->with($data);
    }

    public function updateCustomerProfileInfo(UpdateCustomerProfileRequest $request)
    {

        $profileData = $request->getUserProfileInfo();
        $profileData['user_id'] = get_user_id();
        //save user profile info
        if ($this->userService->saveUserProfileInfo(get_user_id(), $profileData)) {
            return redirect()->back()->with('success', trans('buyer.update_customer_profile_success'));
        }
        return redirect()->back()->withInput($request->all())->withErrors([trans('buyer.update_customer_profile_error')]);
    }

    public function deleteUserProductReview($reviewId, ProductReviewService $productReviewService)
    {
        $productReviewService->deleteReview($reviewId);
        return redirect()->back()->with('success', trans('buyer.delete_customer_review'));
    }

    public function updateUserProductReview($reviewId, Request $request, ProductReviewService $productReviewService)
    {
        $review = $request->get('review');
        $update = array('review' => $review);
        $productReviewService->updateReview($update, $reviewId);
        return response()->json(['status' => "success",'message'=>trans('buyer.update_customer_review')], 200);
    }
}
