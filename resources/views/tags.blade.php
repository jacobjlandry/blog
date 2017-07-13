@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="75%">Tag</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{ $tag->name }}</td>
                            <td><button class="btn btn-danger form-control delete" id="{{ $tag->id }}">Delete</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="display: flex; justify-content: space-between;">
                <a href="/home" class="btn btn-danger">Admin Home</a>
                <a href="/tags/create" class="btn btn-success">New Tag</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.delete').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/tags/' + $(e.currentTarget).attr('id'),
                data: { _token:'{{ csrf_token() }}' },
                method: 'DELETE',
                success: function(response) {
                    location = '/tags';
                }
            });
        });
    });
</script>
@endsection
