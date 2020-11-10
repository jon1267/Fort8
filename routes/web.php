<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('admin.admin'); //dd(auth()->user());
})->middleware('auth');


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::resource('user', UserController::class)->except(['show']);
    Route::resource('post', PostController::class)->except(['show']);

});


