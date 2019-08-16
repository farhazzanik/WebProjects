<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class loansCon extends Controller
{
    //

    function index(Request $request){
    	$onlyUser =  DB::table('user_info')->orderby('id','DESC')->get();

    	$allData = DB::table('user_info')
                ->join('loans_info','loans_info.fk_user_id','user_info.id')
                ->select('user_info.first_name','user_info.last_name','loans_info.*')
                ->orderby('loans_info.id','DESC')
                ->paginate(8);
        

    	if ($request->ajax()) {
            return view('loansPaginate', compact('allData'));
        }


    	return view('loansPage',compact('onlyUser','allData'));
    }


    //add loans
    function addLoans(Request $Request){

    	if($Request->ajax()){

    		try {
    			
    			if($Request->id == "")
    			{
    				$insertSql = DB::table('loans_info')->insert([
                            'id' => $this->maxID('loans_info','id'),
    						'fk_user_id'=> $Request->userID,
    						'amount' => $Request->Ammount,
    						'interest'=> $Request->Interest,
    						'duration' => $Request->Duration,
    						'start_date'=> $Request->StartDate,
    						'end_date' => $Request->EndDate,
    						'campaign'=> $Request->Campaign,
    						'status'=> $Request->status,
    						'created_at' => date("Y-m-d H:i:s"),
    						'updated_at' =>date("Y-m-d H:i:s"),
                        ]);
		    			if($insertSql){
		    				return response()->json(array('sms'=>'Data Insert Successfully ...!!'));
		    			}else{ 
		    				return response()->json(array('sms'=>'Data Insert Unsuccessfully ...!!'));
		    			}
		    	}else{

		    		$insertSql =  DB::table('loans_info')
		    		->where('id' ,$Request->id)
		    		->update([
                            'fk_user_id'=> $Request->userID,
    						'amount' => $Request->Ammount,
    						'interest'=> $Request->Interest,
    						'duration' => $Request->Duration,
    						'start_date'=> $Request->StartDate,
    						'end_date' => $Request->EndDate,
    						'campaign'=> $Request->Campaign,
    						'status'=> $Request->status,
    						'created_at' => date("Y-m-d H:i:s"),
    						'updated_at' =>date("Y-m-d H:i:s"),
                        ]);
		    			if($insertSql){
		    				return response()->json(array('sms'=>'Data Update Successfully ...!!'));
		    			}else{ 
		    				return response()->json(array('sms'=>'Data Update Unsuccessfully ...!!'));
		    			}
		    	}
    		
    		} catch (\Illuminate\Database\QueryException $e) {
    			 $error = $this->databaseCustomMessage($e->errorInfo[1]);
    			 return response()->json(array('sms'=> $error));
    		}

    	}
    }

     //delete item function 
    function delete(Request $request){
    	if($request->ajax()){

    		try {
    			$deleteSql = DB::table('loans_info')->where('id',$request->id)->delete();
    			if($deleteSql){
    				return response()->json(array('sms'=>'Data Delete Successfully ...!!'));
    			}else{ 
    				return response()->json(array('sms'=>'Data Delete Unsuccessfully ...!!'));
    			}
    		}catch (\Illuminate\Database\QueryException $e) {
    			 $error = $this->databaseCustomMessage($e->errorInfo[1]);
    			 return response()->json(array('sms'=> $error));
    		}
    	}
    }


    // user search by name
    function serchbyName(Request $request){
        if($request->ajax()){

            DB::table('user_info')
                ->join('loans_info','loans_info.fk_user_id','user_info.id')
                ->select('user_info.first_name','user_info.last_name','loans_info.*')
                 ->where('user_info.first_name','LIKE',"%{$request->value}%")
                ->get();
        


           $serchSql =  DB::table('user_info')
                ->join('loans_info','loans_info.fk_user_id','user_info.id')
                ->select('user_info.first_name','user_info.last_name','loans_info.*')
                 ->where('user_info.first_name','LIKE',"%{$request->value}%")
                ->get();
                
           if(count($serchSql) > 0){
                return response()->json(array($serchSql));
           }else{
            $serchSql =  DB::table('user_info')
                ->join('loans_info','loans_info.fk_user_id','user_info.id')
                ->select('user_info.first_name','user_info.last_name','loans_info.*')
                 ->where('user_info.last_name','LIKE',"%{$request->value}%")
                ->get();
              return response()->json(array($serchSql));
           }
           
        }  
    }

}
