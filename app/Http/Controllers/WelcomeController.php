<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {

        $posts = Post::all();
        $categories = Category::all();
        $tags       = Tag::all();

        return view('pages.welcome', compact('categories', 'tags', 'posts'));
    }

  
}
