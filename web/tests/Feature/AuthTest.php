<?php

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

beforeEach(function() {
    $this->user = User::factory()->count(1)->create()->first();
});

it('check auth login', function() {
    $this->json("POST", "api/auth/login", [
        "email"    => $this->user->email,
        "password" => "password"
    ])
        ->assertStatus(200)
        ->assertJson(["token_type" => "bearer"]);
});

it('check after auth', function() {
    $this->json("POST", "api/auth/me", [], [
        'Authorization' => 'Bearer ' . JWTAuth::fromUser($this->user)
    ])
        ->assertStatus(200)
        ->assertJson(["name" => $this->user->name]);
});

it('check logout', function() {
    $this->json("POST", "api/auth/logout", [], [
        'Authorization' => 'Bearer ' . JWTAuth::fromUser($this->user)
    ])
        ->assertStatus(200)
        ->assertJson(["message" => "Successfully logged out"]);
});