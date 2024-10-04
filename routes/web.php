<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProfileController;
use \App\Http\Controllers\Auth\AuthenticateUserController;
use \App\Http\Controllers\CategoriesController;
use \App\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::get('user/{login}', [UserController::class, 'show'])->name('user.show');

Route::post('createCategory', [CategoriesController::class, 'store'])->name('createCategory');
Route::post('createWork', [FilesController::class, 'store'])->name('createWork');
Route::get('downloadFile/{id}', [FilesController::class, 'downloadFile'])->name('downloadFile');

Route::get('aboutUs', function () {
    return view('pages/aboutUs');
})->name('aboutUs');

Route::get('auth', function () {
    return view('pages/auth');
})->name('auth');
Route::post('auth', [AuthenticateUserController::class, 'store']);
Route::delete('auth', [AuthenticateUserController::class, 'destroy']);

Route::get('register', function () {
    return view('pages/register');
})->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('catalog', function () {
    return view('pages/catalog');
})->name('catalog');
