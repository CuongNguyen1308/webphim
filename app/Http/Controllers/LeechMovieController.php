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
use Psy\Readline\Hoa\Console;

class LeechMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function leech_movie(Request $request)
    {
        if (!isset($_GET['page'])) {
            $page = 1;
        } else{
            $page = $_GET['page'];
        }
        $resp = Http::get("https://phimapi.com/danh-sach/phim-moi-cap-nhat?page=".$page)->json();
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
        toastr()->success('Thành công', 'Thêm mới thành công');
        return redirect()->back();
    }

    public function leech_episodes($slug)
    {
        $resp = Http::get("https://phimapi.com/phim/" . $slug)->json();
        $movie = Movie::where('slug',$slug)->first();
        $movie_episode = Episode::where('movie_id',$movie->id)->first();
        return view('admin.leech.list_episodes', compact('resp','movie','movie_episode'));
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

                if ($key_data == 0) {
                    $linkmovie = Link_movie::orderBy('id', 'desc')->first();
                    $episode->linkserver = $linkmovie->id;
                } else {
                    $linkmovie = Link_movie::orderBy('id', 'asc')->first();
                    $episode->linkserver = $linkmovie->id;
                }
                $episode->save();
            }
        }
        toastr()->success('Thành công', 'Thêm mới thành công');
        return redirect()->back();
    }

    public function watch_leech_detail(Request $request)
    {
        $slug = $request->slug;
        $resp = Http::get("https://phimapi.com/phim/" . $slug)->json();
        $output['content_title'] = $resp['movie']['name'];
        $output['content_detail'] = '
            <div class="row">
                <div class="col-md-5"><img src="' . $resp['movie']['thumb_url'] . '" width="100%"></div>
                <div class="col-md-7">
                    <h5><b>Tên phim :</b>' . $resp['movie']['name'] . '</h5>
                    <p><b>Tên tiếng anh:' . $resp['movie']['origin_name'] . '</b></p>
                    <p><b>Trạng thái :</b> ' . $resp['movie']['episode_current'] . '</p>
                    <p><b>Số tập :</b> ' . $resp['movie']['episode_total'] . '</p>
                    <p><b>Thời lượng : </b>' . $resp['movie']['time'] . '</p>
                    <p><b>Năm phát hành : </b>' . $resp['movie']['year'] . '</p>
                    <p><b>Chất lượng : </b>' . $resp['movie']['quality'] . '</p>
                    <p><b>Ngôn ngữ : </b>' . $resp['movie']['lang'] . '</p>';
        foreach ($resp['movie']['director'] as $dir) {
            $output['content_detail'] .= 'Đạo diễn: <span class="badge badge-pill badge-info">' . $dir . '</span><br>';
        }
        $output['content_detail'] .= '<b>Thể loại :</b>';

        foreach ($resp['movie']['category'] as $cate) {
            $output['content_detail'] .= '
                        <p><span class="badge badge-pill badge-info">' . $cate['name'] . '</span></p>';
        }
        $output['content_detail'] .= '<b>Diễn viên :</b>';
        foreach ($resp['movie']['actor'] as $act) {
            $output['content_detail'] .= '
                        <p><span class="badge badge-pill badge-info">' . $act . '</span></p>';
        }
        $output['content_detail'] .= '<b>Quốc gia :</b>';
        foreach ($resp['movie']['country'] as $country) {
            $output['content_detail'] .= '
                        <p><span class="badge badge-pill badge-info">' . $country['name'] . '</span></p>';
        }
        $output['content_detail'] .= '

                </div>
            </div>
        ';

        echo json_encode($output);
    }

    public function leech_destroy($movie_id)
    {
        Episode::where('movie_id',$movie_id)->delete();
        toastr()->error('Xóa thành công','Thành công');
        return redirect()->back();
    }
}
