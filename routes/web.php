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

Route::get('/', App\Http\Controllers\HomeController::class)->name('index');

Route::prefix('painel')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');

    Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'index'])->name('login');
    Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'authenticate']);
    Route::post('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'index'])->name('register');
    Route::post('register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'register']);

    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
});
