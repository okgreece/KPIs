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
//API v1 Endpoints
Route::group(['prefix' => 'v1'], function() {
    
    //Aggregators Endpoint
    Route::group(['prefix' => 'aggregators'], function(){
        
        Route::get('/list', 'Admin\AggregatorsController@lineup');
    
        Route::get('/value', 'Admin\AggregatorsController@value');
    
        Route::get('/groupedValue', 'Admin\AggregatorsController@groupedValue');
        
    });
    
    //Indicators Endpoint
    Route::group(['prefix' => 'indicators'], function(){
    
        Route::get('/list', 'Admin\IndicatorsController@indicators');
    
        Route::get('{id}/value', 'APIController@value');
    
    });
    
    //Groups Endpoint
    Route::group(['prefix' => 'groups'], function(){
    
        Route::get('/value', 'Admin\IndicatorsController@value');
    
    });
    
    //Filters Endpoint
    Route::group(['prefix' => 'filters'], function(){
    
       Route::get('/list', 'FiltersController@filters');
       
       Route::get('/phases', 'FiltersController@phases');
       
       Route::get('/organizations', 'FiltersController@organizations');
       
       Route::get('/years', 'FiltersController@years');

       Route::get('/groups', 'FiltersController@groups');
    });
    
    //Codelists Endpoint
    
    Route::group(['prefix' => 'codelists'], function(){
    
       Route::get('/list', 'Admin\CodelistController@getCodelists');
       
    });
    
    Route::group(['prefix' => 'geonames'], function(){
    
       Route::get('/countries', 'Admin\GeonamesInstanceController@countries');
       
       Route::get('/continents', 'Admin\GeonamesInstanceController@continents');
       
       Route::get('/continentregions', 'Admin\GeonamesInstanceController@continentRegions');
       
       Route::get('/adm1', 'Admin\GeonamesInstanceController@adm1');
       
       Route::get('/adm2', 'Admin\GeonamesInstanceController@adm2');
       
       Route::get('/adm3', 'Admin\GeonamesInstanceController@adm3');
       
       Route::get('/adm4', 'Admin\GeonamesInstanceController@adm4');
       
    });
    
});
