<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\PhotosController;

Route::get('/ping', function () {
    return ['pong' => true];
});

Route::get('/401', [AuthController::class, 'unauthorized'])->name('login');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::post('/auth/refresh', [AuthController::class, 'refresh']);
Route::post('/user', [AuthController::class, 'create']);

Route::get('/user', [UserController::class, 'read']); //usuario logado

Route::get('/users', [UserController::class, 'list']);
Route::post('/user', [UserController::class, 'add']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::get('/user/{id}', [UserController::class, 'one']);

Route::get('/products', [ProductController::class, 'list']);
Route::post('/product', [ProductController::class, 'add']);
Route::put('/product/{id}', [ProductController::class, 'update']);
Route::get('/product/{id}', [ProductController::class, 'one']);

Route::get('/packages', [PackageController::class, 'list']);
Route::post('/package', [PackageController::class, 'add']);
Route::put('/package/{id}', [PackageController::class, 'update']);
Route::get('/package/{id}', [PackageController::class, 'one']);

Route::get('/typepackages', [PackageController::class, 'list']);
Route::post('/typepackage', [PackageController::class, 'add']);
Route::put('/typepackage/{id}', [PackageController::class, 'update']);
Route::get('/typepackage/{id}', [PackageController::class, 'one']);

Route::get('/services', [ServiceController::class, 'list']);
Route::post('/service', [ServiceController::class, 'add']);
Route::put('/service/{id}', [ServiceController::class, 'update']);
Route::get('/service/{id}', [ServiceController::class, 'one']);

Route::get('/schedules', [ScheduleController::class, 'list']);
Route::post('/schedule', [ScheduleController::class, 'add']);
Route::put('/schedule/{id}', [ScheduleController::class, 'update']);
Route::get('/schedule/{id}', [ScheduleController::class, 'one']);

Route::get('/photos', [PhotoController::class, 'list']);
Route::post('/photo', [PhotoController::class, 'add']);
Route::put('/photo/{id}', [PhotoController::class, 'update']);
Route::get('/photo/{id}', [PhotoController::class, 'one']);