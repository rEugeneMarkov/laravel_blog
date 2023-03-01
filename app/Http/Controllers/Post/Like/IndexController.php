<?php

namespace App\Http\Controllers\Post\Like;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\Comment\StoreRequest;

class IndexController extends Controller
{
    public function store(Post $post)
    {
        auth()->user()->likedPosts()->toggle($post->id);
        return redirect()->back();
    }
}
