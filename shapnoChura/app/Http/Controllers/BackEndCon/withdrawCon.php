<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use DB;
use Session;
class withdrawCon extends Controller
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
           ->join('createadmin', 'createadmin.id', '=', 'savingcollection.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'savingcollection.fk_brance_id')
           ->select('memberinfo.mem_name','savingcollection.*','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('savingcollection.date', 'DESC')
          ->get();

        $branWiseData =  DB::table('savingcollection')
           ->join('memberinfo', 'memberinfo.id', '=', 'savingcollection.mem_id')
           ->join('createadmin', 'createadmin.id', '=', 'savingcollection.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'savingcollection.fk_brance_id')
           ->select('memberinfo.mem_name','savingcollection.*','createadmin.name as adminname','branceinfo.name as brancName')
           ->orderBy('savingcollection.date', 'DESC')
            ->where('savingcollection.fk_brance_id',$id->fk_brance_id)
            ->get();

    	return  view('Admin.withdraw.withdraw',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','allData','branWiseData'));
    }


      public function shwoMem(Request $request,$id,$id1){


       if($request->ajax()){
              $results = DB::table('savingcollection')
                ->join('memeradd','memeradd.Addid','=','savingcollection.mem_add_id')
                ->join('memberinfo','memberinfo.id','=','savingcollection.mem_id')
                ->where('savingcollection.type', '=', $id)
                ->where('savingcollection.fk_brance_id', '=', $id1)
                ->groupby('savingcollection.mem_add_id')
                ->select('memeradd.Addid','memberinfo.mem_name','memberinfo.id')
                ->get();
              return $results;
                         
                }

      
    }


     public function showpre(Request $request,$id1){

       if($request->ajax()){
          
         $data=DB::table('savingcollection')
          ->join('memeradd','memeradd.Addid','=','savingcollection.mem_add_id')
         ->where('savingcollection.mem_add_id',$id1)
          ->where('memeradd.status', '=', '1')
           
            ->sum('today_withdraw') ;
            
            

        
          return $data;
       }

    }

     public function show(Request $request,$getid,$id1){

       if($request->ajax()){
          
           
         $data=DB::table('savingcollection')
         ->where('mem_add_id',$id1)
            ->where('mem_id',$getid)
            ->sum('today_dep') ;
          return $data;
       }

    }

    public function showINs(Request $request,$getid,$id1){

       if($request->ajax()){
          
         $data=DB::table('savingcollection')
         ->where('mem_add_id',$id1)
            ->where('mem_id',$getid)
            ->where('today_withdraw','!=','')
            ->count('id') ;
            
            

        
          return $data+1;
       }

    }


     public function save(Request $Request){

        $this->validate($Request, [
            'Brance' => 'required',
            'Type' => 'required',
            'Name' => 'required',
            'date' => 'required',
            'todaytk' => 'required',
        ]);



$explode = explode('/', $Request->Name);


   $resutl = DB::table('savingcollection')
            ->where('mem_id',$explode[0])
              ->where('mem_add_id',$explode[1])
              ->where('date',$Request->date)
               ->where('type',$Request->Type)
              ->get();

              if(count($resutl) >0 ){



                      $insertDate =   DB::table('savingcollection')
                  ->where('mem_add_id', $resutl[0]->mem_add_id)
                   ->where('mem_id', $resutl[0]->mem_id)
                    ->where('date', $Request->date)
                      ->where('type',$Request->Type)
                  ->update([
                    'total_withdraw' => $Request->Saving,
                    'today_withdraw' => $Request->todaytk,
                  ]);



              }else{
               


         $insertDate = DB::table('savingcollection')->insert(
                ['date' =>  $Request->date, 
                  'mem_id' => $explode[0], 
                  'mem_add_id' => $explode[1], 
                  'type' => $Request->Type,
                  'total_withdraw' => $Request->Saving, 
                  'today_withdraw' => $Request->todaytk,
                  
                  'fk_brance_id' => $Request->Brance,
                  'fk_user_id' => $Request->adminid]
            );


       }

          if($insertDate){

            Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insertDate);

          }
          return redirect()->back();
    }

     public function delete($id){

                $obj = DB::table('withdrawinfo')->where('id', '=', $id)->delete();
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }



}
