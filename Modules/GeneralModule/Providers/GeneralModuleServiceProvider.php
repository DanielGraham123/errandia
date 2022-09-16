<?php

namespace Modules\GeneralModule\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\ProductCategory\Services\CategoryService;

use Modules\Regions\Entities\Regions;
use Modules\Slider\Entities\Slider;

// Added by T.B.

class GeneralModuleServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'GeneralModule';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'generalmodule';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $categories = $this->app->make(CategoryService::class);
        $categoryList = $categories->getActiveCategories();
        $subCategoryList = $categories->getActiveSubCategories();
        View::composer('helep.general.search_bar', function ($view) use ($categoryList) {
            return $view->with('categories', $categoryList);
        });
        View::composer('helep.general.menu_sidebar', function ($view) use ($categoryList) {
            return $view->with('categories', $categoryList);
        });
        View::composer('helep.general.components.modals', function ($view) use ($subCategoryList) {
            return $view->with('categories', $subCategoryList);
        });
        View::composer('productsearch::search_errands', function ($view) use ($subCategoryList) {
            return $view->with('categories', $subCategoryList);
        });
        //generalmodule::shop_details
        View::composer('generalmodule::shop_details', function ($view) use ($subCategoryList) {
            return $view->with('subCategories', $subCategoryList);
        });
        $Regions = $this->app->make(Regions::class);
        $regions = $Regions->getRegions();
        View::composer('helep.general.search_bar', function ($view) use ($regions) {
            return $view->with('Regions', $regions);
        });
        View::composer('helep.general.footer', function ($view) use ($regions) {
            return $view->with('regions', $regions);
        });
        View::composer('helep.general.components.modals', function ($view) use ($regions) {
            return $view->with('regions', $regions);
        });
        View::composer('productsearch::search_errands', function ($view) use ($regions) {
            return $view->with('regions', $regions);
        });
        View::composer('helep.general.components.advert_slider', function ($view) {
            $sliders = $this->app->make(Slider::class);
            return $view->with('sliders', $sliders->getAllSlider());
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
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
