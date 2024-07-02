<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function show(Post $post): View
    {
        $result = Post::withCount('comments')->with('comments.user')->findOrFail($post->id);

        return view('post.show', [
            'post' => $result
        ]);
    }
}
