<?php

use Illuminate\Support\Arr;
use App\Models\Product;

// source: https://laravel.io/articles/filter-eloquent-models-with-multiple-optional-filters

it('multiple optional filter', function() {
    $product = Product::factory()->count(1)->create()->first();
    $params = http_build_query([
        'price'    => Arr::join([ $product->price, $product->price + 1000 ], ","),
        'category' => $product->category->slug,
        'brand'    => $product->brand->slug,
    ]);

    $this->get("/products/multi-filter?{$params}")
        ->assertStatus(200)
        ->assertSee($product->slug);
});

// source : https://laravel-news.com/modelling-busines-processes-in-laravel

it('multiple optional pipeline', function() {
    $product = Product::factory()->count(1)->create()->first();
    $params = http_build_query([
        'price'    => Arr::join([ $product->price, $product->price + 1000 ], ","),
        'category' => $product->category->slug,
        'brand'    => $product->brand->slug,
    ]);

    $this->get("/products/multi-pipeline?{$params}")
        ->assertStatus(200)
        ->assertSee($product->slug);
});