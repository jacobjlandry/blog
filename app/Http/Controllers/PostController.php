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
        $posts = Post::select('id', 'slug', 'title', 'description', 'category_id', 'subcategory_id', 'published_at')->get();

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
            'title' => 'required|unique:posts|max:255|uniqueSlug',
            'description' => 'required',
            'body' => 'required',
            'category' => 'required',
            'subcategory' => 'category'
        ]);

        $post = Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'body' => nl2br($request->input('body')),
            'published_at' => ($request->input('publish') ? date('Y-m-d H:i:s', time()) : null),
            'published_by' => ($request->input('publish') ? Auth::user()->id : null),
            'category_id' => $request->input('category'),
            'subcategory_id' => ($request->input('subcategory') ?: null),
            'created_by' => Auth::user()->id,
            'slug' => str_slug($request->input('title'))
        ]);

        $tags = collect(explode(",", $request->input('tags')))
            ->filter(function($tag) {
                return $tag != "";
            })
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
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Post $post)
    {
        return view('blog.preview-post')
            ->with('post', $post)
            ->with('categories', Category::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Post $post)
    {
        return view('post.edit')
            ->with('post', $post)
            ->with('categories', Category::all())
            ->with('subcategories', Subcategory::all())
            ->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'id' => 'uniqueSlug',
            'title' => ['required', 'max:255', Rule::unique('posts')->ignore($post->id)],
            'description' => 'required',
            'body' => 'required',
            'category' => 'required',
            'subcategory' => 'category'
        ]);

        $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'body' => nl2br($request->input('body')),
            'category_id' => $request->input('category'),
            'subcategory_id' => ($request->input('subcategory') ?: null),
            'published_at' => ($request->input('publish') == 'true' ? date('Y-m-d H:i:s', time()) : null),
            'published_by' => ($request->input('publish') == 'true' ? Auth::user()->id : null),
            'slug' => str_slug($request->input('title'))
        ]);

        $tags = collect(explode(",", $request->input('tags')))
            ->filter(function($tag) {
                return $tag != "";
            })
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
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Post $post)
    {
        $post->tags()->sync([]);
        $post->delete();
    }
}
