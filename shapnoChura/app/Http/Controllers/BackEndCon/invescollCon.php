<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use Session;
use DB;
use Redirect;
use URL;
class invescollCon extends Controller
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
       $branceNam = DB::table('branceinfo')->get();

         $allData =  DB::table('investcollection')
           ->join('memberinfo', 'memberinfo.id', '=', 'investcollection.fk_app_id')
           ->join('createadmin', 'createadmin.id', '=', 'investcollection.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'investcollection.fk_brance_id')
           ->select('memberinfo.mem_name','investcollection.*','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('investcollection.date', 'DESC')
          ->get();

        $branWiseData = DB::table('investcollection')
           ->join('memberinfo', 'memberinfo.id', '=', 'investcollection.fk_app_id')
           ->join('createadmin', 'createadmin.id', '=', 'investcollection.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'investcollection.fk_brance_id')
           ->select('memberinfo.mem_name','investcollection.*','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('investcollection.date', 'DESC')
            ->where('investcollection.fk_brance_id',$id->fk_brance_id)
            ->get();


      

       return  view('Admin.invest.investCollection',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','allData','branWiseData'));
    }


    public function show(Request $request,$getid,$id1){

    	 if($request->ajax()){
    	 		
    	 		 
    	 	$data=DB::table('investlatter')
              ->join('memberinfo','memberinfo.id','=','investlatter.appName')
              ->select('memberinfo.mem_name','investlatter.*')
              ->where('investlatter.fk_brance_id',$id1)
              ->where('investlatter.type',$getid)
               ->where('investlatter.status','1')
              ->get();
    	 		return $data;
    	 }

    }

      public function showTotal(Request $request,$getid){

    	 if($request->ajax()){
    	 		
    	  	$data=DB::table('investlatter') 
          ->join('memberinfo','memberinfo.id','=','investlatter.appName')
          ->select('memberinfo.mem_name','investlatter.*')
          ->where('investlatter.id',$getid) ->where('investlatter.status','1')->get();
    	  
             return response()->json([
              'totalinvest'=>$data[0]->invesQuanT,
              'Dividend' => $data[0]->divendend,
              'todaytk'=>$data[0]->instalAmm,
              'todaydivend' => $data[0]->inswisedivendend,
              'memname' => $data[0]->mem_name,
             'brance' => $data[0]->fk_brance_id,
              'Type'=>$data[0]->type,
              'memid' => $data[0]->appName]);
    	 }

    }


public function totalIns(Request $request,$getid1){

       if($request->ajax()){
          
         $data=DB::table('investcollection')
         ->join('investlatter','investlatter.id','=','investcollection.fk_invest_id')
            ->where('investcollection.fk_invest_id',$getid1)
        ->where('investlatter.status','1')
            ->count('investcollection.id') ;
            
            

        
          return $data+1;
       }

    }


     public function showPrevious(Request $request,$id1){

    	 if($request->ajax()){
    	 		
    	 	 $data=DB::table('investcollection')
    	 	 ->where('fk_app_id',$id1)
		    	 	
    	 			->sum('today_inv') ;
		    	 	
		    	 	

    	 	
    	 		return $data;
    	 }

    }


    public function saveData(Request $Request){

    		$this->validate($Request, [
		       
		        'Name' => 'required',
		        'date' => 'required',
		        'todaytk' => 'required',
             'totalinvest' => 'required',
            'todaytk' => 'required',
            
		    ]);


        $explode = explode('/',  $Request->Name);
        $explodedate = explode('-', $Request->date);
        $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

          $sql =DB::select("SELECT SUM(`tody_inves`) AS totalsubmission,`investcollection`.* FROM `investcollection` WHERE `fk_invest_id`='$Request->Name'");
         $netsubmission = $sql[0]->totalsubmission+$Request->todaytk;

        //   $chetotalinvest = DB::table('investlatter')
        //                   ->select('invesQuanT')
        //                   ->where('id',$Request->Name)
        //                   ->get();

        //  if($chetotalinvest[0]->invesQuanT >=$netsubmission)
        
        $chetotalinvest = DB::table('investlatter')
                          ->select('invesQuanT','divendend')
                          ->where('id',$Request->Name)
                          ->get();
            $sum = $chetotalinvest[0]->invesQuanT + $chetotalinvest[0]->divendend;

         if($sum  >=$netsubmission)
        {

		     $insertDate = DB::table('investcollection')->insert(
						    ['date' =>  $renewdate, 
						    'fk_app_id' => $Request->memid, 
                'fk_invest_id' => $Request->Name, 
						    'type' => $Request->Type,
						    'total_inv' => $Request->totalinvest, 
						    'divended' => $Request->Dividend,
						    'tody_inves' => $Request->todaytk,
                'inves_wise_deven' => $Request->todaydivend,
                'ins_no'  => $Request->Installment,
						    'comments' => $Request->comments,
						    'fk_brance_id' => $Request->Brance,
						    'fk_user_id' => $Request->adminid,
                'details'=> $Request->Details]
						);

  $lastid=DB::table('investcollection')
               ->orderby('id','DESC')
              ->limit(1)
              ->get();
    			if($insertDate){



       $sqlcheck = DB::table('sms_set_for_saving')
            ->join('memberinfo','memberinfo.id','=','sms_set_for_saving.fk_mem_id')
            ->select('sms_set_for_saving.sav_id','sms_set_for_saving.*','memberinfo.con_no','memberinfo.mem_name')
            ->where('sms_set_for_saving.sav_id',$Request->Name)
            ->where('sms_set_for_saving.status','1')
             ->get();

                      if(count($sqlcheck) >0){

      $from_number = "sopno cura";
      $text = "Name =".$sqlcheck[0]->mem_name.',Today invest
 ='.$Request->todaytk.',Today Dividend
 ='.$Request->todaydivend;
       $to_numbers=$sqlcheck[0]->con_no;
      $api_url = "http://107.20.199.106/restapi/sms/1/text/single";
      $msg=$this->send_msg($api_url, $from_number, $to_numbers, $text);


                      }

          // return URl::to('showReportinv').'/'.$lastid[0]->id;
    				Session::flash('success','Save Success');
    			}else{

    				Session::flash('error',$insertDate);

    			}
        }
        else
        {
          Session::flash('error','Invest Already Finished..');
        }

    			return redirect()->back();
    }

    

    function send_msg($api_url,$from_number, $to_numbers, $text)
  {   
    $post_data = json_encode(array("from" => $from_number, "to" => $to_numbers, "text" => $text));
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type:application/json", "Accept: application/json", "Authorization: Basic c2JpdDo1WVRwZlhxbw=="));
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    
    curl_exec($ch);
    
    if($errno = curl_errno($ch)) 
    {
        $error_message = curl_strerror($errno);
        $error_message = "cURL error ({$errno}):\n {$error_message}";
    }
    else
      $error_message = true;
   
    curl_close($ch);
    
    return $error_message;
    
    }


    public function deleteData($id){

                $obj = DB::table('investcollection')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }


      //inves collection report

     public function investcolreport(Request $Request){

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

       $allyear = DB::table('investcollection')
        ->select(DB::raw('substr(date, 1, 4) as date'))
        ->groupby(DB::raw('substr(date, 1, 4)'))
        ->get();

       return view('Admin.invest.investcollreport',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','allyear'));
    }

      public function showMemcollreport(Request $request,$id,$id1){


       if($request->ajax()){
                    $results = DB::table('investcollection')
                    ->join('memberinfo','memberinfo.id','=','investcollection.fk_app_id')
                    ->groupby('investcollection.fk_invest_id')
                    ->where('investcollection.type', '=', $id)
                    ->where('investcollection.fk_brance_id', '=', $id1)
                    ->select('memberinfo.mem_name','investcollection.*')
                    
                    ->get();
              return $results;
                         
                }

      
    }


    public function showcollReaporttab(Request $Request){

      
    
   $month = $Request->month;
   $year = $Request->year;
      $allname=    $Request->Name;
     $explode = explode('and', $Request->Name);
     if ($Request->Name == '') {
        $invest =  DB::table('investcollection')
              ->join('memberinfo','memberinfo.id','=','investcollection.fk_app_id')
              ->join('createadmin', 'createadmin.id', '=', 'investcollection.fk_user_id')

              ->join('branceinfo', 'branceinfo.id', '=', 'investcollection.fk_brance_id')    
              

              ->join('investlatter', 'investlatter.id', '=', 'investcollection.fk_invest_id') 
              

              ->join('areainfo', 'areainfo.id', '=', 'investlatter.fk_area_id') 


              // ->where('investcollection.fk_app_id',$explode[0])
              // ->where('investcollection.fk_invest_id',$explode[1])   
              ->where('investcollection.fk_brance_id',$Request->Brance)
              ->where('investcollection.type',$Request->Type)
              ->where(DB::raw("substr(investcollection.date, 6, 2)"), '=',$month)
              ->where(DB::raw("substr(investcollection.date, 1, 4)"), '=',$Request->year)
              ->orderby('investcollection.date','ASC')
              ->select('createadmin.name as adminname','areainfo.area_name','branceinfo.name','memberinfo.*','investcollection.*','investlatter.expireDate')
              ->get();

       $investnettcole = DB::select("SELECT  `memberinfo`.mem_name, `investcollection`.fk_invest_id,
 investcollection.tody_inves,investcollection.inves_wise_deven,investcollection.type,investcollection.date
FROM `investcollection`
INNER JOIN `memberinfo` ON `memberinfo`.`id` = `investcollection`.`fk_app_id`
INNER JOIN `investlatter` ON `investlatter`.`id` = `investcollection`.`fk_invest_id`
WHERE  `investcollection`.`fk_brance_id` = '$Request->Brance' AND `investcollection`.`type` = '$Request->Type' 
 AND SUBSTR(investcollection.date, 6, 2) = '$month' AND SUBSTR(investcollection.date, 1, 4) = '$Request->year'
ORDER BY SUBSTR(investcollection.fk_invest_id, 15,6)");
     }
     else
     {
         
         $inv = DB::table('investlatter')
                ->join('areainfo', 'areainfo.id', '=', 'investlatter.fk_area_id')
                ->where('investlatter.id',$explode[1]) 
                ->select('areainfo.area_name')
                ->first();
                
       $invest =  DB::table('investcollection')
              ->join('memberinfo','memberinfo.id','=','investcollection.fk_app_id')
              ->join('createadmin', 'createadmin.id', '=', 'investcollection.fk_user_id')

              ->join('branceinfo', 'branceinfo.id', '=', 'investcollection.fk_brance_id')    
              

              ->join('investlatter', 'investlatter.id', '=', 'investcollection.fk_invest_id') 
              

            //   ->join('areainfo', 'areainfo.id', '=', 'investlatter.fk_area_id') 


              ->where('investcollection.fk_app_id',$explode[0])
              ->where('investcollection.fk_invest_id',$explode[1])   
              ->where('investcollection.fk_brance_id',$Request->Brance)
              ->where('investcollection.type',$Request->Type)
              ->where(DB::raw("substr(investcollection.date, 6, 2)"), '=',$month)
              ->where(DB::raw("substr(investcollection.date, 1, 4)"), '=',$Request->year)
              ->orderby('investcollection.date','ASC')
              ->select('createadmin.name as adminname','branceinfo.name','memberinfo.*','investcollection.*','investlatter.expireDate','investlatter.businessAdd','investlatter.appDate as applicationdate')
              ->get();

         $sum =  DB::table('investcollection')
              
              ->where('investcollection.fk_app_id',$explode[0])
              ->where('investcollection.fk_invest_id',$explode[1])   
              ->where('investcollection.fk_brance_id',$Request->Brance)
              ->where('investcollection.type',$Request->Type)
              ->where(DB::raw("substr(investcollection.date, 6, 2)"), '=',$month)
              ->where(DB::raw("substr(investcollection.date, 1, 4)"), '=',$Request->year)
              ->sum('investcollection.tody_inves');
              

 $divenden =  DB::table('investcollection')
              
              ->where('investcollection.fk_app_id',$explode[0])
              ->where('investcollection.fk_invest_id',$explode[1])   
              ->where('investcollection.fk_brance_id',$Request->Brance)
              ->where('investcollection.type',$Request->Type)
              ->where(DB::raw("substr(investcollection.date, 6, 2)"), '=',$month)
              ->where(DB::raw("substr(investcollection.date, 1, 4)"), '=',$Request->year)
              ->sum('investcollection.inves_wise_deven');

              $netammount = $sum - $divenden; 
     }
  

     return view('Admin.invest.showInvesColReporttab',compact('invest','month','year','oldinvest','sum','divenden','netammount','areainfo.area_name','branceinfo.name','allname','investnettcole','inv'));


    }


       public function showmeminvcon(Request $request,$getid,$id1){

       if($request->ajax()){
          
           
      return  $data=DB::table('investcollection')
              ->join('memberinfo','memberinfo.id','=','investcollection.fk_app_id')
              ->select('memberinfo.mem_name','investcollection.*')
              ->where('investcollection.fk_brance_id',$id1)
              ->where('investcollection.type',$getid)
              ->get();
          return $data;
       }

    }

    public function showReport(Request $Request,$id){

 $invest =  DB::table('investcollection')
              ->join('memberinfo','memberinfo.id','=','investcollection.fk_app_id')
              ->join('createadmin', 'createadmin.id', '=', 'investcollection.fk_user_id')
              ->where('investcollection.id',$id)
              ->select('createadmin.name as adminname','memberinfo.*','investcollection.*')
              ->get();
      return view('Admin.invest.invesdatewisereport',compact('invest'));
    }



    public function Finishedinvest(){

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

       $allyear = DB::table('savingcollection')
        ->select(DB::raw('substr(date, 7, 4) as date'))
        ->groupby(DB::raw('substr(date, 7, 4)'))
        ->get();

       return view('Admin.invest.Finishedinvest',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','allyear'));
    }

    public function showfinishinvestdata($branceid,$from,$to,$type){



             $data = DB::select("SELECT SUM(`tody_inves`) AS totalinves,SUM(`inves_wise_deven`) AS totaldeven,`memberinfo`.`mem_name`,`investcollection`.*
FROM `investcollection` INNER JOIN `memberinfo` ON `memberinfo`.`id` = `investcollection`.`fk_app_id` where `investcollection`.`fk_brance_id`='$branceid' AND `investcollection`.`type`='$type' 
GROUP BY `investcollection`.`fk_invest_id` LIMIT $from,$to");
            return view('Admin.invest.showfininvdata',compact('data'));
    }

    public function finshedinvedeactive($id){

                $obj = DB::table('investlatter')
                    ->where('id', '=', $id)
                    ->update([
                        'status' => '2'
                    ]);
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Update Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Update Unsuccessfully']);

            }


    }



}
