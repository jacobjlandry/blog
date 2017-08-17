@extends('layouts.app')

@section('content')
    <div class="container" style="padding-bottom: 25px;">
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
                <h3>New Setting</h3>
                <form action="/settings" method="post">
                    {{ csrf_field() }}
                    <div class="@if($errors->has('type')) has-error @endif" style="padding-bottom: 15px;">
                        <input name="type" type="text" class="form-control" placeholder="type" value="{{ old('type') }}" />
                    </div>
                    <div class="@if($errors->has('name')) has-error @endif" style="padding-bottom: 15px;">
                        <input name="name" type="text" class="form-control" placeholder="name" value="{{ old('name') }}" />
                    </div>
                    <div class="@if($errors->has('value')) has-error @endif" style="padding-bottom: 15px;">
                        <input name="value" type="text" class="form-control" placeholder="value" value="{{ old('value') }}" />
                    </div>
                    <div style="display: flex; flex-direction: row; padding-top: 25px;">
                        <div style="flex-grow: 1;">
                            <input type="submit" id="update" class="btn btn-success btn-block" />
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: row; padding-top: 10px;">
                        <div style="flex-grow: 1;">
                            <a href="/settings" class="btn btn-default btn-block">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
