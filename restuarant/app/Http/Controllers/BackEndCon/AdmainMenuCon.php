<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;


class AdmainMenuCon extends Controller
{
    //

    public function index(){
        
 $id =   Auth::guard('admin')->user();

         $vale   = DB::table('linkpiority')
                ->where('adminid', '=', $id->id)
                ->get();

    $mainlink = DB::table('linkpiority')
           ->join('adminmainmenu', 'adminmainmenu.id', '=', 'linkpiority.mainlinkid')
                 ->select('linkpiority.*','adminmainmenu.*')
           ->groupBy('linkpiority.mainlinkid')
           ->orderBy('adminmainmenu.serialNo', 'ASC')
               ->where('linkpiority.adminid',$id->id)
          ->get();

     $sublink = DB::table('linkpiority')
           ->join('adminsubmenu', 'adminsubmenu.id', '=', 'linkpiority.sublinkid')
            ->select('linkpiority.*','adminsubmenu.*')
            ->orderBy('adminsubmenu.serialno', 'ASC')
            ->where('linkpiority.adminid',$id->id)
            ->get();


     $Adminminlink = DB::table('adminmainmenu')
           ->orderBy('adminmainmenu.serialNo', 'ASC')
           ->get();

     $adminsublink = DB::table('adminsubmenu')
            ->orderBy('adminsubmenu.serialno', 'ASC')
           
            ->get();

			
    	$mainMenu  = DB::table('adminmainmenu')
                ->orderBy('serialNo', 'asc')
                ->get();

       
			return  view('Admin.developermenu.mainmenu',compact('mainMenu','mainlink','id','sublink','Adminminlink','adminsublink'));
		}





    public function store(Request $request){



			$this->validate($request, [
		        'MenuNameEn' => 'required|min:2',
		        'serial' => 'required',
		        'Route' => 'required',
		    ]);



			$insertDate = DB::table('adminmainmenu')->insert(
						    ['Link_Name' =>  $request->MenuNameEn, 
						    'serialNo' => $request->serial, 
						    'routeName' => $request->Route]
						);

    			if($insertDate){

    				Session::flash('success','Save Success');
    			}else{

    				Session::flash('error',$insertDate);

    			}
    			return redirect()->route('MainMenu');



    }


    public function showDate($id){


    	   $data = DB::table('adminmainmenu')->where('id', '=', $id)->get();
            return view('Admin.developermenu.mainmenumodel',compact('data'));
    }

    public function update(Request $request){

    if($request->MenuNameEn != "" && $request->serial != "" && $request->Route != ""){
                

                $EditData =DB::table('adminmainmenu')
                            ->where('id', $request->id)
                            ->update(['Link_Name' => $request->MenuNameEn,
                                'serialNo' => $request->serial,
                                'routeName' => $request->Route]);

                if($EditData){

                    Session::flash('success','Edit Success');
                }else{

                    Session::flash('error',$EditData);

                }
            }else{
                 Session::flash('error','Please Fill up required fields');
            }
                return redirect()->route('MainMenu');
                

    }

     public function Dalete($id){

                $obj = DB::table('adminmainmenu')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }


}
