<?php

namespace Learner\Providers;

use Illuminate\Support\ServiceProvider;
use Learner\Services\Image\ImageManagerService;

class ImageManagerServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app['image.manager'] = $this->app->share(function ($app) {
            return new ImageManagerService;
        });
    }
}
