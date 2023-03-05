<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Http\Controllers\Admin\Post\BaseController;

class IndexController extends BaseController
{
    public function index()
    {
        $posts = post::paginate(20);
        return view('admin.post.index', compact('posts'));
    }
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', compact('categories', 'tags'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);

        return redirect()->route('admin.post.index');
    }
    public function show(post $post)
    {
        return view('admin.post.show', compact('post'));
    }
    public function edit(post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }
    public function update(UpdateRequest $request, post $post)
    {
        $data = $request->validated();
        $post = $this->service->update($data, $post);

        return view('admin.post.show', compact('post'));
    }
    public function delete(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.post.index');
    }
}
