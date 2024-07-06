<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Link_movie;
use App\Models\Movie;
use App\Models\Movie_category;
use App\Models\Movie_genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LeechMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function leech_movie()
    {
        $resp = Http::get("https://phimapi.com/danh-sach/phim-moi-cap-nhat?page=1")->json();
        return view('admin.leech.index', compact('resp'));
    }

    public function leech_detail($slug)
    {
        $resp = Http::get("https://phimapi.com/phim/" . $slug)->json();
        $resp_movie[] = $resp['movie'];
        return view('admin.leech.detail', compact('resp_movie'));
    }


    public function leech_store($slug)
    {
        $resp = Http::get("https://phimapi.com/phim/" . $slug)->json();
        $resp_movie[] = $resp['movie'];
        $movie = new Movie();
        foreach ($resp_movie as $key => $data) {
            $movie->title = $data['name'];
            $movie->time = $data['time'];
            $movie->slug = $data['slug'];
            $movie->name_eng = $data['origin_name'];
            $movie->trailer = $data['trailer_url'];
            $movie->episodes = $data['episode_total'];
            $movie->episode_current = $data['episode_current'];
            $movie->year = $data['year'];
            $movie->resolution = 0;
            $movie->sub = 1;
            $movie->description = $data['content'];
            $movie->tags = $data['name'];
            $movie->thuocphim = 'phimbo';
            $movie->status = 1;
            $movie->count_views = rand(1000, 9999);
            $category = Category::orderby('id', 'desc')->first();
            $movie->category_id = $category->id;
            $genre = Genre::orderby('id', 'desc')->first();
            $movie->genre_id = $genre->id;
            $country = Country::orderby('id', 'desc')->first();
            $movie->country_id = $country->id;
            $movie->phim_hot = 1;
            $movie->image = $data['poster_url'];
            $movie->banner = $data['thumb_url'];

            $movie->save();
            $movie->movie_category()->attach($category->id);
            $movie->movie_genre()->attach($genre->id);
        }
        toastr()->success('Thành công','Thêm mới thành công');
        return redirect()->back();
    }

    public function leech_episodes($slug)
    {
        $resp = Http::get("https://phimapi.com/phim/" . $slug)->json();
        return view('admin.leech.list_episodes', compact('resp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function leech_episodes_store(Request $request, $slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        $resp = Http::get("https://phimapi.com/phim/" . $slug)->json();
        foreach ($resp['episodes'] as $key_data => $data) {
            foreach ($data['server_data'] as $key => $res_data) {
                $episode = new Episode();
                $episode->movie_id = $movie->id;
                $episode->linkphim = $res_data['link_embed'];
                $episode->episode = $res_data['name'];
                
                if($key_data == 0){
                    $linkmovie = Link_movie::orderBy('id','desc')->first();
                    $episode->linkserver = $linkmovie->id;
                }else{
                    $linkmovie = Link_movie::orderBy('id','asc')->first();
                    $episode->linkserver = $linkmovie->id;
                }
                $episode->save();
            }
        }
        toastr()->success('Thành công','Thêm mới thành công');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
