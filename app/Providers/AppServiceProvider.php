<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\ServiceProvider;
use App\Observers\PostObserver;
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
        if (app()->environment('production') && !app()->runningInConsole()) {
            try {
                if (!\Illuminate\Support\Facades\Schema::hasTable('users')) {
                    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                }
            } catch (\Exception $e) {
                //
            }
        }

        Post::observe(PostObserver::class);
     
}
}