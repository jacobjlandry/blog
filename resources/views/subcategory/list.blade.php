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
                    </tr>
                </thead>
                <tbody>
                    @foreach($subcategories as $subcategory)
                        <tr>
                            <td><a href="/subcategories/{{ $subcategory->id }}/edit">{{ $subcategory->name }}</a></td>
                            <td>{{ $subcategory->description }}</td>
                        </tr>
                    @endforeach

                    @if(!$subcategories->count())
                        <tr><td colspan="2">No subcategories have been created!</td></tr>
                    @endif
                </tbody>
            </table>
            <div style="display: flex; justify-content: space-between;">
                <a href="/home" class="btn btn-danger">Admin Home</a>
                <a href="/subcategories/create" class="btn btn-success">New Subcategory</a>
            </div>
        </div>
    </div>
</div>
@endsection
