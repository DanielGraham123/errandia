<?php

use \Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('errands', ErrandController::class);
    $router->resource('towns', TownsController::class);
    $router->resource('regions', RegionsController::class);
    $router->resource('shops', ShopsController::class);
    $router->resource('products', ProductController::class);
    $router->resource('users', UserController::class);



});
