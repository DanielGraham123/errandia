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

Route::prefix('productsearch')->group(function () {
    Route::get('/', 'ProductSearchController@index');
    Route::get('/', 'ProductSearchController@index')->name('productsearch');
    Route::get('productsort', 'ProductSearchController@productsort')->name('productsortpage');
    Route::post('productsort', 'ProductSearchController@productsort')->name('productsort');
    Route::post('/sendproductquote', 'ProductSearchController@sendProductQuote')->name('send_product_quote');
    Route::get("/errands", "ProductSearchController@showCustomProductSearchPage")->name("run_errand_page");
});
Route::get('/custom/q/{url}', 'ProductSearchController@showCustomQuotePage')->name('showCustomQuotePage');
