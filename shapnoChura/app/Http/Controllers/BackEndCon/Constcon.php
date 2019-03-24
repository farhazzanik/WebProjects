<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use Session;
use DB;
class Constcon extends Controller
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

        $allData =DB::table('costinfo')
            ->join('createadmin', 'createadmin.id', '=', 'costinfo.fk_user_id')
             ->join('branceinfo', 'branceinfo.id', '=', 'costinfo.fk_brance_id')
            ->select('costinfo.*', 'createadmin.name as adminname','branceinfo.name as brancName')
            ->get();

      $branWiseData = DB::table('costinfo')
            ->join('createadmin', 'createadmin.id', '=', 'costinfo.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'costinfo.fk_brance_id')
            ->select('costinfo.*', 'createadmin.name as adminname','branceinfo.name as brancName')
            ->where('costinfo.fk_brance_id',$id->fk_brance_id)
            ->get();

       $branceNam = DB::table('branceinfo')->get();
    		return view('Admin.cost.costinfo',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','branWiseData','allData'));
    }

    public function save(Request $Request){


			$this->validate($Request, [
		        'Brance' => 'required',
		        'date' => 'required',
		        'Title' => 'required',
		        
		    ]);

		    $insertDate = DB::table('costinfo')->insert(
						    ['date' =>  $Request->date, 
						    'title' => $Request->Title, 
						     'inc_exp' => $Request->inc_exp, 
						    'comment' => $Request->comments,
						    'fk_brance_id' => $Request->Brance, 
						    'fk_user_id' => $Request->adminid, 
                'stitle' => $Request->sTitle]
						);

    			if($insertDate){

    				Session::flash('success','Save Success');
    			}else{

    				Session::flash('error',$insertDate);

    			}
    			return redirect()->back();


    }
    public function delete($id){

                $obj = DB::table('costinfo')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }

    public function editCost($getid){

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
 $branceNam = DB::table('branceinfo')->get();
     	 $data = DB::table('costinfo')
    	  ->join('branceinfo', 'branceinfo.id', '=', 'costinfo.fk_brance_id')
            ->select('costinfo.*', 'branceinfo.name as brancName')
            ->where('costinfo.id',$getid)->get();
    	return view('Admin.cost.costedit',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data'));
    }

    public function editsucc(Request $Request){

    	   $obj = DB::table('costinfo')
                    ->where('id', $Request->id)
                    ->update(['date' => $Request->date,
 'inc_exp' => $Request->inc_exp, 
 'title' => $Request->Title,
                      'comment' => $Request->comments,'fk_brance_id' =>  $Request->Brance,'fk_user_id' =>  $Request->adminid, 
                'stitle' => $Request->sTitle]);

    			if($obj){

    				Session::flash('success','Update Success');
    			}else{

    				Session::flash('error',$obj);

    			}
    			return redirect()->back();
    }

}
