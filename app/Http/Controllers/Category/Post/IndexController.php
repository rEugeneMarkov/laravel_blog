<?php

namespace App\Http\Controllers\Category\Post;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class IndexController extends Controller
{
    public function index(Category $category)
    {
        $posts = $category->posts()->paginate(6);
        return view('category.post.index', compact('posts'));
    }
}
