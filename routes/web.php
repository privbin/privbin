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
    Route::get('/entry/{entry}', 'EntryController@show')->name('entry.show');
    Route::get('/entry/{entry}/raw', 'EntryController@raw')->name('entry.raw');
    Route::get('/entry/{entry}/embed', 'EntryController@embed')->name('entry.embed');
    Route::post('/entry/{entry}/access', 'EntryController@access')->name('entry.access');
    Route::post('/store', 'EntryController@store')->name('entry.store');
    Route::delete('/entry/{entry}/destroy', 'EntryController@destroy')->name('entry.destroy');
});

Route::namespace('\App\Http\Controllers')->name('admin.')->prefix('/admin')->middleware('admin')->group(function () {
    Route::get('/', 'HomeController@dashboard')->name('dashboard');
});
