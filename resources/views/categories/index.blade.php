@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            @if($categories->count() > 0)
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Total Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                                <td>
                                    <a href="{{ $category->id }}">{{ $category->name }}</a>
                                </td> 
                                <td>
                                    {{$category->posts->count()}}
                                </td>     
                                <td>
                                    <a href="{{ route('categories.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                </td> 
                                <td>
                                    {{-- <a href="{{ route('categories.delete', ['id' => $category->id]) }}" class="btn btn-sm btn-danger">Delete</a> --}}
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete({{$category->id}})">Delete</button>
                                </td> 
                        </tr>
                        @endforeach
                    </tbody>
                </table>
          
                <!-- Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="" method="POST" id="deleteCategoryForm">

                            @csrf
                            @method('DELETE')

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
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
                <h4 class="text-center">No Categories</h4>
            @endif


        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('categories.create') }}" class="btn btn-success">Add New Category</a>
    </div>
@endsection

@section('scripts')
    <script>    
        function handleDelete($id) {

            var form = document.getElementById("deleteCategoryForm");
            form.action = "/categories/delete/" + $id;

            // console.log('deleting.',form);
            
            $('#deleteModal').modal('show');   
        }

    </script>    
@endsection