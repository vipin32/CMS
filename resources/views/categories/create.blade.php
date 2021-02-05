@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
           {{ isset($category)? 'Update Category':'Create Category' }}

        </div>
        <div class="card-body">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                @endforeach
            @endif

            <form action="{{ isset($category)? route('categories.update', ['id'=>$category->id]) : route('categories.store') }}" method="POST">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter New Category" value="{{isset($category)?$category->name:''}}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">{{ isset($category)? 'Update Category' : 'Add New Category' }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection