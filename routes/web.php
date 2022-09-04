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

Route::get('/{any}', fn() => view('pages.landing.app'))->where('any', '.*');
Route::get('/account{any}', fn() => view('pages.account.app'))->where('any', '.*');
