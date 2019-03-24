<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use DB;
use Session;

class CollectionAreaCon extends Controller
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

      $AllEmployee = DB::table('employeeinfo')
            ->orderBy('employeeinfo.serialNo', 'ASC')
           ->where('fk_branc_id',$id->fk_brance_id)
            ->get();


        $selectArea = DB::table('areainfo')
                      ->orderBy('areainfo.id', 'ASC')
                      ->where('fk_branc_id',$id->fk_brance_id)
                      ->get();

        $showAllData  = DB::table('employeecollarea')
            ->join('createadmin', 'createadmin.id', '=', 'employeecollarea.fk_user_id')
            ->join('areainfo', 'areainfo.id', '=', 'employeecollarea.fk_area_id')
            ->join('employeeinfo', 'employeeinfo.id', '=', 'employeecollarea.fk_emp_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'employeecollarea.fk_brance_id')
            ->select('employeecollarea.*', 'createadmin.name as adminname', 'areainfo.area_name','employeeinfo.Name as empname','branceinfo.name as branceName')
            ->get();

       $adminWiseData  = DB::table('employeecollarea')
            ->join('createadmin', 'createadmin.id', '=', 'employeecollarea.fk_user_id')
            ->join('areainfo', 'areainfo.id', '=', 'employeecollarea.fk_area_id')
            ->join('employeeinfo', 'employeeinfo.id', '=', 'employeecollarea.fk_emp_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'employeecollarea.fk_brance_id')
            
            ->select('employeecollarea.*', 'createadmin.name as adminname', 'areainfo.area_name','employeeinfo.Name as empname','branceinfo.name as branceName')
            ->where( 'employeecollarea.fk_brance_id',$id->fk_brance_id)
            ->get();


             $branceNam = DB::table('branceinfo')->get();

    	return view('Admin.CollectionArea.collectioninfo',compact('mainlink','id','sublink','Adminminlink','adminsublink','AllEmployee','selectArea','showAllData','branceNam','adminWiseData'));
    }

    public function save(Request $request){

                  $this->validate($request, [
                          'Employee' => 'required',
                          'Area' => 'required',
                          'Brance' => 'required',
                         ]);


if($request->Employee != "Select One" &&  $request->Area != "Select One"){
                  $insertDate = DB::table('employeecollarea')->insert(
                [ 'fk_emp_id' =>  $request->Employee, 
                'fk_area_id' =>  $request->Area, 
                'fk_user_id' => $request->adminid, 
                'description' => $request->description,
                'fk_brance_id' => $request->Brance]
            );


                if($insertDate){

              
            Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insertDate);

          }
        }else{
            Session::flash('error','Please Fill Up Imaportant Fields');

        }
          return redirect()->back();
        

    }

      public function Delete($id){


        $obj = DB::table('employeecollarea')->where('id', '=', $id)->delete();
        
     

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }


     public function edit($id){
    $adminti =   Auth::guard('admin')->user();

 

             $AllEmployee = DB::table('employeeinfo')
            ->orderBy('employeeinfo.serialNo', 'ASC')
           ->where('fk_branc_id',$adminti->fk_brance_id)
            ->get();


        $selectArea = DB::table('areainfo')
                      ->orderBy('areainfo.id', 'ASC')
                      ->where('fk_branc_id',$adminti->fk_brance_id)
                      ->get();


            $showAllData  = DB::table('employeecollarea')
            ->join('createadmin', 'createadmin.id', '=', 'employeecollarea.fk_user_id')
            ->join('areainfo', 'areainfo.id', '=', 'employeecollarea.fk_area_id')
            ->join('employeeinfo', 'employeeinfo.id', '=', 'employeecollarea.fk_emp_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'employeecollarea.fk_brance_id')
            
            ->select('employeecollarea.*', 'createadmin.name as adminname', 'areainfo.area_name','employeeinfo.Name as empname','branceinfo.name as branceName')
            ->where('employeecollarea.id', '=', $id)
            ->get();

         
   $branceNam = DB::table('branceinfo')->get();



        
         return view('Admin.CollectionArea.collectionEdit',compact('showAllData','AllEmployee','selectArea','branceNam','adminti'));
    }

     public function editsucc(Request $Request){

   // return $Request->Employee;
    $obj = DB::table('employeecollarea')
                    ->where('id', $Request->colid)
                    ->update(['fk_emp_id' => $Request->Employee,'fk_area_id' => $Request->Area,'fk_user_id' =>  $Request->adminid,
                      'description' => $Request->description,'fk_brance_id' => $Request->Brance]);
                  if($obj){

                Session::flash('success','Save Success');
                }else{

                  Session::flash('error',$obj);

                }
                return redirect()->back();

    }

  public function showareaADd(Request $request,$id1){


       if($request->ajax()){
                    $results  = DB::table('areainfo') ->where('areainfo.fk_branc_id',$id1)->get();
              return $results;
                         
                }

      
    }
   public function showrefer(Request $request,$id1){


       if($request->ajax()){
                    $results  = DB::table('employeeinfo') ->where('employeeinfo.fk_branc_id',$id1)->get();
              return $results;
                         
                }

      
    }


}
