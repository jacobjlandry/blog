@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>New Tag</h3>
            <form action="/tags" method="post">
                {{ csrf_field() }}
                <input name="name" type="text" class="form-control" placeholder="name" /><br />
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
