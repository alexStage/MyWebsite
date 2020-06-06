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

Route::get('/', 'RootController@index')->name('root');

//Route::get('/', function () {
//	if(Auth::check()){
//		return redirect(route('home'));
//	}else{
//		return view('auth/login');
//	}
//});

Route::resource('/messages','MessageController');
Route::resource('/albums', 'AlbumController');
Route::resource('/photos', 'PhotoController')->only(['store','destroy','show']);
Route::post('/albums/{album}', 'AlbumController@comment')->name('albums.comment');
Route::post('/photos/{photo}', 'PhotoController@comment')->name('photos.comment');
//Route::resource('/games', 'GameController');

//Route::get('/gameTest', 'GameController@gameTest')->name('Test');
//Route::get('/gameRpg', 'GameController@gameRPG')->name('RPG');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');