<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->extend('url', function ($url, $app) {
            $customUrl = new \App\Routing\CustomUrlGenerator(
                $app['router']->getRoutes(),
                $app->make('request'),
                $app['config']['app.asset_url']
            );

            // Copy all properties from the original UrlGenerator to preserve internal state (resolvers, etc.)
            $reflection = new \ReflectionClass($url);
            foreach ($reflection->getProperties() as $property) {
                $property->setAccessible(true);
                if ($property->isInitialized($url)) {
                    $property->setValue($customUrl, $property->getValue($url));
                }
            }

            return $customUrl;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Share common data across all frontend views (queried only once per request)
        view()->composer(['front.*'], function ($view) {
            static $setting = null;
            static $seo = null;

            if ($setting === null) {
                $setting = \App\Models\SiteSetting::find(1) ?? new \App\Models\SiteSetting();
            }
            if ($seo === null) {
                $seo = \App\Models\Seo::find(1);
            }

            $view->with('setting', $setting)->with('seo', $seo);
        });
    }
}
