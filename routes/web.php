<?php

use App\Http\Controllers\LeechMovieController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
// admin controller
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LinkMovieController;
use App\Http\Controllers\InfoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class,'home'])->name('homepage');
Route::get('/danh-muc/{slug}', [IndexController::class,'category'])->name('category');
Route::get('/the-loai/{slug}', [IndexController::class,'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class,'country'])->name('country');
Route::get('/phim/{slug}', [IndexController::class,'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}', [IndexController::class,'watch'])->name('watch');
Route::get('/tap-phim', [IndexController::class,'episode'])->name('episode');
Route::get('/nam/{year}', [IndexController::class,'year']);
Route::get('/tag/{tag}', [IndexController::class,'tag']);
Route::get('/tim-kiem', [IndexController::class,'tim_kiem'])->name('tim-kiem');
Route::get('/loc-phim', [IndexController::class,'filter_movie'])->name('filter-movie');

// rating
Route::post('/add-rating', [IndexController::class,'add_rating'])->name('add-rating');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route controller

Route::resource('category', CategoryController::class);
Route::post('resorting',[CategoryController::class,'resorting'])->name('resorting');
Route::post('resorting-nav',[CategoryController::class,'resorting_nav'])->name('resorting_nav');
Route::resource('country', CountryController::class);
Route::resource('genre', GenreController::class);
Route::resource('link-movie', LinkMovieController::class);
// episode
Route::resource('episode', EpisodeController::class);
Route::get('/select-movie', [EpisodeController::class,'select_movie'])->name('select-movie');
Route::get('/add-episode/{id}', [EpisodeController::class,'add_episode'])->name('add-episode');

// movie
Route::resource('movie', MovieController::class);
Route::get('/update-category-phim', [MovieController::class,'update_category']);
Route::get('/update-country-phim', [MovieController::class,'update_country']);
Route::post('/update-image-phim', [MovieController::class,'update_image'])->name('update-image-phim');
Route::get('/update-thuocphim-phim', [MovieController::class,'update_thuocphim']);
Route::get('/update-phimhot-phim', [MovieController::class,'update_phimhot']);
Route::get('/update-year-phim', [MovieController::class,'update_year']);
Route::get('/update-season-phim', [MovieController::class,'update_season']);
Route::get('/update-topview', [MovieController::class,'update_topview']);
Route::post('/watch-video', [MovieController::class,'watch_video'])->name('watch-video');
Route::get('/sort-movie', [MovieController::class,'sort_movie'])->name('sort_movie');
Route::post('/filter-topview', [MovieController::class,'filter_topview']);
Route::get('/filter-default', [MovieController::class,'filter_default']);
Route::post('resorting-mov',[MovieController::class,'resorting_mov'])->name('resorting_mov');
// info
Route::resource('info', InfoController::class);
// login by google account
Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth-google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});
// route leech movie
Route::resource('leech', LeechMovieController::class);
Route::get('/leech-movie', [LeechMovieController::class,'leech_movie'])->name('leech-movie');
Route::post('/leech-store/{slug}', [LeechMovieController::class,'leech_store'])->name('leech-store');
Route::post('/leech-episodes-store/{slug}', [LeechMovieController::class,'leech_episodes_store'])->name('leech-episodes-store');
Route::post('/watch-leech-detail', [LeechMovieController::class,'watch_leech_detail'])->name('watch-leech-detail');
Route::get('/leech-detail/{slug}', [LeechMovieController::class,'leech_detail'])->name('leech-detail');
Route::get('/leech-episodes/{slug}', [LeechMovieController::class,'leech_episodes'])->name('leech-episodes');
Route::delete('/leech-destroy/{movie_id}', [LeechMovieController::class,'leech_destroy'])->name('leech-destroy');