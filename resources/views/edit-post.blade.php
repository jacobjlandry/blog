@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Edit Post</h3>
            <input id="title" name="title" type="text" class="form-control" placeholder="title" value="{{ $post->title }}" /><br />
            <input id="description" name="description" type="text" class="form-control" placeholder="description" value="{{ $post->description }}" /><br />
            <textarea id="body" name="body" class="form-control" placeholder="Cool blog post!">{{ $post->body }}</textarea><br />
            <select id="subcategory" name="subcategory" class="form-control">
                <option value="">Category</option>
                @foreach($categories as $category)
                    <optgroup label="{{ $category->name }}">
                        @foreach($category->subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" @if($subcategory->id == $post->subcategory_id) selected @endif>{{ $subcategory->name }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select><br />
            <input type="text" id="tags" name="tags" class="form-control" placeholder="tags" autocomplete="off" value="{{ $post->tags->pluck('name')->implode(", ") }}"><br />
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
                        subcategory: $('#subcategory').find(':selected').val(),
                        tags: $('#tags').val(),
                        publish: $('#publish').is(':checked')
                }, 
                success: function(response) {
                    location = '/posts';
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
                }
            });
        });
    });
</script>
@endsection
