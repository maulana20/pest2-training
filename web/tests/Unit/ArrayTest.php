<?php

use Illuminate\Support\Arr;

it('join', function () {
    $stack = ["Tailwind", "Alpine", "Laravel", "Livewire"];
    $this->assertEquals("Tailwind, Alpine, Laravel, Livewire", Arr::join($stack, ", "));
    $this->assertEquals("Tailwind, Alpine, Laravel and Livewire", Arr::join($stack, ", ", " and "));
});

it('keyBy', function () {
    $array = [
        ["product_id" => "prod-100", "name" => "Desk"],
        ["product_id" => "prod-200", "name" => "Chair"],
    ];
    $this->assertEquals([
        "prod-100" => ["product_id" => "prod-100", "name" => "Desk"],
        "prod-200" => ["product_id" => "prod-200", "name" => "Chair"],
    ], Arr::keyBy($array, "product_id"));
});

it('get has', function () {
    $data = [
        'products' => [
            'desk' => [
                'name' => 'Dakendesk',
                'price' => 599.00,
                'description' => 'Solid oak desk built from scatch.'
            ]
        ]
    ];
    $this->assertEquals(599.00, Arr::get($data, 'products.desk.price'));
    $this->assertFalse(Arr::has($data, 'products.desk.discount'));
    $this->assertNull(Arr::get($data, 'products.desk.discount'));
    $this->assertEquals(['type' => 'percent', 'value' => 10], Arr::get($data, 'products.desk.discount', ['type' => 'percent', 'value' => 10]));
});

it('first or last', function () {
    $array = [];
    $this->assertNull(Arr::last($array));
    $this->assertEquals(100, Arr::last($array, null, 100));

    $array = [100, 200, 300, 110];
    $this->assertEquals(300, Arr::last($array, fn ($e) => $e > 110));
    $this->assertEquals(200, Arr::first($array, fn ($e) => $e > 110));
});

it('pluck', function () {
    $array = [
        ['user' => ['id' => 1, 'name' => 'User 1', 'email' => 'user1@example.com']],
        ['user' => ['id' => 2, 'name' => 'User 2', 'email' => 'user2@example.com']],
    ];
    $this->assertEquals([
        'user1@example.com',
        'user2@example.com',
    ], Arr::pluck($array, 'user.email'));
});