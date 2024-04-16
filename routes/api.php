<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\ProductImageUploadController;
use App\Http\Controllers\ProductUploadController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserController;

/*er;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->group(function (){
    Route::group(['namespace' => 'Api'], function() {
        Route::get('/auth/verify_token', 'AuthController@verifyToken');
        Route::post('/auth/refresh_token', 'AuthController@refreshToken');
        Route::delete('/auth/logout', 'AuthController@logout');

        Route::get('/user/shops', 'ShopController@getUserShops');
        Route::post('/user/shops', 'ShopController@store');
        Route::put('/user/shops/{slug}', 'ShopController@update');
        Route::delete('/user/shops/{slug}', 'ShopController@delete');
        Route::delete('/user/shops/{slug}/featured-image', 'ShopController@deleteFeaturedImage');
        Route::post('/user/shops/{slug}/send_otp', [ShopController::class, 'sendShopVerificationCode']);
        Route::post('/user/shops/{slug}/validate_otp', [ShopController::class, 'validateShopOTPCode']);

        Route::get("/user/products", "ProductController@getUserProducts");
        Route::get("/user/services", "ProductController@getUserServices");
        Route::post('/user/items', 'ProductController@store');
        Route::put("/user/items/{slug}", "ProductController@update");
        Route::post('/user/items/{slug}/images/upload', [ProductUploadController::class, 'addItemImage']);
        Route::delete('/user/items/{slug}/images/delete', [ProductUploadController::class, 'removeItemImage']);
        Route::delete('/user/items/{slug}/images/delete-all', [ProductUploadController::class, 'removeAllItemImages']);
        Route::delete("/user/items/{slug}", "ProductController@delete");
        Route::delete("/user/items/{slug}/featured-image", "ProductController@deleteFeaturedImage");

        // subscriptions endpoints

        Route::get("/user/subscriptions", "SubscriptionController@index");
        Route::post("/user/subscriptions", "SubscriptionController@store");
        Route::get("/user/subscription", "SubscriptionController@show");
        Route::get("/user/subscriptions/{id}/check-status", "SubscriptionController@checkStatus");

        Route::get("/user/errands", "ErrandController@user_errands");
        Route::get("/user/errands_received", "ErrandController@errands_received");
        Route::delete("/user/errands_received/{id}", "ErrandController@reject_errands_received");
        Route::post("/user/errands", "ErrandController@store");
        Route::get("/user/errands/{id}/run", "ErrandController@run_errand");
        Route::get("/user/errands/{id}/results", "ErrandController@load_errand_results");
        Route::post("/user/errands/{id}", "ErrandController@update");
        Route::put("/user/errands/{id}/marked_as_found", "ErrandController@marked_as_found");
        Route::post("/user/errands/{id}/add_image", "ErrandController@add_image");
        Route::delete("/user/errands/{id}/image/{image_id}", "ErrandController@delete_image");
        Route::delete("/user/errands/{id}/remove_images", "ErrandController@delete_images");
        Route::delete("/user/errands/{id}", "ErrandController@delete");
        Route::get("/user/errands/{id}", "ErrandController@load_errand");

        Route::get("/user/notifications", "AnnoucementController@index");
        Route::get("/user/notifications/{id}", "AnnoucementController@show");
        Route::delete("/user/notifications/{id}", "AnnoucementController@delete");
    });


    Route::patch('/user', [UserController::class, 'update']);
    Route::get('/user/notify', [UserController::class, 'notify']);
    Route::post('/user/image_upload', [UserController::class, 'userImageUpload']);

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function() {
    Route::post('/auth/signup', 'AuthController@signup');

    Route::post('/auth/login', 'AuthController@login');
    Route::post('/auth/validate_otp_code', 'AuthController@validateOtpCode');
    Route::post('/auth/validate_fp_code', 'AuthController@validateFpCode');
    Route::post('/auth/reset_password', 'AuthController@resetPassword');

    Route::get('/countries', 'LocationController@countries');
    Route::get('/regions', 'LocationController@regions');
    Route::get('/towns', 'LocationController@towns');
    Route::get('/streets', 'LocationController@streets');
    Route::get('/plans', 'PlanController@index');

    // Shop
    Route::get('/sub_categories', 'ShopController@getSubCategories');
    Route::get('/categories', 'ShopController@getCategories');

    Route::get('/shops', [ShopController::class, 'index']);
    Route::get('/shops/featured', [ShopController::class, 'featured_shops']);
    Route::get('/shops/{slug}', [ShopController::class, 'show']);
    Route::get('/shops/{slug}/branches', [ShopController::class, 'otherShops']);
    Route::get("/shops/{slug}/items", [ShopController::class, 'getItemsByShop']);

//    Route::resource('/products', 'ProductController', ['only' => ['index', 'store']]);
    Route::get('/search', 'ProductController@search');
    Route::get('/search/index', 'ProductController@searchIndex');
    Route::get('/index_items', 'ProductController@bulk_index');
    Route::delete('/flush_items', 'ProductController@flush_items');

    Route::get('/items', 'ProductController@index');
    Route::get("/items/{slug}", "ProductController@show");
    Route::get("/items/{slug}/related", "ProductController@otherItems");
    Route::get('/products/related', 'ProductController@relatedProducts');



    Route::get("/errands/{id}", "ErrandController@show");
    Route::get("/errands", "ErrandController@index");
    Route::get('/errand/search', 'ErrandController@runErrand');

    Route::post('/payments/return', 'PaymentController@return');
    Route::resource('reviews', 'ReviewController');
    Route::get('/notifications', 'NotificationController@index');
    Route::get('/notifications/mark_as_read', 'NotificationController@markAllRead');
    Route::post('/products/{id}/images/upload', [ProductUploadController::class, 'uploadProductGallery']);
    Route::delete('/product/{id}/images/delete', [ProductUploadController::class, 'removeProductImage']);
    Route::post('save_images/{id}', [ProductImageUploadController::class, 'uploadProductGallery']);
    Route::delete('remove_image/{product_id}/', [ProductImageUploadController::class, 'removeProductImage']);

    Route::prefix('categories')->group(function(){
        Route::get('/', [CategoryController::class, 'getAll']);
        Route::get('/tree', [CategoryController::class, 'getTree']);
        Route::post('/', [CategoryController::class, 'save']);
        Route::get('/{slug}', [CategoryController::class, 'getBySlug']);
        Route::get('/{slug}/children', [CategoryController::class, 'getWithChildren']);
        Route::put('/{slug}', [CategoryController::class, 'update']);
        Route::delete('/{slug}', [CategoryController::class, 'delete']);
    });


    // secure endpoints that require auth token

});
