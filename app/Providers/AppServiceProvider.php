<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Force HTTPS en production (important pour sécurité)
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Trusted proxies pour déploiements avec load balancer
        if ($this->app->environment('production')) {
            \Illuminate\Http\Request::setTrustedProxies(
                ['*'], // Ou spécifier les IPs: ['192.168.1.1', '10.0.0.0/8']
                \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR | \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO
            );
        }
    }
}
