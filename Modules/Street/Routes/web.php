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
Route::prefix('street')->middleware('helep:' . $admin_account_type)->group(function () {
    Route::get('/', [\Modules\Street\Http\Controllers\StreetController::class, 'index'])->name('street');
	 Route::get('/create', [\Modules\Street\Http\Controllers\StreetController::class, 'create'])->name('add_street');
	 Route::post('/save', [\Modules\Street\Http\Controllers\StreetController::class, 'store'])->name('save_street');
	 Route::get('/edit/{id}', [\Modules\Street\Http\Controllers\StreetController::class, 'edit'])->name('edit_street');
	  Route::post('/update/{id}', [\Modules\Street\Http\Controllers\StreetController::class, 'update'])->name('update_street');
    Route::get('/delete/{id}', [\Modules\Street\Http\Controllers\StreetController::class, 'destroy'])->name('delete_street');
});
Route::get('street/town', [\Modules\Street\Http\Controllers\StreetController::class, 'getStreet'])->name('shop.get_street_ajax');
