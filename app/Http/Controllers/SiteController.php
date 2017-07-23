<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use App\Tag;
use Auth;
use Stat;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $category = false, $subcategory = false)
    {
        // log site stats
        Stat::log($request);

        // No Categories yet, site has not been set up.
        if(!Category::count()) {
            abort(418);
        }

        $categories = Category::orderBy('weight', 'asc')->get();
        if(!$category) {
            $category = $categories->first()->name;
        }

        $posts = Category::where('name', $category)
            ->first()
            ->posts()
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc');

        if($subcategory) {
            $posts->where('subcategory_id', Subcategory::where('name', $subcategory)->first()->id);
        }

        $posts = $posts->get();

        return view('blog.welcome')
            ->with('posts', $posts)
            ->with('categories', $categories)
            ->with('currentCategory', $category);
    }

    public function tags($name)
    {
        $categories = Category::orderBy('weight', 'asc')->get();

        $posts = Tag::where('name', $name)
            ->first()
            ->posts()
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->get();

        return view('blog.welcome')
            ->with('posts', $posts)
            ->with('categories', $categories);
    }

    public function reader(Subcategory $subcategory, $currentPost)
    {
        $categories = Category::orderBy('weight', 'asc')->get();

        $posts = $subcategory
            ->posts()
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'asc')
            ->get();

        return view('blog.reader')
            ->with('post', $posts[$currentPost - 1])
            ->with('categories', $categories)
            ->with('currentCategory', $subcategory->category->name)
            ->with('currentSubcategory', $subcategory)
            ->with('currentPost', $currentPost);
    }
}
