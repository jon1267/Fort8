<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('admin.admin'); //dd(auth()->user());
})->middleware('auth');


//Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::resource('user', UserController::class)->except(['show']);

});


