@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Posts
        </div>
        <div class="card-body">
            @if($posts->count() > 0)

                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>    
                    </thead>

                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    <img src="{{ asset('/storage/'.$post->image) }}" width="120" height="60" alt="">
                                </td>
                                <td>
                                    {{ $post->title }}
                                </td>

                                <td>
                                    {{-- Fetching Category Name beacuse Posts belongsTo category() --}}
                                    {{ isset($post->category->name)? $post->category->name : 'General' }}
                                </td>

                                <td>
                                    @if($post->trashed())
                                        <form action="{{ route('posts.restore', ['id'=>$post->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                        </form>
                                    @else    
                                        <a href="{{ route('posts.edit', ['id'=>$post->id]) }}" class="btn btn-sm btn-primary">Edit</a>  
                                    @endif
                                </td>

                                <td>
                                    <form action="{{route('posts.destroy', ['id'=>$post->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">{{ $post->trashed() ? 'Delete':'Trash'}}</button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @else
                <h4 class="text-center">No Posts</h4>
            @endif
            
        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Add New Post</a>
    </div>
@endsection