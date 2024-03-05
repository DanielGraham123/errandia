<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\RegionRepository;
use App\Repositories\ShopCategoryRepository;
use App\Repositories\ShopManagerRepository;
use App\Repositories\ShopOTPRepository;
use App\Repositories\ShopRepository;
use App\Repositories\StreetRepository;
use App\Repositories\TownRepository;
use App\Repositories\UserOTPRepository;
use App\Repositories\UserRepository;
use App\Services\CategoryService;
use App\Services\GeographicalService\RegionService;
use App\Services\GeographicalService\StreetService;
use App\Services\GeographicalService\TownService;
use App\Services\ShopService;
use App\Services\SMSService;
use App\Services\UserService;
use App\Services\ValidationService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // injecting  all the repositories
        $this->app->bind(UserOTPRepository::class, function ($app) {
            return new UserOTPRepository();
        });

        $this->app->bind(ShopRepository::class, function ($app) {
            return new ShopRepository();
        });

        $this->app->bind(ShopCategoryRepository::class, function ($app) {
            return new ShopCategoryRepository();
        });

        $this->app->bind(ShopManagerRepository::class, function ($app) {
            return new ShopManagerRepository();
        });

        $this->app->bind(CategoryRepository::class, function ($app) {
            return new CategoryRepository();
        });

        $this->app->bind(ProductCategoryRepository::class, function ($app) {
            return new CategoryRepository();
        });

        $this->app->bind(RegionRepository::class, function ($app) {
            return new RegionRepository();
        });

        $this->app->bind(TownRepository::class, function ($app) {
            return new TownRepository();
        });

        $this->app->bind(StreetRepository::class, function ($app) {
            return new StreetRepository();
        });


        // Injecting all the services
        $this->app->bind(UserService::class, function ($app) {
            return new UserService(
                new UserRepository(),
                new ValidationService(),
                new UserOTPRepository(),
                new SMSService()
            );
        });

        $this->app->bind(ShopService::class, function ($app) {
            return new ShopService(
                new ShopRepository(),
                new ValidationService(),
                new ShopManagerRepository(),
                new ShopOTPRepository(),
                new SMSService()
            );
        });

        $this->app->bind(CategoryService::class, function ($app) {
            return new CategoryService(
                new CategoryRepository(),
                new ValidationService(),
                new ProductCategoryRepository(),
                new ShopCategoryRepository(),
            );
        });


        $this->app->bind(RegionService::class, function ($app){
            return new RegionService(
                new RegionRepository()
            );
        });

        $this->app->bind(TownService::class, function ($app){
            return new TownService(
                new TownRepository()
            );
        });

        $this->app->bind(StreetService::class, function ($app){
            return new StreetService(
                new StreetRepository()
            );
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if(Schema::hasTable('privacy_policies')) {
            View::share('policies', \App\Models\PrivacyPolicy::orderBy('title')->get());
        }
    }
}
