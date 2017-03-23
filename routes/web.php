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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/dashboard', 'HomeController@index');

Route::get('/client/new', 'ClientController@viewCreate')->middleware('admin');
Route::get('/client/edit/{uid}', 'ClientController@view');
Route::put('/client/edit/{uid}', 'ClientController@updateClientInformation');
Route::put('/client/edit/{uid}/permissions', 'ClientController@updateUserPermissions');

Auth::routes();

