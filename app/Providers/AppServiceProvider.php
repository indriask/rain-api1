<?php

namespace App\Providers;

use App\View\Components\AddVacancy;
use App\View\Components\DashboardNavbar;
use App\View\Components\Head;
use App\View\Components\LogoutCard;
use App\View\Components\Test;
use Illuminate\Support\Facades\Blade;
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
        Blade::component('logout-card', LogoutCard::class);
        Blade::component('dashboard-navbar', DashboardNavbar::class); 
        Blade::component('add-vacancy', AddVacancy::class);  
    }
}
