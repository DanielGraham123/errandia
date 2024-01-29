<?php

namespace App\Providers;

use App\Repositories\UserOTPRepository;
use App\Repositories\UserRepository;
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
        $this->app->bind(UserOTPRepository::class, function ($app) {
            return new UserOTPRepository();
        });

        $this->app->bind(UserService::class, function ($app) {
            return new UserService(new UserRepository(), new ValidationService, new UserOTPRepository(), new SMSService());
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
