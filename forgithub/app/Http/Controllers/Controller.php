<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //database error message display 
    public function databaseCustomMessage($errorCode){
    		$msg = "";

    		 if($errorCode == '1062'){

				    $msg= 'No ! Duplicate Entry Is not Possible....';
				}elseif($errorCode == '1054'){
					$msg= 'Column not found....';
				}elseif($errorCode == '1146'){
					$msg= 'Table does not exist....';
				}
			return $msg;
    }

    //max id

    public function maxID($table,$fildname){
    	$maxid = 0;
    	$sql = DB::table($table)->max($fildname);

    	if($sql) {
    		return $maxid = $sql + 1;
    	}else{
    		return $maxid = 1;
    	}
    }
}
