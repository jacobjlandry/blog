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
            <h3>New Post</h3>
            <form action="/posts" method="post">
                {{ csrf_field() }}
                <div class="@if($errors->has('title')) has-error @endif" style="padding-bottom: 15px;">
                    <input name="title" type="text" class="form-control" placeholder="title" value="{{ old('title') }}" />
                </div>
                <div class="@if($errors->has('description')) has-error @endif" style="padding-bottom: 15px;">
                    <input name="description" type="text" class="form-control" placeholder="description" value="{{ old('description') }}" />
                </div>
                <div class="@if($errors->has('body')) has-error @endif" style="padding-bottom: 15px;">
                    <textarea name="body" class="form-control" rows="10" placeholder="Cool blog post!">{{ old('body') }}</textarea>
                </div>
                <div id="category-container" class="@if($errors->has('category')) has-error @endif" style="padding-bottom: 15px;">
                    <select id="category" name="category" class="form-control">
                        <option value="" selected>Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if(old('category') == $category->id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="subcategory-container" class="@if($errors->has('subcategory')) has-error @endif" style="padding-bottom: 15px; @if(old('category') === null) display: none; @endif">
                    <select id="subcategory" name="subcategory" class="form-control">
                        <option value="" selected>Subcategory</option>
                        @foreach($categories as $category)
                            <optgroup id="category-{{ $category->id }}" label="{{ $category->name }}">
                                @foreach($category->subcategories as $subcategory)
                                    <option class="subcategory-option" value="{{ $subcategory->id }}" @if(old('subcategory') == $subcategory->id) selected @endif disabled>{{ $subcategory->name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="@if($errors->has('tags')) has-error @endif" style="padding-bottom: 15px;">
                    <input type="text" name="tags" class="form-control" placeholder="tags" autocomplete="off" value="{{ old('tags') }}">
                </div>
                <div style="display: flex; flex-direction: row; justify-content: space-between;">
                    <div>Publish <input type="checkbox" name="publish" @if(old('publish')) checked @endif) /></div>
                    <div>
                        <a href="/posts" class="btn btn-danger">Cancel</a>
                        <input type="submit" value="Create" class="btn btn-success" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#category').on('change', function(e) {
            var category = $('#category :selected').val();
            if(category) {
                $('#subcategory').val('');
                $('#subcategory-container').show();
                $('.subcategory-option').attr('disabled', true);
                $('#category-' + category + ' option').removeAttr('disabled');
            }
            else {
                $('#subcategory-container').hide();
                $('.subcategory-option').removeAttr('selected');
                $('#subcategory').val('');
            }
        });
    });
</script>
@endsection
