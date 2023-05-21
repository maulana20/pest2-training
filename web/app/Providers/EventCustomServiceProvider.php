<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\PipelineProcessService;
use App\Http\Middleware\ContentSecurityPolicy;
use App\Http\Middleware\CacheControl;

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
        $this->app['router']->pushMiddlewareToGroup('web', ContentSecurityPolicy::class);
        $this->app['router']->pushMiddlewareToGroup('web', CacheControl::class);
    }
}
