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

Route::prefix('/ui')->group(function () {
    Route::get('/home', 'GeneralModuleController@showAppHomePage')->name('general_home');
    Route::get('product/show/{id}', 'GeneralModuleController@showProductDetailsPage')->name('general_product_details');
    Route::get('shop/show/{id}', 'GeneralModuleController@showShopProfilePage')->name('show_shop_page');
    Route::get('category/collection/{category}', 'GeneralModuleController@showSubCategoryProducts')->name('show_collection_products');
    Route::get('category/products/{category}', 'GeneralModuleController@showCategoryProducts')->name('show_cat_products');
    Route::get('categories', 'GeneralModuleController@showCategoryList')->name('category_list_page');
    Route::post('product/postreview', 'GeneralModuleController@postReview')->name('post_review');
    Route::post('product/postenquiry', 'GeneralModuleController@postEnquiry')->name('post_enquiry');
    Route::get('shops/subscriber', 'GeneralModuleController@subscribeUserToShop')->name("subscribe_shop");
    Route::get('shops/subscriber/not', 'GeneralModuleController@unSubscribeUserToShop')->name("unsubscribe_shop");
    Route::get('/pages/custom', 'SitePageController@showPageContent')->name('show_page_content');

});
//Authentication section
Route::get('login', 'AuthenticationController@showLoginPage')->name('login_page');
Route::post('login', 'AuthenticationController@login')->name('login_user');
Route::get('register', 'AuthenticationController@showRegisterPage')->name('signup_page');
Route::post('register', 'AuthenticationController@registerUserAccount')->name('signup');
Route::get('logout', 'AuthenticationController@logout');
//reset user password section
Route::get('passwords/reset', 'AuthenticationController@showPasswordResetPage')->name('forgot_password_page');
Route::post('passwords/reset', 'AuthenticationController@generatePasswordResetLink')->name('generate_password_link');
Route::get('passwords/reset/confirmation', 'AuthenticationController@showPasswordResetConfirmationPage')->name('password_reset_link');
Route::post('passwords/reset/confirmation', 'AuthenticationController@resetUserAccountPassword')->name("reset_password");


//manage site pages
$admin_account_type = \Modules\GeneralModule\Config\AccountType::$IS_ADMIN;
Route::prefix('pages/content')->middleware('helep:' . $admin_account_type)->group(function () {
    Route::get('/', 'SitePageController@showManageSitePages')->name('manage_site_pages');
    Route::post('/about', 'SitePageController@saveSiteAboutPage')->name('save_about_us_page');
    Route::post('/help_center', 'SitePageController@saveSiteHelpCenterPage')->name('save_help_center_page');
    Route::post('/policy', 'SitePageController@saveSitePolicyPage')->name('save_policy_page');
    Route::post('/report_abuse', 'SitePageController@saveSiteReportPage')->name('save_report_page');
    Route::post('/', 'SitePageController@saveSiteDisclaimerPage')->name('save_disclaimer_page');
});
