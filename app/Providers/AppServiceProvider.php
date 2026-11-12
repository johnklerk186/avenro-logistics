<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            $siteSettings = SiteSetting::first();
            $siteCurrency = SiteSetting::getCurrency();
        } catch (\Throwable $e) {
            $siteSettings = null;
            $siteCurrency = ['code' => 'USD', 'symbol' => '$', 'label' => 'USD'];
        }
        View::share('siteCurrency', $siteCurrency);
        View::share('siteSettings', $siteSettings);
    }
}
