@extends('layouts.app')

@section('content')
<div class="container" style="padding-bottom: 25px;">
    <div id="errors-alert" class="alert alert-danger" style="display: none;">
        <ul id="errors"></ul>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Edit Category</h3>
            <div class="" style="padding-bottom: 15px;">
                <input id="name" name="name" type="text" class="form-control" placeholder="name" value="{{ $category->name }}" />
            </div>
            <div class="" style="padding-bottom: 15px;">
                <input id="description" name="description" type="text" class="form-control" placeholder="description" value="{{ $category->description }}" />
            </div>
            <div class="" style="padding-bottom: 15px;">
                <input id="weight" name="weight" type="text" class="form-control" placeholder="weight" value="{{ $category->weight }}" />
            </div>
            <div style="display: flex; flex-direction: row; padding-top: 25px;">
                <div style="flex-grow: 1;">
                    <button id="update" class="btn btn-success btn-block">Update</button>
                </div>
            </div>
            <div style="display: flex; flex-direction: row; padding-top: 10px;">
                <div style="flex-grow: 1;">
                    <a href="/categories" class="btn btn-default btn-block">Cancel</a>
                </div>
            </div>
            <div style="display: flex; flex-direction: row; padding-top: 35px;">
                <div style="flex-grow: 1;">
                    <button id="delete" class="btn btn-danger btn-block">Delete</button>
                </div>
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
                url: '/categories/{{ $category->id }}',
                data: { _token:'{{ csrf_token() }}' },
                method: 'DELETE',
                success: function(response) {
                    location = '/categories';
                },
                error: function(response) {
                    $('#errors').html('');
                    $('input').parent().removeClass('has-error');
                    $('#errors').append('<li>Unable to delete. Please make sure this category has no posts attached to it and try again.</li>');
                    $('#errors-alert').show();
                }
            });
        });
    });
</script>
@endsection
