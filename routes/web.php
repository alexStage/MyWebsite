<?php
//root
Route::get('/', 'AlbumController@index')->name('albums.index');

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
	//create albums
	Route::get('/albums','AlbumController@create')->name('albums.create');
	Route::post('/albums/publish', 'AlbumController@createAlbum');
	//comments
	Route::post('/albums/{album}', 'AlbumController@comment')->name('albums.comment');
	Route::post('/photos/{photo}', 'PhotoController@comment')->name('photos.comment');
	Route::post('/comments', 'AlbumController@jscomment');
	//downloads
	Route::get('/téléchargements', 'DownloadController@index')->name('downloads');
});

Route::group(['prefix'=> 'archives', 'middleware'=> ['Family', 'auth']],function(){
	Route::get('/{directory?}', 'ArchiveController@index')->name('archives')->where('directory', '(.*)');
	Route::get('/listDirectories/{directory?}', 'ArchiveController@listDirectories')->where('directory', '(.*)');
});

Route::group(['prefix'=> 'admin', 'middleware'=>['Admin']], function(){
	Route::get('/users', 'UserController@index')->name('admin.users');
});


//test vue.js
Route::get('/vues', function(){
	return view('vues.show');
});

Route::get('/directories/{directory?}', 'ArchiveController@getDirectories')->where('directory', '(.*)');
Route::get('/paginations', 'ArchiveController@getPagination');

