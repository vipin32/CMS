@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Users
        </div>
        <div class="card-body">
            @if($users->count() > 0)

                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                        </tr>    
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <img src="{{ Gravatar::src($user->email) }}" width="60" height="60" style="border-radius:50%;" alt="user-profile-image">
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>

                                <td>
                                    {{-- Fetching Category Name beacuse Posts belongsTo category() --}}
                                    {{ $user->email }}
                                </td>

                                @if($user->role != 'admin')
                                    <td>
                                        <form action="{{ route('users.make-admin', ['id'=>$user->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Make Admin</button>
                                        </form>
                                    </td>
                                @endif
                                
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