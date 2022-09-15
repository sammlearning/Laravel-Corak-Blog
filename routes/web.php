<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeaturedPost;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['reset' => false]);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('home', [HomeController::class, 'index']);

Route::middleware(['auth', 'admin'])->group(function () {
  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::resources([
    'dashboard/posts' => PostController::class,
    'dashboard/categories' => CategoryController::class,
    'dashboard/users' => UserController::class,
    'dashboard/config/link' => LinkController::class,
  ]);
  Route::controller(ConfigController::class)->group(function () {
    Route::get('dashboard/config', 'config_index')->name('config.index');
    Route::post('dashboard/config', 'config_update')->name('config.update');
    Route::post('dashboard/config/logo', 'logo')->name('config.logo');
    Route::get('dashboard/config/navbar', 'navbar_index')->name('config.navbar');
    Route::post('dashboard/config/navbar', 'navbar_update')->name('config.navbar.update');
    Route::get('dashboard/config/footer', 'footer_index')->name('config.footer');
    Route::put('dashboard/config/footer', 'footer_update')->name('config.update');
  });
  Route::put('dashboard/featured', [FeaturedPost::class, 'update'])->name('post.featured');
});

Route::middleware('auth')->group(function () {
  Route::post('profile/image', [ImageController::class, 'user'])->name('profile.image');
  Route::post('post/image', [ImageController::class, 'post'])->name('post.image');
  Route::resource('posts.comments', CommentController::class)->shallow();
  Route::resources([
    'profile' => ProfileController::class,
  ]);
});

Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show')->withoutMiddleware(['auth', 'admin']);
Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show')->withoutMiddleware(['auth', 'admin']);
Route::get('author/{id}', [UserController::class, 'show'])->name('users.show')->withoutMiddleware(['auth', 'admin']);
Route::get('search', [SearchController::class, 'index'])->name('posts.search');
