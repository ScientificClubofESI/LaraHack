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

/**
 * Main view
 */

Route::get('/', function (){
    return view('main');
})->name('home');

/**
 * Registration and confirmation routes
 */

Route::get('/register', 'HackerController@create')->name('register');

Route::post('/store', 'HackerController@store')->name('store');

Route::post('/check', 'HackerController@checkCode')->name('check');

Route::get('/register/confirm/{token}','ConfirmationsController@confirmHacker')->name('confirm');

/**
 * Admin login , logout routes
 */

Route::get('/admin/login','Auth\LoginController@showForm')->name('login') ; 

Route::post('/admin/login','Auth\LoginController@login')->name('authenticate');

Route::post('/admin/logout', 'Auth\LoginController@logout')->name('logout');

/**
 * Admin options routes , it contains :
 *      Consulting hackers and set decisions
 *      Consulting confirmations
 *      Send emails for accepted , rejected and waiting list
 *      Update the application settings
 *      Consulting some statistics about hackers
 */

Route::get('/admin','AdminController@index')->name('main')->middleware('auth');

Route::get('/admin/hackers','AdminController@hackers')->name('hackers')->middleware('auth');

Route::post('/admin/setDecision','AdminController@setDecision')->name('setDecision')->middleware('auth');

Route::get('/admin/checkin','AdminController@checkin')->name('checkin')->middleware('auth');

Route::post('/admin/checkHacker','AdminController@checkHacker')->name('checkHacker')->middleware('auth');

Route::get('/admin/mailing','AdminController@mailing')->name('mailing')->middleware('auth');

Route::post('/admin/sendMails','MailingController@mailHandler')->name('sendMail')->middleware('auth');

Route::get('/admin/settings','SettingsController@index')->name('settings')->middleware('auth');

Route::post('/admin/setSettings','SettingsController@update')->name('updateSettings')->middleware('auth');

Route::get('/admin/statistics','AdminController@statistics')->name('statistics')->middleware('auth');

