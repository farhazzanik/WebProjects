<?php

namespace App\Http\Controllers\frontendcon;

use Illuminate\Http\Request;
use App\Http\Controllers\frontendcon\Controller;

use App\Http\Requests;
use Auth;


class LoginController extends Controller
{
    //
    public function index(){

    	//return view('Login/login');
        return view('Login.login');
    }

    public function chek(Request $request){
   
           
    			$credentials=["email"=>$request->email,"password"=>$request->password];

    			if (Auth::guard('admin')->attempt($credentials)) 
    			{
    //			
    				return redirect()->intended('Dashboard');
				}else{


                    return redirect()->intended('login');
                }
    }


  
}
