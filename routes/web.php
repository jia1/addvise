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

/**
 * Pages Controller
 */

// Get advice
Route::get('ask', 'PagesController@getAsk')->middleware('facebook');

// My Profile
Route::get('me', 'PagesController@getMe')->middleware('facebook');

// Give Advice (to who?)
Route::get('give', 'PagesController@getGive')->middleware('facebook');

// Trending Requests
Route::get('trending', 'PagesController@getTrendingRequests')->middleware('facebook');

// Policy and Terms
Route::get('policy', 'PagesController@getPolicy')->middleware('facebook');

// No JS Page
Route::get('nojs', 'PagesController@getNoJS');


/**
 * Advisees Controller
 */

// #needAddvise feed
Route::get('home', 'AdviseesController@getTakeAdviceIndex')->middleware('facebook');

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

