<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\GoodController;
use App\Http\Controllers\Admin\ParseDataController;
use App\Http\Controllers\Admin\BiddingDataController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('admin.admin'); //dd(auth()->user());
})->middleware('auth');


//Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::resource('user', UserController::class)->except(['show']);
    Route::resource('post', PostController::class)->except(['show']);
    Route::resource('good', GoodController::class)->except(['show']);

    //парсер данных со страницы биржи. ParseDataController@getInstrumentData
    Route::get('/parse', [ParseDataController::class, 'getInstrumentData' ])->name('parse.data');
    Route::get('/show', [BiddingDataController::class, 'instruments' ])->name('show.data');

    Route::post('/filter', [BiddingDataController::class, 'filter' ])->name('filter.data');

});


