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


Auth::routes();
Route::get('get-video/{video}', 'VideoController@getVideo')->name('getVideo');
Route::get('get-thumb/{image}', 'VideoController@getThumb')->name('getThumb');
Route::get('getAvatar/{image}', 'UserController@getAvatar')->name('getAvatar');
Route::get('video/new', 'VideoController@create')->middleware('auth')->name('newVideo');
Route::get('/', 'VideoController@index')->name('home');
Route::get('users/', 'UserController@index')->name('users');
Route::post('users/', 'UserController@index')->name('users');
Route::get('user/{id}', 'UserController@show')->name('user');
Route::get('user/edit/{id}', 'UserController@edit')->middleware('auth')->name('editUser');
Route::post('user/update', 'UserController@update')->middleware('auth')->name('updateUser');
Route::get('videos/', 'VideoController@index')->name('home');
Route::post('videos/', 'VideoController@index')->name('home');
Route::get('video/{id}', 'VideoController@show')->name('video');
Route::get('video/edit/{id}', 'VideoController@edit')->middleware('auth')->name('editVideo');
Route::get('dashboard/', 'DashboardController@index')->name('dashboard');
Route::get('comment/user/new/{id_type}', 'CommentController@createUser')->middleware('auth')->name('newComment');
Route::get('comment/video/new/{id_type}', 'CommentController@createVideo')->middleware('auth')->name('newComment');
Route::get('comment/delete/{id}', 'CommentController@destroy')->middleware('auth')->name('deleteComment');
Route::get('comment/edit/{id}', 'CommentController@edit')->middleware('auth')->middleware('auth')->name('editComment');
Route::post('comment/update', 'CommentController@update')->middleware('auth')->middleware('auth')->name('updateComment');
Route::post('comment/store', 'CommentController@store')->middleware('auth')->name('storeComment');
Route::post('video/store', 'VideoController@store')->middleware('auth')->name('storeVideo');
Route::post('video/store', 'VideoController@store')->middleware('auth')->name('storeVideo');
Route::post('video/update', 'VideoController@update')->middleware('auth')->name('updateVideo');
Route::get('video/delete/{id}', 'VideoController@destroy')->middleware('auth')->name('destroyVideo');

Route::get('sendnotification/', function (){return view('sendNotification');})->middleware('auth')->name('sendView');
Route::post('sendnotification/', 'UserController@sendNotificationAll')->middleware('auth')->name('sendMails');

Route::match(['get','post'],'search/{scope?}/{word?}/{order?}','SearchController@search')->name('search');





