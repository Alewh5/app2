<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', function() {
    return Redirect::to('dashboard');
});

Route::get('dashboard', function() {
    return View::make('dashboard');
});

Route::get('users/data', ['as' => 'users.data', 'uses' => 'UsersController@getData']);

Route::get('users', array('as' => 'users.index', 'uses' => 'UsersController@index'));
Route::get('users/data', array('as' => 'users.data', 'uses' => 'UsersController@getData'));
Route::get('users/create', array('as' => 'users.create', 'uses' => 'UsersController@create'));
Route::post('users', array('as' => 'users.store', 'uses' => 'UsersController@store'));
Route::get('users/{id}', array('as' => 'users.show', 'uses' => 'UsersController@show'));
Route::get('users/{id}/edit', array('as' => 'users.edit', 'uses' => 'UsersController@edit'));
Route::put('users/{id}', array('as' => 'users.update', 'uses' => 'UsersController@update'));
Route::delete('users/{id}', array('as' => 'users.destroy', 'uses' => 'UsersController@destroy'));