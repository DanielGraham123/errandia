<?php

namespace Modules\Location\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Location\Repositories\CountryRepositoryImpl;
use Modules\Location\Repositories\Interfaces\CountryRepository;
use Modules\Location\Repositories\Interfaces\RegionRepository;
use Modules\Location\Repositories\Interfaces\TownRepository;
use Modules\Location\Repositories\Interfaces\StreetRepository;
use Modules\Location\Repositories\RegionRepositoryImpl;
use Modules\Location\Repositories\TownRepositoryImpl;
use Modules\Location\Repositories\StreetRepositoryImpl;
use Modules\Location\Services\Interfaces\LocationService;
use Modules\Location\Services\LocationServiceImpl;

class LocationServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Location';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'location';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        //register repositories
        $this->app->bind(RegionRepository::class, RegionRepositoryImpl::class);
        $this->app->bind(CountryRepository::class, CountryRepositoryImpl::class);
        $this->app->bind(TownRepository::class, TownRepositoryImpl::class);
		$this->app->bind(StreetRepository::class, StreetRepositoryImpl::class);
        //register service
        $this->app->bind(LocationService::class, LocationServiceImpl::class);
    }


    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
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

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
