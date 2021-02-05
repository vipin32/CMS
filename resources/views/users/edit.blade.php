@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            My Profile
        </div>
    </div>

    <div class="text-center">
        <img src="{{ Gravatar::src($user->email) }}" style="border-radius:50%;" alt="">
    </div>


    <form action="{{ route('users.update-profile') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" value="{{ $user->password }}">
        </div>

        <div class="form-group">
            <label for="about">About</label>
            <textarea name="about" id="about" cols="5" rows="5" class="form-control">{{ $user->about }}</textarea>
        </div>

        <input type="submit" class="btn btn-success" value="Update">

    </form>
    
@endsection