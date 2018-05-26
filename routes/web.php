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
Route::get('/threads','ThreadsController@index')->name('threads');
Route::get('/threads/{channel}','ThreadsController@index')->name('channel.threads');
Route::get('/thread/create','ThreadsController@create')->name('thread.create');
Route::get('/threads/{channel}/{thread}','ThreadsController@show')->name('thread.show');
Route::delete('/threads/{channel}/{thread}','ThreadsController@destroy')->name('thread.delete');
Route::post('/threads','ThreadsController@store')->name('thread.store');
Route::get('/threads/{channel}/{thread}/replies', 'RepliesController@index')->name('thread.paginate');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store')->name('thread.reply');
Route::post('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store')->name('thread.subscribe')->middleware('auth');
Route::delete('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy')->name('thread.unsubscribe')->middleware('auth');
Route::post('/replies/{reply}/favorites', 'FavoritesController@store')->name('reply.favorite');
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy')->name('delete.favorite');
Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('reply.delete');
Route::patch('/replies/{reply}', 'RepliesController@update')->name('reply.update');

Route::get('/profile/{user}', 'ProfilesController@show')->name('user.profile');
Route::get('/profile/{user}/notifications', 'UserNotificationController@index')->name('user.notification');
Route::delete('/profile/{user}/notifications/{notification}', 'UserNotificationController@destroy')->name('user.notification.destroy');

