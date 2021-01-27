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
    return view('welcome');
});
Route::get('/admin','AdminController@index')->name('dashboard')->middleware('CheckLogin');
Route::get('/login','UsersController@login')->name('admin.login');
Route::get('/logout','UsersController@logout')->name('logout');
Route::post('/login','UsersController@postLogin')->name('admin.postLogin');
Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => 'CheckLogin'], function() {
    Route::resource('employees','EmployeesController');
    Route::resource('users','UsersController');
    Route::resource('products','ProductsController');
});
