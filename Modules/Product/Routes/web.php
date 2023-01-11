<?php

use Modules\Product\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
/*
 * manage product
 */
$vendor_account_type = \Modules\GeneralModule\Config\AccountType::$IS_VENDOR;
Route::prefix('products')->middleware('helep:' . $vendor_account_type)->group(function () {
    Route::get('create', [ProductController::class, 'showAddProductPage'])->name('add_product');
    Route::post('save', [ProductController::class, 'addProduct'])->name('save_product');

    Route::get('show/{id}', [ProductController::class, 'showProductDetails'])->name('show_product');
    Route::get('edit/{id}', [ProductController::class, 'showEditProductPage'])->name('edit_product');
    Route::post('update/{id}', [ProductController::class, 'updateProduct'])->name('update_product');
	Route::post('postreply', [ProductController::class, 'postReply'])->name('post_reply');
	Route::post('enquirypostreply', [ProductController::class, 'postReplyFromEnquiryDetails'])->name('enquirypostreply');

    Route::get('/list', [ProductController::class, 'showUserProducts'])->name('products');
    Route::get('delete/{id}', [ProductController::class, 'deleteProduct'])->name('delete_product');
	Route::get('/product-list', [ProductController::class, 'showProductList'])->name('product_list');

	Route::get('/quote-list', [ProductController::class, 'showProductQuotes'])->name('product_quote_list');
    Route::get('/quotes/trash',[ProductController::class,'showDeletedProductQuotes'])->name('show_deleted_quotes');
    Route::get('/quotes/trash/{id}',[ProductController::class,'restoreDeletedQuote'])->name('restore_deleted_quote');
    Route::delete('/quotes/trash/{id}',[ProductController::class,'deleteQuotePermanently'])->name('delete_quote_permanently');

    Route::get('/quote-details/{id}', [ProductController::class, 'showProductQuoteDetails'])->name('product_quote_details');
    Route::delete('/quotes/{id}',[ProductController::class,'deleteQuote'])->name('delete_quote');

	Route::get('/enquiry-list', [ProductController::class, 'showProductEnquiries'])->name('product_enquiry_list');
	Route::get('/enquiry-details/{id}', [ProductController::class, 'showProductEnquiryDetails'])->name('product_enquiry_details');
	Route::get('/review-list', [ProductController::class, 'showProductReviews'])->name('product_review_list');
	Route::get('/review-list/hide', [ProductController::class, 'hideProductReview'])->name('hide_product_review');
	Route::get('/review-details/{id}', [ProductController::class, 'showProductReviewDetails'])->name('product_review_details');
});
