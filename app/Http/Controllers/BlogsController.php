<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function index() {

        //Search Key Posts
        $search = request()->query('search');

        if($search)
        {
            // If searching for any specfic posts
            $posts = Post::where("title", "LIKE", "%{$search}%")->paginate(2);
        } 
        else
        {
            //  Show all Posts if no search keyword
             $posts = Post::paginate(2);
        }

        // $posts = Post::all();
        $categories = Category::all();
        $tags       = Tag::all();

        return view('blogs/welcome', compact('categories', 'tags', 'posts'));
    }

    public function show($id) {
        $post = Post::findOrFail($id);

        return view('blogs.show', ['post'=>$post]);
    }

    public function category($id) {

        $category = Category::findOrFail($id); 

        // Fetching Posts realted to category using hasMany relation in Category model
        $posts = $category->posts()->paginate(2);

        // sending categories and tags for sidebar
        $categories = Category::all();
        $tags = Tag::all();

        return view('blogs.category', ['category'=>$category, 'posts' => $posts, 'categories'=> $categories, 'tags'=>$tags]);

    }

    public function tag($id) {

        $tag = Tag::findOrFail($id);

        // Fetching Posts realted to tag using belongsToMany relation in Category model
        $posts = $tag->posts()->paginate(2);

        $categories = Category::all();
        $tags = Tag::all();

        return view('blogs.tag', ['tag'=>$tag, 'posts'=>$posts, 'categories'=>$categories, 'tags'=>$tags]);
    }
}
