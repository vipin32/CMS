<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tag;

use App\Http\Controllers\TagsController;


use Session;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return view('tags.index', ['tags' => $tags]);
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|unique:tags'
        ]);
            
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->save();

        session()->flash('success', 'Tag added successfully');

        return redirect(route('tags.index'));

    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        return view('tags.create', ['tag'=>$tag]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:tags'
        ]);

        $tag = Tag::findOrFail($id);

        $tag->name = $request->name;

        $tag->update();

        session()->flash('success', 'Tag updated successfully');

        return redirect(route('tags.index'));
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);

        if($tag->posts->count()>0){
            
            session()->flash('error', 'Tag cannot be deleted because it has some posts!');
            return redirect(route('tags.index'));
        }

        $tag->delete();

        session()->flash('success', 'Tag Deleted Successfully');

        return redirect(route('tags.index'));
    }
}
