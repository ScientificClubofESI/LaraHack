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
})->name('home');

Route::get('/register', 'HackerController@create')->name('register');

Route::post('/store', 'HackerController@store')->name('store');

Route::post('/check', 'HackerController@checkCode')->name('check');

Route::get('/admin/login','Auth\LoginController@showForm')->name('login') ; 

Route::post('/admin/login','Auth\LoginController@login')->name('authenticate');

Route::post('/admin/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/admin','AdminController@index')->name('main')->middleware('auth');

Route::get('/admin/hackers','AdminController@hackers')->name('hackers')->middleware('auth');

Route::get('/admin/confirm','AdminController@confirmedHackers')->name('confirmed_hackers')->middleware('auth');

Route::get('/admin/mailing','AdminController@mailing')->name('mailing')->middleware('auth');

Route::post('/mailing','MailingController@mailHandler')->name('sendMail')->middleware('auth');

Route::get('/admin/settings','SettingsController@index')->name('settings')->middleware('auth');

Route::post('/settings','SettingsController@update')->name('updateSettings')->middleware('auth');

Route::get('/admin/statistics','AdminController@statistics')->name('statistics')->middleware('auth');

Route::post('/admin/setDecision','AdminController@setDecision')->name('setDecision')->middleware('auth');

Route::get('/register/confirm/{token}','ConfirmationsController@confirmHacker')->name('confirm');