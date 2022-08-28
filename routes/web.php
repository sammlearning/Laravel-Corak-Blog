<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
  Route::get('dashboard', function () {
    return view('dashboard.index');
  })->name('dashboard');
  Route::resources([
    'dashboard/posts' => PostController::class,
    'dashboard/categories' => CategoryController::class,
    'dashboard/users' => UserController::class,
  ]);
});

Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show')->withoutMiddleware(['auth', 'admin']);
Route::resource('posts.comments', CommentController::class)->shallow();
