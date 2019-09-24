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

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/settings', 'SettingsController@index')->name('settings.index')->middleware('auth');
Route::put('/settings/user/edit', 'UserController@update')->name('settings.user.update')->middleware('auth');
Route::put('/settings/user/update', 'UserController@updateUser')->name('settings.user.updateById')->middleware('auth');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
