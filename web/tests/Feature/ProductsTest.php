<?php

use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Product;

beforeEach(function() {
    $this->product = Product::factory()->create()->first();
    $this->params  = http_build_query([
        'price'    => Arr::join([ $this->product->price, $this->product->price + 1000 ], ","),
        'category' => $this->product->category->slug,
        'brand'    => $this->product->brand->slug,
    ]);
});

// source: https://laravel.io/articles/filter-eloquent-models-with-multiple-optional-filters

it('multiple optional filter', function() {
    $this->get("/products/multi-filter?{$this->params}")
        ->assertStatus(200)
        ->assertSee($this->product->slug);
});

// source : https://laravel-news.com/modelling-busines-processes-in-laravel
// source : https://code.tutsplus.com/tutorials/how-to-register-use-laravel-service-providers--cms-28966

it('multiple optional pipeline', function() {
    $this->get("/products/multi-pipeline?{$this->params}")
        ->assertStatus(200)
        ->assertSee($this->product->slug);
});

// source : https://coderadvise.com/laravel-pennant-package-feature-flag-tutorial

it('list in condition subscribe', function() {
    $user = User::factory()->create([
        'name'          => 'subscribe example',
        'email'         => 'subscribe@example.com',
        'password'      => bcrypt('password'),
        'is_subscriber' => 1,
    ]);

    $this->actingAs($user);
    $this->get('/products/subscribe-list')->assertSuccessful();
});

it('list in condition unsubscribe', function() {
    $user = User::factory()->create([
        'name'          => 'unsubscribe example',
        'email'         => 'unsubscribe@example.com',
        'password'      => bcrypt('password'),
        'is_subscriber' => 0,
    ]);

    $this->actingAs($user);
    $this->get('/products/subscribe-list')->assertBadRequest();
});