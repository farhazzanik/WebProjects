<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use Session;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;
class savingCollCon extends Controller
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

       $allData =  DB::table('savingcollection')
           ->join('memberinfo', 'memberinfo.id', '=', 'savingcollection.mem_id')
            ->join('packagetype', 'packagetype.id', '=', 'savingcollection.type')
           ->join('createadmin', 'createadmin.id', '=', 'savingcollection.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'savingcollection.fk_brance_id')
           ->select('memberinfo.mem_name','savingcollection.*','packagetype.name','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('savingcollection.date', 'DESC')
          ->get();

        $branWiseData =  DB::table('savingcollection')
           ->join('memberinfo', 'memberinfo.id', '=', 'savingcollection.mem_id')
             ->join('packagetype', 'packagetype.id', '=', 'savingcollection.type')
           ->join('createadmin', 'createadmin.id', '=', 'savingcollection.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'savingcollection.fk_brance_id')
           ->select('memberinfo.mem_name','savingcollection.*','packagetype.name','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('savingcollection.date', 'DESC')
            ->where('savingcollection.fk_brance_id',$id->fk_brance_id)
            ->get();
              $packageType = DB::table('packagetype')
                      ->orderBy('packagetype.serialNo', 'ASC')
                      ->where('type','1')
                      ->get();

       return  view('Admin.savingcollection.savecollection',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','allData','branWiseData','packageType'));
    }


    public function profitwithsave(Request $Request){



  $explodedate = explode('-', $Request->date);
        $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];


      $this->validate($Request, [
            'tWithdraw' => 'required',
           
            
        ]);




      try {
        

        $insertDate = DB::table('profitwithdraw')->insert(
                ['date' =>  $renewdate,
                  'accno' =>   $Request->Name,
                  'tdeposit' =>   $Request->Previous,
                  'tprofit' =>   $Request->profit,
                  'twithdraw' =>   $Request->tWithdraw,
                  'comments' =>   $Request->comments,
                  'fk_brance_id' =>   $Request->Brance,
                  'fk_mem_id' =>   $Request->memid,
                  'fk_user_id' =>   $Request->adminid,
                  'fk_pack_id' =>   $Request->Type
]);



        if($insertDate){

            Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insertDate);

          }




      } catch (\Exception  $e) {
          return $e;
      }
      return redirect()->back();


    }

    public function savecoll(Request $Request){

        $this->validate($Request, [
            'Brance' => 'required',
            'Type' => 'required',
            'Name' => 'required',
            'date' => 'required',
            
        ]);

$explodedate = explode('-', $Request->date);
$createdate  = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

$explode = explode('/', $Request->Name);

 $precollect=DB::table('savingcollection')
         ->where('mem_add_id',$Request->Name)
            ->where('mem_id',$Request->memid)
            ->sum('today_dep');


 $prewithdraw=DB::table('savingcollection')
         ->where('mem_add_id',$Request->Name)
            ->where('mem_id',$Request->memid)
            ->sum('today_withdraw');






if($Request->todaywithdraw  != ""){

  $netwithdraw = $Request->Previouswith+$Request->todaywithdraw;
$todayDeposit = $Request->todaytk-$Request->todaywithdraw;

 $netdeposit = $precollect-$prewithdraw+$todayDeposit;
}else{
 $netwithdraw = $prewithdraw;
 $netdeposit = $precollect-$prewithdraw+$Request->todaytk;

}

 $explodes = explode('-', $Request->date);
      $renewdats =  $explodes[2].'-'.$explodes[1].'-'.$explodes[0];  
 
$resutl = DB::table('savingcollection')
            ->where('mem_id',$Request->memid)
              ->where('mem_add_id',$Request->Name)
            //   ->where('date',$renewdats)
               ->where('type',$Request->Type)
              ->get();

if(count($resutl) < 0){

 Session::flash('success','not Exist');
           

}else{


          $insertDate = DB::table('savingcollection')->insert(
                ['date' =>  $createdate, 
                'mem_id' => $Request->memid, 
                 'mem_add_id' => $Request->Name, 
                'type' => $Request->Type,
                'total_dep' => $Request->Saving, 
                'net_dep' => $netdeposit,
                'today_dep' => $Request->todaytk,

                
               
                'net_withdraw' => $netwithdraw,
                'today_withdraw' => $Request->todaywithdraw,


                'ins_no' => $Request->Installment,
                'comments' => $Request->comments,
                'fk_brance_id' => $Request->Brance,
                'fk_user_id' => $Request->adminid,
                'details' => $Request->Details]
            );
      



if($insertDate){


      $sqlcheck = DB::table('sms_set_for_saving')
            ->join('memberinfo','memberinfo.id','=','sms_set_for_saving.fk_mem_id')
            ->select('sms_set_for_saving.sav_id','sms_set_for_saving.*','memberinfo.con_no','memberinfo.mem_name')
            ->where('sms_set_for_saving.sav_id',$Request->Name)
            ->where('sms_set_for_saving.status','1')
             ->get();

                      if(count($sqlcheck) >0){

      $from_number = "sopno cura";
      $text = "Name =".$sqlcheck[0]->mem_name.',Today submission
 ='.$Request->todaytk.',Today Withdraw
 ='.$Request->todaywithdraw;
       $to_numbers=$sqlcheck[0]->con_no;
      $api_url = "http://107.20.199.106/restapi/sms/1/text/single";
      $msg=$this->send_msg($api_url, $from_number, $to_numbers, $text);


                      }

            Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insertDate);

          }

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




     public function shwoMem(Request $request,$id,$id1){


       if($request->ajax()){
                    $results = DB::table('memeradd')
                    ->join('memberinfo','memeradd.memberName','=','memberinfo.id')
                    ->where('memeradd.type', '=', $id)
              ->where('memeradd.fk_brance_id', '=', $id1)
              ->where('memeradd.status', '=', '1')
              ->select('memeradd.Addid','memberinfo.mem_name','memberinfo.id')
              ->get();
              return $results;
                         
                }

      
    }



    public function show(Request $request,$id1){

       if($request->ajax()){
          
           
        $data=DB::table('memeradd')
          ->join('memberinfo','memeradd.memberName','=','memberinfo.id')
           ->select('memeradd.*','memberinfo.mem_name')
        ->where('memeradd.Addid',$id1) ->where('memeradd.status', '=', '1')->get();

          return response()->json(['memname'=>$data[0]->mem_name,'ammount'=>$data[0]->Periodic,'brance'=>$data[0]->fk_brance_id,'type'=>$data[0]->PackageName,'memid'=>$data[0]->memberName]);
        
       }

    }




    public function showprofit(Request $request,$id1){

       if($request->ajax()){
          
           
        $data = DB::table('memeradd')
               ->join('memberinfo','memeradd.memberName','=','memberinfo.id')
               ->select('memeradd.*','memberinfo.mem_name')
               ->where('memeradd.Addid',$id1) ->where('memeradd.status', '=', '1')->get();

        $savdate1s = DB::table('savingcollection')
                    ->orderby('date','ASC')
                    ->where('savingcollection.mem_add_id',$id1)
                     ->limit(1)
                  ->get();

         $lsatdate = DB::table('savingcollection')
                    ->orderby('date','DESC')
                    ->where('savingcollection.mem_add_id',$id1)
                     ->limit(1)
                   ->get();

 $deletequery =   $obj = DB::table('sessionprofitreport')->delete();
$converfrstdate =  $savdate1s[0]->date;
$convertsnddate =  $lsatdate[0]->date;


   $begin = new DateTime($converfrstdate);
$end = new DateTime($convertsnddate);


$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);



 foreach($daterange as $date){

     $searchdate = $date->format("Y-m-d");
     
     $lastrate = DB::table('intialrate')
              ->where('schema','=', $data[0]->PackageName)
            ->where('date','<=',$searchdate)
              ->orderby('date','DESC')
              ->limit(1)
              ->get();

    
    $lastammount = DB::table('savingcollection')
            ->where('date','<=',$searchdate)
              ->sum('today_dep');

    
    $lastwithdraw = DB::table('savingcollection')
            ->where('date','<=',$searchdate)
              ->sum('today_withdraw');      
    
    $exactammount = $lastammount-$lastwithdraw;

    $profit = (($lastrate[0]->Rate  * $exactammount)/365);

    $insertDate = DB::table('sessionprofitreport')->insert(
                ['date' =>  $searchdate, 
                 'lastammount' => $exactammount, 
                 'rate' => $lastrate[0]->Rate, 
                'profits' => $profit]);
    
                
          
 }
    $totalprofit = DB::table('sessionprofitreport')->sum('profits');

    $showpreviousprof =  DB::table('profitwithdraw')->where('accno',$id1)->sum('twithdraw');

          return response()->json([ 'memname'=>$data[0]->mem_name,
                                    'ammount'=>$data[0]->Periodic,
                                    'brance'=>$data[0]->fk_brance_id,
                                    'type'=>$data[0]->PackageName,
                                    'memid'=>$data[0]->memberName,
                                    'profit'=>$totalprofit, 'prpro' => $showpreviousprof]);


        
       }



    }


    

     public function showpre(Request $request,$id1){

       if($request->ajax()){
          
         $netdeposit=DB::table('savingcollection')
         ->join('memeradd','memeradd.Addid','=','savingcollection.mem_add_id')
         ->where('savingcollection.mem_add_id',$id1)
          ->where('memeradd.status', '=', '1')
         ->sum('savingcollection.today_dep') ;
            
       $netwithdras=DB::table('savingcollection')
         ->join('memeradd','memeradd.Addid','=','savingcollection.mem_add_id')
         ->where('savingcollection.mem_add_id',$id1)
          ->where('memeradd.status', '=', '1')
         ->sum('today_withdraw') ;

        $data = $netdeposit - $netwithdras;
          return $data;
       }

    }

public function showINs(Request $request,$id1){

       if($request->ajax()){
          
         $data=DB::table('savingcollection')
         ->join('memeradd','memeradd.Addid','=','savingcollection.mem_add_id')
         ->where('savingcollection.mem_add_id',$id1)
          ->where('memeradd.status', '=', '1')
         
            ->count('id') ;
         return $data+1;
       }

    }




    public function delete($id){

                $obj = DB::table('savingcollection')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }


    //report for saving collection

    public function savcollreport(Request $Request){

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
 $packageType = DB::table('packagetype')
                      ->orderBy('packagetype.serialNo', 'ASC')
                      ->where('type','1')
                      ->get();
       return view('Admin.savingcollection.savingcollreport',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','allyear','packageType'));
    }


  public function showMemcollreport(Request $request,$id,$id1){


       if($request->ajax()){
                    $results = DB::table('savingcollection')
                    ->join('memberinfo','memberinfo.id','=','savingcollection.mem_id')
                    ->where('savingcollection.type', '=', $id)
                    ->where('savingcollection.fk_brance_id', '=', $id1)
                    ->groupby('savingcollection.mem_add_id')
                    ->select('memberinfo.mem_name','savingcollection.*')
                    ->get();
              return $results;
                         
                }

      
    }


    public function showcollReaporttab(Request $Request){

  $explode=explode('/', $Request->Name);
  $month = $Request->month;
  $year = $Request->year;

    $frstdate = $Request->frstdate;
    $sndate = $Request->snddate;
   $name = $Request->Name;

 $exfstdate=explode('-', $Request->frstdate);
  $exsnddate=explode('-', $Request->snddate);
    
    $converfrstdate = $exfstdate[2].'-'.$exfstdate[1].'-'.$exfstdate[0];
     $convertsnddate = $exsnddate[2].'-'.$exsnddate[1].'-'.$exsnddate[0];
   

        if($Request->Name == '')
        {
            
            $type = DB::table('packagetype')
                    ->where('id',$Request->Type)
                    ->first();
            
            
            $todayrecieveammount=DB::select("SELECT `createadmin`.`name` AS `adminname`, `areainfo`.`area_name`, `branceinfo`.`name`,
 `memberinfo`.*, `memeradd`.`todaydate`, `savingcollection`.*, `savingcollection`.`date`,
  `memeradd`.`PackageExdate`
FROM `savingcollection`
INNER JOIN `memberinfo` ON `memberinfo`.`id` = `savingcollection`.`mem_id`
INNER JOIN `createadmin` ON `createadmin`.`id` = `savingcollection`.`fk_user_id`
INNER JOIN `branceinfo` ON `branceinfo`.`id` = `savingcollection`.`fk_brance_id`
INNER JOIN `memeradd` ON `memeradd`.`Addid` = `savingcollection`.`mem_add_id`
INNER JOIN `areainfo` ON `areainfo`.`id` = `memeradd`.`AreaName`
WHERE `savingcollection`.`fk_brance_id` = '$Request->Brance' AND  `savingcollection`.`type` = '$Request->Type' AND `savingcollection`.`date` BETWEEN '$converfrstdate' AND '$convertsnddate'
ORDER BY SUBSTR(savingcollection.mem_add_id, 10,4)");



            $collection =  DB::table('savingcollection')
              ->join('memberinfo','memberinfo.id','=','savingcollection.mem_id')
              ->join('createadmin', 'createadmin.id', '=', 'savingcollection.fk_user_id')
              ->join('branceinfo', 'branceinfo.id', '=', 'savingcollection.fk_brance_id')    
              ->join('memeradd', 'memeradd.Addid', '=', 'savingcollection.mem_add_id') 
              ->join('areainfo', 'areainfo.id', '=', 'memeradd.AreaName') 
            //   ->where('savingcollection.mem_id',$explode[0])
            //   ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
              ->whereBetween('savingcollection.date', [$converfrstdate, $convertsnddate])
              ->orderby('savingcollection.date','ASC')
              ->select('createadmin.name as adminname','areainfo.area_name','branceinfo.name','memberinfo.*','memeradd.todaydate','savingcollection.*','savingcollection.date','memeradd.PackageExdate')
              ->get();


       $withdraw =  DB::table('withdrawinfo')
              ->join('memberinfo','memberinfo.id','=','withdrawinfo.mem_id')
              ->join('createadmin', 'createadmin.id', '=', 'withdrawinfo.fk_user_id')
            //   ->where('withdrawinfo.mem_id',$explode[0])
            //   ->where('withdrawinfo.mem_add_id',$explode[1])
              ->where('withdrawinfo.fk_bracne_id',$Request->Brance)
              ->where('withdrawinfo.type',$Request->Type)
              ->whereBetween('withdrawinfo.date', [$converfrstdate, $convertsnddate])
              ->orderby('withdrawinfo.date','ASC')
              ->select('createadmin.name as adminname','memberinfo.*','withdrawinfo.*','withdrawinfo.date')
              ->get();
     

     $monthtotalSaving =  DB::table('savingcollection')
            // ->where('savingcollection.mem_id',$explode[0])
            //   ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
              ->whereBetween('savingcollection.date', [$converfrstdate, $convertsnddate])
              ->sum('savingcollection.today_dep');


  $withdrawTotal =  DB::table('savingcollection')
            // ->where('savingcollection.mem_id',$explode[0])
            //   ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
              ->whereBetween('savingcollection.date', [$converfrstdate, $convertsnddate])
              ->sum('savingcollection.today_withdraw');

       $totaldep = DB::table('savingcollection')
            //   ->where('savingcollection.mem_id',$explode[0])
            //   ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
              ->where('savingcollection.date', '<', $converfrstdate)
              ->sum('savingcollection.today_dep');
        
         $totalwithdraw = DB::table('savingcollection')
            //   ->where('savingcollection.mem_id',$explode[0])
            //   ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
              ->where('savingcollection.date', '<', $converfrstdate)
              ->sum('savingcollection.today_withdraw');


      
   $previousSaving = $totaldep-$totalwithdraw;
         
         $totalsavingno =  DB::table('savingcollection')
            // ->where('savingcollection.mem_id',$explode[0])
            //   ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
              ->where('savingcollection.today_dep','!=',0.00)
              ->whereBetween('savingcollection.date', [$converfrstdate, $convertsnddate])
              ->get();

 $totalwithdrawno =  DB::table('savingcollection')
            // ->where('savingcollection.mem_id',$explode[0])
            //   ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
              ->where('savingcollection.net_withdraw','!=',0.00)
              ->whereBetween('savingcollection.date', [$converfrstdate, $convertsnddate])
              ->get(); 
        }
        else
        {

         $collection =  DB::table('savingcollection')
              ->join('memberinfo','memberinfo.id','=','savingcollection.mem_id')
              ->join('createadmin', 'createadmin.id', '=', 'savingcollection.fk_user_id')
              ->join('branceinfo', 'branceinfo.id', '=', 'savingcollection.fk_brance_id')    
              ->join('memeradd', 'memeradd.Addid', '=', 'savingcollection.mem_add_id') 
              ->join('areainfo', 'areainfo.id', '=', 'memeradd.AreaName') 
               ->where('savingcollection.mem_id',$explode[0])
              ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
              ->whereBetween('savingcollection.date', [$converfrstdate, $convertsnddate])
              ->orderby('savingcollection.date','ASC')
              ->select('createadmin.name as adminname','areainfo.area_name','branceinfo.name','memberinfo.*','memeradd.todaydate','savingcollection.*','savingcollection.date','memeradd.PackageExdate')
              ->get();


       $withdraw =  DB::table('withdrawinfo')
              ->join('memberinfo','memberinfo.id','=','withdrawinfo.mem_id')
              ->join('createadmin', 'createadmin.id', '=', 'withdrawinfo.fk_user_id')
              ->where('withdrawinfo.mem_id',$explode[0])
              ->where('withdrawinfo.mem_add_id',$explode[1])
              ->where('withdrawinfo.fk_bracne_id',$Request->Brance)
              ->where('withdrawinfo.type',$Request->Type)
              ->whereBetween('withdrawinfo.date', [$converfrstdate, $convertsnddate])
              ->orderby('withdrawinfo.date','ASC')
              ->select('createadmin.name as adminname','memberinfo.*','withdrawinfo.*','withdrawinfo.date')
              ->get();
     

     $monthtotalSaving =  DB::table('savingcollection')
            ->where('savingcollection.mem_id',$explode[0])
              ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
              ->whereBetween('savingcollection.date', [$converfrstdate, $convertsnddate])
              ->sum('savingcollection.today_dep');


  $withdrawTotal =  DB::table('savingcollection')
            ->where('savingcollection.mem_id',$explode[0])
              ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
              ->whereBetween('savingcollection.date', [$converfrstdate, $convertsnddate])
              ->sum('savingcollection.today_withdraw');

       $totaldep = DB::table('savingcollection')
              ->where('savingcollection.mem_id',$explode[0])
              ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
              ->where('savingcollection.date', '<', $converfrstdate)
              ->sum('savingcollection.today_dep');
        
         $totalwithdraw = DB::table('savingcollection')
              ->where('savingcollection.mem_id',$explode[0])
              ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
              ->where('savingcollection.date', '<', $converfrstdate)
              ->sum('savingcollection.today_withdraw');


      
   $previousSaving = $totaldep-$totalwithdraw;
         
         $totalsavingno =  DB::table('savingcollection')
            ->where('savingcollection.mem_id',$explode[0])
              ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
              ->where('savingcollection.today_dep','!=',0.00)
              ->whereBetween('savingcollection.date', [$converfrstdate, $convertsnddate])
              ->get();

 $totalwithdrawno =  DB::table('savingcollection')
            ->where('savingcollection.mem_id',$explode[0])
              ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
              ->where('savingcollection.net_withdraw','!=',0.00)
              ->whereBetween('savingcollection.date', [$converfrstdate, $convertsnddate])
              ->get();

}
      return view('Admin.savingcollection.collectionreporttab',compact('collection','withdraw','month','year','oldinvest','monthtotalSaving','withdrawTotal','previousSaving','frstdate','sndate','totalsavingno','totalwithdrawno','name','type','todayrecieveammount'));
    }

        public function showReport(Request $Request,$id){

 $invest =  DB::table('savingcollection')
              ->join('memberinfo','memberinfo.id','=','savingcollection.mem_id')
              ->join('createadmin', 'createadmin.id', '=', 'savingcollection.fk_user_id')
              ->where('savingcollection.id',$id)
              ->select('createadmin.name as adminname','memberinfo.*','savingcollection.*')
              ->get();
      return view('Admin.savingcollection.savingcolldatereport',compact('invest'));
    }


    public function Finishedsaving(){



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
     $packageType = DB::table('packagetype')
                      ->orderBy('packagetype.serialNo', 'ASC')
                      ->where('type','1')
                      ->get();
       return view('Admin.savingcollection.Finishedsaving',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','allyear','packageType'));
    }

    public function showfinishsavingdata($branceid,$from,$to,$type){



              $data = DB::select("SELECT MAX(`net_dep`) as netdep,`savingcollection`.*,`memberinfo`.`mem_name` FROM `savingcollection`
INNER JOIN `memberinfo` ON `memberinfo`.`id`=`savingcollection`.`mem_id`
 WHERE `savingcollection`.`fk_brance_id`='$branceid' AND `savingcollection`.`type`='$type'  GROUP BY `savingcollection`.`mem_add_id`  LIMIT $from,$to");
                  



         return view('Admin.savingcollection.showfinsavdata',compact('data'));
    }
    



    public function deactivefinishsaving($id){

                $obj = DB::table('memeradd')
                        ->where('Addid', '=', $id)
                        ->update([
                            'status' => '0'
                        ]);
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Update Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Update Unsuccessfully']);

            }


    }


    public function PWDELETE($id){

                $obj = DB::table('profitwithdraw')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }
    public function profitwithdraw(){

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

       $allData =  DB::table('profitwithdraw')
           ->join('memberinfo', 'memberinfo.id', '=', 'profitwithdraw.fk_mem_id')
            ->join('packagetype', 'packagetype.id', '=', 'profitwithdraw.fk_pack_id')
           ->join('createadmin', 'createadmin.id', '=', 'profitwithdraw.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'profitwithdraw.fk_brance_id')
           ->select('memberinfo.mem_name','profitwithdraw.*','packagetype.name','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('profitwithdraw.date', 'DESC')
          ->get();

        $branWiseData =  DB::table('profitwithdraw')
           ->join('memberinfo', 'memberinfo.id', '=', 'profitwithdraw.fk_mem_id')
            ->join('packagetype', 'packagetype.id', '=', 'profitwithdraw.fk_pack_id')
           ->join('createadmin', 'createadmin.id', '=', 'profitwithdraw.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'profitwithdraw.fk_brance_id')
           ->select('memberinfo.mem_name','profitwithdraw.*','packagetype.name','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('profitwithdraw.date', 'DESC')
            ->where('profitwithdraw.fk_brance_id',$id->fk_brance_id)
            ->get();

            
              $packageType = DB::table('packagetype')
                      ->orderBy('packagetype.serialNo', 'ASC')
                      ->where('type','1')
                      ->get();

       return  view('Admin.savingcollection.profitwithdraw',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','allData','branWiseData','packageType'));

    }

}
