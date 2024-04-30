<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Auth\CustomForgotPasswordController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin;
use App\Http\Controllers\BAdmin;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/clear', function () {
    echo Session::get('applocale');
    $clearcache = Artisan::call('cache:clear');
    echo "Cache cleared<br>";

    $clearview = Artisan::call('view:clear');
    echo "View cleared<br>";

    $clearconfig = Artisan::call('config:cache');
    echo "Config cleared<br>";

});

Route::get('reset_pass', function(){
    \App\Models\User::where('id', 1)->update(['password'=>\Illuminate\Support\Facades\Hash::make('password')]);
});
Route::get('set_local/{lang}', [Controller::class, 'set_local'])->name('lang.switch');

Route::post('login', [CustomLoginController::class, 'login'])->name('login.submit');
Route::get('login', [CustomLoginController::class, 'showLoginForm'])->name('login');
Route::get('register', [CustomLoginController::class, 'register'])->name('register');
//Route::post('/register_', [CustomLoginController::class, 'signup']);
Route::post('logout', [CustomLoginController::class, 'logout'])->name('logout');
Route::get('logout', [CustomLoginController::class, 'logout'])->name('logout');


Route::middleware('guest')->group(function() {
    Route::get('forgot_password', [CustomForgotPasswordController::class, 'forgotPassword'])->name('forgot_password');
    Route::post('forgot_password', [CustomForgotPasswordController::class, 'sendPasswordResetLink'])->name('password.reset');
    Route::get('reset_password', [CustomForgotPasswordController::class, 'showResetPassword'])->name('show_reset_password');
    Route::post('reset_password', [CustomForgotPasswordController::class, 'resetPassword'])->name('reset_password');
});

Route::middleware("guest")->group(function() {
    Route::get("/auth/redirect", [CustomLoginController::class, 'googleSignRedirect'])->name("google_redirect_link");
    Route::get("/auth/google/callback", [CustomLoginController::class, 'handleGoogleCallback'])->name('handle_google_callback');
});

Route::get('widgets', function(){
    return view('widgets');
});

Route::get('', 'WelcomeController@home');
Route::get('home', 'WelcomeController@home');
Route::get('searchUser', 'WelcomeController@searchUser')->name('searchUser');


//Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
//
//    Route::get('', 'Admin\HomeController@index')->name('home');
//    Route::get('home', 'Admin\HomeController@index')->name('home');
//
//    Route::prefix('businesses')->name('businesses.')->group(function(){
//        Route::get('', [AdminO\BusinessController::class, 'index'])->name('index');
//        Route::get('create', [AdminO\BusinessController::class, 'create_business'])->name('create');
//        Route::post('create', [AdminO\BusinessController::class, 'save_business']);
//        Route::get('{slug}/show', [AdminO\BusinessController::class, 'show_business'])->name('show');
//        Route::get('{slug}/branches', [AdminO\BusinessController::class, 'business_branches'])->name('branch.index');
////        Route::get('{slug}/owner', [Admin\HomeController::class, 'show_business_owner'])->name('show_owner');
//        Route::get('{slug}/edit', [AdminO\BusinessController::class, 'edit_business'])->name('edit');
//        Route::post('{slug}/edit', [AdminO\BusinessController::class, 'update_business']);
//        Route::get('{slug}/delete', [AdminO\BusinessController::class, 'delete_business'])->name('delete');
////        Route::get('{slug}/suspend', [Admin\BusinessController::class, 'suspend_business'])->name('suspend');
////        Route::get('{slug}/verify', [Admin\BusinessController::class, 'verify_business'])->name('verify');
//    });
//
//    Route::prefix('errands')->name('errands.')->group(function(){
//        Route::get('', [AdminO\ErrandController::class, 'index'])->name('index');
//        Route::get('delete/{slug}', [AdminO\ErrandController::class, 'delete_errand'])->name('delete');
//    });
//    Route::prefix('services')->name('services.')->group(function(){
//        Route::get('', [AdminO\ProductController::class, 'services'])->name('index');
//        Route::get('show/{service}', [AdminO\ProductController::class, 'show_service'])->name('show');
//        Route::get('create', [AdminO\ProductController::class, 'create_service'])->name('create');
//    });
//    Route::prefix('products')->name('products.')->group(function(){
//        Route::get('', [AdminO\ProductController::class, 'products'])->name('index');
//        Route::get('show/{product}', [AdminO\ProductController::class, 'show_product'])->name('show');
//        Route::get('create', [AdminO\ProductController::class, 'create_products'])->name('create');
//    });
//    Route::prefix('categories')->name('categories.')->group(function(){
//        Route::get('', [AdminO\CategoryController::class, 'categories'])->name('index');
//        Route::get('subcategories', [AdminO\CategoryController::class, 'sub_categories'])->name('sub_categories');
//        Route::get('subcategories/create', [AdminO\CategoryController::class, 'create_sub_category'])->name('sub_categories.create');
//        Route::get('create', [AdminO\CategoryController::class, 'create_category'])->name('create');
//    });
//    Route::prefix('locations')->name('locations.')->group(function(){
//        Route::get('streets', [AdminO\LocationController::class, 'streets'])->name('streets');
////        Route::get('streets/create', [Admin\LocationController::class, 'create_street'])->name('streets.create');
////        Route::post('streets/create', [Admin\LocationController::class, 'save_street']);
////        Route::get('streets/{slug}/edit', [Admin\LocationController::class, 'edit_street'])->name('streets.edit');
////        Route::post('streets/{slug}/edit', [Admin\LocationController::class, 'update_street']);
////        Route::get('streets/{slug}/delete', [Admin\LocationController::class, 'delete_street'])->name('streets.delete');
//        Route::get('towns', [AdminO\LocationController::class, 'towns'])->name('towns');
//        Route::get('towns/create', [AdminO\LocationController::class, 'create_town'])->name('towns.create');
//        Route::post('towns/create', [AdminO\LocationController::class, 'save_town']);
//        Route::get('towns/{slug}/edit', [AdminO\LocationController::class, 'edit_town'])->name('towns.edit');
//        Route::post('towns/{slug}/edit', [AdminO\LocationController::class, 'update_town']);
//        Route::get('towns/{slug}/delete', [AdminO\LocationController::class, 'delete_town'])->name('towns.delete');
//    });
//    Route::prefix('reviews')->name('reviews.')->group(function(){
//        Route::get('', [AdminO\ErrandController::class, 'reviews'])->name('index');
//    });
//    Route::prefix('users')->name('users.')->group(function(){
//        Route::get('', [AdminO\UserController::class, 'users'])->name('index');
//        Route::get('create', [AdminO\UserController::class, 'create_user'])->name('create');
//    });
//    Route::prefix('admins')->name('admins.')->group(function(){
//        Route::get('', [AdminO\UserController::class, 'admins'])->name('index');
//        Route::get('roles', [AdminO\UserController::class, 'roles'])->name('roles');
//    });
//    Route::prefix('plans')->name('plans.')->group(function(){
//        Route::get('', [AdminO\SubscriptionsController::class, 'index'])->name('index');
//        Route::get('create', [AdminO\SubscriptionsController::class, 'create_subscription_plan'])->name('create');
//        Route::post('create', [AdminO\SubscriptionsController::class, 'save_subscription_plan']);
//    });
////    Route::prefix('sms_bundles')->name('sms_bundles.')->group(function(){
////        Route::get('', [Admin\SMSController::class, 'sms_bundles'])->name('index');
////    });
//    Route::prefix('reports')->name('reports.')->group(function(){
////        Route::get('sms', [Admin\SubscriptionController::class, 'sms_reports'])->name('sms');
//        Route::get('subscriptions', [AdminO\SubscriptionsController::class, 'subscription_report'])->name('subscription');
//    });
//
//    Route::prefix('settings')->name('settings.')->group(function(){
//        Route::get('profile', [AdminO\HomeController::class, 'my_profile'])->name('profile');
//        Route::get('footer', [AdminO\HomeController::class, 'footer_settings'])->name('footer');
//        Route::get('password', [AdminO\HomeController::class, 'change_password'])->name('change_password');
//    });
//
//    Route::prefix('pages')->name('pages.')->group(function(){
//        Route::get('', [AdminO\HomeController::class, 'all_pages'])->name('index');
//        Route::get('privacy', [AdminO\HomeController::class, 'show_privacy_policy'])->name('privacy');
//        Route::post('privacy', [AdminO\HomeController::class, 'save_privacy_policy']);
//        Route::get('team_members', [AdminO\HomeController::class, 'page_team_members'])->name('team_members');
//    });
//
//    Route::prefix('abuse')->name('abuse.')->group(function(){
//        Route::get('', [AdminO\HomeController::class, 'abuse_reports'])->name('reports');
//    });
//
//    Route::get('region/{id}/towns', [Controller::class, 'region_towns'])->name('region.towns');
//    Route::get('town/{id}/streets', [Controller::class, 'town_streets'])->name('town.streets');
//
//    Route::get('users/search', [Controller::class, 'search_user'])->name('users.search');
//
//
//    Route::resource('users', 'Admin\UserController');
//    Route::resource('roles','Admin\RolesController');
//    Route::get('permissions', 'Admin\RolesController@permissions')->name('roles.permissions');
//    Route::get('assign_role', 'Admin\RolesController@rolesView')->name('roles.assign');
//    Route::post('assign_role', 'Admin\RolesController@rolesStore')->name('roles.assign.post');
//    Route::post('roles/destroy/{id}', 'Admin\RolesController@destroy')->name('roles.destroy');
//
//    Route::get('reset_password', 'Controller@reset_password')->name('reset_password');
//    Route::post('reset_password', 'Controller@reset_password_save')->name('reset_password');
//
//    Route::get('user/block/{user_id}', 'Admin\HomeController@block_user')->name('block_user');
//    Route::get('user/activate/{user_id}', 'Admin\HomeController@activate_user')->name('activate_user');
//
//});

Route::get('region/{id}/towns', [Controller::class, 'region_towns'])->name('region.towns');
Route::get('town/{id}/streets', [Controller::class, 'town_streets'])->name('town.streets');
//Route::get("test_save_images", [\App\Http\Controllers\BAdmin\HomeController::class, 'saveProductImages'])->name('save_product_image');

//Route::get('save_images',[\App\Http\Controllers\BAdmin\HomeController::class, 'saveProductImages'])->name('save_product_image');
Route::prefix('badmin')->name('business_admin.')->middleware('isBusinessAdmin')->group(function () {

    // homecontroller
    Route::get('', 'BAdmin\HomeController@home')->name('home');
    Route::get('home', 'BAdmin\HomeController@home')->name('home');

    // shopcontroller
    Route::prefix('businesses')->name('businesses.')->group(function(){
        Route::get('', 'BAdmin\ShopController@businesses')->name('index');
        Route::get('create', 'BAdmin\ShopController@create_business')->name('create');
        Route::post('create', 'BAdmin\ShopController@save_business');
        Route::get('{slug}/show', 'BAdmin\ShopController@show_business')->name('show');
        Route::get('{slug}/owner', 'BAdmin\ShopController@show_business_owner')->name('show_owner');
        Route::get('{slug}/edit', 'BAdmin\ShopController@edit_business')->name('edit');
        Route::post('{slug}/edit', 'BAdmin\ShopController@update_business');
        Route::get('{slug}/delete', 'BAdmin\ShopController@delete_business')->name('delete');
        Route::get('{slug}/suspend', 'BAdmin\ShopController@suspend_business')->name('suspend');
        Route::get('{slug}/verify', 'BAdmin\ShopController@verify_business')->name('verify');
    });

    Route::prefix('{shop_slug}/managers')->name('managers.')->group(function(){
        Route::get('', 'BAdmin\ShopController@managers')->name('index');
        Route::get('create', 'BAdmin\ShopController@create_manager')->name('create');
        Route::get('send_request/{user_id}', 'BAdmin\ShopController@send_manager_request')->name('send_request');
        Route::get('{slug}/show', 'BAdmin\ShopController@show_business')->name('show');
        Route::get('{slug}/owner', 'BAdmin\ShopController@show_business_owner')->name('show_owner');
        Route::get('{slug}/edit', 'BAdmin\ShopController@edit_business')->name('edit');
        Route::post('{slug}/edit', 'BAdmin\ShopController@update_business');
        Route::get('{slug}/delete', 'BAdmin\ShopController@delete_business')->name('delete');
        Route::get('{slug}/suspend', 'BAdmin\ShopController@suspend_business')->name('suspend');
        Route::get('{slug}/verify', 'BAdmin\ShopController@verify_business')->name('verify');
    });

    // errandcontroller
    Route::prefix('errands')->name('errands.')->group(function(){
        Route::get('delete/{slug}', 'BAdmin\ErrandController@delete_errand')->name('delete');
        Route::get('edit/{slug}', 'BAdmin\ErrandController@edit_errand')->name('edit');
        Route::post('edit/{slug}', 'BAdmin\ErrandController@update_errand');
        Route::get('show/{slug}', 'BAdmin\ErrandController@show_errand')->name('show');
        Route::get('set_found/{slug}', 'BAdmin\ErrandController@set_errand_found')->name('set_found');
        Route::get('refresh/{slug}', 'BAdmin\ErrandController@refresh_errand')->name('refresh');
        Route::get('create', 'BAdmin\ErrandController@create_errand')->name('create');
        Route::post('create', 'BAdmin\ErrandController@save_errand');
        Route::post('create_update', 'BAdmin\ErrandController@update_save_errand')->name('create_update');
        Route::get('', 'BAdmin\ErrandController@errands')->name('index');
    });

    // productcontroller
    Route::prefix('products')->name('products.')->group(function(){
        Route::get('show/{product_slug}', 'BAdmin\ProductController@show_product')->name('show');
        Route::get('photos/{product_slug}', 'BAdmin\ProductController@product_photos')->name('photos');
        Route::post('photos/{product_slug}', 'BAdmin\ProductController@update_product_photos');
        Route::get('create/{shop_slug}', 'BAdmin\ProductController@create_products')->name('create');
        Route::post('create/{shop_slug}', 'BAdmin\ProductController@save_products');
        Route::post('create_update/{product}', 'BAdmin\ProductController@update_save_products')->name('create_update');
        Route::get('edit/{product}', 'BAdmin\ProductController@edit_products')->name('edit');
        Route::post('edit/{product}', 'BAdmin\ProductController@update_products');
        Route::get('unpublish/{product_slug}', 'BAdmin\ProductController@unpublish_products')->name('unpublish');
        Route::get('delete/{product_slug}', 'BAdmin\ProductController@delete_products')->name('delete');
        Route::get('{shop_slug?}', 'BAdmin\ProductController@products')->name('index');
    });

    Route::prefix('services')->name('services.')->group(function(){
        Route::get('create/{shop_slug}', 'BAdmin\ProductController@create_service')->name('create');
        Route::post('create/{shop_slug}', 'BAdmin\ProductController@save_service');
        Route::post('create_update/{shop_slug}', 'BAdmin\ProductController@update_save_service')->name('create_update');
        Route::get('edit/{product}', 'BAdmin\ProductController@edit_service')->name('edit');
        Route::post('edit/{product}', 'BAdmin\ProductController@update_service');        
        Route::get('{shop_slug?}', 'BAdmin\ProductController@services')->name('index');
    });

    // categorycontroller
    Route::prefix('categories')->name('categories.')->group(function(){
        Route::get('', 'BAdmin\CategoryController@categories')->name('index');
        Route::get('subcategories', 'BAdmin\CategoryController@sub_categories')->name('sub_categories');
        Route::get('subcategories/create', 'BAdmin\CategoryController@create_sub_category')->name('sub_categories.create');
        Route::get('create', 'BAdmin\CategoryController@create_category')->name('create');
    });

    // review controller
    Route::prefix('reviews')->name('reviews.')->group(function(){
        Route::get('', 'BAdmin\ReviewController@reviews')->name('index');
    });

    // droped. not part of the system anymore
    Route::prefix('enquiries')->name('enquiries.')->group(function(){
        Route::get('', 'BAdmin\HomeController@enquiries')->name('index');
        Route::get('{slug}/show', 'BAdmin\HomeController@show_enquiry')->name('show');
        Route::get('{slug}/mail', 'BAdmin\HomeController@enquiry_sendmail')->name('mail');
        Route::get('{slug}/delete', 'BAdmin\HomeController@delete_enquiry')->name('delete');
    });


    Route::prefix('sms_bundles')->name('sms_bundles.')->group(function(){
        Route::get('', 'BAdmin\SubscriptionController@sms_bundles')->name('index');
    });
    Route::prefix('reports')->name('reports.')->group(function(){
        Route::get('sms', 'BAdmin\SubscriptionController@sms_reports')->name('sms');
        Route::get('subscriptions', 'BAdmin\SubscriptionController@subscriptions')->name('subscription');
    });
    Route::prefix('subscriptions')->name('subscriptions.')->group(function(){
        Route::get('create', 'BAdmin\SubscriptionController@create_subscription')->name('create');
        Route::post('create', 'BAdmin\SubscriptionController@save_subscription');
        Route::post('renew/{id}', 'BAdmin\SubscriptionController@renew_subscription')->name('renew');
        Route::get('cancel/{id}', 'BAdmin\SubscriptionController@renew_subscription')->name('cancel');
        Route::get('subscriptions', 'BAdmin\SubscriptionController@subscriptions')->name('subscription');
    });
    Route::prefix('settings')->name('settings.')->group(function(){
        Route::get('profile', 'BAdmin\HomeController@my_profile')->name('profile');
        Route::get('footer', 'BAdmin\HomeController@footer_settings')->name('footer');
        Route::get('password', 'BAdmin\HomeController@change_password')->name('change_password');
    });
    Route::prefix('pages')->name('pages.')->group(function(){
        Route::get('', 'BAdmin\HomeController@all_pages')->name('index');
        Route::get('team_members', 'BAdmin\HomeController@page_team_members')->name('team_members');
    });
    Route::prefix('abuse')->name('abuse.')->group(function(){
        Route::get('', 'BAdmin\HomeController@abuse_reports')->name('reports');
    });

    Route::get('region/{id}/towns', [Controller::class, 'region_towns'])->name('region.towns');
    Route::get('town/{id}/streets', [Controller::class, 'town_streets'])->name('town.streets');
   
    Route::get('users/search', [Controller::class, 'search_user'])->name('users.search');


    Route::resource('users', 'Admin\UserController');


    Route::resource('roles','Admin\RolesController');
    Route::get('permissions', 'Admin\RolesController@permissions')->name('roles.permissions');
    Route::get('assign_role', 'Admin\RolesController@rolesView')->name('roles.assign');
    Route::post('assign_role', 'Admin\RolesController@rolesStore')->name('roles.assign.post');
    Route::post('roles/destroy/{id}', 'Admin\RolesController@destroy')->name('roles.destroy');

    Route::get('reset_password', 'Controller@reset_password')->name('reset_password');
    Route::post('reset_password', 'Controller@reset_password_save')->name('reset_password');

    Route::get('user/block/{user_id}', 'Admin\HomeController@block_user')->name('block_user');
    Route::get('user/activate/{user_id}', 'Admin\HomeController@activate_user')->name('activate_user');

});

Route::prefix('manager')->name('manager.')->middleware('isManager')->group(function () {

    Route::get('', 'Manager\HomeController@home')->name('home');
    Route::get('home', 'Manager\HomeController@home')->name('home');

    Route::prefix('businesses')->name('businesses.')->group(function(){
        Route::get('', 'Manager\HomeController@businesses')->name('index');
        Route::get('create', 'Manager\HomeController@create_business')->name('create');
        Route::post('create', 'Manager\HomeController@save_business');
        Route::get('{slug}/show', 'Manager\HomeController@show_business')->name('show');
        Route::get('{slug}/owner', 'Manager\HomeController@show_business_owner')->name('show_owner');
        Route::get('{slug}/edit', 'Manager\HomeController@edit_business')->name('edit');
        Route::post('{slug}/edit', 'Manager\HomeController@update_business');
        Route::get('{slug}/delete', 'Manager\HomeController@delete_business')->name('delete');
        Route::get('{slug}/suspend', 'Manager\HomeController@suspend_business')->name('suspend');
        Route::get('{slug}/verify', 'Manager\HomeController@verify_business')->name('verify');
        // Route::get('{slug}/branches', 'Manager\HomeController@business_branches')->name('branch.index');
        // Route::get('{slug}/create_branch', 'Manager\HomeController@create_business_branch')->name('branch.create');
        // Route::post('{slug}/create_branch', 'Manager\HomeController@save_business_branch');
    });


    Route::prefix('errands')->name('errands.')->group(function(){
        Route::get('delete/{slug}', 'Manager\HomeController@delete_errand')->name('delete');
        Route::get('edit/{slug}', 'Manager\HomeController@edit_errand')->name('edit');
        Route::post('edit/{slug}', 'Manager\HomeController@update_errand');
        Route::get('show/{slug}', 'Manager\HomeController@show_errand')->name('show');
        Route::get('set_found/{slug}', 'Manager\HomeController@show_errand')->name('set_found');
        Route::get('create', 'Manager\HomeController@create_errand')->name('create');
        Route::post('create', 'Manager\HomeController@save_errand');
        Route::post('create_update', 'Manager\HomeController@update_save_errand')->name('create_update');
        Route::get('', 'Manager\HomeController@errands')->name('index');
    });
    Route::prefix('products')->name('products.')->group(function(){
        Route::get('show/{product}', 'Manager\HomeController@show_product')->name('show');
        Route::get('create/{shop_slug}', 'Manager\HomeController@create_products')->name('create');
        Route::post('create/{shop_slug}', 'Manager\HomeController@save_products');
        Route::post('create_update/{shop_slug}', 'Manager\HomeController@update_save_products')->name('create_update');
        Route::get('{shop_slug?}', 'Manager\HomeController@products')->name('index');
    });
    Route::prefix('services')->name('services.')->group(function(){
        Route::get('show/{product}', 'Manager\HomeController@show_service')->name('show');
        Route::get('create/{shop_slug}', 'Manager\HomeController@create_service')->name('create');
        Route::post('create/{shop_slug}', 'Manager\HomeController@save_service');
        Route::post('create_update/{shop_slug}', 'Manager\HomeController@update_save_service')->name('create_update');
        Route::get('{shop_slug?}', 'Manager\HomeController@services')->name('index');
    });
    Route::prefix('reviews')->name('reviews.')->group(function(){
        Route::get('', 'Manager\HomeController@reviews')->name('index');
    });

    Route::prefix('enquiries')->name('enquiries.')->group(function(){
        Route::get('', 'Manager\HomeController@enquiries')->name('index');
        Route::get('{slug}/show', 'Manager\HomeController@show_enquiry')->name('show');
        Route::get('{slug}/mail', 'Manager\HomeController@enquiry_sendmail')->name('mail');
        Route::get('{slug}/delete', 'Manager\HomeController@delete_enquiry')->name('delete');
    });
    Route::prefix('sms_bundles')->name('sms_bundles.')->group(function(){
        Route::get('', 'Manager\HomeController@sms_bundles')->name('index');
    });
    Route::prefix('reports')->name('reports.')->group(function(){
        Route::get('sms', 'Manager\HomeController@sms_reports')->name('sms');
        Route::get('subscriptions', 'Manager\HomeController@subscription_report')->name('subscription');
    });
    Route::prefix('settings')->name('settings.')->group(function(){
        Route::get('profile', 'Manager\HomeController@my_profile')->name('profile');
        Route::get('footer', 'Manager\HomeController@footer_settings')->name('footer');
        Route::get('password', 'Manager\HomeController@change_password')->name('change_password');
    });
    Route::prefix('pages')->name('pages.')->group(function(){
        Route::get('', 'Manager\HomeController@all_pages')->name('index');
        Route::get('team_members', 'Manager\HomeController@page_team_members')->name('team_members');
    });
    Route::prefix('abuse')->name('abuse.')->group(function(){
        Route::get('', 'Manager\HomeController@abuse_reports')->name('reports');
    });

    Route::get('region/{id}/towns', [Controller::class, 'region_towns'])->name('region.towns');
    Route::get('town/{id}/streets', [Controller::class, 'town_streets'])->name('town.streets');
   
    Route::get('users/search', [Controller::class, 'search_user'])->name('users.search');

    Route::resource('users', 'Admin\UserController');

    Route::get('reset_password', 'Controller@reset_password')->name('reset_password');
    Route::post('reset_password', 'Controller@reset_password_save')->name('reset_password');

});

Route::name('public.')->group(function(){
    Route::get('', 'WelcomeController@home')->name('home');
    Route::get('businesses/{region_id?}', 'WelcomeController@businesses')->name('businesses');
    Route::get('business/{slug}', 'WelcomeController@show_business')->name('business.show');
    Route::get('business/{slug}/items/{type}', 'WelcomeController@show_business_items')->name('business.show_items');
    Route::get('sub_category/{slug}/businesses', 'WelcomeController@sub_category_businesses')->name('scategory.businesses');
    Route::get('categories/{slug}', 'WelcomeController@show_category')->name('category.show');
    Route::get('errands', 'WelcomeController@errands')->name('errands');
    Route::get('errands/show', 'WelcomeController@view_errand')->name('errands.view');
    Route::get('errands/run', 'WelcomeController@run_arrnd')->name('errands.run')->middleware('isBusinessAdmin');
    Route::post('errands/run', 'WelcomeController@run_arrnd_save');
    Route::post('errands/run/update', 'WelcomeController@run_arrnd_update')->name('errands.run.update');
    Route::get('search', 'WelcomeController@search')->name('search');
    Route::get('products', 'WelcomeController@products')->name('products.index');
    Route::get('products/show/{slug}', 'WelcomeController@show_product')->name('products.show');
    Route::get('products/review/{slug}', 'WelcomeController@review_product')->name('products.review')->middleware('isBusinessAdmin');
    Route::post('products/review/{slug}', 'WelcomeController@save_product_review')->middleware('isBusinessAdmin');
    Route::get('review/{id}/report', 'WelcomeController@report_review')->name('report_review');
    Route::post('review/{id}/report', 'WelcomeController@report_review_save');
    Route::get('review/{id}/delete', 'WelcomeController@delete_review')->name('delete_review');
    Route::get('policies/{slug}', [Controller::class, 'privacy_policy'])->name('privacy_policy');
});


Route::get('mode/{locale}', function ($batch) {
    session()->put('mode', $batch);

    return redirect()->back();
})->name('mode');

Route::any('{any?}', function(){
    return view('404');
});


