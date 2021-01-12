<?php

namespace Marshmallow\NovaSettingsTool;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Marshmallow\NovaSettingsTool\Http\Middleware\Authorize;
use Marshmallow\NovaSettingsTool\ValueObjects\SettingRegister;

/**
 * Class ToolServiceProvider
 * @package Marshmallow\NovaSettingsTool
 */
class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfigs();
        $this->loadTranslations();
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'settings');

        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            $this->addJSData();
            SettingRegister::init();
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/settings')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (Nova::runsMigrations()) {
            $this->loadMigrationsFrom(__DIR__.'/Migrations');
        }

        $this->mergeConfigFrom(
            $this->getConfigsPath(),
            'settings'
        );
    }

    /**
     * Get local package configuration path.
     *
     * @return string
     */
    private function getConfigsPath()
    {
        return __DIR__.'/../config/settings.php';
    }

    /**
     * Publish configuration file.
     *
     * @return void
     */
    private function publishConfigs()
    {
        $this->publishes([
            $this->getConfigsPath() => config_path('settings.php'),
        ], 'settings');
    }

    /**
     * Load the translations.
     *
     * @return void
     */
    private function loadTranslations()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'settings');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/settings'),
            ], 'settings');
        }
    }

    /**
     * Add the config and translation data to the client side Nova component (Laravel Nova does this not by default).
     * @return void
     */
    public function addJSData()
    {
        Nova::provideToScript([
            'settings_tool' => [
                'translations' => [
                    'settings_title' => trans('Settings'),
                    'save_settings' => trans('Save Settings'),
                    'save_success' => trans('The settings are saved successfully!'),
                    'save_error' => trans('An error occurred while saving the settings!'),
                    'load_error' => trans('An error occurred while loading the settings!'),
                    'module_not_migrated' => trans('The settings module is not migrated!'),
                    'setting_tab_suffix' => trans('Settings'),
                ],
                'config' => [
                    'show_title' => config('settings.show_title'),
                    'show_suffix' => config('settings.show_suffix'),
                    'show_icons' => config('settings.show_icons'),
                ],
            ],
        ]);
    }
}
