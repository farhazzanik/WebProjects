<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;

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


      public function logout(){
     Auth::guard('admin')->logout();
       return redirect()->intended('login');
    }

}
