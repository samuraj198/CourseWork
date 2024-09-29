<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('profile', function () {
    return view('pages/profile');
})->name('profile');

Route::get('aboutUs', function () {
    return view('pages/aboutUs');
})->name('aboutUs');

Route::get('auth', function () {
    return view('pages/auth');
})->name('auth');

Route::get('register', function () {
    return view('pages/register');
})->name('register');

Route::get('catalog', function () {
    return view('pages/catalog');
})->name('catalog');
