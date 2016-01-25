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
    }
}
