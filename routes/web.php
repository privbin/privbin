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

Route::namespace('\App\Http\Controllers')->prefix('/auth')->group(function () {
    Route::match(['GET', 'POST'], '/login', 'AuthController@login')->name('login');
    Route::match(['GET', 'POST'], '/register', 'AuthController@register')->name('register');
    Route::get('/logout', 'AuthController@logout')->name('logout');
});

Route::namespace('\App\Http\Controllers')->name('web.')->group(function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/s/{entry}', 'EntryController@show')->name('entry.show');
    Route::get('/s/{entry}/raw', 'EntryController@raw')->name('entry.raw');
    Route::get('/embed/{entry}', 'EntryController@embed')->name('entry.embed');
    Route::post('/a/{entry}', 'EntryController@access')->name('entry.access');
    Route::post('/store', 'EntryController@store')->name('entry.store');
    Route::delete('/d/{entry}', 'EntryController@destroy')->name('entry.destroy');
});

Route::namespace('\App\Http\Controllers')->name('admin.')->prefix('/admin')->middleware('admin')->group(function () {
    Route::get('/', 'HomeController@dashboard')->name('dashboard');
});
