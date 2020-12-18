<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('\App\Http\Controllers')->name('api.')->group(function () {
    Route::get('/entry/{entry}/show', 'ApiController@show')->name('entry.show');
    Route::post('/entry/store', 'ApiController@store')->name('entry.store');
    Route::delete('/entry/{entry}/destroy', 'ApiController@destroy')->name('entry.destroy');
});
