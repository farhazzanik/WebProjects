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

Route::get('/', 'indexCon@index');



Route::get('/jsonFile', 'indexCon@jsonFile');
//Route::get('ajax-pagination','indexCon@index');

//for user route
Route::get('/user',['as' => 'user','uses'=>'userCon@index']);
Route::post('user/add','userCon@addUser');
Route::post('user/delete','userCon@delete');
Route::post('user/serchbyName','userCon@serchbyName');
//Route::get('user','userCon@index');


//for loans rout 
Route::get('/loans',['as' => 'loans','uses'=>'loansCon@index']);
Route::post('loans/add','loansCon@addLoans');
Route::post('loans/delete','loansCon@delete');
Route::post('loans/serchbyName','loansCon@serchbyName');



//for check age route
Route::get('/checkAge',['as' => 'checkAge','uses'=>'checkAge@index']);
