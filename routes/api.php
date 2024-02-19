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
    });


    Route::patch('/user', [UserController::class, 'update']);
    Route::post('/user/image_upload', [UserController::class, 'userImageUpload']);
    Route::get('/user/shops', [ShopController::class, 'getUserShops']);
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

    // Shop
    Route::get('/sub_categories', 'ShopController@getSubCategories');
    Route::get('/categories', 'ShopController@getCategories');

    Route::post('/shops', 'ShopController@store');
    Route::put('/shops/{slug}', 'ShopController@update');
    Route::get('/shops', 'ShopController@index');
    Route::get('/shops/featured', 'ShopController@featured_shops');
    Route::get('/shops/{slug}', 'ShopController@show');
    Route::get('/shops/{slug}/branches', 'ShopController@otherShops');

    Route::resource('/products', 'ProductController', ['only' => ['index', 'store']]);
    Route::post('/product/delete', 'ProductController@deleteProduct');
    Route::get('/product/view', 'ProductController@view');
    Route::get('/products/related', 'ProductController@relatedProducts');

    Route::resource('errands', 'ErrandController', ['only' => ['index', 'store']]);
    Route::get('/errand/search', 'ErrandController@runErrand');
    Route::post('/errand/delete', 'ErrandController@deleteErrand');

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
