<?php

namespace App\Providers;

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
        // Load admin components from resources/views/components/admin
        $this->loadViewComponentsAs('admin', [
            resource_path('views/components/admin'),
        ]);

        // Register Observers
        // Register Observers
        \Spatie\Permission\Models\Role::observe(\App\Observers\RoleObserver::class);
        \App\Models\Page::observe(\App\Observers\PageObserver::class);
        \App\Models\Post::observe(\App\Observers\PostObserver::class);

        // Share menus with header
        \Illuminate\Support\Facades\View::composer('partials.header', function ($view) {
            $view->with('menus', \App\Models\Menu::where('is_active', true)->orderBy('order_no')->get());
        });
    }
}
