<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register() {
            Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
                // filter oauth ones
                if (!str_contains($query->sql, 'oauth')) {
                    Log::debug($query->sql . ' - ' . serialize($query->bindings));
                }
            });
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Builder::useVite();

    }
}
