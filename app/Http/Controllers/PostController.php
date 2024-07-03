<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function show(Post $post): View
    {
        // $result = Post::withCount('comments')->with('comments.user')->findOrFail($post->id);

        // return view('post.show', [
        //     'post' => $result
        // ]);

        $post = Post::withCount('comments')->findOrFail($post->id);
        // $comments = $post->comments()->with('user')->paginate(3); 
        $comments = $post->comments()->with('user')->take(5)->get();

        return view('post.show', [
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function loadMoreComments(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $offset = $request->input('offset', 0);
        $offset += 1;
        $comments = $post->comments()->with('user')->skip($offset)->take(5)->get();

        return response()->json($comments);
    }

    /******* */
    public function postByTopic(Topic $topic): View
    {
        $posts = $topic->posts()->withCount('comments')->paginate(5);
        return view('index', [
            'posts' => $posts,
            'list' => true,
        ]);
    }
}
