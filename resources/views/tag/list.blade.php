@extends('layouts.app')

@section('content')
<div class="container" style="padding-bottom: 25px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Tags</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="75%">Tag</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$tags->count())
                        <tr>
                            <td colspan="2">No tags have been created</td>
                        </tr>
                    @endif
                    
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{ $tag->name }}</td>
                            <td><button class="btn btn-danger form-control delete" id="{{ $tag->id }}">Delete</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="display: flex; flex-direction: row; padding-top: 25px;">
                <div style="flex-grow: 1;">
                    <a href="/tags/create" class="btn btn-success btn-block">New Tag</a>
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
