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

/**
 * Pages Controller
 */

// User settings
Route::get('settings', 'PagesController@getSettings')->middleware('facebook');

// Request for advice
Route::get('ask', 'PagesController@getAsk')->middleware('facebook');

// Give advice
Route::get('show', 'PagesController@getShow')->middleware('facebook');


// Me
Route::get('me', 'PagesController@getMe')->middleware('facebook');

/**
 * Advisees Controller
 */

// #needAddvise feed
Route::get('needAddvise', 'AdviseesController@getTakeAdviceIndex')->middleware('facebook');

// View for creating a new #needAddvise
Route::get('needAddvise/new', 'AdviseesController@getTakeAdviceNew')->middleware('facebook');

// Post to Facebook and store relevant identification in database
Route::post('needAddvise/create', 'AdviseesController@postTakeAdviceCreate')->middleware('facebook');

// View for all #needAddvise created by the user
Route::get('needAddvise/me', 'AdviseesController@getTakeAdviceShow')->middleware('facebook');


/**
 * Advisors Controller
 */

// All advice given (with or without the corresponding #needAddvise?)
Route::get('advice', 'AdvisorsController@getGiveAdviceIndex')->middleware('facebook');

// View for creating a new advice for an existing #needAddvise
Route::get('needAddvise/{id}/advice/new', 'AdvisorsController@getGiveAdviceNew')->middleware('facebook');

// Comment on Facebook and store relevant identifcation in database
Route::post('needAddvise/{id}/advice/create', 'AdvisorsController@postGiveAdviceCreate')->middleware('facebook');

// View for all advice given by the user
Route::get('advice/me', 'AdvisorsController@getGiveAdviceShow')->middleware('facebook');

