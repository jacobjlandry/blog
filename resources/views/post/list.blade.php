@extends('layouts.app')

@push('styles')
    .published {
        display: none;
    }
@endpush

@push('scripts')
    $('#toggle-published').on('click', function(e) {
        if($(e.target).prop('checked')) {
            $('.published').show();
        }
        else {
            $('.published').hide();
        }
    });
@endpush

@section('content')
<div class="container" style="padding-bottom: 25px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="heading" style="display: flex; justify-content: space-between; align-items: flex-end;">
                <h3>Posts</h3>
                <span><input type="checkbox" id="toggle-published" /> &nbsp; Published</span>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th class="unimportant">Description</th>
                        <th>Category</th>
                        <th class="unimportant">Subcategory</th>
                        <th class="unimportant">Tags</th>
                        <th>Published</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$posts->count())
                        <tr>
                            <td colspan="6">No posts have been created</td>
                        </tr>
                    @endif

                    @foreach($posts as $post)
                        <tr @if($post->published_at) class="published" @endif>
                            <td><a href="/posts/{{ $post->slug }}/edit">{{ $post->title }}</a></td>
                            <td class="unimportant">{{ $post->description }}</td>
                            <td>@if($post->category) {{ $post->category->name }} @endif</td>
                            <td class="unimportant">@if($post->subcategory) {{ $post->subcategory->name }} @endif</td>
                            <td class="unimportant">{{ $post->tags->pluck('name')->implode(', ') }}</td>
                            <td>{{ $post->published_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="display: flex; flex-direction: row; padding-top: 25px;">
                <div style="flex-grow: 1;">
                    <a href="/posts/create" class="btn btn-success btn-block">New Post</a>
                </div>
            </div>
            <div style="display: flex; flex-direction: row; padding-top: 10px;">
                <div style="flex-grow: 1;">
                    <a href="/home" class="btn btn-default btn-block">Admin Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection