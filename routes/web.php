<?php
//root
Route::get('/', 'AlbumController@index')->name('accueil');

//resources
Route::resource('/albums', 'AlbumController');
Route::resource('/photos', 'PhotoController')->only(['destroy','show']);
Route::resource('/voyages', 'VoyageController');
Route::resource('/users', 'UserController');

//profile
Route::get('/profile', 'ProfileController@photo')->name('profile.photo');


//voyages
/* Route::get('/voyages', 'VoyageController@index')->name('voyage.index');
Route::get('/voyage/show', 'VoyageController@show')->name('voyage.show');
Route::get('/voyage/edit', 'VoyageController@edit')->name('voyage.edit');
Route::delete('/voyage/{voyage}', 'VoyageController@destroy')->name('voyage.destroy'); */


//photos
Route::post('/photos/store', 'PhotoController@store')->name('photos.store');

Auth::routes();

Route::get('/home', 'AlbumController@index')->name('home');

Route::middleware(['auth'])->group(function () {
	//create albums
	Route::post('/albums/store', 'AlbumController@store')->name('albums.store');
	Route::get('/albums/create', 'AlbumController@create')->name('albums.create');
	//comments
	Route::post('/albums/{album}', 'AlbumController@comment')->name('albums.comment');
	Route::post('/photos/{photo}', 'PhotoController@comment')->name('photos.comment');
	Route::post('/comments', 'AlbumController@jscomment');
	//voyages
	Route::get('/voyages/create', 'VoyageController@create')->name('voyages.create');
	Route::post('/voyages/store', 'VoyageController@store')->name('voyages.store');
});

//archives
//Route::get('/{directory?}', 'ArchiveController@index')->name('archives')->where('directory', '(.*)');
Route::get('/listDirectories/{directory?}', 'ArchiveController@listDirectories')->where('directory', '(.*)');

Route::get('/admin/', 'AdminController@index')->name('admin');
Route::get('/admin/users', 'AdminController@adminUsers')->name('admin.users');
Route::get('/admin/photos', 'AdminController@adminPhotos')->name('admin.photos');



/* Route::group(['prefix'=> 'admin', 'middleware'=>['Admin']], function(){
	Route::get('/', 'AdminController@index')->name('admin');
	Route::get('/users', 'AdminController@adminUsers')->name('admin.users');
	Route::get('/getUser/{id}', 'UserController@getUser');
	Route::get('/updateUser/{id}/{name}/{email}/{family}/{admin}', 'UserController@update');
	Route::get('/photos', 'AdminController@adminPhotos')->name('admin.photos');
	Route::post('/photos/etiquettes', 'AdminController@adminEtiquette')->name('admin.etiquettes');
	Route::post('/etiquettes', 'EtiquetteController@create')->name('create.etiquette');
	Route::get('/deleteUser/{id}', 'UserController@delete')->name('delete.user');
	Route::get('/photosSearch', 'PhotoController@search')->name('photos.search');
}); */

//search
Route::post('/search/photos', 'PhotoController@searchByTag');



Route::get('/directories/{directory?}', 'ArchiveController@getDirectories')->where('directory', '(.*)');
Route::get('/paginations', 'ArchiveController@getPagination');


//suppr
Route::post('/suppr/photos', 'PhotoController@supprPhoto');

