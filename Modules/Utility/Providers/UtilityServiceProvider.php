<?php

namespace Modules\Utility\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Utility\Services\Interfaces\UtilityServiceInterface;
use Modules\Utility\Services\UtilityService;

class UtilityServiceProvider extends ServiceProvider
{
    protected $moduleName = 'Utility';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'utility';
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UtilityServiceInterface::class, UtilityService::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
