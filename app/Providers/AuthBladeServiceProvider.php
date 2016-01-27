<?php

namespace Learner\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AuthBladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('role', function($expression) {
            return "<?php if(Auth::check() && Auth::user()->hasRole{$expression}): ?>";
        });

        Blade::directive('endrole', function($expression) {
            return "<?php endif ?>";
        });

        Blade::directive('permission', function($expression) {
            return "<?php if(Auth::check() && Auth::user()->can{$expression}): ?>";
        });

        Blade::directive('endpermission', function($expression) {
            return "<?php endif ?>";
        });

        Blade::directive('ability', function($expression) {
            return "<?php if(Auth::check() && Auth::user()->ability{$expression}): ?>";
        });

        Blade::directive('endability', function($expression) {
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
        //
    }
}
