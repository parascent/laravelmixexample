<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


Route::middleware('auth')->get('/me',function(){
    return Auth::user();
});

Route::get('/authors', 'AuthorController@retrieve');
Route::get('/authors/{id}', 'AuthorController@retrieveById');
Route::post('/authors', 'AuthorController@create');
Route::put('/authors/{id}', 'AuthorController@update');
Route::delete('/authors/{id}', 'AuthorController@delete');

Route::get('/articles', 'ArticleController@retrieve');
Route::get('/articles/{id}', 'ArticleController@retrieveById');
Route::post('/articles', 'ArticleController@create');
Route::put('/articles/{id}', 'ArticleController@update');
Route::delete('/articles/{id}', 'ArticleController@delete');


Route::get('/reviews', 'ReviewController@retrieve');
Route::get('/reviews/{id}', 'ReviewController@retrieveById');
Route::post('/reviews', 'ReviewController@create');
Route::put('/reviews/{id}', 'ReviewController@update');
Route::delete('/reviews/{id}', 'ReviewController@delete');

