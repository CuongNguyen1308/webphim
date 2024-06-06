<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route controller

Route::resource('category', CategoryController::class);
Route::post('resorting',[CategoryController::class,'resorting'])->name('resorting');
Route::resource('country', CountryController::class);

Route::resource('genre', GenreController::class);
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

Route::post('/filter-topview', [MovieController::class,'filter_topview']);
Route::get('/filter-default', [MovieController::class,'filter_default']);
