<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use App\Jobs\StoreUserJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\User\PasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;

class IndexController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }
    public function create()
    {
        $roles = User::getRoles();
        return view('admin.user.create', compact('roles'));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        StoreUserJob::dispatch($data);
        return redirect()->route('admin.user.index');
    }
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }
    public function edit(User $user)
    {
        $roles = User::getRoles();
        return view('admin.user.edit', compact('user', 'roles'));
    }
    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        return view('admin.user.show', compact('user'));
    }
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index');
    }
}
