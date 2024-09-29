<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Http\HttpClientOptions;
use GuzzleHttp\Client;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('firebase.messaging', function ($app) {
            $factory = new Factory();

            $credentialsPath = base_path(config('firebase.credentials'));

            if (file_exists($credentialsPath)) {
                $factory = $factory->withServiceAccount($credentialsPath);
            } else {
                \Log::error('Firebase credentials file not found: ' . $credentialsPath);
                throw new \Exception('Firebase credentials file not found: ' . $credentialsPath);
            }

            return $factory->createMessaging();
        });
    }
}
