<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\LdapScanProgressObserver;
use DirectoryTree\Watchdog\LdapScanProgress;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        LdapScanProgress::observe(
            LdapScanProgressObserver::class
        );
    }
}
