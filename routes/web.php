<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\GoodController;
use App\Http\Controllers\Admin\InstrumentController;
use App\Http\Controllers\Admin\BasisController;
use App\Http\Controllers\Admin\ParseDataController;
use App\Http\Controllers\Admin\BiddingDataController;
use App\Http\Controllers\Admin\UserRoleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('admin.admin'); //dd(auth()->user());
})->middleware(['auth', 'auth.isAdmin']);


//Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
Route::prefix('admin')->name('admin.')->middleware(['auth', 'auth.isAdmin'])->group(function () {

    Route::resource('user', UserController::class)->except(['show']);
    Route::resource('post', PostController::class)->except(['show']);
    Route::resource('good', GoodController::class)->except(['show']);
    Route::resource('instrument', InstrumentController::class)->except(['show']);
    Route::resource('basis', BasisController::class)->except(['show']);

    //парсер данных со страницы биржи. ParseDataController@getInstrumentData
    Route::get('/parse', [ParseDataController::class, 'getInstrumentData' ])->name('parse.data');
    Route::get('/show', [BiddingDataController::class, 'instruments' ])->name('show.data');

    Route::post('/filter', [BiddingDataController::class, 'filter' ])->name('filter.data');

    // это надо было назвать user (не userr) но уже занято, и ломать не хоца...
    Route::resource('userr', UserRoleController::class)->except(['show']);

});


