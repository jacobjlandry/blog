@extends('layouts.app')

@section('content')
<div class="container">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>New Tag</h3>
            <form action="/tags" method="post">
                {{ csrf_field() }}
                <div class="@if($errors->has('name')) has-error @endif" style="padding-bottom: 15px;">
                    <input name="name" type="text" class="form-control" placeholder="name" value="{{ old('name') }}" />
                </div>
                <div style="display: flex; flex-direction: row; justify-content: space-between;">
                    <div>
                    </div>
                    <div>
                        <a href="/tags" class="btn btn-danger">Cancel</a>
                        <input type="submit" value="Create" class="btn btn-success" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
