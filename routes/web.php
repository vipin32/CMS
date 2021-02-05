<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BlogsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BlogsController::class, 'index'])->name('blogs.index');
Route::get('/blogs/post/{id}', [BlogsController::class, 'show'])->name('blogs.show');
Route::get('/blogs/category/{id}', [BlogsController::class, 'category'])->name('blogs.category');
Route::get('/blogs/tag/{id}', [BlogsController::class, 'tag'])->name('blogs.tag');


Route::middleware('auth')->group(function(){

    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/update/{id}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::delete('/categories/delete/{id}', [CategoriesController::class, 'destroy'])->name('categories.delete');


    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostsController::class, 'store'])->name('posts.store');
    Route::get('/posts/edit/{id}', [PostsController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/update/{id}', [PostsController::class, 'update'])->name('posts.update');
    Route::delete('/posts/delete/{id}', [PostsController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/trashed', [PostsController::class, 'trashed'])->name('posts.trashed');
    Route::put('/posts/restore/{id}', [PostsController::class, 'restore'])->name('posts.restore');

    Route::get('/tags', [TagsController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagsController::class, 'create'])->name('tags.create');
    Route::post('/tags/store', [TagsController::class, 'store'])->name('tags.store');
    Route::get('/tags/edit/{id}', [TagsController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/update/{id}', [TagsController::class, 'update'])->name('tags.update');
    Route::delete('/tags/delete/{id}', [TagsController::class, 'destroy'])->name('tags.delete');
});


Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::post('/users/make-admin/{id}', [UsersController::class, 'makeAdmin'])->name('users.make-admin');

    Route::get('/users/edit-profile', [UsersController::class, 'edit'])->name('users.edit-profile');
    Route::put('/users/update-profile', [UsersController::class, 'update'])->name('users.update-profile');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
