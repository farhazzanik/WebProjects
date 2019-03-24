<?php

Route::group(['middleware' => 'adminauth'], function () {

Route::get('Dashboard',
	['as'=>'Dashboard',
	'uses'=>'DashboardCon@index'
	])->where(['Dashboard' => '[A-Z]+', 'Dashboard' => '[a-z]+']);


Route::get('MainMenu',
	['as'=>'MainMenu',
	'uses'=>'AdmainMenuCon@index'
	])->where(['MainMenu' => '[A-Z]+', 'MainMenu' => '[a-z]+']);

Route::get('AdminMainMenuModel/{id}','AdmainMenuCon@showDate');
Route::post('AdmainSaveMainlink','AdmainMenuCon@store');
Route::post('AdminEditMainlink','AdmainMenuCon@update');
Route::post('adminDeleteData/{id}','AdmainMenuCon@Dalete');



Route::get('SubMenu',
	['as'=>'SubMenu',
	'uses'=>'AdminSubMenuCon@index'
	])->where(['SubMenu' => '[A-Z]+', 'SubMenu' => '[a-z]+']);

Route::post('AdminSubLinkSave','AdminSubMenuCon@store');
Route::get('adminSubModelEdit/{id}','AdminSubMenuCon@showDate');
Route::post('AdminMainMenuEditcon','AdminSubMenuCon@update');
Route::post('AdminSubmenuDelete/{id}','AdminSubMenuCon@Dalete');




Route::get('Brance',
	['as'=>'Brance',
	'uses'=>'BranceCon@index'
	])->where(['Brance' => '[A-Z]+', 'Brance' => '[a-z]+']);

Route::post('SaveBranceInfo','BranceCon@store');
Route::post('DeleteBrance/{id}','BranceCon@Dalete');
Route::get('UpdateBrance/{id}',
	['as'=>'UpdateBrance',
	'uses'=>'BranceCon@update'
	])->where(['UpdateBrance' => '[A-Z]+', 'UpdateBrance' => '[a-z]+']);
Route::post('UpdateBranceSucc','BranceCon@updatesucc');





Route::get('CreateAdmin',
	['as'=>'CreateAdmin',
	'uses'=>'CreateAdminCon@index'
	])->where(['CreateAdmin' => '[A-Z]+', 'CreateAdmin' => '[a-z]+']);
Route::post('CreateAdmin','CreateAdminCon@Store');

Route::get('ViewAdmin',
	['as'=>'ViewAdmin',
	'uses'=>'CreateAdminCon@showallAdmin'
	])->where(['ViewAdmin' => '[A-Z]+', 'ViewAdmin' => '[a-z]+']);

	

Route::post('AdminDeleteById/{id}','CreateAdminCon@Dalete');
Route::get('UpdateData/{id}','CreateAdminCon@updateData');
Route::post('UpdateSuccess','CreateAdminCon@Success');




Route::get('item','ItemCon@index');
Route::post('saveitem','ItemCon@store');
Route::get('itemmodel/{id}','ItemCon@showDate');
Route::post('deleteitem/{id}','ItemCon@Dalete');
Route::post('itemupdatesuc','ItemCon@itemupdatesuc');


Route::get('category','ItemCon@category');
Route::post('savecate','ItemCon@savecate');
Route::get('catmodel/{id}','ItemCon@catmodel');
Route::post('deletecat/{id}','ItemCon@deletecat');
Route::post('catupdatesuc','ItemCon@catupdatesuc');

Route::get('restaurent','RestaurentCon@index');
Route::post('saveres','RestaurentCon@saveres');
Route::get('editres/{id}','RestaurentCon@editres');
Route::post('delrest/{id}','RestaurentCon@delrest');
Route::post('edisucresinfo','RestaurentCon@edisucresinfo');


Route::get('packinfo','PackCon@index');
Route::get('showcatpack/{id}','PackCon@showcatpack');
Route::get('showrespack/{id}','PackCon@showrespack');
Route::post('delpack/{id}','PackCon@delpack');
Route::get('editpack','PackCon@editpack');
Route::post('savepack','PackCon@savepack');
Route::post('ShowCurrentproduct','PackCon@ShowCurrentproduct');
Route::post('subpacksuc','PackCon@subpacksuc');
Route::post('editpacksuc','PackCon@editpacksuc');

Route::get('show','PackCon@show');

Route::match(['get', 'post'], 'ajax-image-upload', 'PackCon@ajaxImage');
Route::delete('ajax-remove-image/{filename}', 'PackCon@deleteImage');

Route::get('logout',
	['as'=>'logout',
	'uses'=>'DashboardCon@logout'
	]);


   
});

