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
Route::prefix('regions')->middleware('helep:' . $admin_account_type)->group(function () {
    //Route::get('/', 'RegionsController@index');
    Route::get('/', 'RegionsController@showRegionsList')->name('regions');
    Route::post('/town/ajax', 'RegionsController@saveTown')->name('save_town');
    Route::get('/town/delete', 'RegionsController@deleteTown')->name('delete_town');
    Route::get('/towns/{town_id}', 'RegionsController@showUpdateTownPage')->name('update_town_page');
    Route::post('/towns/{town_id}', 'RegionsController@updateTown')->name('update_town');
});
Route::prefix('regions')->group(function () {
    Route::get('/town', 'RegionsController@showTownPage')->name('towns');
    Route::get('/town/ajax', 'RegionsController@getRegions')->name('get_towns_by_country_id');
    Route::get('stores/{id}', 'RegionsController@stores')->name('regions_stores');
});
