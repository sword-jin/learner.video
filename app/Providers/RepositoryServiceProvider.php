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

        $this->app->bind(
            'Learner\Repositories\VideoRepositoryInterface',
            'Learner\Repositories\Eloquent\VideoRepository'
        );

        $this->app->bind(
            'Learner\Repositories\BlogRepositoryInterface',
            'Learner\Repositories\Eloquent\BlogRepository'
        );

        $this->app->bind(
            'Learner\Repositories\SubscriberRepositoryInterface',
            'Learner\Repositories\Table\SubscriberRepository'
        );

        $this->app->bind(
            'Learner\Repositories\NewsletterRepositoryInterface',
            'Learner\Repositories\Eloquent\NewsletterRepository'
        );

        $this->app->bind(
            'Learner\Repositories\LinkRepositoryInterface',
            'Learner\Repositories\Eloquent\LinkRepository'
        );
    }
}
