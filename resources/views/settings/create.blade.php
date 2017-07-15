@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>New Setting</h3>
                <form action="/settings" method="post">
                    {{ csrf_field() }}
                    <input name="type" type="text" class="form-control" placeholder="type" /><br />
                    <input name="name" type="text" class="form-control" placeholder="name" /><br />
                    <input name="value" type="text" class="form-control" placeholder="value" /><br />
                    <div style="display: flex; flex-direction: row; justify-content: space-between;">
                        <div>
                        </div>
                        <div>
                            <a href="/settings" class="btn btn-danger">Cancel</a>
                            <input type="submit" value="Create" class="btn btn-success" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
