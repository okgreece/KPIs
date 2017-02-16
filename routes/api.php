<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {

    Route::get('/aggregators/list', 'Admin\AggregatorsController@lineup');
    
    Route::get('/aggregators/value', 'Admin\AggregatorsController@value');
    
    Route::get('/aggregators/groupedValue', 'Admin\AggregatorsController@groupedValue');
    
    Route::get('/indicator/list', 'Admin\IndicatorsController@lineup');
    
    Route::post('/indicator/list/enabled', 'Admin\IndicatorsController@enabled');
    
    Route::get('/indicator/value', 'Admin\IndicatorsController@value');
    
});
