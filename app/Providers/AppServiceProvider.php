<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\AdminAuth;
use App\Models\AdminRole;
use App\Observers\AdminAuthObserver;
use App\Observers\AdminObserver;
use App\Observers\AdminRoleObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (app()->environment() == 'local' || app()->environment() == 'testing') {
            error_reporting(E_ERROR);
        } else {
            error_reporting(0);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Admin::observe(AdminObserver::class);
        AdminAuth::observe(AdminAuthObserver::class);
        AdminRole::observe(AdminRoleObserver::class);
    }
}
