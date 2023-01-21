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

use Illuminate\Support\Facades\Route;

$admin_account_type = \Modules\GeneralModule\Config\AccountType::$IS_ADMIN;
//->middleware('helep:' . $admin_account_type)
Route::prefix('shops')->group(function () {
    Route::get('/', [\Modules\Shop\Http\Controllers\ShopController::class, 'index'])->name('shop_list');
    Route::get('/create', [\Modules\Shop\Http\Controllers\ShopController::class, 'create'])->name('add_shop');
    Route::post('/store', [\Modules\Shop\Http\Controllers\ShopController::class, 'store'])->name('save_shop');
    Route::get('/show/{id}', [\Modules\Shop\Http\Controllers\ShopController::class, 'show'])->name('show_shop');
    Route::get('/edit/{id}', [\Modules\Shop\Http\Controllers\ShopController::class, 'edit'])->name('edit_shop');
    Route::post('/update/{id}', [\Modules\Shop\Http\Controllers\ShopController::class, 'update'])->name('update_shop');
    Route::get('/delete/{id}', [\Modules\Shop\Http\Controllers\ShopController::class, 'destroy'])->name('delete_shop');

});
