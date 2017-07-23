@extends('layouts.app')

@section('content')
<div class="container">
    <div id="errors-alert" class="alert alert-danger" style="display: none;">
        <ul id="errors"></ul>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Edit Post</h3>
            <div class="" style="padding-bottom: 15px;">
                <input id="title" name="title" type="text" class="form-control" placeholder="title" value="{{ $post->title }}" />
            </div>
            <div class="" style="padding-bottom: 15px;">
                <input id="description" name="description" type="text" class="form-control" placeholder="description" value="{{ $post->description }}" />
            </div>
            <div class="" style="padding-bottom: 15px;">
                <textarea id="body" name="body" class="form-control" placeholder="Cool blog post!">{{ preg_replace("/<br\s*\/*>/", "", $post->body) }}</textarea>
            </div>
            <div class="" id="category-container" style="padding-bottom: 15px;">
                <select id="category" name="category" class="form-control">
                    <option value="" selected>Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($post->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="subcategory-container" class="" style="padding-bottom: 15px; @if($post->category_id === null) display: none; @endif">
                <select id="subcategory" name="subcategory" class="form-control">
                    <option value="" selected>Subcategory</option>
                    @foreach($categories as $category)
                        <optgroup id="category-{{ $category->id }}" label="{{ $category->name }}">
                            @foreach($category->subcategories as $subcategory)
                                <option class="subcategory-option" value="{{ $subcategory->id }}" @if($post->subcategory_id == $subcategory->id) selected @endif disabled>{{ $subcategory->name }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>
            <div class="" style="padding-bottom: 15px;">
                <input type="text" id="tags" name="tags" class="form-control" placeholder="tags" autocomplete="off" value="{{ $post->tags->pluck('name')->implode(", ") }}">
            </div>
            <div style="display: flex; flex-direction: row; justify-content: space-between;">
                <div>Publish <input id="publish" type="checkbox" name="publish" @if($post->published_at) checked @endif /></div>
                <div>
                    <a href="/posts/{{ $post->id }}" target="_blank">Preview Last Save</a>
                </div>
                <div>
                    <a href="/posts" class="btn btn-danger">Cancel</a>
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
                url: '/posts/{{ $post->id }}',
                method: 'PUT',
                data: { 
                        _token: '{{ csrf_token() }}',
                        title: $('#title').val(),
                        description: $('#description').val(),
                        body: $('#body').val(),
                        category: $('#category').find(':selected').val(),
                        subcategory: $('#subcategory').find(':selected').val(),
                        tags: $('#tags').val(),
                        publish: $('#publish').is(':checked')
                }, 
                success: function(response) {
                    location = '/posts';
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
                url: '/posts/{{ $post->id }}',
                data: { _token:'{{ csrf_token() }}' },
                method: 'DELETE',
                success: function(response) {
                    location = '/posts';
                },
                error: function(response) {
                    $('#errors').html('');
                    $('input').parent().removeClass('has-error');
                    $('#errors').append('<li>Unable to delete. Please try again.</li>');
                    $('#errors-alert').show();
                }
            });
        });

        $('#category').on('change', function(e) {
            var category = $('#category :selected').val();
            if(category) {
                $('#subcategory').val('');
                $('#subcategory-container').show();
                $('.subcategory-option').attr('disabled', true);
                $('#category-' + category + ' option').removeAttr('disabled');
            }
            else {
                $('#subcategory-container').hide();
                $('.subcategory-option').removeAttr('selected');
                $('#subcategory').val('');
            }
        });
    });
</script>
@endsection
