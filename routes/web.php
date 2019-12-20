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

Route::get('topics/liked', 'TopicController@liked')->name('topics.liked');

Route::get('threads/view/{topic_id}/{topic_title}','ThreadController@index')->name('threads.index');

Route::get('threads/create/{topic_id}/', 'ThreadController@create')->name('thread.create');


Route::get('posts/view/{thread_id}/{thread_title}','PostController@index')->name('posts.index');

Route::get('posts/edit/{post_id}','PostController@edit')->name('post.edit')->middleware('sameUser');

Route::delete('posts/delete/{post_id}','PostController@delete')->name('post.delete');

Route::delete('thread/delete/{thread_id}','ThreadController@delete')->name('thread.delete');

Route::get('posts/create/{parent_post_id}', 'PostController@create')->name('post.create');

Route::get('admin/create/', 'PostController@createAdmin')->name('user.create');

Route::get('/', 'TopicController@index');


Route::post('update/post/{post_id}', 'PostController@update')->name('post.update');

Route::post('update/user/', 'PostController@storeAdmin')->name('user.store');


Route::post('create/post/{parent_post_id}', 'PostController@store')->name('post.store');

Route::post('create/thread/{topic_id}', 'ThreadController@store')->name('thread.store');

Route::post('create/topic', 'TopicController@store')->name('topic.store');

Route::get('like/{topic_id}', 'TopicController@like')->name('topic.like');







Auth::routes();

Route::get('/home', 'TopicController@index')->name('home');
