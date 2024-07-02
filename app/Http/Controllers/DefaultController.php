<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\View\View;

class DefaultController extends Controller
{
    public function index()
    {
        $posts = Post::withCount('comments')->paginate(5);
        return view('index', [
            'posts' => $posts,
            'list' => true,
        ]);
    }

    // public function show(Post $post):View
    // {
    //     return view('post');
    // }
}
