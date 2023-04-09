<?php

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

// source : https://jwt-auth.readthedocs.io/en/develop/laravel-installation

beforeEach(function() {
    $this->user        = User::factory()->create()->first();
    $this->credentials = [
        "email"    => $this->user->email,
        "password" => "password"
    ];
    $this->headers    = [
        'Authorization' => 'Bearer ' . JWTAuth::fromUser($this->user)
    ];
});

it('check auth login', function() {
    $this->json("POST", "api/auth/login", $this->credentials)
        ->assertStatus(200)
        ->assertJson(["token_type" => "bearer"]);
});

it('check after auth', function() {
    $this->json("POST", "api/auth/me", [], $this->headers)
        ->assertStatus(200)
        ->assertJson(["name" => $this->user->name]);
});

it('check logout', function() {
    $this->json("POST", "api/auth/logout", [], $this->headers)
        ->assertStatus(200)
        ->assertJson(["message" => "Successfully logged out"]);
});