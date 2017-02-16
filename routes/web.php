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

Auth::routes();

Route::get('/admin', 'AdminController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/aggregators', 'Admin\\AggregatorsController');
    Route::resource('admin/indicators', 'Admin\\IndicatorsController');
    Route::resource('admin/groups', 'Admin\\GroupsController');
    Route::resource('admin/aggregators', 'Admin\\AggregatorsController');
});
Route::get('/', 'DashboardController@index');

Route::get('/dashboard', 'DashboardController@dashboard');

Route::get('/phases', 'DashboardController@phases');

Route::get('/years', 'DashboardController@years');

