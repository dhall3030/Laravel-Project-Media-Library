<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home-page');
});

Route::get('/hello', function () {
    return "hello";
});



// Route::get('/media', 'MediaLibController@getMedia');


// Route::get('get-profile/{media_id}', 'MediaLibController@getMediaProfile');

// Route::get('create-media', 'MediaLibController@createMedia');
// Route::post('create-media', ['as' => 'create-media', 'uses' =>'MediaLibController@createMedia']);
// Route::get('update-media/{media_id}', 'MediaLibController@updateMedia');
// Route::post('update-media/{media_id}', ['as' => 'update-media', 'uses' =>'MediaLibController@updateMedia']);

// Route::get('delete-media/{media_id}', 'MediaLibController@deleteMedia');


//Media routes

Route::get('search-media', 'MediaLibController@searchMedia');
Route::post('search-media', ['as' => 'search-media', 'uses' =>'MediaLibController@searchMedia']);
Route::get('get-profile/{media_id}', 'MediaLibController@getMediaProfile');




Route::get('upload-image/{media_id}', 'MediaLibController@uplaodImage');
Route::post('upload-image/{media_id}', ['as' => 'upload-image', 'uses' => 'MediaLibController@uplaodImage']);


Route::get('upload-multiple/{media_id}', 'UploadController@uploadMultiple');
Route::post('upload-multiple/{media_id}', ['as' => 'upload-multiple', 'uses' => 'UploadController@uploadMultiple']);



Auth::routes();

//Route::get('/home', 'HomeController@index');


//-----------------------------------------------

//User routes
Route::get('/register', 'UserController@register');
Route::post('/register', ['as' => 'register-user', 'uses' => 'UserController@register']);


Route::get('/user-login', function()
{
	
	return view('user.login');
	
});


Route::post('/user-login', ['as' => 'user-login', 'uses' => 'UserController@authenticate']);

Route::get('/user-logout', 'UserController@logout');







//Admin user routes

Route::group(['middleware' => ['web','auth']], function () {



Route::get('admin-dashboard', 'AdminController@index');


// Auth media routes

Route::get('/media', 'MediaLibController@getMedia');
Route::post('media', ['as' => 'media', 'uses' =>'MediaLibController@getMedia']);


//Route::get('get-profile/{media_id}', 'MediaLibController@getMediaProfile');

Route::get('create-media', 'MediaLibController@createMedia');
Route::post('create-media', ['as' => 'create-media', 'uses' =>'MediaLibController@createMedia']);
Route::get('update-media/{media_id}', 'MediaLibController@updateMedia');
Route::post('update-media/{media_id}', ['as' => 'update-media', 'uses' =>'MediaLibController@updateMedia']);

Route::get('delete-media/{media_id}', 'MediaLibController@deleteMedia');
Route::get('delete-media-image/{media_image_id}', 'MediaLibController@deleteImage');

Route::get('update-image/{media_image_id}', 'MediaLibController@updateImage');
Route::post('update-image/{media_image_id}', ['as' => 'update-image', 'uses' =>'MediaLibController@updateImage']);


});