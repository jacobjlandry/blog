@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Edit Setting</h3>
                <input id="type" name="type" type="text" class="form-control" placeholder="type" value="{{ $setting->type }}" /><br />
                <input id="name" name="name" type="text" class="form-control" placeholder="name" value="{{ $setting->name }}" /><br />
                <input type="text" id="value" name="value" class="form-control" placeholder="value" autocomplete="off" value="{{ $setting->value }}" /><br />
                <div style="display: flex; flex-direction: row; justify-content: space-between;">
                    <div></div>
                    <div></div>
                    <div>
                        <a href="/settings" class="btn btn-danger">Cancel</a>
                        <button id="update" class="btn btn-success">Update</button>
                    </div>
                </div>
                <div style="display: flex; flex-direction: row; justify-content: flex-end; padding-top: 15px;">
                    <button id="delete" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#update').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/settings/{{ $setting->id }}',
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        type: $('#type').val(),
                        name: $('#name').val(),
                        value: $('#value').val()
                    },
                    success: function(response) {
                        location = '/settings';
                    }
                });
            });

            $('#delete').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/settings/{{ $setting->id }}',
                    data: { _token:'{{ csrf_token() }}' },
                    method: 'DELETE',
                    success: function(response) {
                        location = '/settings';
                    }
                });
            });
        });
    </script>
@endsection
