@extends('layouts.app')

@section('content')
<div class="container">
    <div id="errors-alert" class="alert alert-danger" style="display: none;">
        <ul id="errors"></ul>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Edit Subcategory</h3>
            <div class="" style="padding-bottom: 15px;">
                <input id="name" name="name" type="text" class="form-control" placeholder="name" value="{{ $subcategory->name }}" />
            </div>
            <div class="" style="padding-bottom: 15px;">
                <input id="description" name="description" type="text" class="form-control" placeholder="description" value="{{ $subcategory->description }}" />
            </div>
            <div class="" style="padding-bottom: 15px;">
                <select id="category" name="category" class="form-control">
                    <option value="">Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $subcategory->category_id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
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
                },
                error: function(response) {
                    var errors = JSON.parse(response.responseText);
                    $('#errors').html('');
                    $('input').parent().removeClass('has-error');
                    for(var field in errors) {
                        $('#' + field).parent().addClass('has-error');
                        $('#errors').append('<li>' + errors[field] + '</li>');
                    }
                    $('#errors-alert').show();
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
                },
                error: function(response) {
                    $('#errors').html('');
                    $('input').parent().removeClass('has-error');
                    $('#errors').append('<li>Unable to delete. Please try again.</li>');
                    $('#errors-alert').show();
                }
            });
        });
    });
</script>
@endsection
