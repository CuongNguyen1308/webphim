<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_genre;
use App\Models\Movie_category;
use App\Models\Episode;
use App\Models\Rating;
use App\Models\Info;
use App\Models\Link_movie;
use Illuminate\Support\Carbon;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $info = Info::find(1);
        $meta_title = $info->title;
        $meta_description = $info->description;
        $meta_image = "";
        $phimhot = Movie::where('phim_hot', '1')->withCount('episode')->where('status', '1')->orderBy('updated_at', 'desc')->get();
        // Nested trong laravel
        $category_home = Category::with(['movie' => function ($q) {
            $q->withCount('episode');
        }])->orderBy('position', 'asc')->where('status', 1)->get();
        return view('pages.home', compact('category_home', 'phimhot', 'meta_title', 'meta_description','meta_image','meta_image'));
    }
    public function tim_kiem()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $movie = Movie::where('title', 'like', '%' . $search . '%')->orderBy('updated_at', 'desc')->paginate(40);
            $meta_title = "Từ khóa tìm kiếm: " . $search;
            $meta_description = "Tìm phim " . $search;
            $meta_image = "";
            return view('pages.timkiem', compact('search', 'movie', 'meta_title', 'meta_description','meta_image'));
        } else {
            return redirect()->to('/');
        }
    }
    public function year($year)
    {
        $nam = $year;
        $meta_title = "Năm phim: " . $year;
        $meta_description = "Tìm phim theo năm: " . $year;
        $meta_image = "";
        $movie = Movie::where('year', $year)->withCount('episode')->orderBy('updated_at', 'desc')->paginate(40);
        return view('pages.year', compact('movie', 'nam', 'meta_title', 'meta_description','meta_image'));
    }
    public function tag($tag)
    {
        $tu_khoa = $tag;
        $meta_title = $tag;
        $meta_description = $tag;
        $meta_image = "";
        $movie = Movie::where('tags', 'LIKE', '%' . $tag . '%')->withCount('episode')->orderBy('updated_at', 'desc')->paginate(40);
        return view('pages.tag', compact('movie', 'tu_khoa', 'meta_title', 'meta_description','meta_image'));
    }
    public function category($slug)
    {
        $cate_slug = Category::where('slug', $slug)->first();
        $meta_title = $cate_slug->title;
        $meta_description = $cate_slug->description;
        $meta_image = "";
        // Nhiều danh mục
        $movie_category = Movie_category::where("category_id", $cate_slug->id)->get();
        $many_category = [];
        foreach ($movie_category as $key => $value) {
            $many_category[] = $value->movie_id;
        }
        $movie = Movie::whereIn('id', $many_category)->withCount('episode')->orderBy('position', 'asc')->paginate(40);
        return view('pages.category', compact('cate_slug', 'movie', 'meta_title', 'meta_description','meta_image'));
    }
    public function country($slug)
    {
        $coun_slug = Country::where('slug', $slug)->first();
        $meta_title = $coun_slug->title;
        $meta_description = $coun_slug->description;
        $meta_image = "";
        $movie = Movie::where('country_id', $coun_slug->id)->withCount('episode')->orderBy('position', 'asc')->paginate(40);
        return view('pages.country', compact('coun_slug', 'movie', 'meta_title', 'meta_description','meta_image'));
    }
    public function genre($slug)
    {
        $gen_slug = Genre::where('slug', $slug)->first();
        $meta_title = $gen_slug->title;
        $meta_description = $gen_slug->description;
        $meta_image = "";
        // nhiều thể loại
        $movie_genre = Movie_genre::where("genre_id", $gen_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $value) {
            $many_genre[] = $value->movie_id;
        }
        $movie = Movie::whereIn('id', $many_genre)->withCount('episode')->orderBy('position', 'asc')->paginate(40);
        return view('pages.genre', compact('gen_slug', 'movie', 'meta_title', 'meta_description','meta_image'));
    }
    public function episode()
    {
        return view('pages.episode');
    }

    public function movie(Request $request, $slug)
    {
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre','movie_category', 'episode')->where('slug', $slug)->where('status', 1)->first();
        $meta_title = $movie->title;
        $meta_description = $movie->description;
        $meta_image = url('uploads/movie/'.$movie->image);
        $episode_tapdau = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'asc')->first();
        $related = Movie::with('country', 'genre', 'country')->withCount('episode')->where('category_id', $movie->category->id)->orderByRaw('RAND()')->whereNotIn('slug', [$slug])->get();
        // lấy 3 tập gần nhất
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'desc')->take(3)->get();
        // lấy tổng số tập
        $episode_current_list = Episode::with('movie')->where('movie_id', $movie->id)->get();
        $episode_current_list_count = $episode_current_list->count();
        // return response()->json($episode);

        // Rating movie
        $rating = Rating::where('movie_id', $movie->id)->avg('rating');
        $rating = round($rating);
        $count_total = Rating::where('movie_id', $movie->id)->count();
        // increase movie views
        $views = $movie->count_views + 1;
        $movie->count_views = $views;
        $movie->save();
        return view('pages.movie', compact('movie', 'related', 'episode', 'episode_tapdau', 'episode_current_list_count', 'rating', 'count_total', 'meta_title', 'meta_description','meta_image'));
    }
    // add_rating
    public function add_rating(Request $request)
    {
        $data = $request->all();
        $ip_address = $request->ip();
        $rating_count = Rating::where('movie_id', $data['movie_id'])->where('ip_address', $ip_address)->count();
        if ($rating_count > 0) {
            echo 'exist';
        } else {
            $rating = new Rating();
            $rating->movie_id = $data['movie_id'];
            $rating->rating = $data['index'];
            $rating->ip_address = $ip_address;
            $rating->save();
            echo 'done';
        }
    }
    public function watch($slug, $tap)
    {
        if (isset($tap)) {
            $tapphim = $tap;
        } else {
            $tapphim = 1;
        };
        $tapphim = substr($tap, 4);
        $movie = Movie::where('slug', $slug)->with('category', 'episode', 'genre', 'country', 'movie_genre')->where('status', 1)->first();
        $meta_title = $movie->title . " - Tập " . $tapphim;
        $meta_description = $movie->description;
        $meta_image = url('uploads/movie/'.$movie->image);
        $related = Movie::with('country', 'genre', 'country')->withCount('episode')->where('category_id', $movie->category->id)->orderByRaw('RAND()')->whereNotIn('slug', [$slug])->get();
        $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        $server = Link_movie::orderBy('id','desc')->get();
        $episode_movie = Episode::where('movie_id',$movie->id)->orderBy('episode','asc')->get()->unique('linkserver');
        $episode_list = Episode::where('movie_id',$movie->id)->orderBy('episode','asc')->get();
        // return response()->json($movie);
        return view('pages.watch', compact('movie', 'related', 'episode', 'tapphim', 'meta_title', 'meta_description','meta_image','server','episode_movie','episode_list'));
    }
    public function filter_movie()
    {
        $order = $_GET['order'];
        $gen = $_GET['genre'];
        $coun = $_GET['country'];
        $year = $_GET['year'];
        if ($gen == '' && $coun == '' && $year == '') {
            return redirect()->back();
        } else {
            $movie_genre = Movie_genre::where("genre_id", $gen)->get();
            // dd($movie_genre);
            $many_genre = [];
            foreach ($movie_genre as $key => $value) {
                $many_genre[] = $value->movie_id;
            }
            $meta_title = "Tìm kiếm phim";
            $meta_description = "Tìm kiếm";
            $meta_image = "";
            $movie = Movie::withCount('episode', 'movie_genre')->orWhere('country_id', $coun)->orWhereIn('id', $many_genre)->orWhere('year', $year)->orderBy($order, 'desc')->paginate(40);
            return view('pages.filter', compact('movie', 'meta_title', 'meta_description','meta_image'));
        }
    }
}
