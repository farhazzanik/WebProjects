<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmpolyeeWorkDetails;
use App\EmployeeInfo;
use App\CompanyInfo;
use Session;
use DB;
use DateTime;
class indexCon extends Controller
{
    //
    function index(){
        $allStartDate = $this->startEndDatequery('start');
    	$allEndDate =  $this->startEndDatequery('end');
    	$allData = $this->paginatQuery();
		return view('welcome',compact('allData','allStartDate','allEndDate'));
    }

     //select only employee Name 
    function autoComName(Request $request,$prefixName){
            if($request->ajax()){
                $empNameSql = DB::table('employee_info')
                            ->select('employee_info.first_name','employee_info.last_name' ,'employee_info.emp_id')
                            ->where('employee_info.first_name','LIKE',"%{$prefixName}%")
                            ->get();
                foreach ($empNameSql as $showData) {
                         echo "<li onClick='fixedText(this)' class='list-gpfrm-list list list-group-item ' id='list-gpfrm-list ".$showData->emp_id."' data-fullname='".$showData->first_name." ".$showData->last_name.",".$showData->emp_id."'>".$showData->first_name." ".$showData->last_name."(".$showData->emp_id.")</li>";
                        }       
                
            }
    }   

    //employee start and End Date query
    function startEndDatequery($type){

        $sqkQuery = DB::table('emp_work_details')
                        ->select(DB::raw("substr(emp_work_details.".$type.", 1, 10) as date"))
                        ->groupBy(DB::raw("substr(emp_work_details.".$type.", 1, 10)"))
                        ->get();
        return $sqkQuery;
    }


    // for ajax pagination function
    function fetch_data_paginate(Request $request){
        if($request->ajax())
             {
                 
                  $allData = $this->paginatQuery();
                  return view('paginateTableData', compact('allData'));
             }
    }

    //return  paginate query from here
    function paginatQuery(){
        $paginateSql = DB::table('emp_work_details')
                        ->join('employee_info','employee_info.emp_id','=','emp_work_details.fk_emp_id')
                        ->join('company_info','company_info.com_id','=','employee_info.fk_com_id')
                        ->select('employee_info.first_name','employee_info.last_name','employee_info.emp_email','employee_info.emp_phone','employee_info.emp_address','company_info.com_name','company_info.com_address','emp_work_details.end','emp_work_details.start')
                        ->paginate(30);
        return $paginateSql;
    }



    //view groupworkhours page
	function groupWorkHours() {
    		$onlyMonth = $this->getMonth();
            return view('groupWorkHours',compact('onlyMonth'));
    }

    
     //groupd works hour data from month to month 
    function showGroupWorkHours(Request $request,$startMonth,$endMonth){
        if($request->ajax()){
             $allData =  DB::table('emp_work_details')
                        ->join('employee_info','employee_info.emp_id','=','emp_work_details.fk_emp_id')
                        ->join('company_info','company_info.com_id','=','employee_info.fk_com_id')
                        ->select('employee_info.first_name','employee_info.emp_id','employee_info.last_name','employee_info.emp_email','company_info.com_name')
                        ->whereBetween(DB::raw("substr(emp_work_details.start, 6, 2)"), array($startMonth, $endMonth))
                        ->groupBy('emp_work_details.fk_emp_id')
                        ->get();

             $TitmeDiffer =  DB::table('emp_work_details')
                           ->select('emp_work_details.fk_emp_id', DB::raw("SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(`end`, `start`)))) AS totalworks"))
                            ->whereBetween(DB::raw("substr(emp_work_details.start, 6, 2)"), array($startMonth, $endMonth))
                           ->groupBy('emp_work_details.fk_emp_id')
                           ->get();


            return view('gwDatashow',compact('allData','startMonth','endMonth','TitmeDiffer'));
        }
    }

    //company works order by shorted
    function shortedComWorks(Request $request,$short_by){
        if($request->ajax()){
             return  $descComWorkHours = $this->shortedCompnayWorksHours($short_by);

        } 
    }



    //company working hours shorted query
    function shortedCompnayWorksHours($type){

        $descComWorkHours = DB::table('emp_work_details')
                            ->join('employee_info','employee_info.emp_id','=','emp_work_details.fk_emp_id')
                            ->join('company_info','company_info.com_id','=','employee_info.fk_com_id')
                            ->select('company_info.com_name',DB::raw("SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(emp_work_details.`end`,emp_work_details.`start`)))) AS totalworks"))
                            ->groupBy('company_info.com_id')
                            ->orderBy('totalworks', $type)
                            ->get();
        return $descComWorkHours;

    }

   

   //company work hour page view
    function comWorkHours(){
        $allcompnay = DB::table('company_info')->select('com_name','com_id')->groupBy('com_id')->get();
        $descComWorkHours = $this->shortedCompnayWorksHours('DESC');
        return view('comWorkHours',compact('allcompnay','descComWorkHours'));
    }


    //all month getfrom working hours database 
    function getMonth(){
    	$onlyMonth = DB::table('emp_work_details')
    				->select(DB::raw("substr(emp_work_details.start, 6, 2) as month"))
    				->groupBy(DB::raw("substr(emp_work_details.start, 6, 2)"))
    				->get();
    	return $onlyMonth;
    }

    //month converto to full name
	 public static function monthNoConvertTofull($monthNum){
		
            $mcf = DateTime::createFromFormat('!m', $monthNum);
			$fullNameofMonth = $mcf->format('F');
            return $fullNameofMonth;
    }
    //show Each Employee Data from here
    function showEachEmpWH(Request $request,$prefixName,$startDate,$endDate){
    		if($request->ajax()){
    			$employeID = preg_replace('/\D/', '', $prefixName);
    			$employeeInfo = DB::table('employee_info')
    							->join('company_info','employee_info.fk_com_id','=','company_info.com_id')
    							->where('employee_info.emp_id',$employeID)
    							->get();

    			 $totalWHbyEach =  DB::table('emp_work_details')
    			 				  ->select(DB::raw("substr(emp_work_details.start, 1, 10) as date"),DB::raw("substr(emp_work_details.start, 11) as startDate"),DB::raw("substr(emp_work_details.end, 11) as endDate"))
    							  ->where('fk_emp_id',$employeID)
    							  ->whereBetween(DB::raw("substr(emp_work_details.start, 1, 10)"), array($startDate, $endDate))
    							  ->get();

    			return view('eachEmployeeData',compact('employeeInfo','totalWHbyEach','startDate','endDate'));
    		}

    }


    //calculate working hours
     public static  function checkTotalHours($frisDAte,$secondDate){
    		$explodeStartDate = explode(':',$frisDAte);
			$explodeEndDate = explode(':',$secondDate);

			$hours =  $explodeEndDate[0]-$explodeStartDate[0];
			if($explodeEndDate[2] > $explodeStartDate[2]){
			 $seconds = $explodeEndDate[2]-$explodeStartDate[2];
			}else{
			 $seconds = $explodeStartDate[2]-$explodeEndDate[2];
			}
			if($explodeEndDate[1] > $explodeStartDate[1]){
			 $minutes =  $explodeEndDate[1]-$explodeStartDate[1];
			}else{
			 $minutes =  $explodeStartDate[1]-$explodeEndDate[1];
			}
			$obj = array();
			$obj[0]=$hours;
			$obj[1]=$minutes;
			$obj[2]=$seconds;		
			return $obj;
    }

  

    //insert data in database from json api link
    function InsDataFromJsonApi(){
    		ini_set('max_execution_time', 500);
    	$rUrl = 'https://nuvalo.merrant.ee/workhours?start=2018-01-01&end=2018-01-31';

		$data = json_decode(file_get_contents($rUrl), true);

		

		if(count($data) > 0)
		{
			for ($i=0; $i <count($data) ; $i++) { 
				 DB::beginTransaction();
				try {

					$checkEmpWork =  DB::table('emp_work_details')->where('emp_w_id',$data[$i]['id'])->get();
					if(count($checkEmpWork) > 0){

					}else{

						$InsEmpWorkDet = DB::table('emp_work_details')->insert([
							 	           'emp_w_id' => $data[$i]['id'],
											'fk_emp_id' =>  $data[$i]['employee_id'],
											'start' =>  $data[$i]['start'],
											'end' =>  $data[$i]['end'],
											'created_at' =>  $data[$i]['created_at'],
											'updated_at' =>  $data[$i]['updated_at']
										]);
					}
	      				
					 $checkEmp =  DB::table('employee_info')->where('emp_id',$data[$i]['employee']['id'])->get();

					if(count($checkEmp) > 0){

					}else{
						$InsEmpInfo = DB::table('employee_info')->insert([
						 	            'emp_id' => $data[$i]['employee']['id'],
										'fk_com_id' =>  $data[$i]['employee']['company_id'],
										'first_name' =>  $data[$i]['employee']['fname'],
										'last_name' =>  $data[$i]['employee']['lname'],
										'emp_email' =>  $data[$i]['employee']['email'],
										'emp_phone' =>  $data[$i]['employee']['phone'],
										'emp_address' =>  $data[$i]['employee']['address'],
										'created_at' =>  $data[$i]['employee']['created_at'],
										'updated_at' =>  $data[$i]['employee']['updated_at']
									]);
					}
      				


      			$checkCom = DB::table('company_info')->where('com_id',$data[$i]['employee']['company']['id'])->get();

      			if(count($checkCom) > 0){

      			}else{
      				$InsCmpInfo = DB::table('company_info')->insert([
						                'com_id' => $data[$i]['employee']['company']['id'],
										'com_name' =>  $data[$i]['employee']['company']['name'],
										'com_email' =>  $data[$i]['employee']['company']['email'],
										'com_phone' =>  $data[$i]['employee']['company']['phone'],
										'com_address' =>  $data[$i]['employee']['company']['address'],
										'created_at' =>  $data[$i]['employee']['company']['created_at'],
										'updated_at' =>  $data[$i]['employee']['company']['updated_at']
									]);
					}

      			
					
			      
				  DB::commit();		
				}catch (\Illuminate\Database\QueryException $e) {
					DB::rollback();
					$errorCode = $e->errorInfo[1];
					Session::flash('error',$this->databaseErrorMsg($errorCode));
				}


			}
		}
		return redirect()->back();
    }

    //database error message return function 
    function databaseErrorMsg($errorCode){
    		$msg = "";

    		 if($errorCode == '1062'){

				    $msg= 'No ! Duplicate Entry Is not Possible....';
				}elseif($errorCode == '1054'){
					$msg= 'Column not found....';
				}
			return $msg;
    }
}
