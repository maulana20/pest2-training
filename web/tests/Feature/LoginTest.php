<?php

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use App\Providers\RouteServiceProvider;
use App\Models\User;

// source : https://laravel-news.com/how-to-start-testing

it('can login', function() {
    $user = User::factory()->create();
    $this->actingAs($user)
        ->get(RouteServiceProvider::HOME)
        ->assertStatus(200);
});

it('can logout', function() {
    $user = User::factory()->create();
    $this->actingAs($user)
        ->post('/logout')
        ->assertRedirect('/');
    $this->assertGuest();
});

it('can login must verify email', function() {
    $user = User::factory()->unverified()->create();
    $this->actingAs($user)
        ->get(RouteServiceProvider::HOME)
        ->assertRedirect('/email/verify');
});

it('can register send email', function() {
    $this->withoutExceptionHandling();
    $data = User::factory()->register();
    Notification::fake();
    Notification::assertNothingSent();

    $this->post('/register', $data);
    $user = User::firstWhere('email', $data['email']);
    Notification::assertSentTo($user, VerifyEmail::class);
});