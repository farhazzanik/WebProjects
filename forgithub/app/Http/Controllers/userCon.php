<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class userCon extends Controller
{
    //

    function index(Request $request){
    	$allData = DB::table('user_info')->orderby('id','DESC')->paginate(6);

    	  if ($request->ajax()) {
            return view('userDataPaginate', compact('allData'));
        }


    	return view('userPage',compact('allData'));
    }


    //add user
    function addUser(Request $Request){

    	if($Request->ajax()){

    		try {
    			
    			if($Request->id == "")
    			{
    				$insertSql = DB::table('user_info')->insert([
                            'id' => $this->maxID('user_info','id'),
    						'first_name'=> $Request->first_name,
    						'last_name' => $Request->last_name,
    						'email'=> $Request->email,
    						'personal_code' => $Request->personal_code,
    						'phone'=> $Request->phone,
    						'active' => $Request->status,
    						'dead'=> $Request->dead,
    						'lang'=> $Request->lang,
    						'created_at' => date("Y-m-d H:i:s"),
    						'updated_at' =>date("Y-m-d H:i:s"),
                        ]);
		    			if($insertSql){
		    				return response()->json(array('sms'=>'Data Insert Successfully ...!!'));
		    			}else{ 
		    				return response()->json(array('sms'=>'Data Insert Unsuccessfully ...!!'));
		    			}
		    	}else{

		    		$insertSql = DB::table('user_info')
		    		->where('id',$Request->id)
		    		->update([
		    			'first_name'=> $Request->first_name,
    						'last_name' => $Request->last_name,
    						'email'=> $Request->email,
    						'personal_code' => $Request->personal_code,
    						'phone'=> $Request->phone,
    						'active' => $Request->status,
    						'dead'=> $Request->dead,
    						'lang'=> $Request->lang,
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
    			$deleteSql = DB::table('user_info')->where('id',$request->id)->delete();
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
           $serchSql = DB::table('user_info')->where('first_name','LIKE',"%{$request->value}%")->get();

           if(count($serchSql) > 0){
                return response()->json(array($serchSql));
           }else{
             $serchSql = DB::table('user_info')->where('last_name','LIKE',"%{$request->value}%")->get();
              return response()->json(array($serchSql));
           }
           
        }  
    }
}
