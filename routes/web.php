<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ResultsAndTranscriptsController;
use App\Http\Controllers\admin\StockController;
use App\Http\Controllers\Auth\CustomForgotPasswordController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\documentation\BaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Parents\HomeController as ParentsHomeController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Student\HomeController as StudentHomeController;
use App\Http\Controllers\Teacher\ClassController;
use App\Http\Controllers\Teacher\HomeController as TeacherHomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Transactions;
use App\Http\Resources\SubjectResource;
use App\Models\CampusDegree;
use App\Models\Resit;
use App\Models\StudentSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use \App\Models\Subjects;

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
Route::post('logout', [CustomLoginController::class, 'logout'])->name('logout');

Route::post('reset_password_with_token/password/reset', [CustomForgotPasswordController::class, 'validatePasswordRequest'])->name('reset_password_without_token');
Route::get('reset_password_with_token/{token}/{email}', [CustomForgotPasswordController::class, 'resetForm'])->name('reset');
Route::post('reset_password_with_token', [CustomForgotPasswordController::class, 'resetPassword'])->name('reset_password_with_token');

Route::get('', 'WelcomeController@home');
Route::get('home', 'WelcomeController@home');


Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {

    Route::get('', 'Admin\HomeController@index')->name('home');
    Route::get('home', 'Admin\HomeController@index')->name('home');

    Route::prefix('businesses')->name('businesses.')->group(function(){
        Route::get('', [AdminHomeController::class, 'businesses'])->name('index');
        Route::get('create', [AdminHomeController::class, 'create_business'])->name('create');
    });

    Route::prefix('errands')->name('errands.')->group(function(){
        Route::get('', [AdminHomeController::class, 'errands'])->name('index');
    });
    Route::prefix('services')->name('services.')->group(function(){
        Route::get('', [AdminHomeController::class, 'services'])->name('index');
    });
    Route::prefix('products')->name('products.')->group(function(){
        Route::get('', [AdminHomeController::class, 'products'])->name('index');
    });
    Route::prefix('categories')->name('categories.')->group(function(){
        Route::get('', [AdminHomeController::class, 'categories'])->name('index');
        Route::get('sub-categories', [AdminHomeController::class, 'sub_categories'])->name('sub_categories');
    });
    Route::prefix('locations')->name('locations.')->group(function(){
        Route::get('streets', [AdminHomeController::class, 'business_streets'])->name('streets');
        Route::get('towns', [AdminHomeController::class, 'business_towns'])->name('towns');
    });
    Route::prefix('reviews')->name('reviews.')->group(function(){
        Route::get('', [AdminHomeController::class, 'reviews'])->name('index');
    });
    Route::prefix('users')->name('users.')->group(function(){
        Route::get('', [AdminHomeController::class, 'users'])->name('index');
        Route::get('create', [AdminHomeController::class, 'create_user'])->name('create');
    });
    Route::prefix('admins')->name('admins.')->group(function(){
        Route::get('', [AdminHomeController::class, 'admins'])->name('index');
        Route::get('roles', [AdminHomeController::class, 'roles'])->name('roles');
    });
    Route::prefix('plans')->name('plans.')->group(function(){
        Route::get('', [AdminHomeController::class, 'subscription_plans'])->name('index');
    });
    Route::prefix('sms_bundles')->name('sms_bundles.')->group(function(){
        Route::get('', [AdminHomeController::class, 'sms_bundles'])->name('index');
    });
    Route::prefix('reports')->name('reports.')->group(function(){
        Route::get('sms', [AdminHomeController::class, 'sms_reports'])->name('sms');
        Route::get('subscriptions', [AdminHomeController::class, 'subscription_report'])->name('subscription');
    });
    Route::prefix('settings')->name('settings.')->group(function(){
        Route::get('profile', [AdminHomeController::class, 'my_profile'])->name('profile');
        Route::get('footer', [AdminHomeController::class, 'footer_settings'])->name('footer');
        Route::get('password', [AdminHomeController::class, 'change_password'])->name('change_password');
    });
    Route::prefix('pages')->name('pages.')->group(function(){
        Route::get('', [AdminHomeController::class, 'all_pages'])->name('index');
        Route::get('team_members', [AdminHomeController::class, 'page_team_members'])->name('team_members');
    });
    Route::prefix('abuse')->name('abuse.')->group(function(){
        Route::get('', [AdminHomeController::class, 'abuse_reports'])->name('reports');
    });
   
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


Route::get('mode/{locale}', function ($batch) {
    session()->put('mode', $batch);

    return redirect()->back();
})->name('mode');

Route::any('{any?}', function(){return redirect(route('login'));});



