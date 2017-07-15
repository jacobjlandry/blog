@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Edit Category</h3>
            <input id="name" name="name" type="text" class="form-control" placeholder="name" value="{{ $category->name }}" /><br />
            <input id="description" name="description" type="text" class="form-control" placeholder="description" value="{{ $category->description }}" /><br />
            <input id="weight" name="weight" type="text" class="form-control" placeholder="weight" value="{{ $category->weight }}" /><br />
            <div style="display: flex; flex-direction: row; justify-content: space-between;">
                <div></div>
                <div>
                    <a href="/categories" class="btn btn-danger">Cancel</a>
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
                url: '/categories/{{ $category->id }}',
                method: 'PUT',
                data: { 
                        _token: '{{ csrf_token() }}',
                        name: $('#name').val(),
                        description: $('#description').val(),
                        weight: $('#weight').val()
                }, 
                success: function(response) {
                    location = '/categories';
                }
            });
        });

        $('#delete').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/categories/{{ $category->id }}',
                data: { _token:'{{ csrf_token() }}' },
                method: 'DELETE',
                success: function(response) {
                    location = '/categories';
                }
            });
        });
    });
</script>
@endsection
