<?php

namespace Learner\Providers;

use Illuminate\Support\ServiceProvider;
use Learner\Services\Image\AvatarManagerService;

class AvatarServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app['avatar.manager'] = $this->app->share(function ($app) {
            return new AvatarManagerService;
        });
    }
}
