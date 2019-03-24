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



Route::get('Area',
	['as'=>'Area',
	'uses'=>'AreaCon@index'
	])->where(['Area' => '[A-Z]+', 'Area' => '[a-z]+']);


Route::post('saveArea','AreaCon@saveData');
Route::post('areaDelet/{id}','AreaCon@delete');
Route::get('areaModel/{id}','AreaCon@EditModel');
Route::post('areaeditSucc','AreaCon@editSuc');
Route::get('showarewiseb/{brance}','AreaCon@showaread');




Route::get('PackageType','PackageTypeCon@index');
Route::post('PackageAdd','PackageTypeCon@save');
Route::post('packageDelete/{id}','PackageTypeCon@Delete');
Route::get('packageModel/{id}','PackageTypeCon@model');
Route::post('packageUpdate','PackageTypeCon@update');





Route::get('Employee','EmployeeCon@index');
Route::post('saveEmployee','EmployeeCon@save');
Route::post('DeleteEmp/{id}','EmployeeCon@Delete');
Route::get('EditEmpInfo/{id}','EmployeeCon@edit');
Route::post('editSuccessEm','EmployeeCon@editsucc');
Route::get('empsalarysetup','empsalarysetCon@index');
Route::get('showEmpsalarysetu/{id}','empsalarysetCon@showrefer');
Route::post('salarysetup','empsalarysetCon@save');

Route::post('SalayDelete/{id}','empsalarysetCon@Delete');

Route::get('salaryedit/{id}','empsalarysetCon@edit');
Route::post('savesuccsalry','empsalarysetCon@editsucc');
Route::get('salarycollection','empsalarysetCon@salarycolleblade');
Route::get('showEmplContNo/{getid}','empsalarysetCon@showContact');
Route::get('showSalaryemp/{getid}','empsalarysetCon@showSalaryemp');

Route::post('salaryPaidEmp','empsalarysetCon@salaryPaidEmp');
Route::post('SalayDelete/{id}','empsalarysetCon@SalayDelete');

Route::get('showSalaryPaidpayemt/{id}/{month}/{date}',
	['as'=>'showSalaryPaidpayemt/{id}/{month}/{date}',
	'uses'=>'empsalarysetCon@showSlaraypaidreport'
	])->where(['showSalaryPaidpayemt' => '[A-Z]+', 'showSalaryPaidpayemt' => '[a-z]+']);





Route::get('colleactionArea','CollectionAreaCon@index');
Route::post('saveCollection','CollectionAreaCon@save');
Route::post('collectDelete/{id}','CollectionAreaCon@Delete');
Route::get('ecollEdit/{id}','CollectionAreaCon@edit');
Route::post('editSuccCol','CollectionAreaCon@editsucc');
Route::get('showColarea/{id}','CollectionAreaCon@showareaADd');
Route::get('showempforcol/{id}','CollectionAreaCon@showrefer');



Route::get('viewmember','MemberinfoCon@viewmember');
Route::get('memberinfo','MemberinfoCon@index');
Route::post('saveMem','MemberinfoCon@save');
Route::post('deleteMem/{id}','MemberinfoCon@Delete');
Route::get('editMemberInfo/{id}','MemberinfoCon@edit');
Route::post('edotSuccMem','MemberinfoCon@succ');
Route::get('showMemReport/{id}','MemberinfoCon@showReport');
Route::get('Send/{id}','MemberinfoCon@Send');
Route::get('viewMem/{id}','MemberinfoCon@view');




Route::get('Admission','memberAddmission@index');
Route::post('saveMember','memberAddmission@save');
Route::post('DeleteMemAdd/{id}','memberAddmission@Delete');
Route::get('editMemAdd/{id}','memberAddmission@edit');
Route::post('updateMemSucc','memberAddmission@succ');
Route::get('showAddreport/{id}','memberAddmission@showReport');

Route::get('memaddshowmem/{id}','memberAddmission@shwoMem');

Route::get('showreferAdd/{id}','memberAddmission@showrefer');
Route::get('showareadd/{id}','memberAddmission@showareaADd');
Route::get('showAreforMemAdd/{id}','memberAddmission@showAreforMemAdd');






Route::get('typereport','TypeWiseReportCon@index');
Route::post('TypeWisReport','TypeWiseReportCon@Typereport');
Route::get('Mobilelist','TypeWiseReportCon@mobileList');
Route::get('Mobilelistprint','TypeWiseReportCon@Mobilelistprint');
Route::get('showpack','TypeWiseReportCon@showpack');


Route::get('packwisemem','TypeWiseReportCon@packwisemem');
Route::post('showMember','TypeWiseReportCon@showPackwiseMem');

Route::get('collsheet','TypeWiseReportCon@collsheet');
Route::post('showcolshet','TypeWiseReportCon@showcolshet');


Route::get('cashclose','TypeWiseReportCon@cashclose');
Route::post('donecash','TypeWiseReportCon@donecash');


Route::get('cashreport','TypeWiseReportCon@cashreport');
Route::post('showcashtab','TypeWiseReportCon@showcashtab');

Route::get('mcashreport','TypeWiseReportCon@mcashreport');
Route::post('showmcasreport','TypeWiseReportCon@showmcasreport');

Route::get('rootwisereport','TypeWiseReportCon@rootwisereport');
Route::post('getroot/{brance}','TypeWiseReportCon@getroot');

Route::post('rootcollection','TypeWiseReportCon@rootcollection');

Route::get('datetodateinvest','TypeWiseReportCon@datetodateinvest');
Route::get('datetodateseving','TypeWiseReportCon@datetodateseving');

Route::get('overdateaccount','TypeWiseReportCon@overdateaccount');



Route::get('Sendmsg','SendMessageCon@index');
Route::get('showConNo/{data}/{brance}','SendMessageCon@showcon');
Route::post('succMsg','SendMessageCon@sendSuccess');
Route::get('packmsg','SendMessageCon@packwisemsg');
Route::get('showPackCon/{data}/{brance}/{reg}','SendMessageCon@packwisSent');
Route::post('packsuccMsg','SendMessageCon@packsendSucc');


Route::get('cost','Constcon@index');
Route::post('costAdd','Constcon@save');
Route::post('costDelet/{id}','Constcon@delete');
Route::get('editcost/{id}','Constcon@editCost');
Route::post('costsucc','Constcon@editsucc');


Route::get('Expense','incomeExpenseCon@index');
Route::get('showExpenseTitle/{brance}','incomeExpenseCon@showExpenseTitle');
Route::post('saveExpense','incomeExpenseCon@saveexpense');
Route::post('expensDele/{id}','incomeExpenseCon@deleteex');
Route::get('editExpense/{id}','incomeExpenseCon@editexpense');
Route::post('updateSuccexpen','incomeExpenseCon@updateSuccexpen');


Route::get('income','incomeExpenseCon@index2');

Route::get('savingmemsa/{brance}','incomeExpenseCon@sabingmem');

Route::post('saveIncome','incomeExpenseCon@saveIncome');
Route::post('incomeDel/{id}','incomeExpenseCon@deleteincom');
Route::get('editINcome/{id}/{id1}','incomeExpenseCon@editINcome');
Route::post('updateSuccincome','incomeExpenseCon@updateIncomeSuc');

Route::get('shareammount','incomeExpenseCon@shareammount');
Route::post('saveshare','incomeExpenseCon@saveshare');
Route::post('shareamoutdel/{id}','incomeExpenseCon@shareamoutdel');
Route::get('sharelist','incomeExpenseCon@sharelist');
Route::post('showsharelist','incomeExpenseCon@showsharelist');
Route::get('sharewithdraw','incomeExpenseCon@sharewithdraw');
Route::get('sharewimeme/{brance}','incomeExpenseCon@sharewimeme');
Route::get('showssamm/{brance}/{memid}','incomeExpenseCon@showssamm');
Route::post('sharereturn/{id}','incomeExpenseCon@sharereturn');

// ++++++++++++++++++++++=share withdraw+++++++++++++++++++++++++

Route::get('sharedrawing','incomeExpenseCon@sharedrawing');
Route::post('showsharpackage/{Member}','incomeExpenseCon@showsharpackage');
Route::post('showsharammount','incomeExpenseCon@showsharammount');
Route::post('savesharewithdraw','incomeExpenseCon@savesharewithdraw');


// ++++++++++++++++++++++=share withdraw+++++++++++++++++++++++++


Route::get('incexpreport','incomeExpenseCon@indexreport');
Route::post('showReposrExpInc','incomeExpenseCon@showReposrExpInc');


Route::get('savcollection','savingCollCon@index');
Route::get('showMem/{type}/{brance}','savingCollCon@shwoMem');
Route::post('savingcoll','savingCollCon@savecoll');
Route::get('ss/{id1}','savingCollCon@show');
Route::get('showpre/{id1}','savingCollCon@showpre');
Route::post('savColl/{id}','savingCollCon@delete');
Route::get('EditSavCol/{id}','savingCollCon@EditSavCol');
Route::get('showINs/{id1}','savingCollCon@showINs');
Route::get('savcollreport','savingCollCon@savcollreport');
Route::get('showMemcollreport/{id}/{id1}','savingCollCon@showMemcollreport');
Route::post('showSavingColreport','savingCollCon@showcollReaporttab');

Route::post('profitwithsave','savingCollCon@profitwithsave');
Route::get('showprofit/{id1}','savingCollCon@showprofit');


Route::get('profitwithdraw','savingCollCon@profitwithdraw');



Route::get('Finishedsaving','savingCollCon@Finishedsaving');
Route::get('showfinishsavingdata/{branceid}/{from}/{to}/{type}','savingCollCon@showfinishsavingdata');
Route::post('deactivefinishsaving/{id}','savingCollCon@deactivefinishsaving');
Route::post('PWDELETE/{id}','savingCollCon@PWDELETE');




Route::get('showreportsaveing/{id}','savingCollCon@showReport');



Route::get('withdraw','withdrawCon@index');
Route::get('shownameWithdraw/{type}/{brance}','withdrawCon@shwoMem');
Route::get('showprewithd/{id1}','withdrawCon@showpre');
Route::get('showTotadep/{id}/{id1}','withdrawCon@show');
Route::get('showINswithsraw/{id}/{id1}','withdrawCon@showINs');
Route::post('withdrawsave','withdrawCon@save');
Route::post('delWithdraw/{id}','withdrawCon@delete');




Route::get('invesColl','invescollCon@index');
Route::get('showAppliInvest/{id}/{id1}','invescollCon@show');
Route::get('showTotalInves/{id1}','invescollCon@showTotal');
Route::get('showINsinvest/{getid}','invescollCon@totalIns');
Route::get('showpreinves/{id}','invescollCon@showPrevious');
Route::post('invescollec','invescollCon@saveData');
Route::post('deleInvColl/{getid}','invescollCon@deleteData');
Route::get('investreport','invescollCon@investcolreport');
Route::get('investreport','invescollCon@investcolreport');
Route::get('showInvesMem/{id}/{id1}','invescollCon@showMemcollreport');
Route::post('showInvestReport','invescollCon@showcollReaporttab');

Route::get('Finishedinvest','invescollCon@Finishedinvest');
Route::get('showfinishinvestdata/{branceid}/{from}/{to}/{type}','invescollCon@showfinishinvestdata');

Route::post('finshedinvedeactive/{getid}','invescollCon@finshedinvedeactive');



Route::get('showReportinv/{id}','invescollCon@showReport');



Route::get('Investmelatter','investlatterCon@index');
Route::post('saveInslatter','investlatterCon@save');
Route::post('deletInvesLat/{id}','investlatterCon@delete');
Route::get('editInvestLatter/{id}','investlatterCon@editPage');
Route::post('updateInvestReport','investlatterCon@update');
Route::get('showInvestLatterR/{id}','investlatterCon@showReport');
Route::get('showMemberforinvest/{brance}','investlatterCon@showMem');
Route::get('showAlldataoforinvest/{appid}','investlatterCon@shoalldata');
Route::get('savidforinvest/{appid}','investlatterCon@savidforinvest');



Route::get('dateoverinvacc','investreportCon@dateoverinvacc');
Route::post('expireaccreport','investreportCon@expireaccreport');



Route::get('bankinfo','Bankmanagementcon@index');
Route::post('savebankinfo','Bankmanagementcon@save');
Route::post('Deletebankinfo/{id}','Bankmanagementcon@Dalete');
Route::get('EditBrancinfo/{id}','Bankmanagementcon@editbankinfo');
Route::post('editsuccbankinfo','Bankmanagementcon@editsucc');
Route::get('showMembank/{id}','Bankmanagementcon@showMem');
Route::get('showAcNo/{id}/{id1}','Bankmanagementcon@showAcNO');
Route::get('showCurrent/{id}/{id1}','Bankmanagementcon@showCurrent');





Route::get('bankmangement','Bankmanagementcon@index1');
Route::post('manageAdd','Bankmanagementcon@savemange');
Route::post('deleteBankmang/{id}','Bankmanagementcon@Daletemanage');
Route::get('editbankmanage/{id}','Bankmanagementcon@editbankmanage');
Route::post('editsuccmangae','Bankmanagementcon@editsuccmangae');

Route::get('bankreport','Bankmanagementcon@showBankreport');
Route::post('shwoReportBank','Bankmanagementcon@showTabReport');


Route::get('salarytitle','EmployeeCon@index1');
Route::post('savitsaltitle','EmployeeCon@savitsaltitle');
Route::post('salartitledel/{id}','EmployeeCon@deletSaltitle');
Route::get('showDatasalttit/{brance}/{emp}/{month}/{Year}','EmployeeCon@shwoSalTitle');
Route::post('sessiosaltitledelete/{getid}','EmployeeCon@deletsessionSaltile');
Route::post('saveSalaryColl','EmployeeCon@saveSalaryColl');






Route::get('monthlypackage','monthlyprofitCon@index');
Route::post('mmpdsPackageAdd','monthlyprofitCon@save');
Route::post('mmpdspackageDelete/{id}','monthlyprofitCon@Delete');


Route::get('packregistration','monthlyprofitCon@packreg');
Route::get('showPackageRegis/{id}','monthlyprofitCon@showpack');
Route::get('showOldpackamm/{id}/{date}','monthlyprofitCon@showData');
Route::post('packregmmpds','monthlyprofitCon@savemmpds');
Route::post('mmpdspackregdel/{id}','monthlyprofitCon@delmmpds');


Route::get('mmpdsregedit/{id}/{branceid}','monthlyprofitCon@editmmpreg');
Route::post('editsuccmmpds','monthlyprofitCon@editsuccmmpds');
Route::get('mmpdsreport','monthlyprofitCon@showReport');
Route::post('showReportmmpds','monthlyprofitCon@showReportmmpds');
Route::get('mmpdsReportShow/{id}','monthlyprofitCon@showReporttab');




Route::get('mmpdsprowith','monthlyprofitCon@mmpdsprowith');
Route::get('mmpdsprwithmem/{id}','monthlyprofitCon@mmpdsprwithmem');
Route::get('mmpdsshowdd/{id}/{date1}','monthlyprofitCon@mmpdsshowdd');
Route::post('mmpdsammwith','monthlyprofitCon@mmpdsammwith');
Route::post('mmpdswithdel/{id}','monthlyprofitCon@mmpdswithdel');




Route::get('tkintializemsg','SmsSetupCon@index');
Route::post('savesmsprice','SmsSetupCon@SmsSetupCon');
Route::post('deletesmsinitia/{id}','SmsSetupCon@Deletesms');

Route::get('msgsetup','SmsSetupCon@indexx');
Route::get('showDatamem/{branceid}/{from}/{to}/{type}','SmsSetupCon@showDatamem');
Route::post('savesmssetup','SmsSetupCon@savesmssetup');
Route::get('ShowMsgSetup','SmsSetupCon@ShowMsgSetup');

Route::get('smssetupdata/{branceid}/{from}/{to}/{type}','SmsSetupCon@smssetupdata');
Route::post('deletesmssetup/{id}','SmsSetupCon@deletesmssetup');
Route::post('activetodec/{id}','SmsSetupCon@activetodec');
Route::post('dectoac/{id}','SmsSetupCon@dectoac');


Route::get('generatebarcode',
	['as'=>'generatebarcode',
	'uses'=>'BarcodeCon@index'
	])->where(['generatebarcode' => '[A-Z]+', 'generatebarcode' => '[a-z]+']);

Route::post('generatebarcodereporrt',
	['as'=>'generatebarcodereporrt',
	'uses'=>'BarcodeCon@showreport'
	])->where(['generatebarcodereporrt' => '[A-Z]+', 'generatebarcodereporrt' => '[a-z]+']);


Route::get('intialinterestrate',
	['as'=>'intialinterestrate',
	'uses'=>'intialinterestrate@index'
	])->where(['intialinterestrate' => '[A-Z]+', 'intialinterestrate' => '[a-z]+']);

Route::post('saveintialrate','intialinterestrate@saveintialrate');
Route::post('intialratedel/{id}','intialinterestrate@intialratedel');
Route::get('editintialrate/{id}','intialinterestrate@edit');
Route::post('editsuccrate','intialinterestrate@intialinterestrate');


Route::get('activelist','intialinterestrate@activelist');
Route::post('showactive','intialinterestrate@report');



Route::get('profitreportsaving','profitrepcon@index');
Route::post('showprofitrept','profitrepcon@report');


Route::get('logout',
	['as'=>'logout',
	'uses'=>'LoginController@logout'
	]);
   




   
});

Route::get('/',
	['as'=>'/',
	'uses'=>'LoginController@index'
	])->where(['login' => '[A-Z]+', 'login' => '[a-z]+']);
	
	
	Route::get('login',
	['as'=>'login',
	'uses'=>'LoginController@index'
	])->where(['login' => '[A-Z]+', 'login' => '[a-z]+']);

Route::post('CheckAdmin','LoginController@chek');
