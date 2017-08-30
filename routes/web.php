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

Route::get('/', 'PagesController@getWelcome');

Route::get('home', 'PagesController@getHome')->middleware('facebook');
Route::get('settings', 'PagesController@getSettings')->middleware('facebook');

Route::get('needAddvise', 'AdviseesController@getTakeAdviceIndex')->middleware('facebook');
Route::get('needAddvise/new', 'AdviseesController@getTakeAdviceNew')->middleware('facebook');
Route::post('needAddvise/create', 'AdviseesController@postTakeAdviceCreate')->middleware('facebook');

