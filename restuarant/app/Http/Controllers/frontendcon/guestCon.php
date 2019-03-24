<?php

namespace App\Http\Controllers\frontendcon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Image;
use App\guest;
use Auth;
class guestCon extends Controller
{
    //


    public function store(Request $request){

    	$this->validate($request, [
		        'name' => 'required',
		         'Email' => 'required',
		         'Phone' => 'required',
		         'password' => 'required',
		      
		    ]);

    	try {
    		
            
          
          
		  	$insertDate = DB::table('guest')->insert(
						    ['name' =>  $request->name, 
						    'email' => $request->Email, 
						    'password' => bcrypt($request->password),
						  'phoneno' => $request->Phone]
						);

		   





    	} catch (\Exception  $e) {
            Session::flash('error','Data Insert Unsuccessfully');
    		return redirect()->back();
    	}

    	return redirect()->back();


    }

    public function userchek(Request $request){
   
           
    			$credentials=["email"=>$request->name,"password"=>$request->password];

    			if (Auth::guard('guest')->attempt($credentials)) 
    			{
    //			
    				return 'a';
				}else{


                   return 'b';
                }
    }
}
