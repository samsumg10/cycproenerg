<?php

namespace App\Providers;
use App\MyApp;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Request;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $requestUri = $this->app->request->getRequestUri();
        Request::macro('routeType', function () use ($requestUri) {
            if (preg_match("#^/" . MyApp::ADMINS_SUBDIR . "/#", $requestUri)) {
                return MyApp::ADMINS_SUBDIR;
            } elseif (preg_match("#^/" . MyApp::COMPANIES_SUBDIR . "/#", $requestUri)) {
                return MyApp::COMPANIES_SUBDIR;
            } elseif (preg_match("#^/" . MyApp::EMPLOYEE_SUBDIR . "/#", $requestUri)) {
                return MyApp::EMPLOYEE_SUBDIR;
            } else {
                return null;
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
