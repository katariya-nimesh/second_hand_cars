<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use GuzzleHttp\Client as GuzzleClient;
use Kreait\Firebase\Messaging\ApiClient;
use Kreait\Firebase\Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind Guzzle HTTP client
        $this->app->singleton(GuzzleClient::class, function ($app) {
            return new GuzzleClient();
        });

        // Bind Firebase Factory with service account
        $this->app->singleton(Factory::class, function ($app) {
            return (new Factory())
                ->withServiceAccount(base_path('firebase.json')); // Update path to your service account JSON
        });

        // Bind Firebase Messaging
        $this->app->singleton(Messaging::class, function ($app) {
            return $app->make(Factory::class)->createMessaging();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); // or other supported length
    }
}
