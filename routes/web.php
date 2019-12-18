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


Route::get('topics/view', 'TopicController@index')->name('topics.index');

Route::get('topics/create', 'TopicController@create')->name('topic.create')->middleware('admin');

Route::get('threads/view/{topic_id}/{topic_title}','ThreadController@index')->name('threads.index');

Route::get('threads/create/{topic_id}/', 'ThreadController@create')->name('thread.create');


Route::get('posts/view/{thread_id}/{thread_title}','PostController@index')->name('posts.index');

Route::get('posts/edit/{post_id}','PostController@edit')->name('post.edit');

Route::delete('posts/delete/{post_id}','PostController@delete')->name('post.delete');

Route::get('posts/create/{parent_post_id}', 'PostController@create')->name('post.create');


Route::post('update/post/{post_id}', 'PostController@update')->name('post.update');

Route::post('create/post/{parent_post_id}', 'PostController@store')->name('post.store');

Route::post('create/thread/{topic_id}', 'ThreadController@store')->name('thread.store');

Route::post('create/topic', 'TopicController@store')->name('topic.store');







Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
