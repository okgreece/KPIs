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
if(env("APP_ENV") != 'local'){
      \URL::forceRootUrl(env('APP_URL'));
    }

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');

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

Route::group(['prefix' => 'admin', 'middleware' => ['role:superadmin']], function () {
    Route::resource('aggregators', 'Admin\\AggregatorsController');
    Route::resource('indicators', 'Admin\\IndicatorsController');
    Route::resource('groups', 'Admin\\GroupsController');
    
    Route::resource('organizations', 'Admin\\OrganizationsController');
    Route::resource('s-p-a-r-q-l-endpoints', 'Admin\\SPARQLEndpointsController');
    Route::resource('o-s-endpoints', 'Admin\\OSEndpointsController');
    Route::resource('rdf-namespaces', 'Admin\\RdfNamespacesController');

    Route::get('codelists', 'Admin\\CodelistController@getCodelistSelect')->name("codelists");

    Route::get('collections', 'Admin\\CodelistController@getCollectionSelect')->name("collections");

    Route::get('localcollections', 'Admin\\CodelistController@getLocalCollectionSelect')->name("localcollections");

    Route::get('codelist', 'Admin\\CodelistController@codelist2select')->name("codelist");
});

Route::group(['prefix' => 'admin', 'middleware' => ['role:superadmin|micrositeadmin']], function () {
    Route::resource('aggregator-instances', 'Admin\\AggregatorInstancesController');
    Route::resource('codelist-collections', 'Admin\\CodelistCollectionsController');
});

Route::group(['prefix' => 'admin', 'middleware' => ['role:superadmin|micrositeadmin|ontology']], function () {
    Route::resource('aggregator-instances', 'Admin\\AggregatorInstancesController');
    Route::resource('codelist-collections', 'Admin\\CodelistCollectionsController');

    Route::get('geonames/continents', 'Admin\\GeonamesInstanceController@getContinents')->name("continents");

    Route::get('geonames/countries', 'Admin\\GeonamesInstanceController@getCountries')->name("countries");

    Route::get('geonames/adm1', 'Admin\\GeonamesInstanceController@getAdm1')->name("adm1");

    Route::get('geonames/adm2', 'Admin\\GeonamesInstanceController@getAdm2')->name("adm2");

    Route::get('geonames/adm3', 'Admin\\GeonamesInstanceController@getAdm3')->name("adm3");

    Route::get('geonames/adm4', 'Admin\\GeonamesInstanceController@getAdm4')->name("adm4");    
});

Route::get('/', 'DashboardController@index')->name("index");

Route::get('/dashboard', 'DashboardController@dashboard')->name("dashboard");

Route::get('/phases', 'DashboardController@phases')->name("phases");

Route::get('/years', 'DashboardController@years')->name("years");

Route::get('/evolution', 'DashboardController@evolution')->name("evolution");

Route::get('/update', 'DashboardController@update')->name("update");

Route::get('/dimension', 'DashboardController@dimension')->name("dimension");

Route::get('/compare', 'DashboardController@compare')->name("compare");

Route::get('/radar', 'DashboardController@radar')->name("radar");

Route::get('/updateRadar', 'DashboardController@updateRadar')->name("updateRadar");

Route::get('/lang/{lang}', 'DashboardController@language')->name('lang');

Route::get('/embed', 'DashboardController@embed')->name("embed");

Route::get('/tinyURL', 'DashboardController@tinyURL')->name("tinyURL");

