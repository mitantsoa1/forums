<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('comment');
    }

    public function show(Post $post): View
    {

        $post = Post::withCount('comments')->findOrFail($post->id);
        $comments = $post->comments()->with('reaction_jmsCount')->with('reaction_jmpsCount')->with('user')->take(5)->get();

        return view('post.show', [
            'post' => $post,
            'comments' => $comments,
            'list' => false
        ]);
    }

    public function loadMoreComments(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $offset = $request->input('offset', 0);
        // $offset += 1;
        $comments = $post->comments()->with('reaction_jmsCount')->with('reaction_jmpsCount')->with('user')->skip($offset)->take(5)->get();

        return response()->json($comments);
    }

    /******* */
    public function postByTopic(Topic $topic, Request $request): View
    {
        $posts = $topic->posts()->withCount('comments')->paginate(5);
        return view('index', [
            'posts' => $posts,
            'list' => true,
        ]);
    }

    public function comment(Post $post, Request $request)
    {
        $content = $request->validate([
            'comment' => ['required', 'string', 'between:4,255']
        ]);

        /**
         * Dans le Model/Comment, on ajoute la ligne 
         * protected $fillable = ['content', 'post_id', 'user_id'] <=> protect $guarded = ['id','created_at','updated_at']
         * puis on peut faire
         * Comment::create([
         *  'content' => $validated['comment'],
         *  'post_id' => $post->id,
         *  'user_id' => Auth::id(),
         *]);
         */


        $comment = new Comment();
        $comment->content = $content['comment'];
        $comment->post_id = $post->id;
        $comment->user_id = Auth::id();

        $comment->save();

        return back()->withStatus('Success !');
    }

    public function react(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($request->react == 'jm') {
            return response()->json('ok');
        }
    }
}
