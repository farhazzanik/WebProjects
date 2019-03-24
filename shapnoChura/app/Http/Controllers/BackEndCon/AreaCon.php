<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use App\AreaModel;
use Auth;
use DB;
use Session;

class AreaCon extends Controller
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


       $allData =DB::table('areainfo')
            ->join('createadmin', 'createadmin.id', '=', 'areainfo.fk_user_id')
             ->join('branceinfo', 'branceinfo.id', '=', 'areainfo.fk_branc_id')
            ->select('areainfo.*', 'createadmin.name as adminname','branceinfo.name as brancName')
            ->get();

      $branWiseData = DB::table('areainfo')
            ->join('createadmin', 'createadmin.id', '=', 'areainfo.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'areainfo.fk_branc_id')
            ->select('areainfo.*', 'createadmin.name as adminname','branceinfo.name as brancName')
            ->where('areainfo.fk_branc_id',$id->fk_brance_id)
            ->get();

      $branceNam = DB::table('branceinfo')->get();
      
    	return view('Admin.Area.AreaInfo',compact('mainlink','id','sublink','Adminminlink','adminsublink','allData','branceNam','branWiseData'));
    }

    public function saveData(Request $Request){

      $this->validate($Request, [
            'Area' => 'required',
            'adminid' => 'required',
             'Brance' => 'required',
           
        
        ]);

        $area = new AreaModel;
        $area->area_name = $Request->Area;
        $area->fk_user_id = $Request->adminid;
        $area->description = $Request->description;
      $area->fk_branc_id = $Request->Brance;
        $area->save(); 

            if($area){

          Session::flash('success','Save Success');
          }else{

            Session::flash('error',$area);

          }
          return redirect()->back();
    }

 public function delete($id){

                $obj = DB::table('areainfo')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }


      public function EditModel($id){

 $adminti =   Auth::guard('admin')->user();
   $branceNam = DB::table('branceinfo')->get();
      
          $data = DB::table('areainfo')
            ->join('branceinfo', 'branceinfo.id', '=', 'areainfo.fk_branc_id')
            ->select('areainfo.*','branceinfo.name as brname')
            ->where('areainfo.id', '=', $id)->get();
          return view('Admin.Area.areamodel',compact('data','adminti','branceNam'));
    }

    public function editSuc(Request $Request){

              $obj = AreaModel::find($Request->id);

              $obj->area_name = $Request->Area;
              $obj->fk_user_id = $Request->adminid;
              $obj->description = $Request->description;
              $obj->fk_branc_id = $Request->Brance;
              $obj->save(); 

                  if($obj){

                Session::flash('success','Save Success');
                }else{

                  Session::flash('error',$obj);

                }
                return redirect()->back();

    }

    public function showaread(Request $Request,$branceid){

      if($Request->ajax()){
                    $results  =  DB::table('areainfo')
                      ->select('id as areaid','area_name')
                      ->where('areainfo.fk_branc_id',$branceid)
                    
                      ->get();
              return $results;
                         
                }
    }
}
