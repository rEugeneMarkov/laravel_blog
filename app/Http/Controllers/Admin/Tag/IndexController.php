<?php

namespace App\Http\Controllers\Admin\tag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\tag\StoreRequest;
use App\Http\Requests\Admin\tag\UpdateRequest;
use App\Models\tag;

class IndexController extends Controller
{
    public function index()
    {
        $tags = tag::all();
        return view('admin.tag.index', compact('tags'));
    }
    public function create()
    {
        return view('admin.tag.create');
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data = tag::firstOrCreate($data);
        return redirect()->route('admin.tag.index');
    }
    public function show(tag $tag)
    {
        return view('admin.tag.show', compact('tag'));
    }
    public function edit(tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }
    public function update(UpdateRequest $request, tag $tag)
    {
        $data = $request->validated();
        $tag->update($data);
        return view('admin.tag.show', compact('tag'));
    }
    public function delete(tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tag.index');
    }
}
