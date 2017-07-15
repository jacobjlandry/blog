@extends('layouts.blog')

@section('body')
    <div class="post">
        <div class="post-header">
            <div class="post-title">
                {{ $post->title }}
                @if($post->subcategory)
                    <span class="subcategory"><a href="/{{ $post->category->name }}/{{ $post->subcategory->name }}">[{{ $post->subcategory->name }}]</a></span>
                @endif
            </div>
            <div class="post-date">{{ $post->published_at->toDateString() }}</div>
        </div>
        {!! $post->body !!}
    </div>
@endsection
