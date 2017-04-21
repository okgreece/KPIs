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
    Route::resource('admin/organizations', 'Admin\\OrganizationsController');    
    Route::resource('admin/s-p-a-r-q-l-endpoints', 'Admin\\SPARQLEndpointsController');
    Route::resource('admin/o-s-endpoints', 'Admin\\OSEndpointsController');
});
Route::get('/', 'DashboardController@index');

Route::get('/dashboard', 'DashboardController@dashboard');

Route::get('/phases', 'DashboardController@phases');

Route::get('/years', 'DashboardController@years');

Route::get('/evolution', 'DashboardController@evolution');

Route::get('/update', 'DashboardController@update');

Route::get('/dimension', 'DashboardController@dimension');

Route::get('/compare', 'DashboardController@compare');

Route::get('/radar', 'DashboardController@radar');

Route::get('/updateRadar', 'DashboardController@updateRadar');

Route::get('/lang/{lang}', 'DashboardController@language');

