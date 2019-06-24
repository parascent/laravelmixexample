<?php
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});


Route::view('/authors', '/authors', ['user'=>Auth::id()])->name('authors');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/authorss', function(){
    dd(Auth::id());
});