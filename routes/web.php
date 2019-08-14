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

            /* --- Home Routes --- */
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/author/{author}', 'HomeController@postAuthor');

Route::get('/category/{category}', 'HomeController@postCategory');

/*

Route::get('/search/{search}', 'HomeController@index')->name('home');
*/
Auth::routes();
Route::get('/post/{title}','HomeController@blogPost');
Route::get('/create', 'PostController@createPost')->name('create');
Route::get('/delete/{slug}','PostController@deletePost');
Route::get('/edit/{slug}','PostController@editPost');

Route::post('/createSubmit','PostController@Create');
Route::post('/Edit','PostController@Edit');

Route::get('/comment/{post}','HomeController@getComments');
Route::post('/comment/addcomment','CommentController@postComment');





