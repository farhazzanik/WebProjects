<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use Session;
use DB;
class investreportCon extends Controller
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
    	return view('Admin.invest.Investmentreport',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam'));
    }

          public function dateoverinvacc()
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
          

            return view('Admin.invest.expireaccreport',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data','brancewiseexpTitle'));
        }

        public function expireaccreport(Request $request)
        {
                  $type=$request->Type;
                  $Brance=$request->Brance;
                  $root=$request->root;
                  $deposit_type=$request->name;
                  $calender=$request->dmy;
                  $year=$request->year;
                  $month=$request->month;

                  if ($deposit_type == '2') {


                    if($request->Type == 'all')
                  {
                     if ($calender == '3')
                     {

                  $data=DB::SELECT("SELECT memberinfo.mem_name,branceinfo.name,investlatter.appDate,
                  investlatter.expireDate,investlatter.id as AcID,investlatter.profits as totalammounts,investlatter.invesQuanT as totalammount,investlatter.divendend as totalp,areainfo.area_name,sum(investcollection.tody_inves) as totalpaid,sum(investcollection.inves_wise_deven) as tinves_wise_deven
                  from investlatter
                  inner join investcollection on investcollection.fk_invest_id = investlatter.id
                  inner join memberinfo on investlatter.appName = memberinfo.id
                  inner join areainfo on areainfo.id = investlatter.fk_area_id
                  inner join branceinfo on branceinfo.id = investlatter.fk_brance_id
                  where investlatter.fk_brance_id = '$request->Brance' and investlatter.fk_area_id = '$request->root' 
                  and  substr(investcollection.`date`,1,4) = '$year'
                  group by investcollection.fk_invest_id");

                  // echo "<pre>";
                  // print_r($data);
                  // exit();
                     }

                     else
                     {
                         $data=DB::SELECT("SELECT memberinfo.mem_name,branceinfo.name,investlatter.appDate,
                  investlatter.expireDate,investlatter.id as AcID,investlatter.invesQuanT as totalammount,investlatter.divendend as totalp,investlatter.profits as totalammounts,areainfo.area_name,sum(investcollection.tody_inves) as totalpaid,sum(investcollection.inves_wise_deven) as tinves_wise_deven
                  from investlatter
                  inner join investcollection on investcollection.fk_invest_id = investlatter.id
                  inner join memberinfo on investlatter.appName = memberinfo.id
                  inner join areainfo on areainfo.id = investlatter.fk_area_id
                  inner join branceinfo on branceinfo.id = investlatter.fk_brance_id
                  where investlatter.fk_brance_id = '$request->Brance' and investlatter.fk_area_id = '$request->root' 
                  and  substr(investcollection.`date`,1,4) = '$year'and substr(investcollection.`date`,6,2) = '$month'
                  group by investcollection.fk_invest_id");
                     }

                 return view('Admin.invest.duecollectionreporttab',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data','brancewiseexpTitle','type','deposit_type','pcktype','calender','year','month'));
                }
                    if ($calender == '3') {
                     $data=DB::SELECT("SELECT memberinfo.mem_name,branceinfo.name,investlatter.appDate,
                  investlatter.expireDate,investlatter.id as AcID,investlatter.profits as totalammounts,investlatter.invesQuanT as totalammount,investlatter.divendend as totalp,areainfo.area_name,sum(investcollection.tody_inves) as totalpaid,sum(investcollection.inves_wise_deven) as tinves_wise_deven
                  from investlatter
                  inner join investcollection on investcollection.fk_invest_id = investlatter.id
                  inner join memberinfo on investlatter.appName = memberinfo.id
                  inner join areainfo on areainfo.id = investlatter.fk_area_id
                  inner join branceinfo on branceinfo.id = investlatter.fk_brance_id
                  where investlatter.fk_brance_id = '$request->Brance' and investlatter.fk_area_id = '$request->root' 
                  and investcollection.`type`= '$request->Type' and substr(investcollection.`date`,1,4) = '$year'
                  group by investcollection.fk_invest_id");
                    }

                    else
                    {
                      $data=DB::SELECT("SELECT memberinfo.mem_name,branceinfo.name,investlatter.appDate,
                  investlatter.expireDate,investlatter.id as AcID,investlatter.invesQuanT as totalammount,investlatter.divendend as totalp,investlatter.profits as totalammounts,areainfo.area_name,sum(investcollection.tody_inves) as totalpaid,sum(investcollection.inves_wise_deven) as tinves_wise_deven
                  from investlatter
                  inner join investcollection on investcollection.fk_invest_id = investlatter.id
                  inner join memberinfo on investlatter.appName = memberinfo.id
                  inner join areainfo on areainfo.id = investlatter.fk_area_id
                  inner join branceinfo on branceinfo.id = investlatter.fk_brance_id
                  where investlatter.fk_brance_id = '$request->Brance' and investlatter.fk_area_id = '$request->root' 
                  and investcollection.`type`= '$request->Type' and substr(investcollection.`date`,1,4) = '$year'and substr(investcollection.`date`,6,2) = '$month'
                  group by investcollection.fk_invest_id");
                    }
                  }

                    else
                    {
                      if ($type == '') {

                       if ($calender == '3') 
                    {
                      

                     $data=DB::SELECT("SELECT `createadmin`.`name` AS `adminname`, `areainfo`.`area_name`,
      sum(savingcollection.today_dep) as totalcol,sum(savingcollection.today_withdraw) as totalwithdraw,
       `branceinfo`.`name`, `memberinfo`.mem_name, `memeradd`.Addid, `memeradd`.PackageExdate,
       `savingcollection`.`date`,packagetype.name AS typename,memeradd.amount,memeradd.todaydate,memeradd.Date as exdate
      FROM `savingcollection`
      INNER JOIN `memberinfo` ON `memberinfo`.`id` = `savingcollection`.`mem_id`
      INNER JOIN `packagetype` ON `packagetype`.`id` = `savingcollection`.`type`
      INNER JOIN `createadmin` ON `createadmin`.`id` = `savingcollection`.`fk_user_id`
      INNER JOIN `branceinfo` ON `branceinfo`.`id` = `savingcollection`.`fk_brance_id`
      INNER JOIN `memeradd` ON `memeradd`.`Addid` = `savingcollection`.`mem_add_id`
      INNER JOIN `areainfo` ON `areainfo`.`id` = `memeradd`.`AreaName`
      WHERE `savingcollection`.`fk_brance_id` = '$Brance' 
       AND `memeradd`.`AreaName` = '$root' AND SUBSTR(savingcollection.date,1,4)='$year'
      GROUP BY savingcollection.mem_add_id");
                    }
                    else
                    {
                      $data=DB::SELECT("SELECT `createadmin`.`name` AS `adminname`, `areainfo`.`area_name`,
      sum(savingcollection.today_dep) as totalcol,sum(savingcollection.today_withdraw) as totalwithdraw,
       `branceinfo`.`name`, `memberinfo`.mem_name, `memeradd`.Addid, `memeradd`.PackageExdate,
       `savingcollection`.`date`,packagetype.name AS typename,memeradd.amount,memeradd.todaydate,memeradd.Date as exdate
      FROM `savingcollection`
      INNER JOIN `memberinfo` ON `memberinfo`.`id` = `savingcollection`.`mem_id`
      INNER JOIN `packagetype` ON `packagetype`.`id` = `savingcollection`.`type`
      INNER JOIN `createadmin` ON `createadmin`.`id` = `savingcollection`.`fk_user_id`
      INNER JOIN `branceinfo` ON `branceinfo`.`id` = `savingcollection`.`fk_brance_id`
      INNER JOIN `memeradd` ON `memeradd`.`Addid` = `savingcollection`.`mem_add_id`
      INNER JOIN `areainfo` ON `areainfo`.`id` = `memeradd`.`AreaName`
      WHERE `savingcollection`.`fk_brance_id` = '$Brance' 
       AND `memeradd`.`AreaName` = '$root' AND SUBSTR(savingcollection.date,1,4)='$year'
      GROUP BY savingcollection.mem_add_id");
                    }
                    return view('Admin.invest.duecollectionreporttab',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data','brancewiseexpTitle','type','deposit_type','pcktype','calender','year','month'));

                    }

                    if ($calender == '3') 
                    {
                      $pcktype=DB::table('packagetype')
                      ->where('id',$type)
                      ->first();

                    $data=DB::SELECT("SELECT `createadmin`.`name` AS `adminname`, `areainfo`.`area_name`,
      sum(savingcollection.today_dep) as totalcol,sum(savingcollection.today_withdraw) as totalwithdraw,
       `branceinfo`.`name`, `memberinfo`.mem_name, `memeradd`.Addid, `memeradd`.PackageExdate,
       `savingcollection`.`date`,packagetype.name AS typename,memeradd.amount,memeradd.todaydate,memeradd.Date as exdate
      FROM `savingcollection`
      INNER JOIN `memberinfo` ON `memberinfo`.`id` = `savingcollection`.`mem_id`
      INNER JOIN `packagetype` ON `packagetype`.`id` = `savingcollection`.`type`
      INNER JOIN `createadmin` ON `createadmin`.`id` = `savingcollection`.`fk_user_id`
      INNER JOIN `branceinfo` ON `branceinfo`.`id` = `savingcollection`.`fk_brance_id`
      INNER JOIN `memeradd` ON `memeradd`.`Addid` = `savingcollection`.`mem_add_id`
      INNER JOIN `areainfo` ON `areainfo`.`id` = `memeradd`.`AreaName`
      WHERE `savingcollection`.`fk_brance_id` = '$Brance' and savingcollection.`type`='$type'
       AND `memeradd`.`AreaName` = '$root' AND SUBSTR(savingcollection.date,1,4)='$year'
      GROUP BY savingcollection.mem_add_id");
                    }
                    else
                    {
                      $pcktype=DB::table('packagetype')
                      ->where('id',$type)
                      ->first();

                      $data=DB::SELECT("SELECT `createadmin`.`name` AS `adminname`, `areainfo`.`area_name`,
      sum(savingcollection.today_dep) as totalcol,sum(savingcollection.today_withdraw) as totalwithdraw,
       `branceinfo`.`name`, `memberinfo`.mem_name, `memeradd`.Addid, `memeradd`.PackageExdate,
       `savingcollection`.`date`,packagetype.name AS typename,memeradd.amount,memeradd.todaydate,memeradd.Date as exdate
      FROM `savingcollection`
      INNER JOIN `memberinfo` ON `memberinfo`.`id` = `savingcollection`.`mem_id`
      INNER JOIN `packagetype` ON `packagetype`.`id` = `savingcollection`.`type`
      INNER JOIN `createadmin` ON `createadmin`.`id` = `savingcollection`.`fk_user_id`
      INNER JOIN `branceinfo` ON `branceinfo`.`id` = `savingcollection`.`fk_brance_id`
      INNER JOIN `memeradd` ON `memeradd`.`Addid` = `savingcollection`.`mem_add_id`
      INNER JOIN `areainfo` ON `areainfo`.`id` = `memeradd`.`AreaName`
      WHERE `savingcollection`.`fk_brance_id` = '$Brance' and savingcollection.`type`='$type'
       AND `memeradd`.`AreaName` = '$root' AND SUBSTR(savingcollection.date,1,4)='$year' AND SUBSTR(savingcollection.date,6,2)='$month'
      GROUP BY savingcollection.mem_add_id");
                    }
                  }

                


          return view('Admin.invest.expireaccreporttab',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data','brancewiseexpTitle','type','deposit_type','pcktype','calender','year','month'));
        }

}
