<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use Session;
use DB;
class incomeExpenseCon extends Controller
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


$brancewiseexpTitle  = DB::table('costinfo')
               			
					    ->where('costinfo.inc_exp', '=', 'Expense')
					   
					    ->get();
   $branceNam = DB::table('branceinfo')->get();


     $allData =  DB::table('expenseinfo')
           ->join('costinfo', 'costinfo.id', '=', 'expenseinfo.fk_title_id')
           ->join('createadmin', 'createadmin.id', '=', 'expenseinfo.fk_user_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'expenseinfo.fk_brance_id')
           ->select('expenseinfo.*','costinfo.title','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('expenseinfo.date', 'DESC')
          ->get();

        $adminWiseData = DB::table('expenseinfo')
           ->join('costinfo', 'costinfo.id', '=', 'expenseinfo.fk_title_id')
           ->join('createadmin', 'createadmin.id', '=', 'expenseinfo.fk_user_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'expenseinfo.fk_brance_id')
           ->select('expenseinfo.*','costinfo.title','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('expenseinfo.date', 'DESC')
            ->where('expenseinfo.fk_brance_id',$id->fk_brance_id)
            ->get();


    	return view('Admin.cost.expensinfo',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','brancewiseexpTitle','allData','adminWiseData'));
    }



     public function showExpenseTitle(Request $request,$id1){


    	 if($request->ajax()){
               			$results = DB::table('costinfo')
               			
					    ->where('costinfo.inc_exp', '=', 'Expense')
					    ->where('costinfo.fk_brance_id','=',$id1)
					    ->get();
					    return $results;
					               
                }

    	
    }


    

    public function sharewimeme(Request $request,$id1){


       if($request->ajax()){
                    $results =DB::table('shareammount')
                        ->join('memberinfo', 'memberinfo.id', '=', 'shareammount.fk_mem_id')
                      ->orderBy('shareammount.fk_mem_id', 'ASC')
                      ->where('shareammount.fk_brance_id',$id1)
                      ->groupBy('shareammount.fk_mem_id')
                      ->get();


              return $results;
                         
                }

      
    }


    public function saveexpense(Request $Request){

$explodedate = explode('-', $Request->date);
        $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

    		$this->validate($Request, [
		        'Brance' => 'required',
		        'Title' => 'required',
		        'date' => 'required',
		        'ammount' => 'required',
		       
		    ]);


		    $insertDate = DB::table('expenseinfo')->insert(
						    ['date' => $renewdate, 
						    'fk_title_id' => $Request->Title, 
						     'ammount' => $Request->ammount, 
						    'comments' => $Request->comments,
						    'fk_brance_id' => $Request->Brance,
						    'fk_user_id' => $Request->adminid]
						);



		    if($insertDate){

    				Session::flash('success','Save Success');
    			}else{

    				Session::flash('error',$insertDate);

    			}
    			return redirect()->back();


    }




    public function deleteex($id){

                $obj = DB::table('expenseinfo')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }
    public function editexpense($getid){

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
               			
					    ->where('costinfo.inc_exp', '=', 'Expense')
					    ->where('costinfo.fk_brance_id','=',$id->fk_brance_id)
					    ->get();
   $branceNam = DB::table('branceinfo')->get();

   $data =DB::table('expenseinfo')
           ->join('costinfo', 'costinfo.id', '=', 'expenseinfo.fk_title_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'expenseinfo.fk_brance_id')
           ->select('expenseinfo.*','costinfo.title','branceinfo.name as brancName')
           ->where('expenseinfo.id',$getid)
          ->get();
    
    	return view('Admin.cost.editexpens',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data','brancewiseexpTitle'));
    }

    public function updateSuccexpen(Request $Request){
      
$explodedate = explode('-', $Request->date);
        $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

        $obj = DB::table('expenseinfo')
      
                    ->where('id', $Request->upid)
                    ->update( ['date' =>  $renewdate, 
                'fk_title_id' => $Request->Title, 
                 'ammount' => $Request->ammount, 
                'comments' => $Request->comments,
                'fk_brance_id' => $Request->Brance,
                'fk_user_id' => $Request->adminid]);
                  if($obj){

                Session::flash('success','Save Success');
                }else{

                  Session::flash('error',$obj);

                }

                return redirect()->back();
    }

     public function index2(){

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


$brancewiseexpTitle  = DB::table('costinfo')
                    
              ->where('costinfo.inc_exp', '=', 'Income')
              ->where('costinfo.fk_brance_id','=',$id->fk_brance_id)
              ->get();


   $branceNam = DB::table('branceinfo')->get();


     $allData =  DB::table('incomeinfo')
           ->join('costinfo', 'costinfo.id', '=', 'incomeinfo.fk_title_id')
           ->join('createadmin', 'createadmin.id', '=', 'incomeinfo.fk_user_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'incomeinfo.fk_brance_id')
           ->select('incomeinfo.*','costinfo.title','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('incomeinfo.date', 'DESC')
          ->get();

        $adminWiseData =  DB::table('incomeinfo')
           ->join('costinfo', 'costinfo.id', '=', 'incomeinfo.fk_title_id')
           ->join('createadmin', 'createadmin.id', '=', 'incomeinfo.fk_user_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'incomeinfo.fk_brance_id')
           ->select('incomeinfo.*','costinfo.title','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('incomeinfo.date', 'DESC')
            ->where('incomeinfo.fk_brance_id',$id->fk_brance_id)
            ->get();

      $selectMemnber = DB::table('memeradd')
                    ->join('memberinfo','memeradd.memberName','=','memberinfo.id')
                    
              ->where('memeradd.fk_brance_id', '=', $id)
              ->where('memeradd.status', '=', '1')
              ->select('memeradd.Addid','memberinfo.mem_name','memberinfo.id')
              ->get();
       $rltitle = DB::table('costinfo')
              ->where('costinfo.inc_exp', '=', 'Income')
             
              ->get();

      return view('Admin.cost.incomeinfo',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','brancewiseexpTitle','allData','adminWiseData','selectMemnber','rltitle'));
    }


 public function sabingmem(Request $request,$id){


       if($request->ajax()){
                    $results = DB::table('memeradd')
                    ->join('memberinfo','memeradd.memberName','=','memberinfo.id')
                    
              ->where('memeradd.fk_brance_id', '=', $id)
              ->where('memeradd.status', '=', '1')
              ->select('memeradd.Addid','memberinfo.mem_name','memberinfo.id')
              ->get();
              return $results;
                         
                }

      
    }



    public function saveIncome(Request $Request){


  $explodedate = explode('-', $Request->date);
        $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

        $this->validate($Request, [
            'Brance' => 'required',
            'Title' => 'required',
            'date' => 'required',
            'ammount' => 'required',
           
        ]);


        $insertDate = DB::table('incomeinfo')->insert(
                ['date' =>  $renewdate, 
                'fk_title_id' => $Request->Title, 
                 'ammount' => $Request->ammount, 
                'comments' => $Request->comments,
                'fk_brance_id' => $Request->Brance,
                'fk_user_id' => $Request->adminid,
                 'fk_mem_id' => $Request->Member ]
            );



        if($insertDate){

            Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insertDate);

          }
          return redirect()->back();



    }


    public function deleteincom($id){

                $obj = DB::table('incomeinfo')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }


    public function editINcome($getid,$savid){


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

    $data =DB::table('incomeinfo')
           ->join('costinfo', 'costinfo.id', '=', 'incomeinfo.fk_title_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'incomeinfo.fk_brance_id')
             ->join('memeradd', 'memeradd.Addid', '=', 'incomeinfo.fk_mem_id')
            ->join('memberinfo', 'memberinfo.id', '=', 'memeradd.memberName')
           ->select('incomeinfo.*','costinfo.title','branceinfo.name as brancName','memberinfo.mem_name')
           ->where('incomeinfo.id',$getid)
           ->where('incomeinfo.fk_mem_id',$savid)
          ->get();
    

      return view('Admin.cost.editincomeinfo',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data','brancewiseexpTitle'));


    }

    public function updateIncomeSuc(Request $Request){

  $explodedate = explode('-', $Request->date);
        $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

       $obj = DB::table('incomeinfo')
                    ->where('id', $Request->upid)
                    ->update( ['date' =>  $renewdate, 
                'fk_title_id' => $Request->Title, 
                 'ammount' => $Request->ammount, 
                'comments' => $Request->comments,
                'fk_brance_id' => $Request->Brance,
                'fk_user_id' => $Request->adminid,'fk_mem_id' => $Request->Member]);
                  if($obj){

                Session::flash('success','Save Success');
                }else{

                  Session::flash('error',$obj);

                }
                return redirect()->back();

                
    }




    public function indexreport(){
      

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
    

      return view('Admin.cost.report',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data','brancewiseexpTitle'));

    }

    public function showReposrExpInc(Request $request){


      $Brance = $request->Brance;
      $date = $request->data;

      $month = $request->month;
      $year = $request->year;
      $Title = $request->Title;
      $Type = $request->Type;


        if($request->Title ==='1'){

              

            if($request->Type === '5'){
           
           $date = $request->data;

        $explodedate = explode('-', $date);
        $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

             $data = DB::table('incomeinfo')
                    ->join('costinfo','costinfo.id','=','incomeinfo.fk_title_id')
                    ->select('incomeinfo.*','costinfo.title')
                    ->where('incomeinfo.date', '=',$renewdate)
                     ->where('incomeinfo.fk_brance_id', '=',$request->Brance)
                    ->get();

                  $total = DB::table('incomeinfo')
                    ->join('costinfo','costinfo.id','=','incomeinfo.fk_title_id')
                    ->select('incomeinfo.*','costinfo.title')
                    ->where('incomeinfo.date', '=',$renewdate)
                      ->where('incomeinfo.fk_brance_id', '=',$request->Brance)
                    ->sum('incomeinfo.ammount');

            }


            if($request->Type === '2'){

             // select `incomeinfo`.*, `costinfo`.`title` from `incomeinfo` inner join `costinfo` on `costinfo`.`id` = `incomeinfo`.`fk_title_id` where substr(incomeinfo.date, 6, 2) = 01 and substr(incomeinfo.date, 1, 4) = 2018 and `incomeinfo`.`fk_brance_id` = 13


           
           $data = DB::table('incomeinfo')
                    ->join('costinfo','costinfo.id','=','incomeinfo.fk_title_id')
                     ->select('incomeinfo.*','costinfo.title')
                    ->where(DB::raw("substr(incomeinfo.date, 6, 2)"), '=',$request->month)
                    ->where(DB::raw("substr(incomeinfo.date, 1, 4)"), '=',$request->year)
                      ->where('incomeinfo.fk_brance_id', '=',$request->Brance)
                    ->get();

                      $total = DB::table('incomeinfo')
                    ->join('costinfo','costinfo.id','=','incomeinfo.fk_title_id')
                     ->select('incomeinfo.*','costinfo.title')
                    ->where(DB::raw("substr(incomeinfo.date, 6, 2)"), '=',$request->month)
                    ->where(DB::raw("substr(incomeinfo.date, 1, 4)"), '=',$request->year)
                      ->where('incomeinfo.fk_brance_id', '=',$request->Brance)
                     ->sum('incomeinfo.ammount');

            }

              if($request->Type === '3'){
           
           $data = DB::table('incomeinfo')
                    ->join('costinfo','costinfo.id','=','incomeinfo.fk_title_id')
                     ->select('incomeinfo.*','costinfo.title')
                   
                    ->where(DB::raw("substr(incomeinfo.date, 1, 4)"), '=',$request->year)
                      ->where('incomeinfo.fk_brance_id', '=',$request->Brance)
                    ->get();

                     $total = DB::table('incomeinfo')
                    ->join('costinfo','costinfo.id','=','incomeinfo.fk_title_id')
                     ->select('incomeinfo.*','costinfo.title')
                   
                    ->where(DB::raw("substr(incomeinfo.date, 1, 4)"), '=',$request->year)
                      ->where('incomeinfo.fk_brance_id', '=',$request->Brance)
                    ->sum('incomeinfo.ammount');

            }



         
        }
        else
        {

             if($request->Type === '5'){
           
      

$explodedate = explode('-', $date);
$renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];
            $data = DB::table('expenseinfo')
                    ->join('costinfo','costinfo.id','=','expenseinfo.fk_title_id')
                    ->select('expenseinfo.*','costinfo.title')
                    ->where('expenseinfo.date', '=',$renewdate)
                      ->where('expenseinfo.fk_brance_id', '=',$request->Brance)
                    ->get();
                  $total = DB::table('expenseinfo')
                    ->join('costinfo','costinfo.id','=','expenseinfo.fk_title_id')
                    ->select('expenseinfo.*','costinfo.title')
                    ->where('expenseinfo.date', '=', $renewdate)
                      ->where('expenseinfo.fk_brance_id', '=',$request->Brance)
                    ->sum('expenseinfo.ammount');

            }


            if($request->Type === '2'){
           
           $data = DB::table('expenseinfo')
                    ->join('costinfo','costinfo.id','=','expenseinfo.fk_title_id')
                     ->select('expenseinfo.*','costinfo.title')
                    ->where(DB::raw("substr(expenseinfo.date, 6, 2)"), '=',$request->month)
                    ->where(DB::raw("substr(expenseinfo.date, 1, 4)"), '=',$request->year)
                      ->where('expenseinfo.fk_brance_id', '=',$request->Brance)
                    ->get();

                      $total = DB::table('expenseinfo')
                    ->join('costinfo','costinfo.id','=','expenseinfo.fk_title_id')
                     ->select('expenseinfo.*','costinfo.title')
                    ->where(DB::raw("substr(expenseinfo.date, 6, 2)"), '=',$request->month)
                    ->where(DB::raw("substr(expenseinfo.date, 1, 4)"), '=',$request->year)
                      ->where('expenseinfo.fk_brance_id', '=',$request->Brance)
                     ->sum('expenseinfo.ammount');

            }

              if($request->Type === '3'){
           
           $data = DB::table('expenseinfo')
                    ->join('costinfo','costinfo.id','=','expenseinfo.fk_title_id')
                     ->select('expenseinfo.*','costinfo.title')
                   
                    ->where(DB::raw("substr(expenseinfo.date, 1, 4)"), '=',$request->year)
                      ->where('expenseinfo.fk_brance_id', '=',$request->Brance)
                    ->get();

                     $total = DB::table('expenseinfo')
                    ->join('costinfo','costinfo.id','=','expenseinfo.fk_title_id')
                     ->select('expenseinfo.*','costinfo.title')
                   
                    ->where(DB::raw("substr(expenseinfo.date, 1, 4)"), '=',$request->year)
                      ->where('expenseinfo.fk_brance_id', '=',$request->Brance)
                    ->sum('expenseinfo.ammount');

            }
        


        }
         
          return view('Admin.cost.reporttab',compact('data','month','year','Title','Type','total','date'));

    }



     public function shareammount(){

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

$brancewiseroot = DB::table('areainfo')->where('fk_branc_id','=',$id->fk_brance_id)->get();
$brancewiseexpTitle  = DB::table('costinfo')
                    
              ->where('costinfo.inc_exp', '=', 'Income')
              ->where('costinfo.fk_brance_id','=',$id->fk_brance_id)
              ->get();
   $branceNam = DB::table('branceinfo')->get();


     $allData =  DB::table('shareammount')
    
           ->join('memberinfo', 'memberinfo.id', '=', 'shareammount.fk_mem_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'shareammount.fk_brance_id')
            ->join('createadmin', 'createadmin.id', '=', 'shareammount.fk_user_id')
           ->select('shareammount.*','memberinfo.mem_name','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('shareammount.date', 'DESC')
          ->get();

        $adminWiseData =  DB::table('shareammount')
           ->join('memberinfo', 'memberinfo.id', '=', 'shareammount.fk_mem_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'shareammount.fk_brance_id')
            ->join('createadmin', 'createadmin.id', '=', 'shareammount.fk_user_id')
           ->select('shareammount.*','memberinfo.mem_name','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('shareammount.date', 'DESC')
            ->where('shareammount.fk_brance_id',$id->fk_brance_id)
            ->get();

      $selectMemnber =   DB::table('memberinfo')
                      ->orderBy('memberinfo.id', 'ASC')
                      ->where('memberinfo.fk_brance_Id',$id->fk_brance_id)
                      ->where('memberinfo.status','1')
                      ->get();



      return view('Admin.cost.shareammount',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','brancewiseexpTitle','allData','adminWiseData','selectMemnber'));
    }

      public function saveshare(Request $Request){
                  $explode = explode('-', $Request->date);
                  $renewdate =  $explode[2].'-'.$explode[1].'-'.$explode[0];  

        $this->validate($Request, [
            'Brance' => 'required',
            'Member' => 'required',
            'date' => 'required',
            'package' => 'required',
            'ammount' => 'required',
            'sharenumber' => 'required',

           
        ]);

        // $check = DB::table('shareammount')->where('fk_mem_id',$Request->Member)->where('package',$Request->package)->get();

        // if (count($check)>0) 
        // {
        //   $update=DB::table('shareammount')
        //           ->where('fk_mem_id',$Request->Member)
        //           ->where('package',$Request->package)
        //           ->update(['ammount' => $Request->ammount+$check[0]->ammount]);
        //           return redirect()->back()->with('success','Successfully done');
        // }

        // else
        // {
         $insertDate = DB::table('shareammount')->insert(
                ['date' =>  $renewdate, 
                
                'ammount' => $Request->ammount, 
                'package' => $Request->package, 
                'address' => $Request->Address,
                'fk_brance_id' => $Request->Brance,
                'fk_user_id' => $Request->adminid,
                'fk_mem_id' => $Request->Member,
                'sharenumber' => $Request->sharenumber,
                'details' => $Request->Details,'status' =>'share'  ]
            ); 
         
        // }
        



        if($insertDate){

            Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insertDate);

          }
          return redirect()->back();



    }


  public function shareamoutdel($id){

                $obj = DB::table('shareammount')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }


    public function sharelist(){

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

$brancewiseroot = DB::table('areainfo')->where('fk_branc_id','=',$id->fk_brance_id)->get();
$brancewiseexpTitle  = DB::table('costinfo')
                    
              ->where('costinfo.inc_exp', '=', 'Income')
              ->where('costinfo.fk_brance_id','=',$id->fk_brance_id)
              ->get();
   $branceNam = DB::table('branceinfo')->get();


     $allData =  DB::table('shareammount')
    
           ->join('memberinfo', 'memberinfo.id', '=', 'shareammount.fk_mem_id')
           // ->join('areainfo', 'areainfo.id', '=', 'shareammount.fk_root_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'shareammount.fk_brance_id')
            ->join('createadmin', 'createadmin.id', '=', 'shareammount.fk_user_id')
           ->select('shareammount.*','memberinfo.mem_name','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('shareammount.date', 'DESC')
          ->get();

        $adminWiseData =  DB::table('shareammount')
           ->join('memberinfo', 'memberinfo.id', '=', 'shareammount.fk_mem_id')
           // ->join('areainfo', 'areainfo.id', '=', 'shareammount.fk_root_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'shareammount.fk_brance_id')
            ->join('createadmin', 'createadmin.id', '=', 'shareammount.fk_user_id')
           ->select('shareammount.*','memberinfo.mem_name','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('shareammount.date', 'DESC')
            ->where('shareammount.fk_brance_id',$id->fk_brance_id)
            ->get();

      $selectMemnber =   DB::table('memberinfo')
                      ->orderBy('memberinfo.id', 'ASC')
                      ->where('memberinfo.fk_brance_Id',$id->fk_brance_id)
                      ->where('memberinfo.status','1')
                      ->get();



      return view('Admin.cost.sharelist',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','brancewiseexpTitle','allData','adminWiseData','selectMemnber'));

    }

    public function showsharelist(Request $Request){
        $type = $Request->package;
        $first = $Request->firstdate;
        $seconddate = $Request->seconddate;
         $explode = explode('-', $Request->firstdate);
      $renewdate =  $explode[2].'-'.$explode[1].'-'.$explode[0];  

      $explodes = explode('-', $Request->seconddate);
      $renewdats =  $explodes[2].'-'.$explodes[1].'-'.$explodes[0]; 

      $data =DB::table('shareammount')
           ->join('memberinfo', 'memberinfo.id', '=', 'shareammount.fk_mem_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'shareammount.fk_brance_id')
            ->join('createadmin', 'createadmin.id', '=', 'shareammount.fk_user_id')
            ->where('shareammount.fk_brance_id',$Request->Brance)
            ->where('shareammount.package',$Request->package)
            ->whereBetween('shareammount.date',array($renewdate,$renewdats))
            ->select('shareammount.*','memberinfo.mem_name','memberinfo.con_no','createadmin.name as adminname','branceinfo.name as bbane',DB::raw("sum(shareammount.ammount) as tammount"))
            ->groupBy('shareammount.fk_mem_id')
           ->orderBy('shareammount.sharenumber', 'ASC')
          ->get();

  $withs =DB::table('sharewithdraws')
            ->where('sharewithdraws.fk_brance_id',$Request->Brance)
            ->where('sharewithdraws.package',$Request->package)
            ->select('sharewithdraws.*',DB::raw("sum(sharewithdraws.sharewithdraw) as tsharewithdraw"))
            ->groupBy('sharewithdraws.fk_mem_id')
          ->get();

        


        return view('Admin.Report.sharelistreport',compact('data','type','withs','first','seconddate'));
    }


    public function sharedrawing()
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

$brancewiseroot = DB::table('areainfo')->where('fk_branc_id','=',$id->fk_brance_id)->get();
$brancewiseexpTitle  = DB::table('costinfo')
                    
              ->where('costinfo.inc_exp', '=', 'Income')
              ->where('costinfo.fk_brance_id','=',$id->fk_brance_id)
              ->get();
   $branceNam = DB::table('branceinfo')->get();


     $allData =  DB::table('shareammount')
    
           ->join('memberinfo', 'memberinfo.id', '=', 'shareammount.fk_mem_id')
           // ->join('areainfo', 'areainfo.id', '=', 'shareammount.fk_root_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'shareammount.fk_brance_id')
            ->join('createadmin', 'createadmin.id', '=', 'shareammount.fk_user_id')
           ->select('shareammount.*','memberinfo.mem_name','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('shareammount.date', 'DESC')
          ->get();

        $adminWiseData =  DB::table('shareammount')
           ->join('memberinfo', 'memberinfo.id', '=', 'shareammount.fk_mem_id')
           // ->join('areainfo', 'areainfo.id', '=', 'shareammount.fk_root_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'shareammount.fk_brance_id')
            ->join('createadmin', 'createadmin.id', '=', 'shareammount.fk_user_id')
           ->select('shareammount.*','memberinfo.mem_name','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('shareammount.date', 'DESC')
            ->where('shareammount.fk_brance_id',$id->fk_brance_id)
            ->get();

      $selectMemnber =   DB::table('shareammount')
                        ->join('memberinfo', 'memberinfo.id', '=', 'shareammount.fk_mem_id')
                      ->orderBy('shareammount.fk_mem_id', 'ASC')
                      ->where('shareammount.fk_brance_id',$id->fk_brance_id)
                      ->groupBy('shareammount.fk_mem_id')
                      ->get();
      return view('Admin.cost.sharedrawing',compact('data','type','mainlink','id','sublink','Adminminlink','adminsublink','branceNam','brancewiseexpTitle','allData','adminWiseData','selectMemnber'));
    }

    public function showsharpackage($Member)
    {
      echo '<option value="0">Select package</option>';
        $package=DB::table('shareammount')
        ->where('fk_mem_id',$Member)
        ->groupBy('package')
        ->get();
        if(count($package)){
            foreach ($package as $b) 
            {
              if ($b->package=='1') {
                echo '<option value="'.$b->package.'">100Tk</option>';
              }
              else
              {
                echo '<option value="'.$b->package.'">500Tk</option>';
              }
            }
        }
    }

    public function showsharammount(Request $request)
    {
        $totalamount=DB::select("SELECT sum(shareammount.ammount) as sharetotalamount,`shareammount`.*, `memberinfo`.`mem_name`, `memberinfo`.`con_no`, `createadmin`.`name` AS `adminname`, `branceinfo`.`name` AS `bbane`
FROM `shareammount`
INNER JOIN `memberinfo` ON `memberinfo`.`id` = `shareammount`.`fk_mem_id`
INNER JOIN `branceinfo` ON `branceinfo`.`id` = `shareammount`.`fk_brance_id`
INNER JOIN `createadmin` ON `createadmin`.`id` = `shareammount`.`fk_user_id`
WHERE `shareammount`.`fk_mem_id` = $request->Member 
AND `shareammount`.`package` = $request->package GROUP BY `shareammount`.`fk_mem_id`");        



        $totalwith=DB::select("SELECT sum(sharewithdraws.sharewithdraw) as totalsharewithdraw,`sharewithdraws`.*, `memberinfo`.`mem_name`, `memberinfo`.`con_no`, `branceinfo`.`name` AS `bbane`
FROM `sharewithdraws`
INNER JOIN `memberinfo` ON `memberinfo`.`id` = `sharewithdraws`.`fk_mem_id`
INNER JOIN `branceinfo` ON `branceinfo`.`id` = `sharewithdraws`.`fk_brance_id`
WHERE `sharewithdraws`.`fk_mem_id` = $request->Member 
AND `sharewithdraws`.`package` = $request->package GROUP BY `sharewithdraws`.`fk_mem_id`");


            if (count($totalwith)>0){
              $totalwith = $totalwith[0]->totalsharewithdraw;
            }
            else
            {
               $totalwith =0;
            }
                  return $showsharammount = $totalamount[0]->sharetotalamount - $totalwith;
    }



    public function savesharewithdraw(Request $request)

                    {
                      $explode= explode('-', $request->date);
                      $Date=$explode[2].'-'.$explode[1].'-'.$explode[0];
                      // $check= DB::table('shareammount')->where('fk_brance_id',$request->Brance)->where('fk_mem_id',$request->Member)->where('package',$request->package)->get();

                      // if (count($check)>0) {
                        $insert=DB::table('sharewithdraws')
                              ->where('fk_brance_id',$request->Brance)
                              ->where('fk_mem_id',$request->Member)
                              ->where('package',$request->package)
                              ->insert(['package'=> $request->package,'fk_mem_id' => $request->Member,'fk_brance_id'=> $request->Brance,'sharewithdraw' => $request->withdraw ,'ammount' => $request->presentshare,'withdraw_date'=> $Date,'fk_user_id' => $request->adminid]);

                      if ($insert) 
                      {
                        return redirect()->back()->with('success','withdraw Successfully');
                      }
                      else
                      {
                        return redirect()->back()->with('error','Something Wrong');
                      }
                      }
                      

    public function sharewithdraw(){



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

$brancewiseroot = DB::table('areainfo')->where('fk_branc_id','=',$id->fk_brance_id)->get();
$brancewiseexpTitle  = DB::table('costinfo')
                    
              ->where('costinfo.inc_exp', '=', 'Income')
              ->where('costinfo.fk_brance_id','=',$id->fk_brance_id)
              ->get();
   $branceNam = DB::table('branceinfo')->get();


     $allData =  DB::table('shareammount')
    
           ->join('memberinfo', 'memberinfo.id', '=', 'shareammount.fk_mem_id')
           // ->join('areainfo', 'areainfo.id', '=', 'shareammount.fk_root_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'shareammount.fk_brance_id')
            ->join('createadmin', 'createadmin.id', '=', 'shareammount.fk_user_id')
           ->select('shareammount.*','memberinfo.mem_name','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('shareammount.date', 'DESC')
          ->get();

        $adminWiseData =  DB::table('shareammount')
           ->join('memberinfo', 'memberinfo.id', '=', 'shareammount.fk_mem_id')
           // ->join('areainfo', 'areainfo.id', '=', 'shareammount.fk_root_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'shareammount.fk_brance_id')
            ->join('createadmin', 'createadmin.id', '=', 'shareammount.fk_user_id')
           ->select('shareammount.*','memberinfo.mem_name','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('shareammount.date', 'DESC')
            ->where('shareammount.fk_brance_id',$id->fk_brance_id)
            ->get();

      $selectMemnber =   DB::table('shareammount')
                        ->join('memberinfo', 'memberinfo.id', '=', 'shareammount.fk_mem_id')
                      ->orderBy('shareammount.fk_mem_id', 'ASC')
                      ->where('shareammount.fk_brance_id',$id->fk_brance_id)
                      ->groupBy('shareammount.fk_mem_id')
                      ->get();



      return view('Admin.cost.sharewithdraw',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','brancewiseexpTitle','allData','adminWiseData','selectMemnber'));

    }

    public function showssamm($brance,$memeid){
      

      $data = DB::table('shareammount')
                ->join('memberinfo','shareammount.fk_mem_id','=','memberinfo.id')
                
                ->join('branceinfo','branceinfo.id','=','shareammount.fk_brance_id')
                ->where('shareammount.fk_brance_id',$brance)
               ->where('shareammount.fk_mem_id',$memeid)
               ->where('shareammount.status','share')
               
                 ->select('memberinfo.mem_name','shareammount.*','branceinfo.name as bbane','memberinfo.con_no','memberinfo.perma_add')
                 ->get();

           

        return view('Admin.cost.sharetabledata',compact('data','type'));
    }
      
public function sharereturn(Request $Request,$getid)
    {

$obj = DB::table('shareammount')
                    ->where('id', $getid)
                    ->update( ['status' =>  'return','withdraw_date' =>  date('Y-m-d')]);


  if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Update Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Update Unsuccessfully']);

            }

    } 

}
