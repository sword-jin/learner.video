<?php

namespace Learner\Providers;

use Learner\Services\Videos\VideoApi;
use Illuminate\Support\ServiceProvider;

class VideoApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['video-api'] = $this->app->share(function ($app) {
            return new VideoApi;
        });
    }
}
