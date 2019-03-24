<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use Session;
use DB;
class BarcodeCon extends Controller
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
     $allData =  DB::table('branceinfo')->get();
   $branceNam = DB::table('branceinfo')->get();
    	return view('Admin.Report.barcode',compact('mainlink','id','sublink','Adminminlink','adminsublink','allData','branceNam'));
    }


    public function showreport(Request $Request){


    		$this->validate($Request, [
		        'Brance' => 'required',
		        'Type' => 'required',
		        'pacType' => 'required',
		        'from' => 'required',
		        'to' => 'required',
	             
            
		    ]);




    	if($Request->pacType == '1'){
				 $data = DB::table('memeradd')
				->select('Addid as barid')
					->where('type',$Request->Type)
					->where('fk_brance_id',$Request->Brance)
					->skip($Request->from)
					->take($Request->to)
					->get();
    	}else{
    		 $data = DB::table('investlatter')
    				->select('id as barid')
					->where('type',$Request->Type)
					->where('fk_brance_id',$Request->Brance)
					->skip($Request->from)
					->take($Request->to)
					->get();
    	}

    	
    	 return view('Admin.Report.showbarcodegen',compact('data'));
    }
}
