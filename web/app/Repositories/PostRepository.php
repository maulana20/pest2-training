<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    public function all(): object
    {
        return Post::latest()->get();
    }

    public function create(array $data): void
    {
        Post::create($data);
    }
}