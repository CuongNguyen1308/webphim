<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie_genre;
use App\Models\Episode;
use App\Models\Info;
// use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $path = public_path() . "/json_file/";
        $category = Category::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $list = Movie::with('category', 'country', 'movie_genre', 'genre')->withCount('episode')->orderBy('id', 'desc')->get();

        // return response()->json($list);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        File::put($path . 'movies.json', json_encode($list));
        return view('admin.movie.index', compact('list', 'category', 'genre', 'country'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $list_genre = Genre::all();
        $country = Country::pluck('title', 'id');
        // $list = Movie::with('category','country','genre')->orderBy('id','desc')->get();
        return view('admin.movie.form', compact('category', 'genre', 'country', 'list_genre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->time = $data['time'];
        $movie->slug = $data['slug'];
        $movie->name_eng = $data['name_eng'];
        $movie->trailer = $data['trailer'];
        $movie->episodes = $data['episodes'];
        $movie->resolution = $data['resolution'];
        $movie->sub = $data['sub'];
        $movie->description = $data['description'];
        $movie->tags = $data['tags'];
        $movie->category_id = $data['category_id'];
        $movie->thuocphim = $data['thuocphim'];
        $movie->count_views = rand(1000, 9999);
        foreach ($data['genre'] as $key => $value) {
            $movie->genre_id = $value[0];
        }
        $movie->country_id = $data['country_id'];
        $movie->status = $data['status'];
        $movie->phim_hot = $data['phim_hot'];
        $get_image = $request->file('image');
        if ($get_image) {
            $get_image_name = $get_image->getClientOriginalName(); //hinhanh.jpg
            $name_image = current(explode('.', $get_image_name)); //[0]=>hinhanh .[1]=>jpg || current lấy đầu tiên, end lấy cuối cùng
            $new_image = $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension(); // hinhanh1234 .  getClientOriginalExtension() lấy đuôi mở rộng
            $get_image->move('uploads/movie/', $new_image); // copy hình ảnh vào đường dẫn và lưu tên
            // File::copy($path,$name_image,$path_gallery,$new_image); thêm thôi k liên quan
            $movie->image = $new_image;
        }
        $movie->save();
        $movie->movie_genre()->attach($data['genre']);
        return redirect()->route('movie.index');
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
        $category = Category::pluck('title', 'id');
        $genre = Genre::pluck('title', 'id');
        $country = Country::pluck('title', 'id');
        $list_genre = Genre::all();
        // $list = Movie::with('category','country','genre')->orderBy('id','desc')->get();
        $movie = Movie::find($id);
        $movie_genre = $movie->movie_genre;
        return view('admin.movie.form', compact('category', 'genre', 'country', 'movie', 'list_genre', 'movie_genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->time = $data['time'];
        $movie->slug = $data['slug'];
        $movie->name_eng = $data['name_eng'];
        $movie->trailer = $data['trailer'];
        $movie->episodes = $data['episodes'];
        $movie->resolution = $data['resolution'];
        $movie->sub = $data['sub'];
        $movie->description = $data['description'];
        $movie->tags = $data['tags'];
        $movie->category_id = $data['category_id'];
        $movie->thuocphim = $data['thuocphim'];
        // $movie->count_views = rand(1000,9999);
        foreach ($data['genre'] as $key => $value) {
            $movie->genre_id = $value[0];
        }
        $movie->country_id = $data['country_id'];
        $movie->status = $data['status'];
        $movie->phim_hot = $data['phim_hot'];
        // thêm hình ảnh
        $get_image = $request->file('image');
        if ($get_image) {
            if (file_exists('uploads/movie/' . $movie->image)) {
                if (!empty($movie->image)) {
                    unlink('uploads/movie/' . $movie->image);
                    $get_image_name = $get_image->getClientOriginalName(); //hinhanh.jpg
                    $name_image = current(explode('.', $get_image_name)); //[0]=>hinhanh .[1]=>jpg || current lấy đầu tiên, end lấy cuối cùng
                    $new_image = $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension(); // hinhanh1234 .  getClientOriginalExtension() lấy đuôi mở rộng
                    $get_image->move('uploads/movie/', $new_image); // copy hình ảnh vào đường dẫn và lưu tên
                    // File::copy($path,$name_image,$path_gallery,$new_image); thêm thôi k liên quan
                    $movie->image = $new_image;
                }
            }
        }
        $movie->save();
        $movie->movie_genre()->sync($data['genre']);
        return redirect()->route('movie.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::find($id);
        // xóa ảnh
        if (file_exists('uploads/movie/' . $movie->image)) {
            unlink('uploads/movie/' . $movie->image);
        }
        // nhiều thể loại
        Movie_genre::whereIn("movie_id", [$movie->id])->delete();
        // xóa tập phim
        Episode::where('movie_id', $movie->id)->delete();
        $movie->delete();

        return redirect()->back();
    }
    // update dữ liệu trong index
    public function update_category(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->category_id = $data['category'];
        $movie->save();
    }
    public function update_country(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->country_id = $data['country'];
        $movie->save();
    }
    public function update_image(Request $request)
    {
        $get_image = $request->file('file');
        $movie_id = $request->movie_id;
        if ($get_image) {
            $movie = Movie::find($movie_id);
            // xóa ảnh cũ
            unlink('uploads/movie/' . $movie->image);
            // thêm ảnh mới
            $get_image_name = $get_image->getClientOriginalName(); //hinhanh.jpg
            $name_image = current(explode('.', $get_image_name)); //[0]=>hinhanh .[1]=>jpg || current lấy đầu tiên, end lấy cuối cùng
            $new_image = $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension(); // hinhanh1234 .  getClientOriginalExtension() lấy đuôi mở rộng
            $get_image->move('uploads/movie/', $new_image); // copy hình ảnh vào đường dẫn và lưu tên
            // File::copy($path,$name_image,$path_gallery,$new_image); thêm thôi k liên quan
            $movie->image = $new_image;
            $movie->save();
        }
    }
    public function update_thuocphim(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->thuocphim = $data['thuocphim'];
        $movie->save();
    }
    public function update_phimhot(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->phim_hot = $data['phim_hot'];
        $movie->save();
    }
    public function update_year(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->year = $data['year'];
        $movie->save();
    }
    public function update_season(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->season = $data['season'];
        $movie->save();
    }
    public function update_topview(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->topview = $data['topview'];
        $movie->save();
    }
    // ///////////////////////////////////////////////////////////////
    public function filter_topview(Request $request)
    {
        $data = $request->all();
        $movie = Movie::where('topview', $data['value'])->orderBy('updated_at', 'desc')->take(20)->get();
        $output = '';
        foreach ($movie as $key => $mov) {
            if ($mov->resolution == 0)
                $text = ' HD';
            else if ($mov->resolution == 1)
                $text = ' SD';
            else if ($mov->resolution == 2)
                $text = ' HDCam';
            else if ($mov->resolution == 3)
                $text = ' Cam';
            else if ($mov->resolution == 4)
                $text = 'FullHD';
            else {
                $text = 'Trailer';
            }
            $output .= '
            <div class="item">
            <a href="' . url('phim/' . $mov->slug) . ' " title=" ' . $mov->title . '">
                <div class="item-link">
                    <img src="' . asset('uploads/movie/' . $mov->image) . ' "
                        class="lazy post-thumb" alt=" ' . $mov->title . ' "
                        title=" ' . $mov->title . ' " />
                    <span class="is_trailer">
                        ' . $text . '
                    </span>
                </div>
                <p class="title"> ' . $mov->title . '</p>
            </a>
            <div class="viewsCount" style="color: #9d9d9d;">Năm: ' . $mov->year . '</div>
            <div class="viewsCount" style="color: #9d9d9d;">Lượt xem: ' . $mov->count_views . '</div>
            <ul class="list-inline rating" title="Average Rating">';

            for ($count = 1; $count <= 5; $count++) {
                $output .= '<li title="star_rating" class="star"
                                        style="color:#ffcc00; font-size:15px; padding:0;">
                                        &#9733;</li>';
            }

            $output .= '</ul>
            <div style="float: left;">
            
                <span class="user-rate-image post-large-rate stars-large-vang"
                    style="display: block;/* width: 100%; */">
                    <span style="width: 0%"></span>
                </span>
            </div>
        </div>';
        }
        echo $output;
    }
    public function filter_default(Request $request)
    {
        $data = $request->all();
        $movie = Movie::where('topview', 0)->orderBy('updated_at', 'desc')->take(20)->get();
        $output = '';
        foreach ($movie as $key => $mov) {
            if ($mov->resolution == 0)
                $text = 'HD';
            else if ($mov->resolution == 1)
                $text = 'SD';
            else if ($mov->resolution == 2)
                $text = 'HDCam';
            else if ($mov->resolution == 3)
                $text = 'Cam';
            else if ($mov->resolution == 4)
                $text = 'FullHD';
            else {
                $text = 'Trailer';
            }

            $output .= '
            <div class="item">
            <a href="' . url('phim/' . $mov->slug) . ' " title=" ' . $mov->title . '">
                <div class="item-link">
                    <img src="' . asset('uploads/movie/' . $mov->image) . ' "
                        class="lazy post-thumb" alt=" ' . $mov->title . ' "
                        title=" ' . $mov->title . ' " />
                    <span class="is_trailer">
                        ' . $text . '
                    </span>
                </div>
                <p class="title"> ' . $mov->title . '</p>
            </a>
            <div class="viewsCount" style="color: #9d9d9d;">Năm: ' . $mov->year . '</div>
            <div class="viewsCount" style="color: #9d9d9d;">Lượt xem: ' . $mov->count_views . '</div>
            <ul class="list-inline rating" title="Average Rating">';

            for ($count = 1; $count <= 5; $count++) {
                $output .= '<li title="star_rating" class="star"
                                        style="color:#ffcc00; font-size:15px; padding:0;">
                                        &#9733;</li>';
            }

            $output .= '</ul>
            <div style="float: left;">
            
                <span class="user-rate-image post-large-rate stars-large-vang"
                    style="display: block;/* width: 100%; */">
                    <span style="width: 0%"></span>
                </span>
            </div>
        </div>';
        }
        echo $output;
    }
}
