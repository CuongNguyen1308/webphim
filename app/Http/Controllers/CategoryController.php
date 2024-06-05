<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        $list = Category::orderBy('position','asc')->get();
        return view('admin.category.form',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $catetory = new Category();
        $catetory->title = $data['title'];
        $catetory->description = $data['description'];
        $catetory->status = $data['status'];
        $catetory->slug = $data['slug'];
        $catetory->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        $list = Category::orderBy('position','asc')->get();
        return view('admin.category.form',compact('list','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $catetory = Category::find($id);
        $catetory->title = $data['title'];
        $catetory->description = $data['description'];
        $catetory->status = $data['status'];
        $catetory->slug = $data['slug'];
        $catetory->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();
        return redirect()->back();
    }
    public function resorting(Request $request){
        $data = $request->all();
        foreach ($data['array_id'] as $key => $value) {
            $category = Category::find($value);
            $category->position = $key;
            $category->save();
        }
    }
}
