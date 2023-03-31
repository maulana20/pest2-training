<?php

// source : https://laravel-news.com/pest2
// guide  : https://pestphp.com/docs/installation

it('can be listed', function($message) {
    \App\Models\Post::factory()->create([
        'message' => $message,
    ]);

    $this->get('/posts')
        ->assertStatus(200)
        ->assertSee($message);
})->with(['Laracon IN', 'Laracon US']);

it ('can be created')->todo();