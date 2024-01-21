<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Models\ReviewImage;
use App\Models\User;
use App\Notifications\ReviewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $reviews = new Review();
        if ($request->product_id) {
            $reviews = $reviews->where('item_id', $request->product_id);
        }
        $reviews = $reviews->orderBy('created_at', 'desc')->paginate(20);
        return response()->json(['data' => [
            'reviews' => ReviewResource::collection($reviews)
        ]]);
    }

    public function store(Request $request)
    {
        try {
            $result = DB::transaction(function () use ($request) {
                $user = auth('api')->user();
                $review = new Review();
                $review->item_id = $request->item_id;
                $review->buyer_id = $user->id;
                $review->rating = $request->rating;
                $review->review = $request->review;
                $review->status = true;
                $review->save();

                $count = intval($request->image_count ?? 0);
                for($i = 1; $i <= $count; $i++) {
                    $image_name = 'image_'. $i;
                    if ($request->file($image_name)) {
                        $image = new ReviewImage();
                        $image->review_id = $review->id; 
                        $image->image = $request->file($image_name)->store('reviews');
                        $image->save();
                    }
                }

                $shop_owner = $review->product->shop->user;
                if ($shop_owner && $user->id != $shop_owner->id) {
                    $data = [
                        'type' => 'review',
                        'name' => $user->name,
                        'body' => '<br>'. $user->name . ' wrote a review on your product, '. $review->product->name,
                        'message' => $user->name . ' wrote a review on your product, '. $review->product->name,
                        'profile' => $user->getProfileUrl()
                    ];
                    $shop_owner->notify(new ReviewNotification($data));
                }
                return $review;
            });

            return response()->json(['data' => [
                'review' => new ReviewResource($result)
            ]]);
        } catch(\Exception $e) {
            return response()->json(['data' => [
                'error' => $e->getMessage(),
                'message' => 'Sorry, We encountered an error'
            ]], 500);
        }
    }

    public function deleteReview()
    {

    }
}
