@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Value</th>
                        <th>Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!$settings->count())
                        <tr>
                            <td colspan="3">No settings have been created</td>
                        </tr>
                    @endif

                    @foreach($settings as $setting)
                        <tr>
                            <td><a href="/settings/{{ $setting->id }}/edit">{{ $setting->name }}</a></td>
                            <td>{{ $setting->value }}</td>
                            <td>{{ $setting->type }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="display: flex; justify-content: space-between;">
                    <a href="/home" class="btn btn-danger">Admin Home</a>
                    <a href="/settings/create" class="btn btn-success">New Setting</a>
                </div>
            </div>
        </div>
    </div>
@endsection
