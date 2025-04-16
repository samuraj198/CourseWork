<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProfileController;
use \App\Http\Controllers\Auth\AuthenticateUserController;
use \App\Http\Controllers\CategoriesController;
use \App\Http\Controllers\IndexController;
use \App\Http\Controllers\CatalogController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::post('createCategory', [CategoriesController::class, 'store'])->name('createCategory');
Route::post('createWork', [FilesController::class, 'store'])->name('createWork');
Route::get('downloadFile/{id}', [FilesController::class, 'downloadFile'])->name('downloadFile');
Route::post('changeCategory', [CategoriesController::class, 'changeCategory'])->name('changeCategory');

Route::get('aboutUs', function () {
    return view('pages/aboutUs');
})->name('aboutUs');

Route::get('auth', [AuthenticateUserController::class, 'index'])->name('auth');
Route::post('auth', [AuthenticateUserController::class, 'store']);
Route::delete('auth', [AuthenticateUserController::class, 'destroy']);

Route::get('register', [RegisteredUserController::class, 'index'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

Route::get('catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('search', [CatalogController::class, 'searchClear'])->name('searchClear');

Route::get('profile/{login}', [ProfileController::class, 'index'])->name('profile');
Route::delete('delete', [FilesController::class, 'destroy'])->name('deleteFile');
