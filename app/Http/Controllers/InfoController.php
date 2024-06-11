<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = Info::find(1);
        return view('admin.info.form', compact('info'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'title' => 'required|max:255',
                'description' => 'required',
                'logo' => 'image|mimes:png,jpg,gif,svg|max:2048|dimensions:min_width:100,min_height:100,max_width:2000,max_height:2000',
            ],
            [
                'title.required' => 'Vui lòng nhập tiêu đề',
                'description.required' => 'Vui lòng nhập mô tả',
            ]
        );
        $info = Info::find($id);
        $info->title = $data['title'];
        $info->description = $data['description'];
        $get_logo = $request->file('logo');
        if ($get_logo) {
            if (file_exists('uploads/logo/' . $info->logo)) {
                if (!empty($info->logo)) {
                    unlink('uploads/logo/' . $info->logo);
                    $get_logo_name = $get_logo->getClientOriginalName(); //hinhanh.jpg
                    $name_logo = current(explode('.', $get_logo_name)); //[0]=>hinhanh .[1]=>jpg || current lấy đầu tiên, end lấy cuối cùng
                    $new_logo = $name_logo . rand(0, 999) . '.' . $get_logo->getClientOriginalExtension(); // hinhanh1234 .  getClientOriginalExtension() lấy đuôi mở rộng
                    $get_logo->move('uploads/logo/', $new_logo); // copy hình ảnh vào đường dẫn và lưu tên
                    // File::copy($path,$name_logo,$path_gallery,$new_logo); thêm thôi k liên quan
                    $info->logo = $new_logo;
                }
            }
        };
        toastr()->info('Cập nhật thành công', 'Thành công');
        $info->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
