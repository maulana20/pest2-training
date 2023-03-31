<?php

// source : https://laravel-news.com/pest2
// guide  : https://pestphp.com/docs/installation

test('controllers')
    ->expect('App\Http\Controllers')
    ->not->toUse('Illuminate\Http\Request');

test('models')
    ->expect('App\Models\Post') // actual App\Models
    ->toOnlyBeUsedIn('App\Repositories')
    ->toOnlyUse('Illuminate\Database');

test('repositories')
    ->expect('App\Repositories')
    ->toOnlyBeUsedIn('App\Http\Controllers')
    ->toOnlyUse('App\Models');

test('globals')
    ->expect(['dd', 'dump', 'ray'])
    ->not->toBeUsed();

test('facades')
    ->expect('Illuminate\support\Facades')
    ->not->toBeUsed()
    ->ignoring('App\Providers');