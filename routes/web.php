<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

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

//Closure
Route::get('/', function () {
    return view('principal');
});

//Controller (static)
Route::get('/create-account', [RegisterController::class, 'index'])->name('create-account');
Route::post('/create-account', [RegisterController::class, 'store'])->name('create-account');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
//->name helps to redirect through the helper route()

//Route model Binding {model:field you want to show off}
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');