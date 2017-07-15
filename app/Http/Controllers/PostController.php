<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Subcategory;
use App\Tag;
use Auth;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::select('id', 'title', 'description', 'category_id', 'subcategory_id', 'published_at')->get();

        return view('post.list')
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create')
            ->with('categories', Category::all())
            ->with('subcategories', Subcategory::all())
            ->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts|max:255',
            'description' => 'required',
            'body' => 'required'
        ]);

        $subcategory = Subcategory::find($request->input('subcategory'));

        $post = Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'body' => nl2br($request->input('body')),
            'published_at' => ($request->input('publish') ? date('Y-m-d H:i:s', time()) : null),
            'published_by' => ($request->input('publish') ? Auth::user()->id : null),
            'category_id' => ($subcategory ? $subcategory->category_id : null),
            'subcategory_id' => ($request->input('subcategory') ?: null),
            'created_by' => Auth::user()->id
        ]);

        $tags = collect(explode(",", $request->input('tags')))
            ->map(function($name) {
                $tag = Tag::firstOrCreate([
                    'name' => trim($name)
                ]);

                return $tag->id;
            });
        $post->tags()->sync($tags);

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('blog.preview-post')
            ->with('post', Post::find($id))
            ->with('categories', Category::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('post.edit')
            ->with('post', Post::find($id))
            ->with('categories', Category::all())
            ->with('subcategories', Subcategory::all())
            ->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => ['required', 'max:255', Rule::unique('posts')->ignore($id)],
            'description' => 'required',
            'body' => 'required'
        ]);

        $post = Post::find($id);
        $subcategory = Subcategory::find($request->input('subcategory'));

        $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'body' => nl2br($request->input('body')),
            'category_id' => ($subcategory ? $subcategory->category_id : null),
            'subcategory_id' => ($request->input('subcategory') ?: null),
            'published_at' => ($request->input('publish') == 'true' ? date('Y-m-d H:i:s', time()) : null),
            'published_by' => ($request->input('publish') == 'true' ? Auth::user()->id : null)
        ]);

        $tags = collect(explode(",", $request->input('tags')))
            ->map(function($name) {
                $tag = Tag::firstOrCreate([
                    'name' => trim($name)
                ]);

                return $tag->id;
            });
        $post->tags()->sync($tags);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->tags()->sync([]);
        Post::find($id)->delete();
    }
}
