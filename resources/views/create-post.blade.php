@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>New Post</h3>
            <form action="/posts" method="post">
                {{ csrf_field() }}
                <input name="title" type="text" class="form-control" placeholder="title" /><br />
                <input name="description" type="text" class="form-control" placeholder="description" /><br />
                <textarea name="body" class="form-control" placeholder="Cool blog post!"></textarea><br />
                <select name="subcategory" class="form-control">
                    <option value="" selected>Category</option>
                    @foreach($categories as $category)
                        <optgroup label="{{ $category->name }}">
                            @foreach($category->subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select><br />
                <input type="text" name="tags" class="form-control" placeholder="tags" autocomplete="off"><br />
                <div style="display: flex; flex-direction: row; justify-content: space-between;">
                    <div>Publish <input type="checkbox" name="publish" /></div>
                    <div>
                        <a href="/posts" class="btn btn-danger">Cancel</a>
                        <input type="submit" value="Create" class="btn btn-success" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
