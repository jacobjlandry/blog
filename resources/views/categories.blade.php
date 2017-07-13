@extends('layouts.app')

@section('content')
<div class="container">
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
                    @foreach($categories as $category)
                        <tr>
                            <td><a href="/categories/{{ $category->id }}/edit">{{ $category->name }}</a></td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->weight }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="display: flex; justify-content: space-between;">
                <a href="/home" class="btn btn-danger">Admin Home</a>
                <a href="/categories/create" class="btn btn-success">New Category</a>
            </div>
        </div>
    </div>
</div>
@endsection
