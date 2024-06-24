<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;


class CountryController extends Controller
{
    public function index()
    {
        $list = Country::all();
        return view('admin.country.index',compact('list'));
    }
    public function create()
    {
        $list = Country::all();
        return view('admin.country.form',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $country = new Country();
        $country->title = $data['title'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->slug = $data['slug'];
        $country->save();
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
        $country = Country::find($id);
        $list = Country::all();
        return view('admin.country.form',compact('list','country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $country = Country::find($id);
        $country->title = $data['title'];
        $country->description = $data['description'];
        $country->status = $data['status'];
        $country->slug = $data['slug'];
        $country->save();
        return redirect()->route('country.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Country::find($id)->delete();
        return redirect()->back();
    }
}
