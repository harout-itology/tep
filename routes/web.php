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

Route::get('/', function () {
    return redirect(route('tower.index'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home.index');

Route::get('/google-oauth2callback', 'Auth\LoginController@google')->name('google.callback');

Route::get('/socialite-url/{slug?}', 'Auth\LoginController@socialiteurl')->name('socialite.url');
Route::get('/socialite-oauth2callback/{slug?}', 'Auth\LoginController@socialite')->name('socialite.callback');

Route::get('/user-edit', 'UserController@edit')->name('user.edit');
Route::put('/user-update', 'UserController@store')->name('user.store');

Route::get('/towers','TowerController@index')->name('tower.index');
Route::get('/towers/create','TowerController@create')->name('tower.create');
Route::post('/towers','TowerController@store')->name('tower.store');
Route::get('/towers/{id}/edit','TowerController@edit')->name('tower.edit');
Route::put('/towers/{id}','TowerController@update')->name('tower.update');
Route::delete('/towers/{id}','TowerController@destroy')->name('tower.delete');

