<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.list')
            ->with('categories', Category::orderBy('weight', 'asc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'name' => 'required|unique:categories|max:255',
            'description' => 'required|max:255'
        ]);

        Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'weight' => ($request->input('weight') ?: 0),
            'created_by' => Auth::user()->id
        ]);

        return redirect('/categories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Category $category)
    {
        return view('category.edit')
            ->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => ['required', 'max:255', Rule::unique('categories')->ignore($category->id)],
            'description' => 'required|max:255'
        ]);

        $category
            ->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'weight' => ($request->input('weight') ?: 0)
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Category $category)
    {
        if($category->posts->count() == 0) {
            $category->delete();
        }
        else {
            throw new \Exception('Cannot delete category while it still has posts attached to it.');
        }
    }
}
