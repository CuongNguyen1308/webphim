<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
class GenreController extends Controller
{
    public function index()
    {
        $list = Genre::all();
        return view('admin.genre.index',compact('list'));
    }
    public function create()
    {
        $list = Genre::all();
        return view('admin.genre.form',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $genre = new Genre();
        $genre->title = $data['title'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->slug = $data['slug'];
        $genre->save();
        toastr()->success('Thành công','Thêm mới thành công');
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
        $genre = Genre::find($id);
        $list = Genre::all();
        return view('admin.genre.form',compact('list','genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $genre = Genre::find($id);
        $genre->title = $data['title'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->slug = $data['slug'];
        $genre->save();
        return redirect()->route('genre.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Genre::find($id)->delete();
        toastr()->error('Thành công','Xóa thành công');
        return redirect()->back();
    }
}
