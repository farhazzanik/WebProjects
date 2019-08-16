<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class indexCon extends Controller
{
    //
     function index(Request $request){

         $allData = DB::table('user_info')
                ->join('loans_info','loans_info.fk_user_id','user_info.id')
                ->select('user_info.first_name','user_info.last_name','user_info.email','user_info.personal_code','user_info.phone','loans_info.amount','loans_info.interest','loans_info.duration')
                ->orderby('user_info.id','DESC')
                ->paginate(10);
        
        if ($request->ajax()) {
            return view('paginateData', compact('allData'));
        }


    	return view('welcome',compact('allData'));
    }

    //import data from json file 
    function jsonFile(){
    	$path = base_path() .'/storage/app/jsonfile/users.json';
		$content = json_decode(file_get_contents($path), true);

		$path1 = base_path() .'/storage/app/jsonfile/loans.json';
		$content1 = json_decode(file_get_contents($path1), true);

		for ($i=0; $i < count($content); $i++) { 

			try {

				//insert data from user json file 
				$insertSql = DB::table('user_info')->insert([
                            'id' => $content[$i]["id"],
    						'first_name'=> $content[$i]["first_name"],
    						'last_name' => $content[$i]["last_name"],
    						'email'=> $content[$i]["email"],
    						'personal_code' => $content[$i]["personal_code"],
    						'phone'=> $content[$i]["phone"],
    						'active' => $content[$i]["active"],
    						'dead'=> $content[$i]["dead"],
    						'lang'=> $content[$i]["lang"],
    						'created_at' => date("Y-m-d H:i:s"),
    						'updated_at' =>date("Y-m-d H:i:s"),
                        ]);
				//return redirect()->back();
				
			} catch (\Illuminate\Database\QueryException $e) {
    			
    			 if($e->errorInfo[1] == "1062"){	
    			 	//replace the data reference by ID
					$insertSql = DB::table('user_info')
							->where('id',  $content[$i]["id"])
							->update([
	    						'first_name'=> $content[$i]["first_name"],
	    						'last_name' => $content[$i]["last_name"],
	    						'email'=> $content[$i]["email"],
	    						'personal_code' => $content[$i]["personal_code"],
	    						'phone'=> $content[$i]["phone"],
	    						'active' => $content[$i]["active"],
	    						'dead'=> $content[$i]["dead"],
	    						'lang'=> $content[$i]["lang"],
	    						'created_at' => date("Y-m-d H:i:s"),
	    						'updated_at' =>date("Y-m-d H:i:s"),
	                        ]);
				///return redirect()->back();
    			 }else{
    			 	 return $error = $this->databaseCustomMessage($e->errorInfo[1]);
				 }
    			
    		}
			
		}



		for ($j=0; $j < count($content1); $j++) { 

			try {
				

				//insert data from loans json file 
				 $insertSqsl = DB::table('loans_info')->insert([
                            'id' => $content1[$j]["id"],
    						'fk_user_id'=> $content1[$j]["user_id"],
    						'amount' => $content1[$j]["amount"],
    						'interest'=> $content1[$j]["interest"],
    						'duration' => $content1[$j]["duration"],
    						'start_date'=> $content1[$j]["start_date"],
    						'end_date' => $content1[$j]["end_date"],
    						'campaign'=> $content1[$j]["campaign"],
    						'status'=> $content1[$j]["status"],
    						'created_at' => date("Y-m-d H:i:s"),
    						'updated_at' =>date("Y-m-d H:i:s"),
                        ]);
				// return redirect()->back();
			} catch (\Illuminate\Database\QueryException $e) {
    			if($e->errorInfo[1] == "1062"){	
    			 	//replace the data reference by ID
					 $insertSqsl = DB::table('loans_info')->insert([
                            'id' => $content1[$j]["id"],
    						'fk_user_id'=> $content1[$j]["user_id"],
    						'amount' => $content1[$j]["amount"],
    						'interest'=> $content1[$j]["interest"],
    						'duration' => $content1[$j]["duration"],
    						'start_date'=> $content1[$j]["start_date"],
    						'end_date' => $content1[$j]["end_date"],
    						'campaign'=> $content1[$j]["campaign"],
    						'status'=> $content1[$j]["status"],
    						'created_at' => date("Y-m-d H:i:s"),
    						'updated_at' =>date("Y-m-d H:i:s"),
                        ]);
					 //return redirect()->back();

    			 }else{
    			 	 return $error = $this->databaseCustomMessage($e->errorInfo[1]);
				 }
    			
    		}
			
		}

        return redirect()->action('indexCon@index');


    }
}
