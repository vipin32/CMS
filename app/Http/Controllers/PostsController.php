<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PostsController;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

use Illuminate\Http\Request;

use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use Illuminate\Support\Facades\Storage;

use Session;

class PostsController extends Controller
{


    public function __construct() 
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isAdmin()) {
            $posts = Post::all();
        } else {
            $posts = Post::all()->where('user_id', auth()->user()->id);

            // dd($posts);
        }

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Sending Categories List for Posts
        $categories = Category::all();

        $tags = Tag::all();

        return view('posts.create', ['categories' => $categories, 'tags'=>$tags]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
      

        $post = new Post;

        $post->user_id = auth()->user()->id;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;

        $image = $request->image->store('posts');  //creates one folder named posts in storage/app/public and uploads image inside that folder with a unique name

        $post->image = $image;                     //save images name along with folder posts/abc.jpg
        $post->published_at = $request->published_at;
        $post->category_id = $request->category;

        $post->save();

        if($request->tags)
        {
            $post->tags()->attach($request->tags);
        }
        

        session()->flash('success', 'Post added successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $tags = Tag::all();

        $post = Post::findOrFail($id);


        return view('posts.create', ['post'=>$post, 'categories'=>$categories,'tags'=>$tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, $id)
    {
        $post = Post::findorFail($id);

        //Method 1
        $data = $request->only(['title','description','content','image','published_at']);

        //Check if user has uploaded any image
        if($request->hasFile('image')) 
        {
            //Upload The latest image to Posts Folder
            $image = $request->image->store('posts');

            //Method 1 : Delete previous image
            // Storage::delete($post->image);

            //Method2 : deleteImage() function in Models/Post created by user to delete old image
            $post->deleteImage();

            $data['image'] = $image;
        }

        if($request->tags)
        {
            $post->tags()->sync($request->tags);
        }

        $post->update($data);

        // Method 2
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->content = $request->content;

        // $post->image = $request->image->store('posts');

        // $post->published_at = $request->published_at;

        // $post->update();

        session()->flash('success', 'Post Updated Successfully');

        return redirect(route('posts.index'));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();

        if($post->trashed()) 
        {
            Storage::delete($post->image); //Deleting Image from folder also during permanent delete

            $post->forceDelete();

            session()->flash('success', 'Post Deleted Successfully');
            return redirect(route('posts.trashed'));

        } 
        else
        {
            $post->delete();

            session()->flash('success', 'Post Trashed Successfully');

            return redirect(route('posts.index'));
        }
        
    }

    public function trashed() {

        $trashed_posts = Post::withTrashed()->where('deleted_at','!=', 'NULL')->get();
        // OR
        // $trashed_posts = Post::onlyTrashed()->get();

        return view('posts.index', ['posts' => $trashed_posts]);
    }

    public function restore($id) {
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post restored successfully');

        return redirect(route('posts.trashed'));
    }
}
