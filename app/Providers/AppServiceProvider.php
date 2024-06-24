<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Movie_genre;
use App\Models\Episode;
use App\Models\Rating;
use App\Models\Info;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $info = Info::find(1);
        $phimhot_sidebar = Movie::where('phim_hot', '1')->where('status', '1')->take(10)->get();
        $phimhot_trailer = Movie::where('resolution', '5')->where('status', '1')->take(10)->get();
        $category = Category::orderBy('position', 'asc')->where('status', 1)->get();
        $genre = Genre::orderBy('id', 'desc')->get();
        $country = Country::orderBy('id', 'desc')->get();
        View::share([
            'info'=>$info,
            'phimhot_sidebar'=>$phimhot_sidebar,
            'phimhot_trailer'=>$phimhot_trailer,

            'category_home'=>$category,
            'genre_home'=>$genre,
            'country_home'=>$country
        ]);
    }
}
