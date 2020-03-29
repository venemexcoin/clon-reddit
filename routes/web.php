<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'], function () {

    Route::name('post_path_create')->get('posts/create', 'PostsController@create');

    Route::name('store_post_path')->post('posts', 'PostsController@store');

    Route::name('edit_post_path')->get('posts/{post}/edit', 'PostsController@edit');

    Route::name('update_post_path')->put('posts/{post}', 'postsController@update');

    Route::name('delete_post_path')->delete('post/{post}', 'postsController@delete');

    Route::name('create_comment_path')->post('/posts/{post}/comments', 'PostsCommentsController@create');

    Route::name('vote_post_path')->post('/posts/{post}/vote', 'PostVotesController@store');
});


Route::get('/', 'PostsController@index');

Route::name('posts_path')->get('/posts', 'PostsController@index');

Route::name('post_path')->get('/posts/{post}', 'PostsController@show');





Auth::routes();

Route::get('/home', 'PostsController@index')->name('home');
