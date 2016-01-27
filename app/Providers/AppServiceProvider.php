<?php

namespace Learner\Providers;

use Illuminate\Validation\Factory;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Factory $validator)
    {
        require_once app_path() . '/validators.php';

        Blade::directive('role', function($expression) {
            return "<?php if(Auth::check() && Auth::user()->hasRole{$expression}): ?>";
        });

        Blade::directive('endrole', function($expression) {
            return "<?php endif ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
    }
}
