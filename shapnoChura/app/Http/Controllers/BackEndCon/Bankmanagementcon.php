<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use Session;
use DB;
class Bankmanagementcon extends Controller
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

			
    	$mainMenu  = DB::table('adminmainmenu')
                ->orderBy('serialNo', 'asc')
                ->get();

        $branceNam = DB::table('branceinfo')->get();

        $showAllData  = DB::table('bank_info')
            ->join('createadmin', 'createadmin.id', '=', 'bank_info.fk_user_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'bank_info.fk_brance_id')
            ->select('bank_info.*', 'createadmin.name as adminname','branceinfo.name as branceName')
            ->get();

       $adminWiseData  = DB::table('bank_info')
            ->join('createadmin', 'createadmin.id', '=', 'bank_info.fk_user_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'bank_info.fk_brance_id')
            ->select('bank_info.*', 'createadmin.name as adminname','branceinfo.name as branceName')
            ->where( 'bank_info.fk_brance_id',$id->fk_brance_id)
            ->get();

       
			return  view('Admin.Bankmanagement.bankinfo',compact('mainMenu','mainlink','id','sublink','Adminminlink','adminsublink','branceNam','showAllData','adminWiseData'));
    }

      public function save(Request $request){

          $this->validate($request, [
            'Date' => 'required',
            'Bank' => 'required',
            'Ac' => 'required',
            'Accounttype' => 'required',
            'mblno' => 'required',
            

        ]);

             $insertDate = DB::table('bank_info')->insert(
                [ 'date' =>  $request->Date, 
                'bank_name' =>  $request->Bank, 
                'ac_no' => $request->Ac, 
                'type' => $request->Accounttype,
                'add' => $request->Address,
                'mbl_no' => $request->mblno,
               'fk_brance_id' => $request->Brance, 
                'fk_user_id' => $request->adminid]
            );


          if($insertDate){

              
            Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insertDate);

          }
          return redirect()->back();


      }

       public function Dalete($id){


        $obj = DB::table('bank_info')->where('id', '=', $id)->delete();
        
     

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }


    public function editbankinfo($getid){

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

      
      $mainMenu  = DB::table('adminmainmenu')
                ->orderBy('serialNo', 'asc')
                ->get();
 $branceNam = DB::table('branceinfo')->get();

    $alldata = DB::table('bank_info') 
            ->join('branceinfo', 'branceinfo.id', '=', 'bank_info.fk_brance_id')
            ->select('bank_info.*','branceinfo.name as branceName')
            ->where( 'bank_info.id',$getid)
            ->get();
       
      return  view('Admin.Bankmanagement.editbankinfo',compact('mainMenu','mainlink','id','sublink','Adminminlink','adminsublink','branceNam','alldata'));
    }


    public function editsucc(Request $Request)
    {

      $obj = DB::table('bank_info')
                    ->where('id', $Request->upid)
                    ->update(['date' => $Request->Date,
                      'bank_name' => $Request->Bank,
                      'ac_no' =>  $Request->Ac,
                      'type' => $Request->Accounttype,
                      'add' => $Request->Address,
                      'mbl_no' => $Request->mblno,
                      'fk_brance_id' => $Request->Brance,
                      'fk_user_id' => $Request->adminid]);
                  if($obj){

                Session::flash('success','Save Success');
                }else{

                  Session::flash('error',$obj);

                }
                return redirect()->back();
    }


 public function showMem(Request $request,$id){


       if($request->ajax()){
                    $results = DB::table('bank_info')
                   
             
              ->where('bank_info.fk_brance_id', '=', $id)

              ->get();
              return $results;
                         
                }

      
    }




 public function showAcNO(Request $request,$id,$getid){


       if($request->ajax()){
              $results = DB::table('bank_info')
               
              ->where('bank_info.fk_brance_id', '=', $id)
              ->where('bank_info.id', '=', $getid)
              ->get();
             return $results[0]->ac_no;
                         
                }

      
    }


 public function showCurrent(Request $request,$id,$getid){


       if($request->ajax()){
              $saving = DB::table('bank_management')
              ->where('bank_management.fk_brance_id', '=', $id)
              ->where('bank_management.fk_bank_id', '=', $getid)
              ->where('bank_management.transaction_type', '=', 'Saving')
              ->sum('ammount');

               $withdraw = DB::table('bank_management')
              ->where('bank_management.fk_brance_id', '=', $id)
              ->where('bank_management.fk_bank_id', '=', $getid)
              ->where('bank_management.transaction_type', '=', 'Withdraw')
              ->sum('ammount');


             return $saving-$withdraw;
                         
                }

      
    }






    public function index1(){


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

			
    	$mainMenu  = DB::table('adminmainmenu')
                ->orderBy('serialNo', 'asc')
                ->get();
 $branceNam = DB::table('branceinfo')->get();

  $bankname = DB::table('bank_info')
              ->where('bank_info.fk_brance_id', '=', $id->fk_brance_id)
              ->get();

    $showAllData  = DB::table('bank_management')

            ->join('bank_info', 'bank_info.id', '=', 'bank_management.fk_bank_id')
           
            ->join('createadmin', 'createadmin.id', '=', 'bank_management.fk_user_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'bank_management.fk_brance_id')
            ->select('bank_management.*','bank_info.bank_name', 'createadmin.name as adminname','branceinfo.name as branceName')
            ->get();

       $adminWiseData  = DB::table('bank_management')

            ->join('bank_info', 'bank_info.id', '=', 'bank_management.fk_bank_id')
           
            ->join('createadmin', 'createadmin.id', '=', 'bank_management.fk_user_id')
           ->join('branceinfo', 'branceinfo.id', '=', 'bank_management.fk_brance_id')
            ->select('bank_management.*','bank_info.bank_name', 'createadmin.name as adminname','branceinfo.name as branceName')
            ->where( 'bank_management.fk_brance_id',$id->fk_brance_id)
            ->get();


       
			return  view('Admin.Bankmanagement.Bankmanage',compact('mainMenu','mainlink','id','sublink','Adminminlink','adminsublink','branceNam','bankname','showAllData','adminWiseData'));
    }


 public function withoutPrefix($table,$fildname,$prefix,$id_length)
          {

            $subt = substr($prefix, 0,1);
            $query  = DB::table('bank_management')
            ->where('id','LIKE',"%{$subt}%")
            ->max('id');
            $prefix_length=strlen($prefix);
     
            $only_id=substr($query,$prefix_length);

            $new=(int)($only_id);
  
            $new++;
 
            $number_of_zero=$id_length-$prefix_length-strlen($new);
            $zero=str_repeat("0", $number_of_zero);
       
            $made_id=$prefix.$zero.$new;

            return   $made_id;

        }


    public function savemange(Request $request){


$explodedate = explode('-', $request->Date);
        $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];


          $this->validate($request, [
            'Date' => 'required',
            'Bank' => 'required',
            'Ac' => 'required',
            'Voucher' => 'required',
            'Ammount' => 'required',
            

        ]);

          if( $request->Accounttype ==="Withdraw"){
            $prefix = 'w-'.date('d-m-y-');
      $autid=$this->withoutPrefix('bank_management','id',$prefix,'20');
    }else{
         $prefix = 's-'.date('d-m-y-');
  $autid=$this->withoutPrefix('bank_management','id',$prefix,'20');
   

    }

             $insertDate = DB::table('bank_management')->insert(
                [ 'id' =>  $autid,
                  'date' =>  $renewdate, 
                'fk_bank_id' =>  $request->Bank, 
                'ac_no' => $request->Ac, 
                'transaction_type' => $request->Accounttype,
                'voucherNo' => $request->Voucher,
                 'ammount' => $request->Ammount,
                'naration' => $request->Narration,
               'fk_user_id' => $request->adminid, 
                'fk_brance_id' => $request->Brance]
            );


          if($insertDate){

              if( $request->Accounttype =="Withdraw"){
      $autid=$this->withoutPrefix('bank_management','id','with-','12');
    }else{
  $autid=$this->withoutPrefix('bank_management','id','sav-','12');
   

    }

              
            Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insertDate);

          }
          return redirect()->back();
    }

       public function Daletemanage($id){


        $obj = DB::table('bank_management')->where('id', '=', $id)->delete();
        
     

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }



    public function editbankmanage($getid){

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

      
      $mainMenu  = DB::table('adminmainmenu')
                ->orderBy('serialNo', 'asc')
                ->get();
 $branceNam = DB::table('branceinfo')->get();

    $alldata = DB::table('bank_management') 
            ->join('bank_info', 'bank_info.id', '=', 'bank_management.fk_bank_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'bank_management.fk_brance_id')
            ->select('bank_management.*','bank_info.bank_name','branceinfo.name as branceName')
            ->where( 'bank_management.id',$getid)
            ->get();

    $saving = DB::table('bank_management')
              ->where('bank_management.fk_brance_id', '=', $alldata[0]->fk_brance_id)
              ->where('bank_management.fk_bank_id', '=',  $alldata[0]->fk_bank_id)
              ->where('bank_management.transaction_type', '=', 'Saving')
              ->sum('ammount');

    $withdraw = DB::table('bank_management')
                ->where('bank_management.fk_brance_id', '=', $alldata[0]->fk_brance_id)
              ->where('bank_management.fk_bank_id', '=',  $alldata[0]->fk_bank_id)
              ->where('bank_management.transaction_type', '=', 'Withdraw')
              ->sum('ammount');


        $total= $saving-$withdraw;


       
      return  view('Admin.Bankmanagement.editbankmanage',compact('mainMenu','mainlink','id','sublink','Adminminlink','adminsublink','branceNam','alldata','total'));
    }





    

public function editsuccmangae(Request $Request)
    {


      $explodedate = explode('-', $Request->Date);
        $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];

      $obj = DB::table('bank_management')
                    ->where('id', $Request->upid)
                    ->update(['date' => $renewdate,
                      'fk_bank_id' => $Request->Bank,
                      'ac_no' =>  $Request->Ac,
                      'transaction_type' => $Request->Accounttype,
                      'voucherNo' => $Request->Voucher,
                      'ammount' => $Request->Ammount,
                      'naration' => $Request->Narration,
                      'fk_brance_id' => $Request->Brance,
                      'fk_user_id' => $Request->adminid]);
                  if($obj){

                Session::flash('success','Save Success');
                }else{

                  Session::flash('error',$obj);

                }
                return redirect()->back();
    }

    public function showBankreport(){



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
    

      return view('Admin.Bankmanagement.report',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data','brancewiseexpTitle'));
      
    }

    public function showTabReport(Request $request){

      $Brance = $request->Brance;
$date = $request->data;
      $month = $request->month;
      $year = $request->year;
       $Title = $request->Title;
       $Type = $request->Type;


        if($request->Title ==='1'){

              

            if($request->Type === '5'){
           
              $data = DB::table('bank_management')
                    ->where('bank_management.transaction_type', '=','Saving')
                    ->where('bank_management.date', '=',$request->data)
                    ->where('bank_management.fk_brance_id', '=',$request->Brance)
                    ->get();
                  $total = DB::table('bank_management')
                    ->where('bank_management.transaction_type', '=','Saving')
                    ->where('bank_management.date', '=',$request->data)
                    ->where('bank_management.fk_brance_id', '=',$request->Brance)
                    ->sum('bank_management.ammount');

            }


            if($request->Type === '2'){
           
           $data =  DB::table('bank_management')
                    ->where('bank_management.transaction_type', '=','Saving')
                    ->where(DB::raw("substr(bank_management.date, 1, 2)"), '=',$request->month)
                    ->where(DB::raw("substr(bank_management.date, 7, 4)"), '=',$request->year)
                      ->where('bank_management.fk_brance_id', '=',$request->Brance)
                    ->get();

                      $total =  DB::table('bank_management')
                    ->where('bank_management.transaction_type', '=','Saving')
                    ->where(DB::raw("substr(bank_management.date, 1, 2)"), '=',$request->month)
                    ->where(DB::raw("substr(bank_management.date, 7, 4)"), '=',$request->year)
                      ->where('bank_management.fk_brance_id', '=',$request->Brance)
                     ->sum('bank_management.ammount');

            }

              if($request->Type === '3'){
           
           $data = DB::table('bank_management')
                    ->where('bank_management.transaction_type', '=','Saving')
                   
                    ->where(DB::raw("substr(bank_management.date, 7, 4)"), '=',$request->year)
                      ->where('bank_management.fk_brance_id', '=',$request->Brance)
                    ->get();

                     $total =  DB::table('bank_management')
                    ->where('bank_management.transaction_type', '=','Saving')
                   
                    ->where(DB::raw("substr(bank_management.date, 7, 4)"), '=',$request->year)
                      ->where('bank_management.fk_brance_id', '=',$request->Brance)
                    ->sum('bank_management.ammount');

            }



         
        }
        else
        {

               if($request->Type === '5'){
           
             $data = DB::table('bank_management')
                    ->where('bank_management.transaction_type', '=','Withdraw')
                   ->where('bank_management.date', '=',$request->data)
                   ->where('bank_management.fk_brance_id', '=',$request->Brance)
                    ->get();
                  $total = DB::table('bank_management')
                    ->where('bank_management.transaction_type', '=','Withdraw')
                    ->where('bank_management.date', '=',$request->data)
                    ->where('bank_management.fk_brance_id', '=',$request->Brance)
                    ->sum('bank_management.ammount');

            }


            if($request->Type === '2'){
           
           $data =  DB::table('bank_management')
                    ->where('bank_management.transaction_type', '=','Withdraw')
                    ->where(DB::raw("substr(bank_management.date, 1, 2)"), '=',$request->month)
                    ->where(DB::raw("substr(bank_management.date, 7, 4)"), '=',$request->year)
                      ->where('bank_management.fk_brance_id', '=',$request->Brance)
                    ->get();

                      $total =  DB::table('bank_management')
                    ->where('bank_management.transaction_type', '=','Withdraw')
                    ->where(DB::raw("substr(bank_management.date, 1, 2)"), '=',$request->month)
                    ->where(DB::raw("substr(bank_management.date, 7, 4)"), '=',$request->year)
                      ->where('bank_management.fk_brance_id', '=',$request->Brance)
                     ->sum('bank_management.ammount');

            }

              if($request->Type === '3'){
           
           $data = DB::table('bank_management')
                    ->where('bank_management.transaction_type', '=','Withdraw')
                   
                    ->where(DB::raw("substr(bank_management.date, 7, 4)"), '=',$request->year)
                      ->where('bank_management.fk_brance_id', '=',$request->Brance)
                    ->get();

                     $total =  DB::table('bank_management')
                    ->where('bank_management.transaction_type', '=','Withdraw')
                   
                    ->where(DB::raw("substr(bank_management.date, 7, 4)"), '=',$request->year)
                      ->where('bank_management.fk_brance_id', '=',$request->Brance)
                    ->sum('bank_management.ammount');

            }

        


        }

        $bankname = DB::table('bank_info')->get();

        return view('Admin.Bankmanagement.reporttab',compact('data','month','year','Title','Type','total','date','bankname'));



    }

}
