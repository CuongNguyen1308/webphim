<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link_movie;
class LinkMovieController extends Controller
{
    public function index()
    {
        $list = Link_movie::all();
        return view('admin.linkmovie.index',compact('list'));
    }
    public function create()
    {
        $list = Link_movie::all();
        return view('admin.linkmovie.form',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $linkmovie = new Link_movie();
        $linkmovie->title = $data['title'];
        $linkmovie->description = $data['description'];
        $linkmovie->status = $data['status'];
        $linkmovie->save();
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
        $linkmovie = Link_movie::find($id);
        $list = Link_movie::all();
        return view('admin.linkmovie.form',compact('list','linkmovie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $linkmovie = Link_movie::find($id);
        $linkmovie->title = $data['title'];
        $linkmovie->description = $data['description'];
        $linkmovie->status = $data['status'];
        $linkmovie->save();
        return redirect()->route('linkmovie.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Link_movie::find($id)->delete();
        return redirect()->back();
    }
}
