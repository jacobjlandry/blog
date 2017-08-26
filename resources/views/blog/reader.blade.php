@extends('layouts.blog')

@push('styles')
    .controls {
        display: flex;
        justify-content: space-between;
        height: 50px;
        align-items: center;
    }
@endpush

@section('body')
    <div class="post">
        <div class="post-date"><span>{{ $currentSubcategory->name }} vol. {{ $currentPost }} - {{ $post->published_at->format('l F j, Y') }}</span></div>
        <div class="post-header">
            <div class="post-title">
                {{ $post->title }}
            </div>
        </div>
        {!! $post->body !!}
        <div class="post-tags">
            @foreach($post->tags as $tag)
                <a href="/tags/{{ $tag->name }}">#{{ $tag->name }}</a> &nbsp;
            @endforeach
        </div>
        <div class="controls">
            <div>
                <a href="/reader/{{ $currentSubcategory->id }}/1" class="btn btn-primary @if($currentPost == 1) disabled @endif">First</a>
                <a href="/reader/{{ $currentSubcategory->id }}/{{ $currentPost - 1 }}" class="btn btn-primary @if(!$post->hasPrevious()) disabled @endif ">Previous</a>
            </div>
            <div>
                <a href="/reader/{{ $currentSubcategory->id }}/{{ $currentPost + 1 }}" class="btn btn-primary @if(!$post->hasNext()) disabled @endif ">Next</a>
                <a href="/reader/{{ $currentSubcategory->id }}/{{ $post->last() }}" class="btn btn-primary @if($currentPost == $post->last()) disabled @endif">Last</a>
            </div>
        </div>
    </div>
@endsection
