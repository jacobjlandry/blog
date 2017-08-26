@extends('layouts.app')

@section('content')
<div class="container" style="padding-bottom: 25px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Posts</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Tags</th>
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
                        <tr>
                            <td><a href="/posts/{{ $post->id }}/edit">{{ $post->title }}</a></td>
                            <td>{{ $post->description }}</td>
                            <td>@if($post->category) {{ $post->category->name }} @endif</td>
                            <td>@if($post->subcategory) {{ $post->subcategory->name }} @endif</td>
                            <td>{{ $post->tags->pluck('name')->implode(', ') }}</td>
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