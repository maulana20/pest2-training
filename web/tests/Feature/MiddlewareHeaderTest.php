<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Middleware\ContentSecurityPolicy;
use App\Http\Middleware\CacheControl;

// source : https://github.com/Treblle/security-headers

it('can set the content security policy header for the response', function (): void {
    $middleware = new ContentSecurityPolicy;
    $response = $middleware->handle(
        request: Request::create(uri: '/'),
        next: fn () => new Response,
    );
    expect($response->headers->get('Content-Security-Policy'))->toEqual("frame-ancestors 'self'");
});

it('can set the cache control header for the response', function (): void {
    $middleware = new CacheControl;
    $response = $middleware->handle(
        request: Request::create(uri: '/'),
        next: fn () => new Response,
    );
    expect($response->headers->get('Cache-Control'))->toEqual("no-cache, no-store, private");
});

it ('can not set the content security policy header for the response', function (): void {
    $this->mock(ContentSecurityPolicy::class)
        ->expects('handle')
        ->andReturnUsing(function($request, \Closure $next) {
            return $next($request);
        });
    $response = $this->get('/');
    expect($response->headers->get('Content-Security-Policy'))->not->toMatchArray([
        'content-security-policy' => 'Content-Security-Policy'
    ]);
});
