<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('\App\Http\Controllers')->name('web.')->group(function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/s/{entry}', 'EntryController@show')->name('entry.show');
    Route::post('/a/{entry}', 'EntryController@access')->name('entry.access');
    Route::post('/store', 'EntryController@store')->name('entry.store');
});
