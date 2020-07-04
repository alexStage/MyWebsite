<?php

//root
Route::get('/', 'AlbumController@index')->name('album.index');

//resources
Route::resource('/messages','MessageController');
Route::resource('/albums', 'AlbumController', ['except'=>'create']);
Route::resource('/photos', 'PhotoController')->only(['store','destroy','show']);


//profile
Route::get('/profile', 'ProfileController@photo')->name('profile.photo');
Route::post('/profile', 'ProfileController@edit')->name('profile.edit');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {


	Route::get('/albums','AlbumController@create')->name('albums.create');
	//comments
	Route::post('/albums/{album}', 'AlbumController@comment')->name('albums.comment');
	Route::post('/photos/{photo}', 'PhotoController@comment')->name('photos.comment');
    
});