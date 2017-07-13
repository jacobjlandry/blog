@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Edit Subcategory</h3>
            <input id="name" name="name" type="text" class="form-control" placeholder="name" value="{{ $subcategory->name }}" /><br />
            <input id="description" name="description" type="text" class="form-control" placeholder="description" value="{{ $subcategory->description }}" /><br />
            <select id="category" name="category" class="form-control">
                <option value="">Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id == $subcategory->category_id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select><br />
            <div style="display: flex; flex-direction: row; justify-content: space-between;">
                <div></div>
                <div>
                    <a href="/subcategories" class="btn btn-danger">Cancel</a>
                    <button id="update" class="btn btn-success">Update</button>
                </div>
            </div>
            <div style="display: flex; flex-direction: row; justify-content: flex-end; padding-top: 15px;">
                <button id="delete" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#update').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/subcategories/{{ $subcategory->id }}',
                method: 'PUT',
                data: { 
                        _token: '{{ csrf_token() }}',
                        name: $('#name').val(),
                        description: $('#description').val(),
                        category: $('#category').find(':selected').val()
                }, 
                success: function(response) {
                    location = '/subcategories';
                }
            });
        });

        $('#delete').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/subcategories/{{ $subcategory->id }}',
                data: { _token:'{{ csrf_token() }}' },
                method: 'DELETE',
                success: function(response) {
                    location = '/subcategories';
                }
            });
        });
    });
</script>
@endsection
