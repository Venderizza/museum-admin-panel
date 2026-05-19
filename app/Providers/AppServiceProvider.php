<?php

namespace App\Providers;

use App\Models\ExhibitScanPage;
use App\Observers\ExhibitScanPageObserver;
use App\Services\AgentService;
use App\Services\ScanService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ScanService::class, function(){
            return new ScanService(config('api.send_scan_url'));
        });

        $this->app->bind(AgentService::class, function(){ 
            return new AgentService(config('api.send_exhibit'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ExhibitScanPage::observe(ExhibitScanPageObserver::class);
    }
}
