@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
            <div class="panel panel-success">
                <div class="panel-heading">Actions</div>
                <div class="panel-body">
                    <a href="/posts">Manage Posts</a><br />
                    <a href="/categories">Manage Categories</a><br />
                    <a href="/subcategories">Manage Subcategories</a><br />
                    <a href="/tags">Manage Tags</a><br />
                </div>
            </div>
            <div style="display: flex;">
                @foreach($settings->where('type', 'job')->groupBy('name') as $name => $jobs)
                    <div class="panel panel-danger" style="flex-grow: 1; @if(!$loop->last) margin-right: 15px; @endif">
                        <div class="panel-heading">{{ $name }}</div>
                        <div class="panel-body">
                            @foreach($jobs as $job)
                                <a href="">{!! $job->value !!}</a><br />
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
