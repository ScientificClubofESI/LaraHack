<?php

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

Route::get('/', function (){
    return view('main');
});

Route::get('/register', 'HackerController@create')->name('register');

Route::post('/store', 'HackerController@store')->name('store');

Route::post('/check', 'HackerController@checkCode')->name('check');

Route::get('/admin/login','Auth\LoginController@showLoginForm')->name('login');

Route::post('/admin/login','Auth\LoginController@login')->name('authenticate');

Route::post('/admin/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/admin','AdminController@dashboard')->name('dashboard')->middleware('auth');

Route::get('/statistics','AdminController@statistics')->name('statistics')->middleware('auth');

Route::post('/admin/setDecision','AdminController@setDecision')->name('setDecision')->middleware('auth');