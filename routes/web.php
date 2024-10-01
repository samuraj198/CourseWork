<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProfileController;
use \App\Http\Controllers\Auth\AuthenticateUserController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('profile', [ProfileController::class, 'index'])->name('profile');

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
