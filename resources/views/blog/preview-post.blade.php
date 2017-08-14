@extends('layouts.blog')

@section('body')
        <div class="separator"></div>
        <div class="post">
            <div class="post-date"><span>{{ $post->created_at->format('l F j, Y') }}</span></div>
            <div class="post-header">
                <div class="post-title">
                    {{ $post->title }}
                    @if($post->subcategory)
                        <span class="subcategory"><a href="/{{ $post->subcategory->category->name }}/{{ $post->subcategory->name }}">[{{ $post->subcategory->name }}]</a></span>
                        <span class="subcategory"><a href="/reader/{{ $post->subcategory->id }}/{{ $post->currentPosition() + 1 }}">[Reader View]</a></span>
                    @endif
                </div>
            </div>
            {!! $post->body !!}
            <div class="post-tags">
                @foreach($post->tags as $tag)
                    <a href="/tags/{{ $tag->name }}">#{{ $tag->name }}</a> &nbsp;
                @endforeach
            </div>
        </div>
@endsection
