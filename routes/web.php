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

Route::get('/', function () {
    return view('welcome');
});

Route::get('index', 'IndexController@index');
Route::get('post/{slug}', 'PostController@index');
Route::get('create', 'PostController@create');
Route::get('doCreate', 'PostController@doCreate');
Route::get('search', 'IndexController@search');
Route::get('category/{slug}', 'CategoryController@index');
Route::get('tag/{slug}', 'TagController@index');