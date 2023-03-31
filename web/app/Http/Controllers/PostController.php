<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Repositories\PostRepository;
use App\Requests\Post\StoreRequest;

class PostController extends Controller
{
    protected $post;
    
    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }
    
    public function index(): View
    {
        return view('posts.index', [
            'posts' => $this->post->all()
        ]);
    }
    
    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->post->create($data);

        return redirect(route('posts.index'));
    }
}
