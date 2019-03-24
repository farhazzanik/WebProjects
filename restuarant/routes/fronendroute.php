
<?php

Route::get('/',
	['as'=>'/',
	'uses'=>'frontendCon@index'
	]);

Route::get('index',
	['as'=>'index',
	'uses'=>'frontendCon@index'
	]);

Route::get('restuarantview/{id}','frontendCon@restuarantview');
Route::get('showreswise/{itemid}/{resid}','frontendCon@showreswise');
Route::get('showallprowiseres/{resid}','frontendCon@showallprowiseres');
Route::post('addshoppingcard/{itemid}/{proid}/{resid}','frontendCon@addshoppingcard');
Route::post('newaddshoppingcard/{itemid}/{proid}/{resid}','frontendCon@newaddshoppingcard');
Route::post('fullnewshoppingcard/{itemid}/{proid}/{resid}','frontendCon@fullnewshoppingcard');

Route::post('deleteshoping/{id}','frontendCon@deleteshoping');
Route::post('incshoping/{resid}/{itemid}/{proid}','frontendCon@incshoping');
Route::post('loadSuborder','frontendCon@loadSuborder');
Route::get('proload','frontendCon@proload');

Route::get('index/fetch_data','frontendCon@fetch_data');

Route::get('Checkout','frontendCon@Checkout');




Route::post('createuser','guestCon@store');
Route::post('userchek','guestCon@userchek');




	
Route::get('login',
	['as'=>'login',
	'uses'=>'LoginController@index'
	])->where(['login' => '[A-Z]+', 'login' => '[a-z]+']);

Route::post('CheckAdmin','LoginController@chek');

Route::group(['middleware' => 'guestauth'], function () {

Route::post('ordersubmit','frontendCon@ordersubmit');

});