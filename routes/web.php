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

if(env("REGISTRATION_ENABLED")){
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
}
else{
    Route::get('register', function(){
        abort(403,"Registrations are closed by the Admin.");
        
    });
    Route::post('register', function(){
        abort(403, "Registrations are closed by the Admin.");        
    });
}



Route::get('/admin', 'AdminController@index');

Route::get('/admin/codelists', 'Admin\\CodelistController@getCodelistSelect');

Route::get('/admin/collections', 'Admin\\CodelistController@getCollectionSelect');

Route::get('/admin/localcollections', 'Admin\\CodelistController@getLocalCollectionSelect');

Route::get('/admin/codelist', 'Admin\\CodelistController@codelist2select');

Route::get('/admin/geonames/continents', 'Admin\\GeonamesInstanceController@getContinents');

Route::get('/admin/geonames/countries', 'Admin\\GeonamesInstanceController@getCountries');

Route::get('/admin/geonames/adm1', 'Admin\\GeonamesInstanceController@getAdm1');

Route::get('/admin/geonames/adm2', 'Admin\\GeonamesInstanceController@getAdm2');

Route::get('/admin/geonames/adm3', 'Admin\\GeonamesInstanceController@getAdm3');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('admin/aggregators', 'Admin\\AggregatorsController');
    Route::resource('admin/indicators', 'Admin\\IndicatorsController');
    Route::resource('admin/groups', 'Admin\\GroupsController');
    Route::resource('admin/aggregators', 'Admin\\AggregatorsController');   
    Route::resource('admin/organizations', 'Admin\\OrganizationsController');    
    Route::resource('admin/s-p-a-r-q-l-endpoints', 'Admin\\SPARQLEndpointsController');
    Route::resource('admin/o-s-endpoints', 'Admin\\OSEndpointsController');
    Route::resource('admin/rdf-namespaces', 'Admin\\RdfNamespacesController');
    Route::resource('admin/aggregator-instances', 'Admin\\AggregatorInstancesController');
    Route::resource('admin/codelist-collections', 'Admin\\CodelistCollectionsController');
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

Route::get('/embed', 'DashboardController@embed')->name("embed");

Route::get('/tinyURL', 'DashboardController@tinyURL')->name("tinyURL");

