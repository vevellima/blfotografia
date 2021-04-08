<?php


use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\Site\HomeController::class, 'index']);

Route::prefix('painel')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');

    Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'index'])->name('login');
    Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'authenticate']);
    Route::post('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'index'])->name('register');
    Route::post('register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'register']);

    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('packagenames', App\Http\Controllers\Admin\PackageNameController::class);
});
