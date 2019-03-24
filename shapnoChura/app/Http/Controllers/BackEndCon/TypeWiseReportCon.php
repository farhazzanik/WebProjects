<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use Session;
use DB;
class TypeWiseReportCon extends Controller
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
      

    	return view('Admin.Report.typewisereport',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam'));
    }




    public function Typereport(Request $request){

        

         $this->validate($request, [
                          'name' => 'required',
                          'Type' => 'required',
                         
                         ]);



        $typereq= $request->name;
        $area = $request->Area;


        if($request->name == '1')
        {
           if($request->Area != 'All'){
            
            $data = DB::table('memeradd')
              ->join('memberinfo', 'memberinfo.id', '=', 'memeradd.memberName')
              ->join('areainfo', 'areainfo.id', '=', 'memeradd.AreaName')
              ->join('branceinfo', 'branceinfo.id', '=', 'memeradd.fk_brance_id')   
                ->join('packagetype', 'packagetype.id', '=', 'memeradd.PackageName')   
              ->select('memeradd.*','memberinfo.*','packagetype.name as packname','areainfo.area_name','branceinfo.name')

              ->where('memeradd.PackageName',$request->Type)
              ->where('memeradd.AreaName',$request->Area)
              ->where('memeradd.status','1')
              ->where('memeradd.fk_brance_id',$request->Brance)
              ->orderBy(DB::raw('substr(memeradd.Addid, 11, 4)'),'ASC')
              ->get();
            }else{

                $data = DB::table('memeradd')
              ->join('memberinfo', 'memberinfo.id', '=', 'memeradd.memberName')
              ->join('branceinfo', 'branceinfo.id', '=', 'memeradd.fk_brance_id')   
              ->join('packagetype', 'packagetype.id', '=', 'memeradd.PackageName')   
              ->select('memeradd.*','memberinfo.*','packagetype.name as packname','branceinfo.name')
              ->where('memeradd.PackageName',$request->Type)
              ->where('memeradd.status','1')
              ->where('memeradd.fk_brance_id',$request->Brance)
              ->orderBy(DB::raw('substr(memeradd.Addid, 11, 4)'),'ASC')
              ->get();


            }



        }else{

 if($request->Area != 'All'){
             $data = DB::table('investlatter')
                      ->join('memberinfo', 'memberinfo.id', '=', 'investlatter.appName')
                       ->join('areainfo', 'areainfo.id', '=', 'investlatter.fk_area_id')
                       ->join('branceinfo', 'branceinfo.id', '=', 'investlatter.fk_brance_id')   
             

                      ->select('investlatter.*','memberinfo.*','areainfo.area_name','branceinfo.name')
                     ->where('investlatter.type',$request->Type)
                     ->where('investlatter.fk_area_id',$request->Area)
                     ->where('investlatter.fk_brance_id',$request->Brance)

                      ->orderBy(DB::raw('SUBSTR(investlatter.id, 16,10)'),'ASC')



                     ->select('investlatter.*','memberinfo.*','branceinfo.name','areainfo.*','investlatter.id as invid')
                     ->get();
                   }else{
  $data = DB::table('investlatter')
                      ->join('memberinfo', 'memberinfo.id', '=', 'investlatter.appName')
                        ->join('branceinfo', 'branceinfo.id', '=', 'investlatter.fk_brance_id')   
             

                      ->select('investlatter.*','memberinfo.*','areainfo.area_name','branceinfo.name')
                     ->where('investlatter.type',$request->Type)
                    
                     ->where('investlatter.fk_brance_id',$request->Brance)
                      ->orderBy(DB::raw('SUBSTR(investlatter.id, 16,10)'),'ASC')
                     ->select('investlatter.*','memberinfo.*','branceinfo.name','investlatter.id as invid')
                     ->get();
                   }



        }

         return view('Admin.Report.showTypeReport',compact('data','typereq','area'));

    }


     public function showpack(Request $request){


       if($request->ajax()){
                    $results = $packageType = DB::table('packagetype')
                      ->orderBy('packagetype.serialNo', 'ASC')
                      ->where('type','1')
                       ->where('name','!=','MMPDS')
                          ->where('name','!=','MMFDS')
                      ->get();
              return $results;
                         
                }

      
    }

    public function mobileList(){
   

   $id =   Auth::guard('admin')->user();

  $vale = DB::table('linkpiority')
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

        
     $brancedata = DB::table('memberinfo')->where('fk_brance_Id',$id->fk_brance_id)->get();
     $data = DB::table('memberinfo')->get();
      return view('Admin.Report.mobileLIst',compact('mainlink','id','sublink','Adminminlink','adminsublink','data','brancedata'));

    }

    public function mobileListprint(){


   $id =   Auth::guard('admin')->user();





        
     $brancedata = DB::table('memberinfo')->where('fk_brance_Id',$id->fk_brance_id)->get();
     $data = DB::table('memberinfo')->get();
      return view('Admin.Report.mobileLIstprint',compact('id','data','brancedata'));

    }

    public function showcolshet(Request $Request){


   $id =   Auth::guard('admin')->user();





        
        $brancedata = DB::table('memeradd')
                   ->join('memberinfo','memeradd.memberName','=','memberinfo.id')

                    ->join('areainfo', 'areainfo.id', '=', 'memeradd.AreaName')
                  ->join('branceinfo', 'branceinfo.id', '=', 'memeradd.fk_brance_id')   

                  ->where('memeradd.AreaName',$Request->Area)
                   ->where('memeradd.fk_brance_Id',$Request->Brance)
                    ->orderBy(DB::raw('substr(memeradd.Addid, 11, 4)'),'ASC')
                   ->skip($Request->from)
                   ->take($Request->to)
                   
                   ->get();


    $ivestdata = DB::table('investlatter')
                  
                   ->where('investlatter.fk_brance_Id',$Request->Brance)
                   ->get();
   



      return view('Admin.Report.showcolshet',compact('id','data','brancedata','ivestdata'));
    }

    public function packwisemem(){

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
 $pack = DB::table('packagetype')->get();
     return view('Admin.Report.packwisemem',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','pack'));

    }

    public function showPackwiseMem(Request $Request){

   $type = $Request->name;
              
              if($Request->name =='1'){


            $data = DB::table('memeradd')
                ->join('memberinfo','memeradd.memberName','=','memberinfo.id')
                ->join('packagetype','packagetype.id','=','memeradd.PackageName')
                ->join('branceinfo','branceinfo.id','=','memeradd.fk_brance_id')
                ->where('memeradd.fk_brance_id',$Request->Brance)
                ->where('memeradd.PackageName',$Request->Type)
                ->where('memeradd.status','1')
                  ->orderBy(DB::raw('substr(memeradd.Addid, 11, 4)'),'ASC')
                 ->select('memberinfo.mem_name','branceinfo.name as bbane','memberinfo.con_no','memberinfo.perma_add','memeradd.Addid','memeradd.fk_brance_id','packagetype.name')
                 ->get();

              }else{

            
         $data = DB::table('investlatter')
                      ->join('memberinfo', 'memberinfo.id', '=', 'investlatter.appName')
                    
                       ->join('branceinfo', 'branceinfo.id', '=', 'investlatter.fk_brance_id')   
             

                      ->select('investlatter.*','memberinfo.*','areainfo.area_name','branceinfo.name')
                     ->where('investlatter.type',$Request->Type)
                    
                     ->where('investlatter.fk_brance_id',$Request->Brance)
                       ->orderBy(DB::raw('SUBSTR(investlatter.id, 11,10)'),'ASC')
                     ->select('investlatter.*','investlatter.type AS name','memberinfo.*','branceinfo.name as bbane','investlatter.id as invid')
                     ->get();
        }


        return view('Admin.Report.packwisememlis',compact('data','type'));
    }



    public function collsheet(){

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
      

      return view('Admin.Report.collectionsheet',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam'));

    }


    public function cashreport(){
     
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
      

      return view('Admin.Report.cashreport',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam'));
    }


    public function showcashtab(Request $Request){


      $id =   Auth::guard('admin')->user();
      $type = $Request->name;

      $brancename = DB::select("SELECT `name` FROM `branceinfo` WHERE `id`='$Request->Brance'");

      if($type == 1 or $type== 2){
      
      $daterpit =      $Request->date;

      $explode = explode('-', $Request->date);
      $renewdate =  $explode[2].'-'.$explode[1].'-'.$explode[0];  

    $todayrecieveammount = DB::select("SELECT `savingcollection`.*,SUM(`savingcollection`.`today_dep`) AS total,`packagetype`.`name` FROM `savingcollection`
INNER JOIN `packagetype` ON `packagetype`.`id`=`savingcollection`.`type` WHERE `date`='$renewdate' AND `fk_brance_id`='$Request->Brance'
GROUP BY `savingcollection`.`type` ORDER BY `packagetype`.`serialNo` ASC");
     

      $investnettcole = DB::select("SELECT `investcollection`.*,SUM(`investcollection`.`tody_inves`) as totaltodyinv,
      SUM(`investcollection`.`inves_wise_deven`) AS netpro FROM `investcollection`
WHERE `date`='$renewdate' AND `fk_brance_id`='$Request->Brance'");

        $todaysare = DB::select("SELECT `shareammount`.*,SUM(`shareammount`.`ammount`) AS totalshare FROM `shareammount`
WHERE `fk_brance_id`='$Request->Brance' AND `date`='$renewdate' AND status='share'");


        $bankwithdraw = DB::select("SELECT SUM(`bank_management`.`ammount`) AS withdrwa FROM `bank_management`
WHERE `transaction_type`='Withdraw' and  `fk_brance_id`='$Request->Brance' AND `date`='$renewdate'");

        $otherincome  = DB::select("SELECT SUM(`incomeinfo`.`ammount`) AS ammount,`costinfo`.`title`
FROM `incomeinfo` INNER JOIN  `costinfo` ON `costinfo`.`id`= `incomeinfo`.`fk_title_id`
WHERE `incomeinfo`.`fk_brance_id`='$Request->Brance' AND `incomeinfo`.`date`='$renewdate'
GROUP BY `incomeinfo`.`fk_title_id` ORDER BY `costinfo`.`id` ASC");



  $mmpdsrcv=DB::select("SELECT SUM(`ammount`) AS total FROM `mmpds_pack_reg` WHERE `fk_brance_id`='$Request->Brance' AND `date`='$renewdate'");

             
    $mmpdreturn=DB::select("SELECT SUM(`withdraw`) AS total FROM `mmpds_withdraw` WHERE `fk_brance_id`='$Request->Brance' and `status`='1' AND `date`='$renewdate'");
    
     $mmpdsprofit=DB::select("SELECT SUM(`withdraw`) AS total FROM `mmpds_withdraw` WHERE `fk_brance_id`='$Request->Brance' and `status`='2' AND `date`='$renewdate'");





         $todaywitdrwaam = DB::select("SELECT `savingcollection`.*,SUM(`savingcollection`.`today_withdraw`) AS total,`packagetype`.`name` FROM `savingcollection`
INNER JOIN `packagetype` ON `packagetype`.`id`=`savingcollection`.`type` WHERE `date`='$renewdate' AND `fk_brance_id`='$Request->Brance'
GROUP BY `savingcollection`.`type` ORDER BY `packagetype`.`serialNo` ASC");

          $invprovide = DB::table('investlatter')
                      ->where('appDate','=',$renewdate)
                      ->where('fk_brance_id','=',$Request->Brance)
                      ->sum('invesQuanT');


             $othercost  = DB::select("SELECT SUM(`expenseinfo`.`ammount`) AS ammount,`costinfo`.`title`
FROM `expenseinfo` INNER JOIN  `costinfo` ON `costinfo`.`id`= `expenseinfo`.`fk_title_id`
WHERE `expenseinfo`.`fk_brance_id`='$Request->Brance' AND `expenseinfo`.`date`='$renewdate'
GROUP BY `expenseinfo`.`fk_title_id` ORDER BY `costinfo`.`id` ASC");


            $totpwithdraw = DB::table('profitwithdraw')
                      ->where('date','=',$renewdate)
                      ->where('fk_brance_id','=',$Request->Brance)
                      ->sum('twithdraw');


              $employsalary = DB::table('emp_salary_collection')
                      ->where('date','=',$renewdate)
                      ->where('fk_brance_id','=',$Request->Brance)
                      ->sum('paid_ammount');

                $bankdeposit = DB::table('bank_management')
                      ->where('date','=',$renewdate)
                      ->where('fk_brance_id','=',$Request->Brance)
                       ->where('transaction_type','=','Saving')
                      ->sum('ammount');

      $sharewithdraw = DB::select("SELECT `shareammount`.*,SUM(`shareammount`.`ammount`) AS totalshare FROM `shareammount`
WHERE `fk_brance_id`='$Request->Brance' AND `withdraw_date`='$renewdate' AND status='return'");


        }else if($type == 3 ){
  $date1 =  $Request->ssdate;
     $date2 =  $Request->snddate;


 $explode = explode('-', $Request->ssdate);
      $renewdate =  $explode[2].'-'.$explode[1].'-'.$explode[0];  

    $explodes = explode('-', $Request->snddate);
      $renewdats =  $explodes[2].'-'.$explodes[1].'-'.$explodes[0];  


    $todayrecieveammount = DB::select("SELECT `savingcollection`.*,SUM(`savingcollection`.`today_dep`) AS total,`packagetype`.`name` FROM `savingcollection`
INNER JOIN `packagetype` ON `packagetype`.`id`=`savingcollection`.`type` WHERE  `fk_brance_id`='$Request->Brance' and `date`
BETWEEN 
'$renewdate' and '$renewdats'
GROUP BY `savingcollection`.`type` ORDER BY `packagetype`.`serialNo` ASC");
     

      $investnettcole = DB::select("SELECT `investcollection`.*,SUM(`investcollection`.`tody_inves`) as totaltodyinv,
      SUM(`investcollection`.`inves_wise_deven`) AS netpro FROM `investcollection`
WHERE  `fk_brance_id`='$Request->Brance' and `date`
BETWEEN 
'$renewdate' and '$renewdats'");

        $todaysare = DB::select("SELECT `shareammount`.*,SUM(`shareammount`.`ammount`) AS totalshare FROM `shareammount`
WHERE `fk_brance_id`='$Request->Brance'  AND status='share' and `date`
BETWEEN 
'$renewdate' and '$renewdats' ");


        $bankwithdraw = DB::select("SELECT SUM(`bank_management`.`ammount`) AS withdrwa FROM `bank_management`
WHERE `transaction_type`='Withdraw' and  `fk_brance_id`='$Request->Brance' and `date`
BETWEEN 
'$renewdate' and '$renewdats'");

        $otherincome  = DB::select("SELECT SUM(`incomeinfo`.`ammount`) AS ammount,`costinfo`.`title`
FROM `incomeinfo` INNER JOIN  `costinfo` ON `costinfo`.`id`= `incomeinfo`.`fk_title_id`
WHERE `incomeinfo`.`fk_brance_id`='$Request->Brance'


and incomeinfo.`date`
BETWEEN 
'$renewdate' and '$renewdats'


GROUP BY `incomeinfo`.`fk_title_id` ORDER BY `costinfo`.`id` ASC");

  $mmpdsrcv=DB::select("SELECT SUM(`ammount`) AS total FROM `mmpds_pack_reg` WHERE `fk_brance_id`='$Request->Brance' AND `date`  BETWEEN  '$renewdate' and '$renewdats'");

             
    $mmpdreturn=DB::select("SELECT SUM(`withdraw`) AS total FROM `mmpds_withdraw` WHERE `fk_brance_id`='$Request->Brance' and `status`='1' AND `date`  BETWEEN  '$renewdate' and '$renewdats'");
     $mmpdsprofit=DB::select("SELECT SUM(`withdraw`) AS total FROM `mmpds_withdraw` WHERE `fk_brance_id`='$Request->Brance' and `status`='2' AND `date`  BETWEEN  '$renewdate' and '$renewdats'");

$todaywitdrwaam = DB::select("SELECT `savingcollection`.*,SUM(`savingcollection`.`today_withdraw`) AS total,`packagetype`.`name` FROM `savingcollection`
INNER JOIN `packagetype` ON `packagetype`.`id`=`savingcollection`.`type` WHERE `date` BETWEEN 
'$renewdate' and '$renewdats' AND `fk_brance_id`='$Request->Brance'
GROUP BY `savingcollection`.`type` ORDER BY `packagetype`.`serialNo` ASC");

          $invprovide = DB::table('investlatter')
                      
                       ->whereBetween('appDate', [$renewdate, $renewdats])
                      ->where('fk_brance_id','=',$Request->Brance)
                      ->sum('invesQuanT');


             $othercost  = DB::select("SELECT SUM(`expenseinfo`.`ammount`) AS ammount,`costinfo`.`title`
FROM `expenseinfo` INNER JOIN  `costinfo` ON `costinfo`.`id`= `expenseinfo`.`fk_title_id`
WHERE `expenseinfo`.`fk_brance_id`='$Request->Brance' AND `expenseinfo`.`date` BETWEEN 
'$renewdate' and '$renewdats'
GROUP BY `expenseinfo`.`fk_title_id` ORDER BY `costinfo`.`id` ASC");


            $totpwithdraw = DB::table('profitwithdraw')
                      
                        ->whereBetween('date', [$renewdate, $renewdats])

                      ->where('fk_brance_id','=',$Request->Brance)
                      ->sum('twithdraw');

             $employsalary = DB::table('emp_salary_collection')
              ->whereBetween('date', [$renewdate, $renewdats])
                      
                      ->where('fk_brance_id','=',$Request->Brance)
                      ->sum('paid_ammount');

            $bankdeposit = DB::table('bank_management')
                      
                       ->whereBetween('date', [$renewdate, $renewdats])
                      
                      ->where('fk_brance_id','=',$Request->Brance)
                       ->where('transaction_type','=','Saving')
                      ->sum('ammount');

               $shareWithdrawss = DB::select("SELECT `shareammount`.*,SUM(`shareammount`.`ammount`) AS totalshare FROM `shareammount`
WHERE `fk_brance_id`='$Request->Brance'  AND status='return' and `withdraw_date`
BETWEEN 
'$renewdate' and '$renewdats' ");

    $mmpdreturn=DB::select("SELECT SUM(`withdraw`) AS total FROM `mmpds_withdraw` WHERE `fk_brance_id`='$Request->Brance' and `status`='1' AND `date`  BETWEEN  '$renewdate' and '$renewdats'");
     $mmpdsprofit=DB::select("SELECT SUM(`withdraw`) AS total FROM `mmpds_withdraw` WHERE `fk_brance_id`='$Request->Brance' and `status`='2' AND `date`  BETWEEN  '$renewdate' and '$renewdats'");

          $lastcashcloseamnt = DB::select("SELECT * FROM `cash_close` WHERE `date` < '$renewdate' AND `fk_brance_id`='$Request->Brance'  ORDER BY `date` DESC LIMIT 1");



        }else if($type == 5 ){

  $date1 =  $Request->ssdate;
     $date2 =  $Request->snddate;
           $explode = explode('-', $Request->ssdate);
      $renewdate =  $explode[2].'-'.$explode[1].'-'.$explode[0];  

    $explodes = explode('-', $Request->snddate);
      $renewdats =  $explodes[2].'-'.$explodes[1].'-'.$explodes[0];  

                $todayrecieveammount = DB::select("SELECT `savingcollection`.*,`packagetype`.`name`,`memberinfo`.`mem_name` FROM `savingcollection`
INNER JOIN `packagetype` ON `packagetype`.`id`=`savingcollection`.`type` INNER JOIN `memberinfo` ON `memberinfo`.`id`=`savingcollection`.`mem_id`  WHERE  savingcollection.`fk_brance_id`='$Request->Brance' and savingcollection.`date`
BETWEEN 
'$renewdate' and '$renewdats' ORDER BY `savingcollection`.`id` ASC");
     

        }else if($type == 6 ){


 $date1 =  $Request->ssdate;
     $date2 =  $Request->snddate;
           $explode = explode('-', $Request->ssdate);
      $renewdate =  $explode[2].'-'.$explode[1].'-'.$explode[0];  

    $explodes = explode('-', $Request->snddate);
      $renewdats =  $explodes[2].'-'.$explodes[1].'-'.$explodes[0];  
   $investnettcole = DB::select("SELECT `investcollection`.*,`memberinfo`.`mem_name` FROM `investcollection` INNER JOIN `memberinfo` ON `memberinfo`.`id`=`investcollection`.`fk_app_id`
WHERE   investcollection.`fk_brance_id`='$Request->Brance' and investcollection.`date`
BETWEEN 
'$renewdate' and '$renewdats'");

        }
        else if($type == 7 ){

   $cashcloasesheets = DB::select("SELECT `cash_close`.*,`createadmin`.`name` FROM `cash_close` INNER JOIN `createadmin` ON  `cash_close`.`fk_user_id`=`createadmin`.`id`
WHERE `cash_close`.`fk_brance_id`='$Request->Brance' ORDER BY DATE DESC");

        }
        else{


      $explode = explode('-', $Request->date);
      $renewdate =  $explode[2].'-'.$explode[1].'-'.$explode[0];  



    $todayrecieveammount = DB::select("SELECT `savingcollection`.*,SUM(`savingcollection`.`today_dep`) AS total,`packagetype`.`name` FROM `savingcollection`
INNER JOIN `packagetype` ON `packagetype`.`id`=`savingcollection`.`type` WHERE  `fk_brance_id`='$Request->Brance' and `date`='$renewdate'
GROUP BY `savingcollection`.`type` ORDER BY `packagetype`.`serialNo` ASC");
     

      $investnettcole = DB::select("SELECT `investcollection`.*,SUM(`investcollection`.`tody_inves`) as totaltodyinv,
      SUM(`investcollection`.`inves_wise_deven`) AS netpro FROM `investcollection`
WHERE  `fk_brance_id`='$Request->Brance' and `date`='$renewdate'");

        $todaysare = DB::select("SELECT `shareammount`.*,SUM(`shareammount`.`ammount`) AS totalshare FROM `shareammount`
WHERE `fk_brance_id`='$Request->Brance'  AND status='share' and `date`='$renewdate'");


        $bankwithdraw = DB::select("SELECT SUM(`bank_management`.`ammount`) AS withdrwa FROM `bank_management`
WHERE `transaction_type`='Withdraw' and  `fk_brance_id`='$Request->Brance' and `date`= '$renewdate'");

        $otherincome  = DB::select("SELECT SUM(`incomeinfo`.`ammount`) AS ammount,`costinfo`.`title`
FROM `incomeinfo` INNER JOIN  `costinfo` ON `costinfo`.`id`= `incomeinfo`.`fk_title_id`
WHERE `incomeinfo`.`fk_brance_id`='$Request->Brance'


and incomeinfo.`date`='$renewdate' GROUP BY `incomeinfo`.`fk_title_id` ORDER BY `costinfo`.`id` ASC");

  $mmpdsrcv=DB::select("SELECT SUM(`ammount`) AS total FROM `mmpds_pack_reg` WHERE `fk_brance_id`='$Request->Brance' AND `date`='$renewdate'");

             
    $mmpdreturn=DB::select("SELECT SUM(`withdraw`) AS total FROM `mmpds_withdraw` WHERE `fk_brance_id`='$Request->Brance' and `status`='1' AND `date`='$renewdate'");
     $mmpdsprofit=DB::select("SELECT SUM(`withdraw`) AS total FROM `mmpds_withdraw` WHERE `fk_brance_id`='$Request->Brance' and `status`='2' AND `date`='$renewdate'");
$todaywitdrwaam = DB::select("SELECT `savingcollection`.*,SUM(`savingcollection`.`today_withdraw`) AS total,`packagetype`.`name` FROM `savingcollection`
INNER JOIN `packagetype` ON `packagetype`.`id`=`savingcollection`.`type` WHERE `date`='$renewdate' AND `fk_brance_id`='$Request->Brance'
GROUP BY `savingcollection`.`type` ORDER BY `packagetype`.`serialNo` ASC");

          $invprovide = DB::table('investlatter')
                      ->where('appDate', '=', $renewdate)
                      ->where('fk_brance_id','=', $Request->Brance)
                      ->sum('invesQuanT');


             $othercost  = DB::select("SELECT SUM(`expenseinfo`.`ammount`) AS ammount,`costinfo`.`title`
FROM `expenseinfo` INNER JOIN  `costinfo` ON `costinfo`.`id`= `expenseinfo`.`fk_title_id`
WHERE `expenseinfo`.`fk_brance_id`='$Request->Brance' AND `expenseinfo`.`date`='$renewdate'
GROUP BY `expenseinfo`.`fk_title_id` ORDER BY `costinfo`.`id` ASC");


            $totpwithdraw = DB::table('profitwithdraw')
                      
                        ->where('date', '=', $renewdate)
 
                      ->where('fk_brance_id','=',$Request->Brance)
                      ->sum('twithdraw');

             $employsalary = DB::table('emp_salary_collection')
              ->where('date', '=',$renewdate)
                      
                      ->where('fk_brance_id','=',$Request->Brance)
                      ->sum('paid_ammount');

            $bankdeposit = DB::table('bank_management')
                      
                       ->where('date', '=',$renewdate)
                      
                      ->where('fk_brance_id','=',$Request->Brance)
                       ->where('transaction_type','=','Saving')
                      ->sum('ammount');

               $shareWithdrawss = DB::select("SELECT `shareammount`.*,SUM(`shareammount`.`ammount`) AS totalshare FROM `shareammount`
WHERE `fk_brance_id`='$Request->Brance'  AND status='return' and `withdraw_date`= '$renewdate'");

    $mmpdreturn=DB::select("SELECT SUM(`withdraw`) AS total FROM `mmpds_withdraw` WHERE `fk_brance_id`='$Request->Brance' and `status`='1' AND `date`='$renewdate'");
     $mmpdsprofit=DB::select("SELECT SUM(`withdraw`) AS total FROM `mmpds_withdraw` WHERE `fk_brance_id`='$Request->Brance' and `status`='2' AND `date`= '$renewdate'");

     $lastcashcloseamnt = DB::select("SELECT * FROM `cash_close` WHERE `date` < '$renewdate' AND `fk_brance_id`='$Request->Brance'  ORDER BY `date` DESC LIMIT 1");


        }

       return view('Admin.Report.showcashtab',compact('id','type','todayrecieveammount','investnettcole','todaysare','bankwithdraw','otherincome','todaywitdrwaam','invprovide','othercost','totpwithdraw','daterpit','employsalary','bankdeposit','brancename','sharewithdraw','shareWithdrawss','mmpdsrcv','mmpdreturn','mmpdsprofit','date1','date2','cashcloasesheets','lastcashcloseamnt','renewdate'));

    }



    public function mcashreport(){

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
        ->select(DB::raw('substr(date, 1, 4) as date'))
        ->groupby(DB::raw('substr(date, 1, 4)'))
        ->get();



      return view('Admin.Report.mcashreport',compact('mainlink','allyear','id','sublink','Adminminlink','adminsublink','branceNam'));

    }


    public function showmcasreport(Request $Request){


 $brancename = DB::select("SELECT `name` FROM `branceinfo` WHERE `id`='$Request->Brance'");


      $id =   Auth::guard('admin')->user();
      $type = $Request->Type;
      $year = $Request->year;
      $month = $Request->month;


if($type == 1){


     $savingcollpack =  DB::select("SELECT 
  `savingcollection`.*,
  `packagetype`.`name`,
   SUM(`savingcollection`.`today_dep`) AS totals
FROM
  `savingcollection` 
  INNER JOIN `packagetype` 
    ON `packagetype`.`id` = `savingcollection`.`type` 
WHERE savingcollection.`fk_brance_id` = '$Request->Brance' 
 AND SUBSTR(savingcollection.date, 6, 2) = '$month' 
  AND SUBSTR(savingcollection.date, 1, 4) = '$year' 
GROUP BY `savingcollection`.`type`
ORDER BY `packagetype`.`serialNo` ASC");


    
 $deletequery =   $obj = DB::table('sessionprofitreport')->delete();


for ($i=0; $i <count($savingcollpack) ; $i++) { 
  # code...
        $fstpac = DB::select("SELECT `savingcollection`.*,SUM(`today_dep`) AS total FROM `savingcollection` WHERE `type`='".$savingcollpack[$i]->type."' AND today_dep != '' AND `fk_brance_id` = '$Request->Brance' 
  AND SUBSTR(savingcollection.date, 6, 2) = '$month' AND SUBSTR(savingcollection.date, 1, 4) = '$year'   GROUP BY `date`");
       
       for ($x=0; $x < count($fstpac) ; $x++) { 
         # code...
         $insertDate = DB::table('sessionprofitreport')->insert(
                ['date' =>  $fstpac[$x]->date, 
                 'lastammount' => $fstpac[$x]->total, 
                 'rate' => $fstpac[$x]->type, 
                'profits' => '0']);
       }

      


}

   $packdate = DB::select("SELECT * FROM `sessionprofitreport`");

   

    $investnettcole = DB::select("SELECT `investcollection`.*,SUM(`investcollection`.`tody_inves`) as totaltodyinv,
      SUM(`investcollection`.`inves_wise_deven`) AS netpro FROM `investcollection`
WHERE  `fk_brance_id`='$Request->Brance' AND SUBSTR(investcollection.date, 6, 2) = '$month'  AND SUBSTR(investcollection.date, 1, 4) = '$year'   GROUP BY `date`");
    $totalinvestcol =  DB::select("SELECT `investcollection`.*,SUM(`investcollection`.`tody_inves`) as totaltodyinv,
      SUM(`investcollection`.`inves_wise_deven`) AS netpro FROM `investcollection`
WHERE  `fk_brance_id`='$Request->Brance' AND SUBSTR(investcollection.date, 6, 2) = '$month'  AND SUBSTR(investcollection.date, 1, 4) = '$year'  ");


  $todaysare = DB::select("SELECT `shareammount`.*,SUM(`shareammount`.`ammount`) AS totalshare FROM `shareammount`
WHERE `fk_brance_id`='$Request->Brance' AND SUBSTR(shareammount.date, 6, 2) = '$month'  AND SUBSTR(shareammount.date, 1, 4) = '$year' AND `status`='share'  GROUP BY `date`");

  $totalshare = DB::select("SELECT `shareammount`.*,SUM(`shareammount`.`ammount`) AS totalshare FROM `shareammount`
WHERE `fk_brance_id`='$Request->Brance' AND SUBSTR(shareammount.date, 6, 2) = '$month'  AND SUBSTR(shareammount.date, 1, 4) = '$year'  AND `status`='share'");





         $bankwithdraw = DB::select("SELECT bank_management.*,SUM(`bank_management`.`ammount`) AS withdrwa FROM `bank_management`
WHERE `transaction_type`='Withdraw' and  `fk_brance_id`='$Request->Brance' AND SUBSTR(bank_management.date, 6, 2) = '$month'  AND SUBSTR(bank_management.date, 1, 4) = '$year'  GROUP BY `date`");

     $totalbankwithdraw = DB::select("SELECT bank_management.*,SUM(`bank_management`.`ammount`) AS withdrwa FROM `bank_management`
WHERE `transaction_type`='Withdraw' and  `fk_brance_id`='$Request->Brance' AND SUBSTR(bank_management.date, 6, 2) = '$month' AND SUBSTR(bank_management.date, 1, 4) = '$year' ");


     $mmpdssav = DB::select("SELECT SUM(`ammount`) AS total,mmpds_pack_reg.* FROM `mmpds_pack_reg`  WHERE `fk_brance_id`='$Request->Brance' AND SUBSTR(`date`,6,2)='$month' AND SUBSTR(`date`,1,4)='$year' GROUP BY `date`");

   $totalmmpdssav = DB::select("SELECT SUM(`ammount`) AS total,mmpds_pack_reg.* FROM `mmpds_pack_reg`  WHERE `fk_brance_id`='$Request->Brance' AND SUBSTR(`date`,6,2)='$month' AND SUBSTR(`date`,1,4)='$year'");
 $deletsssequery =   $obj = DB::table('sesionalcostdate')->delete();


             $otherincome  = DB::select("SELECT `incomeinfo`.*,SUM(`incomeinfo`.`ammount`) AS ammount,`costinfo`.`stitle` as title,`incomeinfo`.`date`,`incomeinfo`.`fk_title_id` FROM  `incomeinfo`
INNER JOIN `costinfo` ON `costinfo`.`id`=`incomeinfo`.`fk_title_id`
WHERE  SUBSTR(incomeinfo.date, 6, 2) = '$month' AND SUBSTR(incomeinfo.date, 1, 4) = '$year'  AND  `incomeinfo`.`fk_brance_id`='$Request->Brance' GROUP BY `incomeinfo`.`fk_title_id` ORDER BY incomeinfo.fk_title_id asc");
    

for ($w=0; $w <count($otherincome) ; $w++) { 
 

             $datewisedate  = DB::select("SELECT SUM(`incomeinfo`.`ammount`) AS ammount,`incomeinfo`.`date`,`incomeinfo`.`fk_title_id`
FROM `incomeinfo` WHERE  `incomeinfo`.`fk_title_id`='".$otherincome[$w]->fk_title_id."' and  `incomeinfo`.`fk_brance_id`='$Request->Brance'  AND SUBSTR(incomeinfo.date, 6, 2) = '$month' AND SUBSTR(incomeinfo.date, 1, 4) = '$year' 
GROUP BY incomeinfo.date ORDER BY incomeinfo.fk_title_id asc");


       
       for ($z=0; $z < count($datewisedate) ; $z++) { 
         # code...
         $insertDate = DB::table('sesionalcostdate')->insert(
                ['date' =>  $datewisedate[$z]->date, 
                 'ammount' => $datewisedate[$z]->ammount, 
                 'fk_title_id' => $datewisedate[$z]->fk_title_id
                ]);
       }



}

$alldata  = DB::select("SELECT * FROM `sesionalcostdate`");

}else{





      $savingcollpack = DB::select("SELECT `savingcollection`.*,SUM(`savingcollection`.`today_withdraw`) AS totals,`packagetype`.`name` FROM `savingcollection`
INNER JOIN `packagetype` ON `packagetype`.`id`=`savingcollection`.`type` WHERE savingcollection.`fk_brance_id` = '$Request->Brance' 
 AND SUBSTR(savingcollection.date, 6, 2) = '$month' AND SUBSTR(savingcollection.date, 1, 4) = '$year' 
GROUP BY `savingcollection`.`type`
ORDER BY `packagetype`.`serialNo` ASC");




    
 $deletequery =   $obj = DB::table('sessionprofitreport')->delete();


for ($i=0; $i <count($savingcollpack) ; $i++) { 
  # code...
        $fstpac = DB::select("SELECT `savingcollection`.*,SUM(`today_withdraw`) AS total FROM `savingcollection` WHERE `type`='".$savingcollpack[$i]->type."'  AND `today_withdraw` !=  ''  AND `fk_brance_id` = '$Request->Brance' 
  AND SUBSTR(savingcollection.date, 6, 2) = '$month' AND SUBSTR(savingcollection.date, 1, 4) = '$year'   GROUP BY `date`");
       
       for ($x=0; $x < count($fstpac) ; $x++) { 
         # code...
         $insertDate = DB::table('sessionprofitreport')->insert(
                ['date' =>  $fstpac[$x]->date, 
                 'lastammount' => $fstpac[$x]->total, 
                 'rate' => $fstpac[$x]->type, 
                'profits' => '0']);
       }

      


}

   $packdate = DB::select("SELECT * FROM `sessionprofitreport`");



       $profitwithdraw = DB::select("SELECT profitwithdraw.*,SUM(`twithdraw`) AS totals,`packagetype`.`name` FROM `profitwithdraw`
INNER JOIN `packagetype` ON `packagetype`.`id`=`profitwithdraw`.`fk_pack_id`
WHERE `profitwithdraw`.`fk_brance_id`='$Request->Brance' AND SUBSTR(`profitwithdraw`.`date`,6,2)='$month' AND SUBSTR(profitwithdraw.date, 1, 4) = '$year' 
GROUP BY `profitwithdraw`.`fk_pack_id`
ORDER BY `packagetype`.`serialNo` ASC");




    
 $deletequery =   $obj = DB::table('sessionprwith')->delete();


for ($p=0; $p <count($profitwithdraw) ; $p++) { 
  # code...
        $xsxs = DB::select("SELECT `profitwithdraw`.*,SUM(`profitwithdraw`.`twithdraw`) AS totalswithd FROM `profitwithdraw`
WHERE `twithdraw`!='' AND `fk_brance_id`='$Request->Brance' AND `fk_pack_id`='".$profitwithdraw[$p]->fk_pack_id."' AND SUBSTR(`date`,6,2)='$month' AND SUBSTR(date, 1, 4) = '$year'  GROUP BY `date`");
       
       for ($c=0; $c < count($xsxs) ; $c++) { 
         # code...
         $insertDate = DB::table('sessionprwith')->insert(
                ['date' =>  $xsxs[$c]->date, 
                 'total' => $xsxs[$c]->totalswithd, 
                 'packid' => $xsxs[$c]->fk_pack_id, 
                'others' => '0']);
       }

      


}
 $seleprofitwitd = DB::select("SELECT * FROM `sessionprwith`");

                      
  $invprovide = DB::select("SELECT SUM(`invesQuanT`) AS total,`investlatter`.* FROM `investlatter`
WHERE `fk_brance_id`='$Request->Brance' AND   SUBSTR(`appDate`,6,2)='$month' AND SUBSTR(appDate, 1, 4) = '$year'  GROUP BY `appDate`");



 $bankdeposit = DB::select("SELECT SUM(`ammount`) AS totaldiposit,`bank_management`.* FROM `bank_management` WHERE`transaction_type`='Saving'
AND `fk_brance_id`='$Request->Brance' AND SUBSTR(`date`,1,4)='$year' AND SUBSTR(`date`,6,2)='$month'
GROUP BY `date` ");

 $deletsssequery =   $obj = DB::table('sesionalcostdate')->delete();
 
             $otherincome  = DB::select("SELECT `expenseinfo`.*,SUM(`expenseinfo`.`ammount`) AS ammount,`costinfo`.`stitle` as title,`expenseinfo`.`date`,`expenseinfo`.`fk_title_id` FROM  `expenseinfo`
INNER JOIN `costinfo` ON `costinfo`.`id`=`expenseinfo`.`fk_title_id`
WHERE  SUBSTR(expenseinfo.date, 6, 2) = '$month' AND SUBSTR(expenseinfo.date, 1, 4) = '$year'  AND  `expenseinfo`.`fk_brance_id`='$Request->Brance' GROUP BY `expenseinfo`.`fk_title_id` ORDER BY expenseinfo.fk_title_id asc");
    

for ($w=0; $w <count($otherincome) ; $w++) { 
 

             $datewisedate  = DB::select("SELECT SUM(`expenseinfo`.`ammount`) AS ammount,`expenseinfo`.`date`,`expenseinfo`.`fk_title_id`
FROM `expenseinfo` WHERE  `expenseinfo`.`fk_title_id`='".$otherincome[$w]->fk_title_id."' and  `expenseinfo`.`fk_brance_id`='$Request->Brance'  AND SUBSTR(expenseinfo.date, 6, 2) = '$month' AND SUBSTR(expenseinfo.date, 1, 4) = '$year' 
GROUP BY expenseinfo.date ORDER BY expenseinfo.fk_title_id asc");


       
       for ($z=0; $z < count($datewisedate) ; $z++) { 
         # code...
         $insertDate = DB::table('sesionalcostdate')->insert(
                ['date' =>  $datewisedate[$z]->date, 
                 'ammount' => $datewisedate[$z]->ammount, 
                 'fk_title_id' => $datewisedate[$z]->fk_title_id
                ]);
       }



}

$alldata  = DB::select("SELECT * FROM `sesionalcostdate`");


$onlysalary = DB::select("SELECT SUM(`ammount`) AS totalsal,session_emp_title.*  FROM `session_emp_title` WHERE `month`='$month' AND `year`='$year' AND `fk_title_id`='Salary'  GROUP BY `Data`");




 $sessssalary =   $obj = DB::table('sesionalsalarytable')->delete();
 
              $slaryfetch  = DB::select("SELECT 
  SUM( session_emp_title.`ammount`) AS taotal,
  `session_emp_title`.*,
   `salarytitle`.`titel`
FROM
  `session_emp_title` 
  INNER JOIN `salarytitle`
  ON `salarytitle`.`id`=`session_emp_title`.`fk_title_id`
WHERE  session_emp_title.`month` = '$month' 
  AND  session_emp_title.`year` = '$year' 
  AND session_emp_title. fk_title_id != 'Salary' 
  AND session_emp_title.`fk_brance_id` = '".$Request->Brance."' 
GROUP BY session_emp_title.`fk_title_id` 
ORDER BY session_emp_title.`fk_title_id` ASC");
    

for ($t=0; $t < count($slaryfetch) ; $t++) { 
 

             $datewisedate  = DB::select("SELECT SUM(`ammount`) AS taotal,`session_emp_title`.* FROM `session_emp_title`
WHERE  `fk_title_id`='".$slaryfetch[$t]->fk_title_id."' AND   `month`='$month' AND `year`='$year' AND `fk_brance_id`='".$Request->Brance."' GROUP BY `Data` ORDER BY `fk_title_id`  ASC");


       
       for ($s=0; $s < count($datewisedate) ; $s++) { 
         # code...
         $insertDate = DB::table('sesionalsalarytable')->insert(
                ['date' =>  $datewisedate[$s]->Data, 
                 'ammount' => $datewisedate[$s]->taotal, 
                 'fk_title_id' => $datewisedate[$s]->fk_title_id
                ]);
       }



}

$salaryall   = DB::select("SELECT * FROM `sesionalsalarytable`");


   $todaysare = DB::select("SELECT `shareammount`.*,SUM(`shareammount`.`ammount`) AS totalshare FROM `shareammount`
WHERE `fk_brance_id`='$Request->Brance' AND SUBSTR(shareammount.withdraw_date, 6, 2) = '$month'  AND SUBSTR(shareammount.withdraw_date, 1, 4) = '$year' AND `status`='return'  GROUP BY `withdraw_date`");

  $totalshare = DB::select("SELECT `shareammount`.*,SUM(`shareammount`.`ammount`) AS totalshare FROM `shareammount`
WHERE `fk_brance_id`='$Request->Brance' AND SUBSTR(shareammount.withdraw_date, 6, 2) = '$month'  AND SUBSTR(shareammount.withdraw_date, 1, 4) = '$year'  AND `status`='return'");

 $mmpdssav = DB::select("SELECT SUM(`withdraw`) AS total,mmpds_withdraw.* FROM `mmpds_withdraw`  WHERE `fk_brance_id`='$Request->Brance' AND `status`='1' AND SUBSTR(`date`,6,2)='$month' AND SUBSTR(`date`,1,4)='$year' GROUP BY `date`");

   $mmpdsprof = DB::select("SELECT SUM(`withdraw`) AS total,mmpds_withdraw.* FROM `mmpds_withdraw`  WHERE `fk_brance_id`='$Request->Brance' AND `status`='2' AND SUBSTR(`date`,6,2)='$month' AND SUBSTR(`date`,1,4)='$year' GROUP BY `date`");

}



 
 
      return view('Admin.Report.showmcasreport',compact('id','type','year','month','savingcollpack','packdate','todaysare','investnettcole','totalbankwithdraw','bankwithdraw','otherincome','alldata','totalinvestcol','totalshare','seleprofitwitd','profitwithdraw','invprovide','bankdeposit','onlysalary','salaryall','slaryfetch','brancename','mmpdssav','totalmmpdssav','mmpdsprof'));

    }


    public function cashclose(){


      
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
      
             $lastdate = DB::table('cash_close')->orderBy('id','DESC')->take(1)->get();
      return view('Admin.Report.cashclose',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','lastdate'));
    }

    public function donecash(Request $Request){

      $lastdate = DB::table('cash_close')->orderBy('id','DESC')->take(1)->get();


      if($Request->ssdate != date('Y-m-d')){

         $renewdate =  strftime("%Y-%m-%d", strtotime("$Request->ssdate +1 day"));  
      }else{
         $renewdate = $Request->ssdate;  
      }

    $explodes = explode('-', $Request->snddate);
       $renewdats =  $explodes[0].'-'.$explodes[1].'-'.$explodes[2];  


     $todayrecieveammount = DB::select("SELECT SUM(`savingcollection`.`today_dep`) AS total FROM `savingcollection` WHERE  `fk_brance_id`='$Request->Brance' and `date` BETWEEN '$renewdate' and '$renewdats'");
     

      $investnettcole = DB::select("SELECT SUM(`investcollection`.`tody_inves`) as totaltodyinv,
      SUM(`investcollection`.`inves_wise_deven`) AS netpro FROM `investcollection`
WHERE  `fk_brance_id`='$Request->Brance' and `date` BETWEEN  '$renewdate' and '$renewdats'");

        $todaysare = DB::select("SELECT SUM(`shareammount`.`ammount`) AS totalshare FROM `shareammount`
WHERE `fk_brance_id`='$Request->Brance'  AND status='share' and `date`
BETWEEN 
'$renewdate' and '$renewdats' ");


        $bankwithdraw = DB::select("SELECT SUM(`bank_management`.`ammount`) AS withdrwa FROM `bank_management`
WHERE `transaction_type`='Withdraw' and  `fk_brance_id`='$Request->Brance' and `date`
BETWEEN 
'$renewdate' and '$renewdats'");

        $otherincome  = DB::select("SELECT SUM(`incomeinfo`.`ammount`) AS ammount
FROM `incomeinfo` WHERE `incomeinfo`.`fk_brance_id`='$Request->Brance' and incomeinfo.`date`
BETWEEN '$renewdate' and '$renewdats'");


    $mmpdsrcv=DB::select("SELECT SUM(`ammount`) AS total FROM `mmpds_pack_reg` WHERE `fk_brance_id`='$Request->Brance' AND `date`  BETWEEN  '$renewdate' and '$renewdats'");


  $totalcredit = $todayrecieveammount[0]->total+ $investnettcole[0]->totaltodyinv+$investnettcole[0]->netpro+$todaysare[0]->totalshare+ $bankwithdraw[0]->withdrwa+ $otherincome[0]->ammount+$mmpdsrcv[0]->total;



             
    $mmpdreturn=DB::select("SELECT SUM(`withdraw`) AS total FROM `mmpds_withdraw` WHERE `fk_brance_id`='$Request->Brance' and `status`='1' AND `date`  BETWEEN  '$renewdate' and '$renewdats'");

     $mmpdsprofit=DB::select("SELECT SUM(`withdraw`) AS total FROM `mmpds_withdraw` WHERE `fk_brance_id`='$Request->Brance' and `status`='2' AND `date`  BETWEEN  '$renewdate' and '$renewdats'");

$todaywitdrwaam = DB::select("SELECT SUM(`savingcollection`.`today_withdraw`) AS total FROM  `savingcollection` WHERE `date` BETWEEN 
'$renewdate' and '$renewdats' AND `fk_brance_id`='$Request->Brance'");

          $invprovide = DB::table('investlatter')
                      
                     ->whereBetween('appDate', [$renewdate, $renewdats])
                      ->where('fk_brance_id','=',$Request->Brance)
                      ->sum('invesQuanT');


             $othercost  = DB::select("SELECT SUM(`expenseinfo`.`ammount`) AS ammount
FROM `expenseinfo` WHERE `expenseinfo`.`fk_brance_id`='$Request->Brance' AND `expenseinfo`.`date` BETWEEN '$renewdate' and '$renewdats'");


            $totpwithdraw = DB::table('profitwithdraw')
                      
                        ->whereBetween('date', [$renewdate, $renewdats])

                      ->where('fk_brance_id','=',$Request->Brance)
                      ->sum('twithdraw');

             $employsalary = DB::table('emp_salary_collection')
              ->whereBetween('date', [$renewdate, $renewdats])
                      
                      ->where('fk_brance_id','=',$Request->Brance)
                      ->sum('paid_ammount');

            $bankdeposit = DB::table('bank_management')
                      
                       ->whereBetween('date', [$renewdate, $renewdats])
                      
                      ->where('fk_brance_id','=',$Request->Brance)
                       ->where('transaction_type','=','Saving')
                      ->sum('ammount');

               $shareWithdrawss = DB::select("SELECT SUM(`sharewithdraws`.`sharewithdraw`) AS totalshare FROM `sharewithdraws`
WHERE `fk_brance_id`='$Request->Brance'   and `withdraw_date`
BETWEEN 
'$renewdate' and '$renewdats'");

     $totaldebit = $todaywitdrwaam[0]->total+$invprovide+ $othercost[0]->ammount+$totpwithdraw+$employsalary+$bankdeposit+$mmpdreturn[0]->total+$mmpdsprofit[0]->total+$shareWithdrawss[0]->totalshare;

    
      $selectquery = DB::select("SELECT * FROM `cash_close` WHERE `date`='$renewdats'");

      if(count($selectquery) > 0){

         $obj = DB::table('cash_close')
                    ->where('date', '=', $renewdats)
                    ->update([
                       'credit'  => $totalcredit,
                'fk_brance_id' => $Request->Brance,
                'fk_user_id' => $Request->adminid,
                'debit'=> $totaldebit
                    ]);
               
           

      }else 
      {
         $insertDate = DB::table('cash_close')->insert(
                ['date' =>  $renewdats, 
                'credit'  => $totalcredit,
                'fk_brance_id' => $Request->Brance,
                'fk_user_id' => $Request->adminid,
                'debit'=> $totaldebit]
            );
   

      }

 return redirect()->back();
    }
    
    
    public function rootwisereport()
        {
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


      $brancewiseexpTitle = $results = DB::table('costinfo')
                    
              ->where('costinfo.inc_exp', '=', 'Income')
              ->where('costinfo.fk_brance_id','=',$id->fk_brance_id)
              ->get();
        $branceNam = DB::table('branceinfo')->get();
        $pack = DB::table('packagetype')->orderBy('id','DESC')->get();
    

      return view('Admin.Report.rootwisereport',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data','brancewiseexpTitle','pack'));
  }
        public function rootcollection(Request $Request)
                {
                  $root=$Request->root;
                  $Brance=$Request->Brance;
                  $package=$Request->package;
                  $year=$Request->year;
                  $date=$Request->data;
                  $firstdate=$Request->firstdate;
                  $seconddate=$Request->seconddate;
                  $month=$Request->month;
                  $savingpackage=$Request->savingpackage;
                  $investpackage=$Request->investpackage;
                  $Type=$Request->Type;
                  if ($package == '1') 
                  {
                    if ($Type == '3') {


              $collection =  DB::Select("SELECT `createadmin`.`name` AS `adminname`, `areainfo`.`area_name`,
 `branceinfo`.`name`, `memberinfo`.mem_name, `memeradd`.Addid, 
 `savingcollection`.`date`,packagetype.name as typename,savingcollection.today_dep,savingcollection.today_withdraw,`savingcollection`.`fk_brance_id`
FROM `savingcollection`
INNER JOIN `memberinfo` ON `memberinfo`.`id` = `savingcollection`.`mem_id`
INNER JOIN `packagetype` ON `packagetype`.`id` = `savingcollection`.`type`
INNER JOIN `createadmin` ON `createadmin`.`id` = `savingcollection`.`fk_user_id`
INNER JOIN `branceinfo` ON `branceinfo`.`id` = `savingcollection`.`fk_brance_id`
INNER JOIN `memeradd` ON `memeradd`.`Addid` = `savingcollection`.`mem_add_id`
INNER JOIN `areainfo` ON `areainfo`.`id` = `memeradd`.`AreaName`
WHERE `savingcollection`.`fk_brance_id` = '$Brance' and `savingcollection`.`type` = '$savingpackage' AND `memeradd`.`AreaName` = '$root' and substr(savingcollection.date,1,4)='$year'
ORDER BY `savingcollection`.`date` ASC");

                     
                    }

                    elseif ($Type == '5') {



                      $dateexplode = explode('-',$Request->data);
                      $date =  $dateexplode[2].'-'.$dateexplode[1].'-'.$dateexplode[0];  


              $collection =  DB::Select("SELECT `createadmin`.`name` AS `adminname`, `areainfo`.`area_name`,
 `branceinfo`.`name`, `memberinfo`.mem_name, `memeradd`.Addid, 
 `savingcollection`.`date`,packagetype.name as typename,savingcollection.today_dep,savingcollection.today_withdraw,`savingcollection`.`fk_brance_id`
FROM `savingcollection`
INNER JOIN `memberinfo` ON `memberinfo`.`id` = `savingcollection`.`mem_id`
INNER JOIN `packagetype` ON `packagetype`.`id` = `savingcollection`.`type`
INNER JOIN `createadmin` ON `createadmin`.`id` = `savingcollection`.`fk_user_id`
INNER JOIN `branceinfo` ON `branceinfo`.`id` = `savingcollection`.`fk_brance_id`
INNER JOIN `memeradd` ON `memeradd`.`Addid` = `savingcollection`.`mem_add_id`
INNER JOIN `areainfo` ON `areainfo`.`id` = `memeradd`.`AreaName`
WHERE `savingcollection`.`fk_brance_id` = '$Brance' and `savingcollection`.`type` = '$savingpackage' AND `memeradd`.`AreaName` = '$root' and savingcollection.date='$date'
ORDER BY `savingcollection`.`date` ASC");
                    }

                    elseif ($Type == '1') {



                      $dateexplodes = explode('-',$Request->firstdate);
                      $firstdate =  $dateexplodes[2].'-'.$dateexplodes[1].'-'.$dateexplodes[0]; 

                      $dateexplode = explode('-',$Request->seconddate);
                      $seconddate =  $dateexplode[2].'-'.$dateexplode[1].'-'.$dateexplode[0];  


              $collection =  DB::Select("SELECT `createadmin`.`name` AS `adminname`, `areainfo`.`area_name`,
 `branceinfo`.`name`, `memberinfo`.mem_name, `memeradd`.Addid, 
 `savingcollection`.`date`,packagetype.name as typename,savingcollection.today_dep,savingcollection.today_withdraw,`savingcollection`.`fk_brance_id`
FROM `savingcollection`
INNER JOIN `memberinfo` ON `memberinfo`.`id` = `savingcollection`.`mem_id`
INNER JOIN `packagetype` ON `packagetype`.`id` = `savingcollection`.`type`
INNER JOIN `createadmin` ON `createadmin`.`id` = `savingcollection`.`fk_user_id`
INNER JOIN `branceinfo` ON `branceinfo`.`id` = `savingcollection`.`fk_brance_id`
INNER JOIN `memeradd` ON `memeradd`.`Addid` = `savingcollection`.`mem_add_id`
INNER JOIN `areainfo` ON `areainfo`.`id` = `memeradd`.`AreaName`
WHERE `savingcollection`.`fk_brance_id` = '$Brance' and `savingcollection`.`type` = '$savingpackage' AND `memeradd`.`AreaName` = '$root' and savingcollection.date BETWEEN '$firstdate' and '$seconddate'
ORDER BY `savingcollection`.`date` ASC");
                    }
                    else
                    {
                       $collection =  DB::Select("SELECT `createadmin`.`name` AS `adminname`, `areainfo`.`area_name`,
 `branceinfo`.`name`, `memberinfo`.mem_name, `memeradd`.Addid, 
 `savingcollection`.`date`,packagetype.name as typename,savingcollection.today_dep,savingcollection.today_withdraw,`savingcollection`.`fk_brance_id`
FROM `savingcollection`
INNER JOIN `memberinfo` ON `memberinfo`.`id` = `savingcollection`.`mem_id`
INNER JOIN `packagetype` ON `packagetype`.`id` = `savingcollection`.`type`
INNER JOIN `createadmin` ON `createadmin`.`id` = `savingcollection`.`fk_user_id`
INNER JOIN `branceinfo` ON `branceinfo`.`id` = `savingcollection`.`fk_brance_id`
INNER JOIN `memeradd` ON `memeradd`.`Addid` = `savingcollection`.`mem_add_id`
INNER JOIN `areainfo` ON `areainfo`.`id` = `memeradd`.`AreaName`
WHERE `savingcollection`.`fk_brance_id` = '$Brance' and `savingcollection`.`type` = '$savingpackage' AND `memeradd`.`AreaName` = '$root' and substr(savingcollection.date,1,4)='$year' and substr(savingcollection.date,6,2)='$month'
ORDER BY `savingcollection`.`date` ASC");
                    }
                    
                  }
                  elseif ($package == '2') 

                  {
                     if ($Type == '3') {


              $collection =  DB::Select("SELECT `createadmin`.`name` AS `adminname`, `areainfo`.`area_name`,
               `branceinfo`.`name`, `memberinfo`.mem_name, `investlatter`.id as acno, 
               `investcollection`.`date`,
               investcollection.tody_inves,
               investcollection.inves_wise_deven,`investcollection`.`type`,`investcollection`.`fk_brance_id`
              FROM `investcollection`
              INNER JOIN `createadmin` ON `createadmin`.`id` = `investcollection`.`fk_user_id`
              INNER JOIN `branceinfo` ON `branceinfo`.`id` = `investcollection`.`fk_brance_id`
              INNER JOIN `investlatter` ON `investlatter`.`id` = `investcollection`.`fk_invest_id`
              INNER JOIN `memberinfo` ON `memberinfo`.`id` = `investlatter`.`appName`
              INNER JOIN `areainfo` ON `areainfo`.`id` = `investlatter`.`fk_area_id`
              WHERE investcollection.`fk_brance_id`='$Brance' and `investcollection`.`type` = '$investpackage' and investlatter.fk_area_id= '$root' AND substr(investcollection.date,1,4)='$year'");

                     
                    }
                    elseif ($Type == '5') {



                      $dateexplode = explode('-',$Request->data);
                      $date =  $dateexplode[2].'-'.$dateexplode[1].'-'.$dateexplode[0];  


              $collection =  DB::Select("SELECT `createadmin`.`name` AS `adminname`, `areainfo`.`area_name`,
 `branceinfo`.`name`, `memberinfo`.mem_name, `investlatter`.id as acno,`investcollection`.`type`, 
 `investcollection`.`date`,
 investcollection.tody_inves,
 investcollection.inves_wise_deven,`investcollection`.`fk_brance_id`
FROM `investcollection`
INNER JOIN `createadmin` ON `createadmin`.`id` = `investcollection`.`fk_user_id`
INNER JOIN `branceinfo` ON `branceinfo`.`id` = `investcollection`.`fk_brance_id`
INNER JOIN `investlatter` ON `investlatter`.`id` = `investcollection`.`fk_invest_id`
INNER JOIN `memberinfo` ON `memberinfo`.`id` = `investlatter`.`appName`
INNER JOIN `areainfo` ON `areainfo`.`id` = `investlatter`.`fk_area_id`
WHERE investcollection.`fk_brance_id`='$Brance' and `investcollection`.`type` = '$investpackage' and investcollection.date='$date'  and investlatter.fk_area_id= '$root'");
                    }
                    elseif ($Type == '1') {



                      
                      $dateexplodes = explode('-',$Request->firstdate);
                      $firstdate =  $dateexplodes[2].'-'.$dateexplodes[1].'-'.$dateexplodes[0]; 

                      $dateexplode = explode('-',$Request->seconddate);
                      $seconddate =  $dateexplode[2].'-'.$dateexplode[1].'-'.$dateexplode[0];    


              $collection =  DB::Select("SELECT `createadmin`.`name` AS `adminname`, `areainfo`.`area_name`,
 `branceinfo`.`name`, `memberinfo`.mem_name, `investlatter`.id as acno,`investcollection`.`type`, 
 `investcollection`.`date`,
 investcollection.tody_inves,
 investcollection.inves_wise_deven,`investcollection`.`fk_brance_id`
FROM `investcollection`
INNER JOIN `createadmin` ON `createadmin`.`id` = `investcollection`.`fk_user_id`
INNER JOIN `branceinfo` ON `branceinfo`.`id` = `investcollection`.`fk_brance_id`
INNER JOIN `investlatter` ON `investlatter`.`id` = `investcollection`.`fk_invest_id`
INNER JOIN `memberinfo` ON `memberinfo`.`id` = `investlatter`.`appName`
INNER JOIN `areainfo` ON `areainfo`.`id` = `investlatter`.`fk_area_id`
WHERE investcollection.`fk_brance_id`='$Brance' and `investcollection`.`type` = '$investpackage' and investcollection.date BETWEEN '$firstdate' and '$seconddate'  and investlatter.fk_area_id= '$root' ");

                    }

                    else
                    {
                       $collection =  DB::Select("SELECT `createadmin`.`name` AS `adminname`, `areainfo`.`area_name`,
 `branceinfo`.`name`, `memberinfo`.mem_name, `investlatter`.id as acno, 
 `investcollection`.`date`,
 investcollection.tody_inves,
 investcollection.inves_wise_deven,`investcollection`.`type`,`investcollection`.`fk_brance_id`
FROM `investcollection`
INNER JOIN `createadmin` ON `createadmin`.`id` = `investcollection`.`fk_user_id`
INNER JOIN `branceinfo` ON `branceinfo`.`id` = `investcollection`.`fk_brance_id`
INNER JOIN `investlatter` ON `investlatter`.`id` = `investcollection`.`fk_invest_id`
INNER JOIN `memberinfo` ON `memberinfo`.`id` = `investlatter`.`appName`
INNER JOIN `areainfo` ON `areainfo`.`id` = `investlatter`.`fk_area_id`
WHERE investcollection.`fk_brance_id`='$Brance'  and investlatter.fk_area_id= '$root' and `investcollection`.`type` = '$investpackage' and substr(investcollection.date,1,4)='$year' and substr(investcollection.date,6,2)='$month'");
                    }
                  }

              return view('Admin.Report.rootwisereporttab',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','date','brancewiseexpTitle','collection','package','Type','year','month','firstdate','seconddate'));
                }

  public function getroot($brance)
    {
        $root=DB::table('areainfo')
                ->orderBy('area_name','ASC')
                ->where('fk_branc_id',$brance)
                ->get();
        if($root)
        {
        echo '<option value="0">Select A Root</option>';
        foreach ($root as $cat) {
            echo '<option value="'.$cat->id.'">'.$cat->area_name.'</option>';
        }
        }
        else
        {
            echo '<option value="0">Select A Category</option>';
        }
    }

public function datetodateinvest()
              {
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


            $brancewiseexpTitle = $results = DB::table('costinfo')
                          
                    ->where('costinfo.inc_exp', '=', 'Income')
                    ->where('costinfo.fk_brance_id','=',$id->fk_brance_id)
                    ->get();
              $branceNam = DB::table('branceinfo')->get();
      ;
          

            return view('Admin.Report.datetodateinvest',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data','brancewiseexpTitle'));
        }


        public function datetodateseving()
              {
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


            $brancewiseexpTitle = $results = DB::table('costinfo')
                          
                    ->where('costinfo.inc_exp', '=', 'Income')
                    ->where('costinfo.fk_brance_id','=',$id->fk_brance_id)
                    ->get();
              $branceNam = DB::table('branceinfo')->get();
      ;
          

            return view('Admin.Report.datetodateseving',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data','brancewiseexpTitle'));
        }
        
         public function overdateaccount()
                      {
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
        
        
                    $brancewiseexpTitle = $results = DB::table('costinfo')
                                  
                            ->where('costinfo.inc_exp', '=', 'Income')
                            ->where('costinfo.fk_brance_id','=',$id->fk_brance_id)
                            ->get();
                      $branceNam = DB::table('branceinfo')->get();
              ;
                  
        
                    return view('Admin.Report.overdateaccount',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data','brancewiseexpTitle'));
                }


}
