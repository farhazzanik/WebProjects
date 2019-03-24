<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon;
use Auth;
use App\CreateAdminModel;
use DB;

class DashboardCon extends Controller
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

        $totaladmin = DB::Table('createadmin')->count();
         $totalemp = DB::Table('employeeinfo')->count();
         $totalactadmin=  DB::Table('createadmin')->where('Status','1')->count();
          $totaldecadmin=  DB::Table('createadmin')->where('Status','0')->count();
          $totalbrance =  DB::Table('branceinfo')->count();
          $totalarea =  DB::Table('areainfo')->count();



          $totalmem = DB::Table('memberinfo')->count();
 $totalactmem = DB::Table('memberinfo')->where('status','1')->count();
  $totaldeactmem = DB::Table('memberinfo')->where('status','0')->count();
    	return view('Admin.welcome',compact('mainlink','id','sublink','Adminminlink','adminsublink','totaladmin','totalemp','totalactadmin','totaldecadmin','totalbrance','totalarea','totalmem','totalactmem','totaldeactmem'));
    }
}
