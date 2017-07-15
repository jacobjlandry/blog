@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
            <div style="display: flex; justify-content: space-between;">
                <a href="/home" class="btn btn-danger">Admin Home</a>
                <a href="/posts/create" class="btn btn-success">New Post</a>
            </div>
        </div>
    </div>
</div>
@endsection
