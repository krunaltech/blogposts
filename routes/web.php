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
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('posts')->group(function () {
    Route::get('new', 'BlogPostController@new_post')->name('new_blogpost');
	Route::post('create', 'BlogPostController@create')->name('create_blogpost');
	Route::get('view/{post_id}', 'BlogPostController@view')->name('view_blogpost');
	Route::get('edit/{post_id}', 'BlogPostController@edit')->name('edit_blogpost');
	Route::post('update', 'BlogPostController@update')->name('update_blogpost');
	Route::get('list', 'BlogPostController@list')->name('list_blogpost');
	Route::get('delete/{post_id}', 'BlogPostController@delete')->name('delete_blogpost');
});
