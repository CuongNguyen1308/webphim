<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Link_movie;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_episode = Episode::orderBy('episode', 'desc')->get();
        return view('admin.episode.index', compact('list_episode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_movie = Movie::orderBy('id', 'desc')->pluck('title', 'id');
        $linkserver = Link_movie::pluck('title', 'id');
        return view('admin.episode.form', compact('list_movie','linkserver'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $episode_check = Episode::where('episode', $data['episode'])->where('movie_id', $data['movie_id'])->count();
        if ($episode_check > 0) {
            return redirect()->back();
        } else {
            $episode = new Episode();
            $episode->movie_id = $data['movie_id'];
            $episode->linkphim = $data['linkphim'];
            $episode->linkserver = $data['linkserver'];
            $episode->episode = $data['episode'];
            $episode->save();
        }
        return redirect()->back();
    }
    public function add_episode($id)
    {
        $movie = Movie::find($id);
        $linkserver = Link_movie::pluck('title', 'id');
        $list_episode = Episode::with('movie')->where('movie_id', $id)->orderBy('episode', 'desc')->get();
        return view('admin.episode.add_episode', compact('list_episode', 'movie','linkserver'));
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
        $linkserver = Link_movie::pluck('title', 'id');
        $list_movie = Movie::orderBy('id', 'desc')->pluck('title', 'id');
        $episode = Episode::find($id);
        // return response()->json($episode);
        return view('admin.episode.form', compact('episode', 'list_movie','linkserver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $episode = Episode::find($id);
        $episode->movie_id = $data['movie_id'];
        $episode->linkphim = $data['linkphim'];
        $episode->linkserver = $data['linkserver'];
        $episode->episode = $data['episode'];
        $episode->save();
        return redirect()->route('episode.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Episode::find($id)->delete();
        return redirect()->back();
    }
    public function select_movie()
    {
        $movie = Movie::find($_GET['id']);
        $output = '<option value="">----Chọn tập phim----</option>';
        if ($movie->thuocphim == "phimbo") {
            for ($i = 1; $i <= $movie->episodes; $i++) {
                $output .= '
            <option value="' . $i . '">' . $i . '</option>
            ';
            }
        } else {
            $output .= '
            <option value="Full">Full</option>
            ';
        }
        echo $output;
    }
}
