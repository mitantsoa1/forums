<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\View\View;

class DefaultController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query();

        if ($search = $request->search) {
            $posts->where('title', 'LIKE', '%' . $search . '%')
                ->orWhere('content', 'LIKE', '%' . $search . '%');
        }
        $posts = $posts->withCount('comments')->paginate(5);
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
