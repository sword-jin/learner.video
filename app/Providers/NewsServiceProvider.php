<?php

namespace Learner\Providers;

use Illuminate\Support\ServiceProvider;
use Learner\Services\Newsletter\Newsletter;

class NewsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('news', function() {
            return new Newsletter;
        });
    }
}
