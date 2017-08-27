<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subcategory;
use App\Category;
use Illuminate\Validation\Rule;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('subcategory.list')
            ->with('subcategories', Subcategory::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subcategory.create')
            ->with('categories', Category::all());
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
            'name' => 'required|unique:subcategories|max:255',
            'description' => 'required|max:255',
            'category' => 'required'
        ]);

        Subcategory::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category')
        ]);

        return redirect('/subcategories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subcategory $subcategory
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Subcategory $subcategory)
    {
        return view('subcategory.edit')
            ->with('subcategory', $subcategory)
            ->with('categories', Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Subcategory $subcategory
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $this->validate($request, [
            'name' => ['required', 'max:255', Rule::unique('subcategories')->ignore($subcategory->id)],
            'description' => 'required|max:255',
            'category' => 'required'
        ]);

        $subcategory
            ->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category')
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Subcategory|Subcategory $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        if($subcategory->posts->count() == 0) {
            $subcategory->delete();
        }
        else {
            throw new \Exception('Cannot delete subcategory while it still has posts attached to it.');
        }
    }
}
