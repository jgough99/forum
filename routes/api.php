<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('topics/view','TopicController@apiIndex')
    ->name('api.topics.index');

Route::post('topics/view','TopicController@apiStore')
    ->name('api.topics.store');

Route::get('posts/view','PostController@apiIndex')
    ->name('api.posts.index');

Route::post('posts/view','PostController@apiStore')
    ->name('api.post.store');