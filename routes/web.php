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

Route::post('/postSearch','HomeController@prosSearch');
Route::get('/search/{search}','HomeController@postSearch');

Auth::routes();
Route::get('/post/{title}','HomeController@blogPost');

Route::post('/comment/addcomment','CommentController@postComment');

Route::get('/dashboard','PostController@index');
Route::get('/create', 'PostController@createPost')->name('create');
Route::get('/delete/{slug}','PostController@deletePost');
Route::get('/edit/{slug}','PostController@editPost');
Route::post('/createSubmit','PostController@Create');


Route::get('/api/listcomment/{post}','HomeController@getComments');
Route::get('/api/listpost','HomeController@authorGetPost');

Route::post('/api/listpost/edit_feature','PostController@editFeature');






