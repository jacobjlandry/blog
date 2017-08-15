@extends('layouts.app')

@section('content')
<div class="container" style="padding-bottom: 25px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Weight</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$categories->count())
                        <tr><td colspan="3">No categories have been created</td></tr>
                    @endif
                    @foreach($categories as $category)
                        <tr>
                            <td><a href="/categories/{{ $category->id }}/edit">{{ $category->name }}</a></td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->weight }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="display: flex; flex-direction: row; padding-top: 10px;">
                <div style="flex-grow: 1; padding-right: 5px;">
                    <a href="/home" class="btn btn-default btn-block">Admin Home</a>
                </div>
                <div style="flex-grow: 1; padding-right: 5px;">
                    <a href="/categories/create" class="btn btn-success btn-block">New Category</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
