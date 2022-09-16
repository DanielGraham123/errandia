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

//Route::prefix('user')->group(function() {
//    Route::get('/', 'UserController@index');
//});
//use Modules\User\Http\Controllers\UserController;
//use Illuminate\Support\Facades\Route;

//Route::get('login', [UserController::class, 'showLoginPage']);
//Route::post('login', [UserController::class, 'login']);
//Route::get('logout', [UserController::class, 'logout']);
//
//Route::get('register', [UserController::class, 'showSignUpPage']);
//Route::post('register', [UserController::class, 'signUp']);
//
//Route::get('user/account', [UserController::class, 'showUserAccount'])->name('dashboard');
//Route::get('account/delete', [UserController::class, 'deleteUserAccount']);
//
//Route::get('edit_profile', [UserController::class, 'showEditProfilePage']);
//Route::post('update_profile', [UserController::class, 'updateProfile']);

$vendor_account_type = \Modules\GeneralModule\Config\AccountType::$IS_VENDOR;
$admin_account_type = \Modules\GeneralModule\Config\AccountType::$IS_ADMIN;
$user_account_type = \Modules\GeneralModule\Config\AccountType::$IS_CUSTOMER;
Route::prefix('/user')->middleware('helep:' . $vendor_account_type . ',' . $admin_account_type . ',' . $user_account_type)->group(function () {
    Route::get('profile', 'UserController@showUserProfile')->name('user_profile');
    Route::post('profile/password', 'UserController@changePassword')->name('change_password');
    Route::post('profile/personal/info', 'UserController@changePersonalInfo')->name('update_personal_info');
    Route::post('profile/business/info', 'UserController@updateBusinessInfo')->name('update_business_info');
//    Route::get('profile/edit', 'UserControlller@showEditProfilePage')->name('show_edit_profile');


});

Route::prefix('/users')->middleware('helep:' . $vendor_account_type . ',' . $admin_account_type)->group(function () {
    Route::get('/', 'UserController@showUsers')->name('users');
    Route::post('/searchuser', 'UserController@showUsers')->name('searchuser');
    Route::get('/suspendaccount/{id}', 'UserController@suspendAccount')->name('suspendaccount');
    Route::get('/activeaccount/{id}', 'UserController@activeAccount')->name('activeaccount');
    Route::get('/admins/add', 'UserController@showAddAdminPage')->name('add_admin_page');
    Route::post('/admins/add', 'UserController@addAdminAccount')->name('add_admin_user');
    Route::get('/admins/list', 'UserController@showManageAdminPage')->name('admin_list');
});

Route::prefix('/customers')->middleware('helep:' . $user_account_type)->group(function () {
    Route::get('/reviews', 'BuyerController@showUserProductReviewsPage')->name("customer_reviews");
    Route::get('/reviews/{id}', 'BuyerController@deleteUserProductReview')->name("delete_customer_reviews");
    Route::post('/reviews/{id}', 'BuyerController@updateUserProductReview')->name("update_customer_reviews");
    Route::get('/errands', 'BuyerController@showUserProductQuoteHistoryPage')->name("customer_errands");
    Route::get('/enquiries', 'BuyerController@showUserEnquiryHistoryPage')->name("customer_enquiries");
    Route::get('/subscriptions', 'BuyerController@showUserShopSubscriptionPage')->name("customer_shop_subscriptions");
    Route::post('/profiles', 'BuyerController@updateCustomerProfileInfo')->name('update_customer_profile');
});
