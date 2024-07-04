<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // public function create(Request $request)
    // {
    //     $user = Auth::user();
    //     $comment = $request->validate([
    //         'content' => ['required', 'string', 'between:4,255']
    //     ]);
    //     $comment["post_id"] = $request->post_id;
    // }
}