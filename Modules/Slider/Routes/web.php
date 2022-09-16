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

Route::prefix('slider')->group(function() {
    Route::get('/', 'SliderController@index')->name('slider');
	Route::get('/create', [\Modules\Slider\Http\Controllers\SliderController::class, 'create'])->name('add_slider');
	Route::post('/save', [\Modules\Slider\Http\Controllers\SliderController::class, 'store'])->name('save_slider');
	Route::get('/edit/{id}', [\Modules\Slider\Http\Controllers\SliderController::class, 'edit'])->name('edit_slider');
	Route::post('/update/{id}', [\Modules\Slider\Http\Controllers\SliderController::class, 'update'])->name('update_slider');
	Route::get('/delete/{id}', [\Modules\Slider\Http\Controllers\SliderController::class, 'destroy'])->name('delete_slider');
});
?>
