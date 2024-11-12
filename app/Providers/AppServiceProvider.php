<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Session\DatabaseSessionHandler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
        Paginator::useBootstrap();
        Session::extend('custom-database', function ($app) {
            $table   = config('session.table');
            $minutes = config('session.lifetime');
    
            return new DatabaseSessionHandler($this->getDatabaseConnection(), $table, $minutes, $app);
        });
    }

    protected function getDatabaseConnection()
    {
        $connection = config('session.connection');

        return DB::connection($connection);
    }
}
