<?php

namespace App\Providers;

use App\View\Components\DashboardNavbar;
use App\View\Components\LogoutCard;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('logout-card', LogoutCard::class);
        Blade::component('dashboard-navbar', DashboardNavbar::class); 
    }
}
