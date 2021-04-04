<?php


use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\Site\HomeController::class, 'index']);

Route::prefix('painel')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');
    Route::get('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'index'])->name('login');
});
