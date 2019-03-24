<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use Session;
use DB;
class investlatterCon extends Controller
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




    $data = DB::table('investlatter')
         
            ->join('createadmin', 'createadmin.id', '=', 'investlatter.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'investlatter.fk_brance_id')
            ->join('memberinfo','memberinfo.id','=','investlatter.appName')
            ->select('investlatter.*','createadmin.name as adminname','branceinfo.name as branceName','memberinfo.mem_name')
            ->get();

  $adminWiseData = DB::table('investlatter')
            ->join('createadmin', 'createadmin.id', '=', 'investlatter.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'investlatter.fk_brance_id')
            ->select('investlatter.*','createadmin.name as adminname','branceinfo.name as branceName')
            ->where('investlatter.fk_brance_id',$id->fk_brance_id)
            ->get();

 $selectMemnber = DB::table('memeradd')
                     ->join('memberinfo','memeradd.memberName','=','memberinfo.id')
                     ->orderBy(DB::raw('substr(memeradd.Addid, 11, 4)'),'ASC')
                      ->where('memeradd.fk_brance_id',$id->fk_brance_id)
                      ->where('memeradd.status','1')
                      ->get();




     $referenceBy = DB::table('employeeinfo') ->where('employeeinfo.fk_branc_id',$id->fk_brance_id)->get();

    	return view('Admin.invest.investlatter',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data','adminWiseData','selectMemnber','referenceBy'));
    }



       public function withoutPrefix($table,$fildname,$prefix,$id_length)
          {
            
            $query  = DB::table('investlatter')->max('id');
            $prefix_length=strlen($prefix);
     
            $only_id=substr($query,$prefix_length);

            $new=(int)($only_id);
  
            $new++;
 
            $number_of_zero=$id_length-$prefix_length-strlen($new);
            $zero=str_repeat("0", $number_of_zero);
       
            $made_id=$prefix.$zero.$new;

            return   $made_id;

        }
         public function save(Request $request){



      $this->validate($request, [
            
            'ApplicantN' => 'required',
           
            
    			  'ID' => 'required',
             'Type' => 'required',
              'Status' => 'required',

        ]);

    
        $explodedate = explode('-', $request->Appdate);
        $renewdate = $explodedate[2].'-'.$explodedate[1].'-'.$explodedate[0];
        
        $explodedates = explode('-', $request->Expirationdate);
        $Expirationdate = $explodedates[2].'-'.$explodedates[1].'-'.$explodedates[0];

        $exp = explode('-', $request->FullpaymentDate);
        $FullpaymentDate = $exp[2].'-'.$exp[1].'-'.$exp[0];


      if($request->Type == '5'){

          $packid = '2632';
      }else if($request->Type == '2'){

        $packid = '2662';

      }
      $exsavid = explode('-', $request->ApplicantN);

      $autoid = $packid.'-'.$exsavid[1].'-'.$exsavid[2].'-'.$request->ID;
       $insertDate = DB::table('investlatter')->insert(
                [
                'id' =>   $autoid, 
                'appDate' =>  $renewdate, 
                'type' => $request->Type, 
                'appName' =>$exsavid[1], 
                'fathername' => $request->Father, 
                'mothername' => $request->Mother, 
                
                'soulmate' => $request->soulmate, 
                'businessAdd' => $request->businesAdd, 
                'presentAdd' => $request->Present, 
                'permanentAdd' =>  $request->Permanent, 
                'invesQuanT' =>  $request->investmentqoun, 
                'divendend' => $request->Dividend,
                'servCharge' =>  $request->charge,
                'instalAmm' =>  $request->installmentamm, 
                'inswisedivendend' =>  $request->inswisedivendend, 
                'instalNO' =>  $request->insnumber, 
                'expireDate' =>  $Expirationdate,
                'profits' =>  $request->profits, 
                'fullPayDAte' =>  $FullpaymentDate, 
                'comments' =>  $request->Comments, 

                'fk_user_id' => $request->adminid,
                'fk_brance_id' => $request->Brance,

                
                'fk_emp_id' => $request->Reference,
                'fk_area_id' => $request->Area,
                'status' => $request->Status,
              

              ]
            );



        if($insertDate){

             Session::flash('success','Save Success');

          }else{

            Session::flash('error',$insertDate);

          }
          return redirect()->back();


    }

         public function delete($id){

          $obj = DB::table('investlatter')->where('id', '=', $id)->delete();
         
          

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }

    public function editPage($getiid){
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


        $selectArea = DB::table('areainfo')
                      ->orderBy('areainfo.id', 'ASC')
                      ->where('fk_branc_id',$id->fk_brance_id)
                      ->get();

          $referenceBy = DB::table('employeeinfo')->get();

   $data = DB::table('investlatter')
            ->join('createadmin', 'createadmin.id', '=', 'investlatter.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'investlatter.fk_brance_id')
            ->join('memberinfo','memberinfo.id','=','investlatter.appName')
            ->join('employeeinfo', 'employeeinfo.id', '=', 'investlatter.fk_emp_id')
            ->join('areainfo', 'areainfo.id', '=', 'investlatter.fk_area_id')
            ->select('investlatter.*','createadmin.name as adminname','branceinfo.name as branceName','memberinfo.mem_name','areainfo.area_name','employeeinfo.Name as empname')
            ->where('investlatter.id',$getiid)
            ->get();

        return  view('Admin.invest.EditinvestLater',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','data','packageType','selectArea','referenceBy'));
    }

    public function update(Request $request){





        $insertDate = DB::table('investlatter')
       ->where('id', $request->id)

       ->update(
                [
                'appDate' => $request->Appdate, 
                'type' => $request->Type, 
                'appName' =>$request->ApplicantN, 
                'fathername' => $request->Father, 
                'mothername' => $request->Mother, 
                'soulmate' => $request->soulmate, 
                'businessAdd' => $request->businesAdd, 
                'presentAdd' => $request->Present, 
                'permanentAdd' =>  $request->Permanent, 
                'invesQuanT' =>  $request->investmentqoun,
                 'divendend' => $request->Dividend, 
                'servCharge' =>  $request->charge,
                'instalAmm' =>  $request->installmentamm,
                'instalNO' =>  $request->insnumber, 
                'expireDate' =>  $request->Expirationdate,
                'profits' =>  $request->profits, 
                'fullPayDAte' =>  $request->FullpaymentDate, 
               'comments' =>  $request->Comments, 
                'fk_user_id' => $request->adminid,
                'fk_brance_id' => $request->Brance,
                 'fk_emp_id' => $request->Reference,
                'fk_area_id' => $request->Area,
                'status' => $request->Status
             ]
            );



        if($insertDate){

             Session::flash('success','Save Success');

          }else{

            Session::flash('error',$insertDate);

          }
          return redirect()->back();


    }

    public function showReport($getid){
$data = DB::table('investlatter')
               ->join('memberinfo','memberinfo.id','=','investlatter.appName')
              ->select('investlatter.*','memberinfo.mem_name')
               ->where('investlatter.id',$getid)->get();
      return  view('Admin.invest.report',compact('data'));
    }


    public function showMem(Request $request,$getbrance){

   if($request->ajax()){
                    $results  =  DB::table('memeradd')
                     ->join('memberinfo','memeradd.memberName','=','memberinfo.id')
                     ->orderBy(DB::raw('substr(memeradd.Addid, 11, 4)'),'ASC')
                      ->where('memeradd.fk_brance_id',$getbrance)
                      ->where('memeradd.status','1')
                      ->get();
              return $results;
                         
                }
    }

    public function shoalldata(Request $request,$getappid){
  if($request->ajax()){




                    $results  = DB::table('memeradd')
                     ->join('memberinfo','memeradd.memberName','=','memberinfo.id')
                    
                      ->where('memeradd.Addid',$getappid)
                      ->get();

                return response()->json(['father'=>$results[0]->father_name,'mother'=>$results[0]->mother_name,'pre_add'=>$results[0]->pre_add,'perma_add'=>$results[0]->perma_add]);
                         
                }

    }
 
 public function savidforinvest(Request $request,$getappid){
  if($request->ajax()){
                    $results  =  DB::table('memeradd')
                    ->where('memeradd.Addid', $getappid)
                     ->where('memeradd.status','1')
                      ->where('memeradd.PackageName','6437')
                     ->get();
                return response()->json(['savid'=>$results[0]->Addid]);
                         
                }

    }
   

}
