@extends('layouts.app')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection


@section('content')

    <div class="card">
        <div class="card-header">
            {{ isset($post)? 'Edit Post': 'Create Post' }} 
        </div>
        <div class="card-body">
            <form action="{{ isset($post)? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                @if(isset($post))
                    @method('PUT')
                @endif

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class="text-danger text-center">{{ $error }}</p>
                    @endforeach
                @endif

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ isset($post)? $post->title : old('title')}}">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control"> {{ isset($post)? $post->description : old('description')}} </textarea>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" cols="5" rows="5" class="form-control"> {{ isset($post)? $post->content : old('content') }} </textarea>

                    <script>
                        CKEDITOR.replace( 'content' );
                    </script> 

                </div>

                @if(isset($post))
                    <div class="form-group">
                        <img src="{{ asset('/storage/'.$post->image) }}" width="300" alt="">
                    </div>
                @endif

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                {{-- Categories --}}
                <div class="form-group">
                    <label for="category">Select Category</label>
                    <select name="category" id="category" class="form-control" >
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                 @if(isset($post)) 
                                    @if($category->id == $post->category_id) 
                                        selected 
                                    @endif 
                                  @endif
                                  > {{ $category->name }}
                                </option>
                        @endforeach
                    </select>
                </div>
                {{-- Categories --}}

                {{-- Tags --}}
                <div class="form-group">
                    <label for="tags">Select Tags</label>
                    <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}"
                                 @if(isset($post)) 
                                    @if(in_array($tag->id, $post->tags->pluck('id')->toArray())) 
                                        selected 
                                    @endif 
                                  @endif
                                  > {{ $tag->name }}
                                </option>
                        @endforeach
                    </select>
                </div>
                {{-- Tags --}}


                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="datetime-local" name="published_at" id="published_at" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">{{ isset($post)? 'Update Post' : 'Add Post' }}</button>
                </div>

            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



    <script>
        //Select style jQuery plugin
        $(document).ready(function() {
            $('.tags-selector').select2();
        });

    </script>
@endsection
