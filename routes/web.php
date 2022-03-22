<?php

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

Route::get('/home', function() {
    return view('home');
});

// RegisterControllerのルーティング
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register');
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store'])
    ->middleware('guest');
// ↑バリデーション実装のため↓へ変更
// Route::post('/user/register', 'App\Http\Controllers\UserController@register');

// // RegisterControllerのルーティング
// Route::get('/userRegister', [App\Http\Controllers\UserController::class, 'register'])
//     ->middleware('guest')
//     ->name('userRegister');
// Route::post('/userRegister', [App\Http\Controllers\UserController::class, 'store'])
//     ->middleware('guest');

// ログイン機能のルーティング
Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'authenticate'])
    ->middleware('guest');

// ログアウト機能のルーティング
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// 自作用
Route::get('/training', [App\Http\Controllers\TrainingController::class, 'training']);
