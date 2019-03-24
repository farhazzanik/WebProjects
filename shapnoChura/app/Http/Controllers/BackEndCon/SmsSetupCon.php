<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use DB;
use Session;
class SmsSetupCon extends Controller
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

      $showAllDate  = DB::table('sms_price_initia')
            ->join('createadmin', 'createadmin.id', '=', 'sms_price_initia.fk_user_id')
             ->join('branceinfo', 'branceinfo.id', '=', 'sms_price_initia.fk_brance_id')
            ->select('sms_price_initia.*', 'createadmin.name as adminname','branceinfo.name as brancename')
            
            ->get();


     $adminWiseBrance  = DB::table('sms_price_initia')
            ->join('createadmin', 'createadmin.id', '=', 'sms_price_initia.fk_user_id')
             ->join('branceinfo', 'branceinfo.id', '=', 'sms_price_initia.fk_brance_id')
            ->select('sms_price_initia.*', 'createadmin.name as adminname','branceinfo.name as brancename')
            ->where('sms_price_initia.fk_brance_id',$id->fk_brance_id)
            ->get();

            

          $branceNam = DB::table('branceinfo')->get();



    	return view('Admin.sms.tkinitailize',compact('mainlink','id','sublink','Adminminlink','adminsublink','showAllDate','branceNam','adminWiseBrance'));
    }

    public function SmsSetupCon(Request $Request){


    		   $this->validate($Request, [
		            'Brance' => 'required',
		          	'Type' => 'required',
		            'Ammount' => 'required',
       		 ]);


    		      $insert = DB::table('sms_price_initia')->insert(
				    ['ammount' => $Request->Ammount,
				    'fk_type_id' =>  $Request->Type ,
				    'fk_user_id' =>  $Request->adminid ,
				    'fk_brance_id' =>  $Request->Brance]
        			);
   

            if($insert){

          Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insert);

          }
          return redirect()->back();


    }

 

     public function Deletesms($id){

                $obj = DB::table('sms_price_initia')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }


      public function indexx(){

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

      $showAllDate  = DB::table('sms_price_initia')
            ->join('createadmin', 'createadmin.id', '=', 'sms_price_initia.fk_user_id')
             ->join('branceinfo', 'branceinfo.id', '=', 'sms_price_initia.fk_brance_id')
            ->select('sms_price_initia.*', 'createadmin.name as adminname','branceinfo.name as brancename')
            
            ->get();


     $adminWiseBrance  = DB::table('sms_price_initia')
            ->join('createadmin', 'createadmin.id', '=', 'sms_price_initia.fk_user_id')
             ->join('branceinfo', 'branceinfo.id', '=', 'sms_price_initia.fk_brance_id')
            ->select('sms_price_initia.*', 'createadmin.name as adminname','branceinfo.name as brancename')
            ->where('sms_price_initia.fk_brance_id',$id->fk_brance_id)
            ->get();

            

          $branceNam = DB::table('branceinfo')->get();



    	return view('Admin.sms.smssetup',compact('mainlink','id','sublink','Adminminlink','adminsublink','showAllDate','branceNam','adminWiseBrance'));
    }


    public function showDatamem($branceid,$from,$to,$type){


    	if($type == '1')
    	{
    		$vale =  DB::table('sms_set_for_saving')->where('type','1')->get();

    		 $data = DB::table('memeradd')
    				->join('memberinfo','memberinfo.id','=','memeradd.memberName')
    				->select('memeradd.Addid','memeradd.memberName','memberinfo.con_no','memberinfo.mem_name')
    				->groupBy('memeradd.Addid')
    				->where('memeradd.status','1')
    				->where('memeradd.fk_brance_id',$branceid)
    				->skip($from)
    				->take($to)->get();
    	}else{
$vale =  DB::table('sms_set_for_saving')->where('type','2')->get();
$data = DB::table('investlatter')
    				->join('memberinfo','memberinfo.id','=','investlatter.appName')
    				->select('investlatter.id','investlatter.appName','memberinfo.con_no','memberinfo.mem_name')
    				->groupBy('investlatter.id')
    				->where('investlatter.fk_brance_id',$branceid)
    				->skip($from)
    				->take($to)
    				->get();
    	}

    	 return view('Admin.sms.showdata',compact('data','type','vale'));

    }

    public function savesmssetup(Request $request){

    			if($request->Type =='1'){



    					if(count($request->conno) > 0){

    							for($i=0; $i<count($request->conno); $i++){

    								$expolaid=explode('and',$request->conno[$i]);
    								$fffff = DB::table('sms_set_for_saving')->insert(
										    ['sav_id' => $expolaid[0], 
										    'fk_mem_id' => $expolaid[1], 
										    'status' => '1',
										    'fk_user_id' => $request->adminid,
										    'type' => '1',
										    'fk_brance_id' => $request->Brance  ]
										);



    							}
    					}


    			}
    			else{

    					if(count($request->conno) > 0){

    							for($i=0; $i<count($request->conno); $i++){

    								$expolaid=explode('and',$request->conno[$i]);
    								$fffff = DB::table('sms_set_for_saving')->insert(
										    ['sav_id' => $expolaid[0], 
										    'fk_mem_id' => $expolaid[1], 
										    'status' => '1',
										    'fk_user_id' => $request->adminid,
										    'type' => '2',
										    'fk_brance_id' => $request->Brance  ]
										);



    							}
    					}

    			}



  if($fffff){

          Session::flash('success','Save Success');
          }else{

           return redirect()->back();

          }



    			return redirect()->back();
    }



    public function ShowMsgSetup(){

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

      $showAllDate  = DB::table('sms_price_initia')
            ->join('createadmin', 'createadmin.id', '=', 'sms_price_initia.fk_user_id')
             ->join('branceinfo', 'branceinfo.id', '=', 'sms_price_initia.fk_brance_id')
            ->select('sms_price_initia.*', 'createadmin.name as adminname','branceinfo.name as brancename')
            
            ->get();


     $adminWiseBrance  = DB::table('sms_price_initia')
            ->join('createadmin', 'createadmin.id', '=', 'sms_price_initia.fk_user_id')
             ->join('branceinfo', 'branceinfo.id', '=', 'sms_price_initia.fk_brance_id')
            ->select('sms_price_initia.*', 'createadmin.name as adminname','branceinfo.name as brancename')
            ->where('sms_price_initia.fk_brance_id',$id->fk_brance_id)
            ->get();

            

          $branceNam = DB::table('branceinfo')->get();



    	return view('Admin.sms.ShowMsgSetup',compact('mainlink','id','sublink','Adminminlink','adminsublink','showAllDate','branceNam','adminWiseBrance'));

    }

  public function smssetupdata($branceid,$from,$to,$type){


    	if($type == '1')
    	{
    	
    		 $data = DB::table('sms_set_for_saving')
    				->join('memberinfo','memberinfo.id','=','sms_set_for_saving.fk_mem_id')
    				->select('sms_set_for_saving.sav_id','sms_set_for_saving.*','memberinfo.con_no','memberinfo.mem_name')
    				->groupBy('sms_set_for_saving.sav_id')
    				->where('sms_set_for_saving.type','1')
    				->where('sms_set_for_saving.fk_brance_id',$branceid)
    				->skip($from)
    				->take($to)->get();
    	}else{

 			$data = DB::table('sms_set_for_saving')
    				->join('memberinfo','memberinfo.id','=','sms_set_for_saving.fk_mem_id')
    				->select('sms_set_for_saving.sav_id','sms_set_for_saving.*','memberinfo.con_no','memberinfo.mem_name')
    				->groupBy('sms_set_for_saving.sav_id')
    				->where('sms_set_for_saving.type','2')
    				->where('sms_set_for_saving.fk_brance_id',$branceid)
    				->skip($from)
    				->take($to)->get();
    	}

    	 return view('Admin.sms.showdatasetup',compact('data','type'));

    }




     public function deletesmssetup($id){

                $obj = DB::table('sms_set_for_saving')->where('sav_id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }
}



     public function activetodec($id){

                $obj = DB::table('sms_set_for_saving')
                ->where('sav_id', '=', $id)
                ->update(['status' => '2']);
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Update Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Update Unsuccessfully']);

            }
}


     public function dectoac($id){

                $obj = DB::table('sms_set_for_saving')
                ->where('sav_id', '=', $id)
                ->update(['status' => '1']);
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Update Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Update Unsuccessfully']);

            }
}





}
