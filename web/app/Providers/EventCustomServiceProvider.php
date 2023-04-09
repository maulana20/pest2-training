<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PipelineProcessService;

class EventCustomServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('App\Contracts\PipelineProcessInterface', fn ($app) => new PipelineProcessService());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
