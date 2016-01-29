<?php

namespace Learner\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind(
            'Learner\Repositories\UserRepositoryInterface',
            'Learner\Repositories\Eloquent\UserRepository'
        );

        $this->app->bind(
            'Learner\Repositories\RoleRepositoryInterface',
            'Learner\Repositories\Eloquent\RoleRepository'
        );

        $this->app->bind(
            'Learner\Repositories\SeriesRepositoryInterface',
            'Learner\Repositories\Eloquent\SeriesRepository'
        );

        $this->app->bind(
            'Learner\Repositories\CategoryRepositoryInterface',
            'Learner\Repositories\Eloquent\CategoryRepository'
        );
    }
}
