<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PackageNameController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PaymentControlController;
use App\Http\Controllers\PhotoController;

Route::get('/ping', function () {
    return ['pong' => true];
});

Route::get('/401', [AuthController::class, 'unauthorized'])->name('login');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::post('/auth/refresh', [AuthController::class, 'refresh']);
Route::post('/auth/user', [AuthController::class, 'create']);
Route::get('/auth/user', [AuthController::class, 'read']);

Route::post('/user', [UserController::class, 'create']);
Route::get('/user', [UserController::class, 'read']);
Route::get('/users', [UserController::class, 'list']);
Route::put('/user', [UserController::class, 'update']);

Route::post('/product', [ProductController::class, 'create']);
Route::get('/product', [ProductController::class, 'read']);
Route::get('/products', [ProductController::class, 'list']);
Route::put('/product', [ProductController::class, 'update']);

Route::post('/packagename', [PackageNameController::class, 'create']);
Route::get('/packagename', [PackageNameController::class, 'read']);
Route::get('/packagenames', [PackageNameController::class, 'list']);
Route::put('/packagename', [PackageNameController::class, 'update']);

Route::post('/package', [PackageController::class, 'create']);
Route::get('/package', [PackageController::class, 'read']);
Route::get('/packages', [PackageController::class, 'list']);
Route::put('/package', [PackageController::class, 'update']);

Route::post('/service', [ServiceController::class, 'create']);
Route::get('/service', [ServiceController::class, 'read']);
Route::get('/services', [ServiceController::class, 'list']);
Route::put('/service', [ServiceController::class, 'update']);

Route::post('/paymentcontrol', [PaymentControlController::class, 'create']);
Route::get('/paymentcontrol', [PaymentControlController::class, 'read']);
Route::get('/paymentcontrols', [PaymentControlController::class, 'list']);
Route::put('/paymentcontrol', [PaymentControlController::class, 'update']);

Route::post('/photo', [PhotoController::class, 'create']);
Route::get('/photo', [PhotoController::class, 'read']);
Route::get('/photos', [PhotoController::class, 'list']);
Route::put('/photo', [PhotoController::class, 'update']);
