<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('whereOlderThan', function ($date) {
            return $this->whereDate('created_at', '<', $date);
        });

        Builder::macro('whereNewerThan', function ($date) {
            return $this->whereDate('created_at', '>', $date);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
