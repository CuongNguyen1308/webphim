<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_genre;
use App\Models\Episode;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $phimhot = Movie::where('phim_hot', '1')->withCount('episode')->where('status', '1')->get();
        $phimhot_sidebar = Movie::where('phim_hot', '1')->where('status', '1')->take(20)->get();
        $phimhot_trailer = Movie::where('resolution', '5')->where('status', '1')->take(10)->get();
        $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        // Nested trong laravel
        $category_home = Category::with(['movie' => function ($q) {
            $q->withCount('episode');
        }])->orderBy('position', 'asc')->where('status', 1)->get();
        return view('pages.home', compact('category', 'genre', 'country', 'category_home', 'phimhot', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function tim_kiem()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $phimhot_sidebar = Movie::where('phim_hot', '1')->where('status', '1')->take(20)->get();
            $phimhot_trailer = Movie::where('resolution', '5')->where('status', '1')->take(10)->get();
            $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
            $genre = Genre::orderBy('id', 'desc')->get();
            $country = Country::orderBy('id', 'desc')->get();
            $movie = Movie::where('title', 'like', '%' . $search . '%')->orderBy('updated_at', 'desc')->paginate(40);
            return view('pages.timkiem', compact('category', 'genre', 'search', 'country', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
        } else {
            return redirect()->to('/');
        }
    }
    public function year($year)
    {
        $phimhot_sidebar = Movie::where('phim_hot', '1')->where('status', '1')->take(20)->get();
        $phimhot_trailer = Movie::where('resolution', '5')->where('status', '1')->take(10)->get();
        $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $nam = $year;
        $movie = Movie::where('year', $year)->withCount('episode')->orderBy('updated_at', 'desc')->paginate(40);
        return view('pages.year', compact('category', 'genre', 'country', 'movie', 'nam', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function tag($tag)
    {
        $phimhot_sidebar = Movie::where('phim_hot', '1')->where('status', '1')->take(20)->get();
        $phimhot_trailer = Movie::where('resolution', '5')->where('status', '1')->take(10)->get();
        $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $tu_khoa = $tag;
        $movie = Movie::where('tags', 'LIKE', '%' . $tag . '%')->withCount('episode')->orderBy('updated_at', 'desc')->paginate(40);
        return view('pages.tag', compact('category', 'genre', 'country', 'movie', 'tu_khoa', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function category($slug)
    {
        $phimhot_sidebar = Movie::where('phim_hot', '1')->where('status', '1')->take(20)->get();
        $phimhot_trailer = Movie::where('resolution', '5')->where('status', '1')->take(10)->get();
        $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $cate_slug = Category::where('slug', $slug)->first();
        $movie = Movie::where('category_id', $cate_slug->id)->withCount('episode')->orderBy('updated_at', 'desc')->paginate(40);
        return view('pages.category', compact('category', 'genre', 'country', 'cate_slug', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function country($slug)
    {
        $phimhot_sidebar = Movie::where('phim_hot', '1')->where('status', '1')->take(20)->get();
        $phimhot_trailer = Movie::where('resolution', '5')->where('status', '1')->take(10)->get();
        $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $coun_slug = Country::where('slug', $slug)->first();
        $movie = Movie::where('country_id', $coun_slug->id)->withCount('episode')->orderBy('updated_at', 'desc')->paginate(40);
        return view('pages.country', compact('category', 'genre', 'country', 'coun_slug', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function genre($slug)
    {
        $phimhot_sidebar = Movie::where('phim_hot', '1')->where('status', '1')->take(20)->get();
        $phimhot_trailer = Movie::where('resolution', '5')->where('status', '1')->take(10)->get();
        $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $gen_slug = Genre::where('slug', $slug)->first();
        // nhiều thể loại
        $movie_genre = Movie_genre::where("genre_id", $gen_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $value) {
            $many_genre[] = $value->movie_id;
        }
        $movie = Movie::whereIn('id', $many_genre)->withCount('episode')->orderBy('updated_at', 'desc')->paginate(40);
        return view('pages.genre', compact('category', 'genre', 'country', 'gen_slug', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
    }
    public function episode()
    {
        return view('pages.episode');
    }

    public function movie($slug)
    {
        $phimhot_sidebar = Movie::where('phim_hot', '1')->where('status', '1')->take(20)->get();
        $phimhot_trailer = Movie::where('resolution', '5')->where('status', '1')->take(10)->get();
        $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre', 'episode')->where('slug', $slug)->where('status', 1)->orderBy('updated_at', 'desc')->first();
        $episode_tapdau = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'asc')->first();
        $related = Movie::with('country', 'genre', 'country')->withCount('episode')->where('category_id', $movie->category->id)->orderByRaw('RAND()')->whereNotIn('slug', [$slug])->get();
        // lấy 3 tập gần nhất
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'desc')->take(3)->get();
        // lấy tổng số tập
        $episode_current_list = Episode::with('movie')->where('movie_id', $movie->id)->get();
        $episode_current_list_count = $episode_current_list->count();
        // return response()->json($episode);
        return view('pages.movie', compact('category', 'genre', 'country', 'movie', 'related', 'phimhot_sidebar', 'phimhot_trailer', 'episode', 'episode_tapdau', 'episode_current_list_count'));
    }
    public function watch($slug, $tap)
    {
        if (isset($tap)) {
            $tapphim = $tap;
        } else {
            $tapphim = 1;
        };
        $tapphim = substr($tap, 4);
        $phimhot_sidebar = Movie::where('phim_hot', '1')->where('status', '1')->take(20)->get();
        $phimhot_trailer = Movie::where('resolution', '5')->where('status', '1')->take(10)->get();
        $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        $movie = Movie::where('slug', $slug)->with('category', 'episode', 'genre', 'country', 'movie_genre')->where('status', 1)->first();
        $related = Movie::with('country', 'genre', 'country')->withCount('episode')->where('category_id', $movie->category->id)->orderByRaw('RAND()')->whereNotIn('slug', [$slug])->get();
        $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->first();
        // return response()->json($movie);
        return view('pages.watch', compact('category', 'genre', 'country',  'movie', 'phimhot_sidebar', 'phimhot_trailer', 'related', 'episode', 'tapphim'));
    }
    public function filter_movie()
    {
        $order = $_GET['order'];
        $gen = $_GET['genre'];
        $coun = $_GET['country'];
        $year = $_GET['year'];
        if ($order == '' && $gen == '' && $coun == '' && $year == '') {
            return redirect()->back();
        } else {
            $phimhot_sidebar = Movie::where('phim_hot', '1')->where('status', '1')->take(20)->get();
            $phimhot_trailer = Movie::where('resolution', '5')->where('status', '1')->take(10)->get();
            $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
            $genre = Genre::orderBy('id', 'desc')->get();
            $country = Country::orderBy('id', 'desc')->get();
            $movie_genre = Movie_genre::where("genre_id", $gen)->get();
            // dd($movie_genre);
            $many_genre = [];
            foreach ($movie_genre as $key => $value) {
                $many_genre[] = $value->movie_id;
            }
            $movie = Movie::withCount('episode', 'movie_genre')->orWhere('country_id', $coun)->orWhereIn('id', $many_genre)->orWhere('year', $year)->orderBy('updated_at', 'desc')->paginate(40);
            return view('pages.filter', compact('category', 'genre', 'country', 'movie', 'phimhot_sidebar', 'phimhot_trailer'));
        }
    }
}
