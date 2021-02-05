@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
           {{ isset($tag)? 'Update Tag':'Create Tag' }}

        </div>
        <div class="card-body">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                @endforeach
            @endif

            <form action="{{ isset($tag)? route('tags.update', ['id'=>$tag->id]) : route('tags.store') }}" method="POST">
                @csrf
                @if(isset($tag))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter New Tag" value="{{isset($tag)?$tag->name:''}}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">{{ isset($tag)? 'Update Tag' : 'Add New Tag' }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection