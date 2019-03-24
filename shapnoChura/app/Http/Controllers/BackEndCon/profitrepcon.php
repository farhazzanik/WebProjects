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
class profitrepcon extends Controller
{
    

    public function index(Request $Request){

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
       return view('Admin.savingcollection.profitreport',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','allyear','packageType'));
    }

    public function report(Request $Request){


    $deletequery =   $obj = DB::table('sessionprofitreport')->delete();

    $explode=explode('/', $Request->Name);
    $month = $Request->month;
    $year = $Request->year;

    $frstdate = $Request->frstdate;
    $sndate = $Request->snddate;
	  $exfstdate=explode('-', $Request->frstdate);
	  $exsnddate=explode('-', $Request->snddate);
    
    $converfrstdate = $exfstdate[2].'-'.$exfstdate[1].'-'.$exfstdate[0];
     $convertsnddate = $exsnddate[2].'-'.$exsnddate[1].'-'.$exsnddate[0];
  


   $begin = new DateTime($converfrstdate);
$end = new DateTime($convertsnddate);

$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);


 foreach($daterange as $date){

 		 $searchdate = $date->format("Y-m-d");
 		 
 		 $lastrate = DB::table('intialrate')
 		   				->where('schema','=',$Request->Type)
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


         $collection =  DB::table('savingcollection')
              ->join('memberinfo','memberinfo.id','=','savingcollection.mem_id')
               ->join('createadmin', 'createadmin.id', '=', 'savingcollection.fk_user_id')
              ->where('savingcollection.mem_id',$explode[0])
              ->where('savingcollection.mem_add_id',$explode[1])
              ->where('savingcollection.fk_brance_id',$Request->Brance)
              ->where('savingcollection.type',$Request->Type)
             ->orderby('savingcollection.date','ASC')
              ->select('createadmin.name as adminname','memberinfo.mem_name','savingcollection.*','savingcollection.date')
              ->get();

              $alldata =  DB::table('sessionprofitreport')->get();
  

      return view('Admin.savingcollection.profitreporttab',compact('collection','daterange','alldata','frstdate','sndate'));

    }
}
