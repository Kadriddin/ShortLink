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

Route::get('/', function () {
    return view('welcome');
//    return view('link');
});

Auth::routes();

Route::get('/home', 'ShortController@index')->name('home');

//Route::get('/link', 'ShortController@index')->name('link');
//Route::post('/ajax', 'ShortController@store');
Route::get('/{code}','ShortController@Shortlink')->name('Short.link');
//resource