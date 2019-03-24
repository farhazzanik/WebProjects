<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use Session;
use DB;
use DateTime;
class monthlyprofitCon extends Controller
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

  $showAllDate  = DB::table('pakage_type_mmpds')
            ->join('createadmin', 'createadmin.id', '=', 'pakage_type_mmpds.fk_admin_id')
              ->select('pakage_type_mmpds.*', 'createadmin.name as adminname')
         
            ->get();


     $adminWiseBrance  =  DB::table('pakage_type_mmpds')
            ->join('createadmin', 'createadmin.id', '=', 'pakage_type_mmpds.fk_admin_id')
->select('pakage_type_mmpds.*', 'createadmin.name as adminname')
         
       
            
            ->get();

    	return view('Admin.mmpds.monthlypackage',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','showAllDate','adminWiseBrance'));
    }


    public function save(Request $request){

    	 $this->validate($request, [
            
           
            'Ammount' => 'required',
            'Profit' => 'required',
            'numbmonth' => 'required',
        ]);
$explodedate = explode('-', $request->Date);
$createdate  = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

    	  $insert = DB::table('pakage_type_mmpds')->insert(
    ['ammount' =>  $request->Ammount ,'Profit' =>  $request->Profit , 'fk_admin_id'=>$request->adminid,'date' => $createdate,'num_of_month' => $request->numbmonth ]
        );

    	   if($insert){

          Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insert);

          }
          return redirect()->back();
   

    }


    
 public function Delete($id){

                $obj = DB::table('pakage_type_mmpds')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }

    public function packreg(){

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

$showAllDate = DB::table('mmpds_pack_reg')
            ->join('createadmin', 'createadmin.id', '=', 'mmpds_pack_reg.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'mmpds_pack_reg.fk_brance_id')
            ->join('memberinfo', 'memberinfo.id', '=', 'mmpds_pack_reg.fk_mem_id')
            ->select('mmpds_pack_reg.*', 'createadmin.name as adminname','branceinfo.name as brancename','memberinfo.mem_name')
          ->get();


$adminWiseBrance  = DB::table('mmpds_pack_reg')
            ->join('createadmin', 'createadmin.id', '=', 'mmpds_pack_reg.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'mmpds_pack_reg.fk_brance_id')
            ->join('memberinfo', 'memberinfo.id', '=', 'mmpds_pack_reg.fk_mem_id')
            ->select('mmpds_pack_reg.*', 'createadmin.name as adminname','branceinfo.name as brancename','memberinfo.mem_name')
            ->where('mmpds_pack_reg.fk_brance_id',$id->fk_brance_id)
            ->get();

$allpackage = DB::table('pakage_type_mmpds')->get();
$selectMemnber =  DB::table('memberinfo')
                      ->orderBy('memberinfo.id', 'ASC')
                      ->where('memberinfo.fk_brance_Id',$id->fk_brance_id)
                      ->where('memberinfo.status','1')
                      ->get();

$showpack  =  DB::table('pakage_type_mmpds')
                   ->groupBy('num_of_month')
                     ->get();
                       $referenceBy = DB::table('employeeinfo') ->where('employeeinfo.fk_branc_id',$id->fk_brance_id)->get();

        return view('Admin.mmpds.packregister',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','showAllDate','adminWiseBrance','allpackage','selectMemnber','referenceBy','showpack'));

    }



  public function showpack(Request $request,$id1){


       if($request->ajax()){
                    $results  =  DB::table('pakage_type_mmpds')
                    ->where('pakage_type_mmpds.fk_brance_id',$id1)
                     ->get();
              return $results;
                         
                }

      
    }


    public function showData(Request $request,$id1,$date){

$explodedate = explode('-', $date);
$createdate  = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

    
     $results  =  DB::table('pakage_type_mmpds')
                    ->where('date','<=',$createdate)
                    ->where('num_of_month',$id1)
                    ->orderBy('date','DESC')
                    ->limit(1)
                     ->get();


  if($results== true){
     return response()->json(['ammount'=>$results[0]->ammount,
        'profit'=>$results[0]->profit ]);

       }
    }


 public function withoutPrefix($table,$fildname,$prefix,$id_length)
          {
            
            $query  = DB::table('mmpds_pack_reg')->max('id');
            $prefix_length=strlen($prefix);
     
            $only_id=substr($query,$prefix_length);

            $new=(int)($only_id);
  
            $new++;
 
            $number_of_zero=$id_length-$prefix_length-strlen($new);
            $zero=str_repeat("0", $number_of_zero);
       
            $made_id=$prefix.$zero.$new;

            return   $made_id;

        }



    public function savemmpds(Request $request){

          $this->validate($request, [
             'accno' =>'required', 
            'Todaydate' => 'required',
            'Member' => 'required',
            'Package' => 'required',
            'Ammount' => 'required',
            'Profit' => 'required',
        ]);

// $prefix= $request->Member.$request->Package;
// $autid=$this->withoutPrefix('mmpds_pack_reg','id',$prefix,'10');

$explodedate = explode('-', $request->Todaydate);
$createdate  = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];
          $insert = DB::table('mmpds_pack_reg')
          ->insert(
                [
                'id' =>$request->accno, 
                'date' =>$createdate, 
                'fk_mem_id' =>$request->Member,
                'fk_pack_id' =>$request->Package, 
                'fk_refer_id'=>$request->Reference,
                'ammount' =>$request->Ammount,
                'profit' =>$request->Profit, 
                'comment'=>$request->comments,
                'fk_user_id' =>$request->adminid,
                'fk_brance_id' =>$request->Brance 
            ]);

           if($insert){

          Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insert);

          }
          return redirect()->back();   
    }



public function editmmpreg($getid,$branceid){

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

$allpackage = DB::table('pakage_type_mmpds')->get();
$selectMemnber =  DB::table('memberinfo')
                      ->orderBy('memberinfo.id', 'ASC')
                      ->where('memberinfo.fk_brance_Id',$id->fk_brance_id)
                      ->where('memberinfo.status','1')
                      ->get();
$showpack  =  DB::table('pakage_type_mmpds')
                    ->where('pakage_type_mmpds.fk_brance_id',$branceid)
                     ->get();
$allDAta = DB::table('mmpds_pack_reg')
          ->join('memberinfo','memberinfo.id','=','mmpds_pack_reg.fk_mem_id')
          ->join('employeeinfo','employeeinfo.id','=','mmpds_pack_reg.fk_refer_id')
          ->join('pakage_type_mmpds','pakage_type_mmpds.id','=','mmpds_pack_reg.fk_pack_id')
          ->select('mmpds_pack_reg.*','employeeinfo.Name as empname','memberinfo.mem_name','pakage_type_mmpds.name as packname')
          ->where('mmpds_pack_reg.id','=',$getid)
          ->get();

          

  return view('Admin.mmpds.editmmpdsreg',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','showAllDate','adminWiseBrance','allpackage','selectMemnber','allDAta','showpack'));

}



    public function editsuccmmpds(Request $request){

          $this->validate($request, [
            'Todaydate' => 'required',
            'Member' => 'required',
            'Package' => 'required',
            'Ammount' => 'required',
            'Profit' => 'required',
        ]);



          $insert = DB::table('mmpds_pack_reg')
         ->where('id', $request->autoid)
           
          ->update(
                [
               
                'date' =>$request->Todaydate, 
                'fk_pack_id' =>$request->Package, 
                'ammount' =>$request->Ammount,
                'profit' =>$request->Profit, 
                'comment'=>$request->comments
                
            ]);

           if($insert){

          Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insert);

          }
          return redirect()->back();   
    }
 public function delmmpds($id){
$obj = DB::table('mmpds_pack_reg')->where('id', '=', $id)->delete();
 if($obj== true){
      return response()->json(['success'=>true,'status'=>'Delete Successfully']);
}else {

   return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }



    public function showReport(){


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

$allpackage = DB::table('pakage_type_mmpds')->get();

$selectMemnber =  DB::table('memberinfo')
                      ->orderBy('memberinfo.id', 'ASC')
                      ->where('memberinfo.fk_brance_Id',$id->fk_brance_id)
                      ->where('memberinfo.status','1')
                      ->get();

$showpack  =  DB::table('pakage_type_mmpds')
                    ->groupBy('num_of_month')
                     ->get();
                       $referenceBy = DB::table('employeeinfo') ->where('employeeinfo.fk_branc_id',$id->fk_brance_id)->get();

        return view('Admin.mmpds.report',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','showAllDate','adminWiseBrance','allpackage','selectMemnber','referenceBy','showpack'));
      
    }



public function showReportmmpds(Request $request){
    $id =   Auth::guard('admin')->user();

$type = $request->type;
$pack = $request->Package;
    if($request->type == '2'){

$explodedate = explode('-', $request->Todaydate);
$selecteddate  = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

    $date = substr($request->Todaydate, 0,2);

      $allDAta =  DB::table('mmpds_pack_reg')
          ->join('memberinfo','memberinfo.id','=','mmpds_pack_reg.fk_mem_id')
          ->select('mmpds_pack_reg.*','memberinfo.mem_name')
          ->where('mmpds_pack_reg.fk_pack_id','=',$request->Package)
          ->where('mmpds_pack_reg.fk_brance_id','=',$request->Brance)
           ->where(DB::raw("substr(mmpds_pack_reg.date, 9, 2)"), '=',$explodedate[0])
          ->get();

      $paymenttype = $request->Package;
    }else{

    

      $allDAta =  DB::table('mmpds_pack_reg')
          ->join('memberinfo','memberinfo.id','=','mmpds_pack_reg.fk_mem_id')
          ->select('mmpds_pack_reg.*','memberinfo.*')
          ->where('mmpds_pack_reg.fk_pack_id','=',$request->Package)
          ->where('mmpds_pack_reg.fk_brance_id','=',$request->Brance)

          ->get();

      $paymenttype = $request->Package;


    }
    return view('Admin.mmpds.reporttab',compact('allDAta','pack','id','selecteddate','paymenttype','type'));    
}


public function showReporttab($getid){

   $obj =  DB::table('mmpds_pack_reg')
          ->join('memberinfo','memberinfo.id','=','mmpds_pack_reg.fk_mem_id')
          ->select('mmpds_pack_reg.*','memberinfo.*')
          ->where('mmpds_pack_reg.id','=',$getid)
          ->get();
      return view('Admin.mmpds.showReport',compact('obj'));
}


public function mmpdsprowith(){

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

$showAllDate = DB::table('mmpds_withdraw')
            ->join('createadmin', 'createadmin.id', '=', 'mmpds_withdraw.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'mmpds_withdraw.fk_brance_id')
            ->join('memberinfo', 'memberinfo.id', '=', 'mmpds_withdraw.fk_mem_id')
            ->select('mmpds_withdraw.*', 'createadmin.name as adminname','branceinfo.name as brancename','memberinfo.mem_name')
          ->get();


$adminWiseBrance  =DB::table('mmpds_withdraw')
            ->join('createadmin', 'createadmin.id', '=', 'mmpds_withdraw.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'mmpds_withdraw.fk_brance_id')
            ->join('memberinfo', 'memberinfo.id', '=', 'mmpds_withdraw.fk_mem_id')
            ->select('mmpds_withdraw.*', 'createadmin.name as adminname','branceinfo.name as brancename','memberinfo.mem_name')
      
            ->where('mmpds_withdraw.fk_brance_id',$id->fk_brance_id)
            ->get();

$allpackage = DB::table('pakage_type_mmpds')->get();
$selectMemnber =  DB::table('memberinfo')
                      ->orderBy('memberinfo.id', 'ASC')
                      ->where('memberinfo.fk_brance_Id',$id->fk_brance_id)
                      ->where('memberinfo.status','1')
                      ->get();

$showpack  =  DB::table('pakage_type_mmpds')
                   ->groupBy('num_of_month')
                     ->get();
                       $referenceBy = DB::table('employeeinfo') ->where('employeeinfo.fk_branc_id',$id->fk_brance_id)->get();

        return view('Admin.mmpds.mmpdsprowith',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','showAllDate','adminWiseBrance','allpackage','selectMemnber','referenceBy','showpack'));



}

public function mmpdsprwithmem(Request $request,$id){


       if($request->ajax()){
        
          $results = DB::table('mmpds_pack_reg')
                      ->join('memberinfo','mmpds_pack_reg.fk_mem_id','=','memberinfo.id')
                      ->where('mmpds_pack_reg.fk_brance_id', '=', $id)
                      ->select('mmpds_pack_reg.id','memberinfo.mem_name')
                      ->get();
              return $results;
                         
                }

}


 public function mmpdsshowdd(Request $request,$id1,$selecdate){


   


     $results  =  DB::table('mmpds_pack_reg')
                    ->where('id','=',$id1)
                    ->get();

$oldnet = DB::table('mmpds_withdraw')
                    ->where('fk_mmpds_id','=',$id1)
                    ->where('status','=','1')
                    ->sum('withdraw');

    $oldprofit = DB::table('mmpds_withdraw')
                    ->where('fk_mmpds_id','=',$id1)
                    ->where('status','=','2')
                    ->sum('withdraw');

    $date1 = new DateTime($results[0]->date);
    $date2 = new DateTime($selecdate);
    $interval = date_diff($date1, $date2);
    $howma= $interval->m + ($interval->y * 12);

    $totalprofit = $results[0]->profit*$howma;

     return response()->json(['oldprofit'=>$oldprofit,'oldnet'=>$oldnet,'memid'=>$results[0]->fk_mem_id,'ammount'=>$results[0]->ammount,
        'profit'=>$totalprofit,'date' =>  $results[0]->date,'hmonth' => $howma]);

      
    }


    public function mmpdsammwith(Request $request){

       $this->validate($request, [
            
           
            'Member' => 'required',
            'pwith' => 'required',
            'Todaydate' => 'required',
        ]);
$explodedate = explode('-', $request->Todaydate);
$createdate  = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];



        $insert = DB::table('mmpds_withdraw')->insert(
    ['fk_mmpds_id' =>  $request->Member ,'withdraw' =>  $request->pwith , 'status'=>$request->Status,'fk_user_id' =>$request->adminid,'fk_brance_id' => $request->Brance,'date' => $createdate,'fk_mem_id' => $request->memberid]
        );

         if($insert){

          Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insert);

          }
          return redirect()->back();
   

    }

    
 public function mmpdswithdel($id){

                $obj = DB::table('mmpds_withdraw')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }


}
