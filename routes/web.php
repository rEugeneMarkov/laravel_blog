<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'Main'], function () {
    Route::get('/', [App\Http\Controllers\Main\IndexController::class, 'index'])
        ->name('main.index');
});
Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
    Route::get('/', [App\Http\Controllers\Post\IndexController::class, 'index'])
        ->name('post.index');
    Route::get('/{post}', [App\Http\Controllers\Post\IndexController::class, 'show'])
        ->name('post.show');

    Route::group(['namespace' => 'Comment', 'prefix' => '{post}/comments'], function () {
        Route::post('/', [App\Http\Controllers\Post\Comment\IndexController::class, 'store'])
            ->name('post.comment.store');
    });

    Route::group(['namespace' => 'Like', 'prefix' => '{post}/likes'], function () {
        Route::post('/', [App\Http\Controllers\Post\Like\IndexController::class, 'store'])
            ->name('post.like.store');
    });
});

Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
    Route::get('/', [App\Http\Controllers\Category\IndexController::class, 'index'])
        ->name('category.index');

    Route::group(['namespace' => 'Post', 'prefix' => '{category}/posts'], function () {
        Route::get('/', [App\Http\Controllers\Category\Post\IndexController::class, 'index'])
            ->name('category.post.index');
    });
});

Route::middleware(['auth', 'verified']) -> group(function () {
    Route::group(['namespace' => 'Personal', 'prefix' => 'personal'], function () {
        Route::group(['namespace' => 'Main', 'prefix' => 'main'], function () {
            Route::get('/', [App\Http\Controllers\Personal\Main\IndexController::class, 'index'])
                ->name('personal.main.index');
        });
        Route::group(['namespace' => 'Liked', 'prefix' => 'liked'], function () {
            Route::get('/', [App\Http\Controllers\Personal\Liked\IndexController::class, 'index'])
                ->name('personal.liked.index');
            Route::delete('/{post}', [App\Http\Controllers\Personal\Liked\IndexController::class, 'delete'])
                ->name('personal.liked.delete');
        });
        Route::group(['namespace' => 'Comment', 'prefix' => 'comment'], function () {
            Route::get('/', [App\Http\Controllers\Personal\Comment\IndexController::class, 'index'])
                ->name('personal.comment.index');
            Route::get('/{comment}/edit', [App\Http\Controllers\Personal\Comment\IndexController::class, 'edit'])
                ->name('personal.comment.edit');
            Route::patch('/{comment}', [App\Http\Controllers\Personal\Comment\IndexController::class, 'update'])
                ->name('personal.comment.update');
            Route::delete('/{comment}', [App\Http\Controllers\Personal\Comment\IndexController::class, 'delete'])
                ->name('personal.comment.delete');
        });
    });
});
Route::middleware(['auth', 'admin', 'verified']) -> group(function () {
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::group(['namespace' => 'Main'], function () {
            Route::get('/', [App\Http\Controllers\Admin\Main\IndexController::class, 'index'])
                ->name('admin.main.index');
        });

        Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
            Route::get('/', [App\Http\Controllers\Admin\Post\IndexController::class, 'index'])
                ->name('admin.post.index');
            Route::get('/create', [App\Http\Controllers\Admin\Post\IndexController::class, 'create'])
                ->name('admin.post.create');
            Route::post('/', [App\Http\Controllers\Admin\Post\IndexController::class, 'store'])
                ->name('admin.post.store');
            Route::get('/{post}', [App\Http\Controllers\Admin\Post\IndexController::class, 'show'])
                ->name('admin.post.show');
            Route::get('/{post}/edit', [App\Http\Controllers\Admin\Post\IndexController::class, 'edit'])
                ->name('admin.post.edit');
            Route::patch('/{post}', [App\Http\Controllers\Admin\Post\IndexController::class, 'update'])
                ->name('admin.post.update');
            Route::delete('/{post}', [App\Http\Controllers\Admin\Post\IndexController::class, 'delete'])
                ->name('admin.post.delete');
        });

        Route::group(['namespace' => 'Category', 'prefix' => 'categories'], function () {
            Route::get('/', [App\Http\Controllers\Admin\Category\IndexController::class, 'index'])
                ->name('admin.category.index');
            Route::get('/create', [App\Http\Controllers\Admin\Category\IndexController::class, 'create'])
                ->name('admin.category.create');
            Route::post('/', [App\Http\Controllers\Admin\Category\IndexController::class, 'store'])
                ->name('admin.category.store');
            Route::get('/{category}', [App\Http\Controllers\Admin\Category\IndexController::class, 'show'])
                ->name('admin.category.show');
            Route::get('/{category}/edit', [App\Http\Controllers\Admin\Category\IndexController::class, 'edit'])
                ->name('admin.category.edit');
            Route::patch('/{category}', [App\Http\Controllers\Admin\Category\IndexController::class, 'update'])
                ->name('admin.category.update');
            Route::delete('/{category}', [App\Http\Controllers\Admin\Category\IndexController::class, 'delete'])
                ->name('admin.category.delete');
        });

        Route::group(['namespace' => 'Tag', 'prefix' => 'tags'], function () {
            Route::get('/', [App\Http\Controllers\Admin\Tag\IndexController::class, 'index'])
                ->name('admin.tag.index');
            Route::get('/create', [App\Http\Controllers\Admin\Tag\IndexController::class, 'create'])
                ->name('admin.tag.create');
            Route::post('/', [App\Http\Controllers\Admin\Tag\IndexController::class, 'store'])
                ->name('admin.tag.store');
            Route::get('/{tag}', [App\Http\Controllers\Admin\Tag\IndexController::class, 'show'])
                ->name('admin.tag.show');
            Route::get('/{tag}/edit', [App\Http\Controllers\Admin\Tag\IndexController::class, 'edit'])
                ->name('admin.tag.edit');
            Route::patch('/{tag}', [App\Http\Controllers\Admin\Tag\IndexController::class, 'update'])
                ->name('admin.tag.update');
            Route::delete('/{tag}', [App\Http\Controllers\Admin\Tag\IndexController::class, 'delete'])
                ->name('admin.tag.delete');
        });

        Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
            Route::get('/', [App\Http\Controllers\Admin\User\IndexController::class, 'index'])
                ->name('admin.user.index');
            Route::get('/create', [App\Http\Controllers\Admin\User\IndexController::class, 'create'])
                ->name('admin.user.create');
            Route::post('/', [App\Http\Controllers\Admin\User\IndexController::class, 'store'])
                ->name('admin.user.store');
            Route::get('/{user}', [App\Http\Controllers\Admin\User\IndexController::class, 'show'])
                ->name('admin.user.show');
            Route::get('/{user}/edit', [App\Http\Controllers\Admin\User\IndexController::class, 'edit'])
                ->name('admin.user.edit');
            Route::patch('/{user}', [App\Http\Controllers\Admin\User\IndexController::class, 'update'])
                ->name('admin.user.update');
            Route::delete('/{user}', [App\Http\Controllers\Admin\User\IndexController::class, 'delete'])
                ->name('admin.user.delete');
        });
    });
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
