@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Tags
        </div>
        <div class="card-body">
            @if($tags->count() > 0)
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Total Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                        <tr>
                                <td>
                                    <a href="{{ $tag->id }}">{{ $tag->name }}</a>
                                </td> 
                                <td>
                                    {{$tag->posts->count()}}
                                </td>     
                                <td>
                                    <a href="{{ route('tags.edit', ['id' => $tag->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                </td> 
                                <td>
                                    {{-- <a href="{{ route('tags.delete', ['id' => $tag->id]) }}" class="btn btn-sm btn-danger">Delete</a> --}}
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete({{$tag->id}})">Delete</button>
                                </td> 
                        </tr>
                        @endforeach
                    </tbody>
                </table>
          
                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="" method="POST" id="deleteTagForm">

                            @csrf
                            @method('DELETE')

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center text-danger font-weight-bold">Are you sure you want to delete ?</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- Modal -->

            @else    
                <h4 class="text-center">No Tags</h4>
            @endif


        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('tags.create') }}" class="btn btn-success">Add New Tag</a>
    </div>
@endsection

@section('scripts')
    <script>    
        function handleDelete($id) {

            var form = document.getElementById("deleteTagForm");
            form.action = "/tags/delete/" + $id;

            // console.log('deleting.',form);
            
            $('#deleteModal').modal('show');   
        }

    </script>    
@endsection