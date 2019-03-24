<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth; 
Use DB;
Use Session;
class PackageTypeCon extends Controller
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

      $showAllDate  = DB::table('packagetype')
            ->join('createadmin', 'createadmin.id', '=', 'packagetype.fk_user_id')
             ->join('branceinfo', 'branceinfo.id', '=', 'packagetype.fk_branc_id')
            ->select('packagetype.*', 'createadmin.name as adminname','branceinfo.name as brancename')
            ->orderBy('packagetype.serialNo','ASC')
            ->get();


     $adminWiseBrance  = DB::table('packagetype')
            ->join('createadmin', 'createadmin.id', '=', 'packagetype.fk_user_id')
             ->join('branceinfo', 'branceinfo.id', '=', 'packagetype.fk_branc_id')
            ->select('packagetype.*', 'createadmin.name as adminname','branceinfo.name as brancename')
            ->orderBy('packagetype.serialNo','ASC')
            ->where('packagetype.fk_branc_id',$id->fk_brance_id)
            ->get();

            

          $branceNam = DB::table('branceinfo')->get();



    	return view('Admin.PackageType.packageinfo',compact('mainlink','id','sublink','Adminminlink','adminsublink','showAllDate','branceNam','adminWiseBrance'));
    }



       public function save(Request $Request){

      $this->validate($Request, [
            'serial' => 'required',
            'Name' => 'required',
            'Type' => 'required',
            'Brance' => 'required',
        ]);

         $insert = DB::table('packagetype')->insert(
    ['serialNo' => $Request->serial,'longName' =>$Request->lName, 'name' =>  $Request->Name ,'type' =>  $Request->Type , 'commision'=>$Request->Commision,'description' => $Request->description ,'fk_user_id' =>  $Request->adminid ,'fk_branc_id' =>  $Request->Brance]
        );
   

            if($insert){

          Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insert);

          }
          return redirect()->back();
    }


 public function Delete($id){

                $obj = DB::table('packagetype')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }


      public function model($id){
          
           $adminti =   Auth::guard('admin')->user();
          $branceNam = DB::table('branceinfo')->get();
            $data = DB::table('packagetype')
           ->join('branceinfo', 'branceinfo.id', '=', 'packagetype.fk_branc_id')
           ->select('branceinfo.name as branceName','packagetype.*')
           ->where('packagetype.id', '=', $id)->get();
          return view('Admin.PackageType.packageModel',compact('data','branceNam','adminti'));
    }

        public function update(Request $Request){

              $obj = DB::table('packagetype')
                    ->where('id', $Request->id)
                    ->update(['serialNo' => $Request->serial,'longName' =>$Request->lName,'name' => $Request->Name,'type' =>  $Request->Type,'commision'=>$Request->Commision,
                      'description' => $Request->description,'fk_user_id' =>  $Request->adminid,'fk_branc_id' =>  $Request->Brance]);

                  if($obj){

                Session::flash('success','Save Success');
                }else{

                  Session::flash('error',$obj);

                }
                return redirect()->back();

    }



}
