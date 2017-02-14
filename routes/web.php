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

Auth::routes();

Route::get('/admin', 'AdminController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/aggregators', 'Admin\\AggregatorsController');
    Route::resource('admin/indicators', 'Admin\\IndicatorsController');
    Route::resource('admin/groups', 'Admin\\GroupsController');
    Route::resource('admin/aggregators', 'Admin\\AggregatorsController');
});

