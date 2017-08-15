@extends('layouts.app')

@section('content')
    <div class="container" style="padding-bottom: 25px;">
        <div id="errors-alert" class="alert alert-danger" style="display: none;">
            <ul id="errors"></ul>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Edit Setting</h3>
                <div class="" style="padding-bottom: 15px;">
                    <input id="type" name="type" type="text" class="form-control" placeholder="type" value="{{ $setting->type }}" />
                </div>
                <div class="" style="padding-bottom: 15px;">
                    <input id="name" name="name" type="text" class="form-control" placeholder="name" value="{{ $setting->name }}" />
                </div>
                <div class="" style="padding-bottom: 15px;">
                    <input type="text" id="value" name="value" class="form-control" placeholder="value" autocomplete="off" value="{{ $setting->value }}" />
                </div>
                <div style="display: flex; flex-direction: row; padding-top: 10px;">
                    <div style="flex-grow: 1; padding-right: 5px;">
                        <a href="/settings" class="btn btn-default btn-block">Cancel</a>
                    </div>
                    <div style="flex-grow: 1; padding-left: 5px;">
                        <button id="update" class="btn btn-success btn-block">Update</button>
                    </div>
                </div>
                <div style="display: flex; flex-direction: row; padding-top: 35px;">
                    <div style="flex-grow: 1;">
                        <button id="delete" class="btn btn-danger btn-block">Delete</button>
                    </div>
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
                    },
                    error: function(response) {
                        var errors = JSON.parse(response.responseText);
                        $('#errors').html('');
                        $('input').parent().removeClass('has-error');
                        for(var field in errors) {
                            $('#' + field).parent().addClass('has-error');
                            $('#errors').append('<li>' + errors[field] + '</li>');
                        }
                        $('#errors-alert').show();
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
                    },
                    error: function(response) {
                        $('#errors').html('');
                        $('input').parent().removeClass('has-error');
                        $('#errors').append('<li>Unable to delete. Please try again.</li>');
                        $('#errors-alert').show();
                    }
                });
            });
        });
    </script>
@endsection
