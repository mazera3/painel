<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Exibir todos os posts
    public function index()
    {
        $posts = Post::latest()->paginate(10); // Paginação opcional
        return view('posts.index', compact('posts'));
    }

    // Exibir um post específico
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('posts.show', compact('post'));
    }
}
