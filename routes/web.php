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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/threads', 'ThreadsController@store');

Route::get('/threads/create','ThreadsController@create');
Route::get('/threads','ThreadsController@index');
Route::get('threads/{channel}','ThreadsController@index');

Route::get('/threads/{channel}/{thread}','ThreadsController@show');
Route::delete('/threads/{channel}/{thread}','ThreadsController@destroy');
Route::post('/threads/{channel}/{thread}/replies','RepliesController@store');

#-----------  Delete Replies  -----------------
Route::delete('/replies/{reply}','RepliesController@destroy');
#-----------  Update Replies  -----------------
Route::patch('/replies/{reply}','RepliesController@update');


#--------------- FAVORITES -------------------
Route::post('/replies/{reply}/favorites', 'FavoritesController@store');

#----- this reply is not my favorite anymore
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy');
#--------------  User Profile  ---------------
Route::get('/profiles/{user}','ProfilesController@show')->name('profile');

