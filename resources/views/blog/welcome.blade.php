@extends('layouts.blog')

@push('styles')
    .post-title {
        color: inherit;
    }
    .post-title:hover {
        color: inherit;
        text-decoration: none;
    }
@endpush

@section('body')
    @foreach($posts as $post)
        @if(!$loop->first)
            <div class="separator"></div>
        @endif
        <div class="post">
            <div class="post-date"><span>{{ $post->published_at->format('l F j, Y') }}</span></div>
            <div class="post-header">
                <div class="post-title">
                    <a class="post-title" href="{{ $post->url() }}">{{ $post->title }}</a>
                    @if($post->subcategory)
			<span class="mobile-only"><br /></span>
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
    @endforeach

    @if($posts->count() == 0)
        @include('layouts.sorry')
    @endif
@endsection
