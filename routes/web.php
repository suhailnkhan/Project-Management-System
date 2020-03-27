<?php

use Illuminate\Support\Facades\Route;
use App\Post;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::group(['prefix'=>'dashboard', 'middleware'=>'auth'], function () {
//    Route::get('/index','PostController@index');
//   // Route::get('/index','PostController@index');
//   Route::get('/','PostController@index');
//    Route::get('/create' , 'PostController@create');
//
//});


Route::group(['prefix'=>'/user', 'middleware'=>'auth'], function () {

     Route::get('/index','PostController@index');
     Route::get('/create','PostController@create');
     Route::get('/{id}/edit','PostController@edit');
     Route::get('/store','PostController@store');
     Route::get('/{id}/show','PostController@show');
     Route::patch('/{id}/update','PostController@update');
     Route::delete('/{id}/delete','PostController@destroy');



});
