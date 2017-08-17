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
            <div style="display: flex; flex-direction: row; padding-top: 25px;">
                <div style="flex-grow: 1;">
                    <a href="/subcategories/create" class="btn btn-success btn-block">New Subcategory</a>
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
