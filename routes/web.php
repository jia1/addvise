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

// Home page
Route::get('home', 'PagesController@getHome')->middleware('facebook');

// Ask for advice
Route::get('ask', 'PagesController@getAsk')->middleware('facebook');

// Policy and Terms
Route::get('policy', 'PagesController@getPolicy');

// My Profile
Route::get('me', 'PagesController@getMe')->middleware('facebook');

// No JS Page
Route::get('nojs', 'PagesController@getNoJS');


/**
 * Advisees Controller
 */

// #needAddvise feed
Route::get('needAddvise', 'AdviseesController@getTakeAdviceIndex')->middleware('facebook');

// Post to Facebook and store relevant identification in database
Route::post('needAddvise/create', 'AdviseesController@postTakeAdviceCreate')->middleware('facebook');

// View for all #needAddvise created by the user
Route::get('needAddvise/me', 'AdviseesController@getTakeAdviceShowByUser')->middleware('facebook');


/**
 * Advisors Controller
 */

// View for creating a new advice for an existing #needAddvise
Route::get('needAddvise/{id}/advice/new', 'AdvisorsController@getGiveAdviceNew')->middleware('facebook');

// Comment on Facebook and store relevant identifcation in database
Route::post('needAddvise/{id}/advice/create', 'AdvisorsController@postGiveAdviceCreate')->middleware('facebook');

// View for all advice given by the user
Route::get('needAddvise/advice/me', 'AdvisorsController@getGiveAdviceShowByUser')->middleware('facebook');

