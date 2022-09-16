<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$admin_account_type = \Modules\GeneralModule\Config\AccountType::$IS_ADMIN;
Route::prefix('subscription')->middleware('helep:' . $admin_account_type)->group(function () {
    Route::get('/', 'SubscriptionController@index')->name('subscription');
    Route::get('/create', [\Modules\Subscription\Http\Controllers\SubscriptionController::class, 'create'])->name('add_subscription');
    Route::post('/save', [\Modules\Subscription\Http\Controllers\SubscriptionController::class, 'store'])->name('save_subscription');
    Route::get('/edit/{id}', [\Modules\Subscription\Http\Controllers\SubscriptionController::class, 'edit'])->name('edit_subscription');
    Route::post('/update/{id}', [\Modules\Subscription\Http\Controllers\SubscriptionController::class, 'update'])->name('update_subscription');
    Route::get('/delete/{id}', [\Modules\Subscription\Http\Controllers\SubscriptionController::class, 'destroy'])->name('delete_subscription');

    Route::get('/shop-subscription', 'SubscriptionController@ShopSubscription')->name('shop-subscription');
    Route::get('/add-shop-subscription', 'SubscriptionController@AddShopSubscription')->name('add_shop_subscription');
    Route::post('/save-shop-package', 'SubscriptionController@SaveShopSubscription')->name('save_shop_package');
    Route::get('/suspend', 'SubscriptionController@blockShopSubscriptionDue')->name('block_shop_profile');
});

$vendor_account_type = \Modules\GeneralModule\Config\AccountType::$IS_VENDOR;
Route::prefix('shops/subscribers')->middleware('helep:' . $vendor_account_type)->group(function () {
    Route::get('/list', 'SubscriptionController@showShopSubscribersPage')->name('shop_subscribers_list');
});

