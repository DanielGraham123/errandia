<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Modules\Product\Entities\Product;

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

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
Route::get('/', function () {
    return redirect()->route('general_home');
});

Route::get('index_all_products', function () {
    foreach (\Modules\Product\Entities\Product::all() as $product){
        try{
            $product->search_index = $product->name." ".
                $product->description." ".
                $product->summary." ".
                $product->unit_price." ".
                $product->subCategory->name." ".
                $product->subCategory->description." ".
                $product->shop->user->name." ".
                $product->shop->user->description." ".
                $product->shop->name." ".
                $product->shop->shopContactInfo->address." ".
                (isset($product->shop->shopContactInfo)?(
                    $product->shop->shopContactInfo->street->name." ".
                    $product->shop->shopContactInfo->street->town->name." ".
                    $product->shop->shopContactInfo->street->town->region->name." "
                ):"").
                $product->shop->description;
            $product->save();
        }catch (\Exception $e){

        }
    }
});


/*
 * account management
 */
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
//
///*
// * manage product
// */
//Route::get('add_product', [ProductController::class, 'showAddProductPage']);
//Route::post('add_product', [ProductController::class, 'addProduct']);
//
//Route::get('edit_product/{id}', [ProductController::class, 'showEditProductPage']);
//Route::post('update_product/{id}', [ProductController::class, 'updateProduct'])->name('update_product');
//
//Route::get('products/list', [ProductController::class, 'showUserProducts'])->name('products');
//Route::get('delete_product/{id}', [ProductController::class, 'deleteProduct']);
