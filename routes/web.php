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

Route::group(['prefix' => 'admin',  'namespace' => 'Admin', 'middleware' => 'admin'], function () {
    Route::get('posts', 'PostController@index');
    Route::get('posts/create', 'PostController@create');
    Route::post('posts', 'PostController@store');
    Route::get('posts/{id}/edit', 'PostController@edit');
    Route::patch('posts/{id}', 'PostController@update');
    Route::delete('posts/{id}', 'PostController@destroy');
    Route::get('{vue?}', function(){return view('admin.index');})->where('vue', '.*');
});

// Protected pages
Route::group(['middleware' => 'auth'], function () {
    // Comments routes
    Route::post('comments', 'CommentController@store');

    // Tags routes
    Route::get('/tags/{tag}/posts', 'TagController@posts');
});

Route::get('/','PostController@index');
Route::get('/home','PostController@index');
Route::get('/posts/{post}', 'PostController@show');
