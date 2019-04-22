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

// Home page Route
Route::get('/',
	['as'=>'/',
	'uses'=>'indexCon@index'
	]);



Route::post('InsDataFromJsonApi','indexCon@InsDataFromJsonApi')->name('InsDataFromJsonApi');
Route::get('/fetch_data','indexCon@fetch_data_paginate');
Route::get('/autoComName/{prefixName}','indexCon@autoComName');
Route::get('/showEachEmpWH/{prefixName}/{startDate}/{endDate}','indexCon@showEachEmpWH');
// End Home page Route


//route for group works report
Route::get('groupWorkHours',
	['as'=>'groupWorkHours',
	'uses'=>'indexCon@groupWorkHours'
	]);
Route::get('/groupWorkHours/showGroupWorkHours/{startMonth}/{endMonth}','indexCon@showGroupWorkHours');

// end route for group works report


 // company work hours report route 
 Route::get('comWorkHours',
	['as'=>'comWorkHours',
	'uses'=>'indexCon@comWorkHours'
	]);
Route::get('/comWorkHours/shortedComWorks/{shortBy}','indexCon@shortedComWorks');
