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
Route::prefix('categories')->middleware('helep:' . $admin_account_type)->group(function () {
    Route::get('/', [\Modules\ProductCategory\Http\Controllers\ProductCategoryController::class, 'index'])->name('categories');
    Route::get('/create', [\Modules\ProductCategory\Http\Controllers\ProductCategoryController::class, 'create'])->name('add_category');
    Route::get('/show/{id}', [\Modules\ProductCategory\Http\Controllers\ProductCategoryController::class, 'show'])->name('show_category');
    Route::post('/save', [\Modules\ProductCategory\Http\Controllers\ProductCategoryController::class, 'store'])->name('save_product_category');
    Route::get('/edit/{id}', [\Modules\ProductCategory\Http\Controllers\ProductCategoryController::class, 'edit'])->name('edit_category');
    Route::post('/update/{id}', [\Modules\ProductCategory\Http\Controllers\ProductCategoryController::class, 'update'])->name('update_category');
    Route::get('/delete/{id}', [\Modules\ProductCategory\Http\Controllers\ProductCategoryController::class, 'destroy'])->name('delete_category');
    Route::get('/subcategories/{id}/create', [\Modules\ProductCategory\Http\Controllers\ProductCategoryController::class, 'addSubCategoryForm'])->name('add_sub_category');
    Route::post('/subcategories/{id}/save', [\Modules\ProductCategory\Http\Controllers\ProductCategoryController::class, 'saveSubCategory'])->name('save_sub_category');
    Route::get('/subcategories/{id}/edit/{category}', [\Modules\ProductCategory\Http\Controllers\ProductCategoryController::class, 'editSubCategoryForm'])->name('edit_sub_category');
    Route::post('/subcategories/{id}/update/{category}', [\Modules\ProductCategory\Http\Controllers\ProductCategoryController::class, 'updateSubCategory'])->name('update_sub_category');
    Route::get('/subcategories/{id}/delete/{category}', [\Modules\ProductCategory\Http\Controllers\ProductCategoryController::class, 'deleteSubCategory'])->name('delete_sub_category');
});
Route::get('/categories/subcategories/category', [\Modules\ProductCategory\Http\Controllers\ProductCategoryController::class, 'getSubCategoriesByCat']);
