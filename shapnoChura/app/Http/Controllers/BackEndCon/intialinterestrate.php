<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use Session;
use DB;
class intialinterestrate extends Controller
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


  $branceNam = DB::table('branceinfo')->get();

          $totalmem = DB::Table('memberinfo')->count();
 $totalactmem = DB::Table('memberinfo')->where('status','1')->count();
  $totaldeactmem = DB::Table('memberinfo')->where('status','0')->count();
    $allData =  DB::table('intialrate')
           ->join('packagetype', 'packagetype.id', '=', 'intialrate.schema')
           ->join('createadmin', 'createadmin.id', '=', 'intialrate.fk_user_id')
            ->select('intialrate.*','packagetype.name as schemaname','createadmin.name as adminname')
           ->get();

$packa=DB::Table('packagetype')->orderBy('serialNo','ASC')->get();

    	return view('Admin.intialrate.initial',compact('mainlink','id','sublink','Adminminlink','adminsublink','totaladmin','totalemp','totalactadmin','totaldecadmin','totalbrance','totalarea','totalmem','totalactmem','totaldeactmem','branceNam','allData','packa'));

    }


    public function saveintialrate(Request $Request){


  $explodedate = explode('-', $Request->date);
        $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

    		$this->validate($Request, [
		        'date' => 'required',
		        'percent' => 'required',
		        'Schema' => 'required',
		       'Rate' => 'required',
		       
		    ]);



    	try {
    		

		    $insertDate = DB::table('intialrate')->insert(
						    ['date' =>  $renewdate, 
						    'schema' => $Request->Schema, 
						     'interestrate' => $Request->percent, 
						   
						    'fk_user_id' => $Request->adminid,
                'Rate' =>  $Request->Rate]
						);



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



    public function intialratedel($id){

                $obj = DB::table('intialrate')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }

    public function edit($getid){
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


  $branceNam = DB::table('branceinfo')->get();

          $totalmem = DB::Table('memberinfo')->count();
 $totalactmem = DB::Table('memberinfo')->where('status','1')->count();
  $totaldeactmem = DB::Table('memberinfo')->where('status','0')->count();
   
     $allData =  DB::table('intialrate')
           ->join('packagetype', 'packagetype.id', '=', 'intialrate.schema')
           ->join('createadmin', 'createadmin.id', '=', 'intialrate.fk_user_id')
            ->select('intialrate.*','packagetype.name as schemaname','createadmin.name as adminname')
            ->where('intialrate.id',$getid)
           ->get();

    $packa=DB::Table('packagetype')->orderBy('serialNo','ASC')->get();

      return view('Admin.intialrate.editintial',compact('mainlink','id','sublink','Adminminlink','adminsublink','totaladmin','totalemp','totalactadmin','totaldecadmin','totalbrance','totalarea','totalmem','totalactmem','totaldeactmem','branceNam','allData','packa'));

    }

    public function intialinterestrate(Request $Request){

  $explodedate = explode('-', $Request->date);
        $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

        
        $this->validate($Request, [
            'date' => 'required',
            'percent' => 'required',
            'Schema' => 'required',
           
           
        ]);


      try {
        

        $insertDate = DB::table('intialrate')
                  ->where('id', $Request->upid)
                  ->update(
                ['date' =>  $renewdate, 
                'schema' => $Request->Schema, 
                'interestrate' => $Request->percent, 
                'fk_user_id' => $Request->adminid, 
                'Rate' =>  $Request->Rate]
            );



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



    public function activelist(){


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


  $branceNam = DB::table('branceinfo')->get();

          $totalmem = DB::Table('memberinfo')->count();
 $totalactmem = DB::Table('memberinfo')->where('status','1')->count();
  $totaldeactmem = DB::Table('memberinfo')->where('status','0')->count();
    $allData =  DB::table('intialrate')
           ->join('packagetype', 'packagetype.id', '=', 'intialrate.schema')
           ->join('createadmin', 'createadmin.id', '=', 'intialrate.fk_user_id')
            ->select('intialrate.*','packagetype.name as schemaname','createadmin.name as adminname')
           ->get();

$packa=DB::Table('packagetype')->orderBy('serialNo','ASC')->get();

      return view('Admin.intialrate.activelist',compact('mainlink','id','sublink','Adminminlink','adminsublink','totaladmin','totalemp','totalactadmin','totaldecadmin','totalbrance','totalarea','totalmem','totalactmem','totaldeactmem','branceNam','allData','packa'));

    }

    public function report(Request $Request){

      $branceid = $Request->Brance;
      $type = $Request->mem;
      $activelist = $Request->ac;

      if($type == 1){

             $data = DB::table('memberinfo')
            ->join('createadmin', 'createadmin.id', '=', 'memberinfo.fk_user_Id')
            ->join('branceinfo', 'branceinfo.id', '=', 'memberinfo.fk_brance_Id')
            ->select('memberinfo.*', 'createadmin.name as AdminName' , 'branceinfo.name as branceName')
            ->orderBy('memberinfo.id', 'ASC')
            ->where('memberinfo.status',$activelist)
            ->where('memberinfo.fk_brance_Id',$branceid)
            ->get();

      }elseif ($type == 2) {
        # code...
          $data = DB::table('memeradd')
            ->join('memberinfo', 'memberinfo.id', '=', 'memeradd.memberName')
            ->join('areainfo', 'areainfo.id', '=', 'memeradd.AreaName')
            ->join('packagetype', 'packagetype.id', '=', 'memeradd.PackageName')
            ->join('nomineeinfo', 'nomineeinfo.Addid', '=', 'memeradd.Addid')
            ->join('createadmin', 'createadmin.id', '=', 'memeradd.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'memeradd.fk_brance_id')
            ->select('memeradd.*', 'nomineeinfo.*', 'packagetype.name as packname','areainfo.area_name','memberinfo.*','createadmin.name as adminname','branceinfo.name as branceName')
            ->orderBy('memeradd.Addid', 'ASC')
            ->where('memeradd.status',$activelist)
            ->where('memeradd.fk_brance_Id',$branceid)
            ->get();
      }else{



    $data = DB::table('investlatter')
         
            ->join('createadmin', 'createadmin.id', '=', 'investlatter.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'investlatter.fk_brance_id')
            ->join('memberinfo','memberinfo.id','=','investlatter.appName')
            ->select('investlatter.*','investlatter.id as invid','createadmin.name as adminname','branceinfo.name as branceName','memberinfo.*')
            ->orderBy('investlatter.id', 'ASC')
             ->where('investlatter.status',$activelist)

            ->where('investlatter.fk_brance_Id',$branceid)
            ->get();
      }


      return view('Admin.intialrate.showreport',compact('type','activelist','data','branceid'));
    }
}
