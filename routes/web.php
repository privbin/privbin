<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/pastes/{paste}/raw', [App\Http\Controllers\PasteController::class, 'raw']);
Route::get('/{path?}', fn () => view('welcome'))->setWheres(['path' => '.*']);
