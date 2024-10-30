<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();
        // To specify error message on mass assignment => Model::preventSilentlyDiscardingAttributes($this->app->isLocal());
        // To disable mass assignment protection globally in the app (instead of using fillable or guarded) => Model::unguard();


        // Paginator::useBootstrapFive(); If you want to use something else for pagination (than tailwind by default)
    }
}
