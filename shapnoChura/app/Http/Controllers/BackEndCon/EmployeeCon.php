<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use DB;
Use Session;
use Image;

class EmployeeCon extends Controller
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

      $showDatab = DB::table('employeeinfo')
            ->join('createadmin', 'createadmin.id', '=', 'employeeinfo.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'employeeinfo.fk_branc_id')
            ->select('employeeinfo.*', 'createadmin.name as adminname','branceinfo.name as branceName')
            ->orderBy('employeeinfo.serialNo','ASC')
            ->get();

      $adminwiseDat =  DB::table('employeeinfo')
            ->join('createadmin', 'createadmin.id', '=', 'employeeinfo.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'employeeinfo.fk_branc_id')
            ->select('employeeinfo.*', 'createadmin.name as adminname','branceinfo.name as branceName')
            ->orderBy('employeeinfo.serialNo','ASC')
            ->where('employeeinfo.fk_branc_id',$id->fk_brance_id)
            ->get();


      $branceNam = DB::table('branceinfo')->get();


    	return view('Admin.Employee.employeeInfo',compact('mainlink','id','sublink','Adminminlink','adminsublink','showDatab','branceNam','adminwiseDat'));
    }

 
 public function withoutPrefix($table,$fildname,$prefix,$id_length)
          {
            
            $query  = DB::table('employeeinfo')->max('id');
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
                      'serial' => 'required',
                      'adminid' => 'required',
                      'Employee' => 'required',
                      'Contact' => 'required',
                      'Brance' => 'required',
                   ]);
             $date = date('y');
            $autid=$this->withoutPrefix('employeeinfo','id',$date,'5');


          $insertDate = DB::table('employeeinfo')->insert(
                ['id' => $autid, 
                'serialNo' =>  $request->serial, 
                'Name' => $request->Employee, 
                'fatherName' => $request->Father, 
                'MotherName' => $request->Mother, 
                'contactNo' => $request->Contact, 
                 'NIDno' => $request->NID, 
                 'email' => $request->Email, 
                 'presentAddress' => $request->Present, 
                 'fk_user_id' => $request->adminid, 
                'permanentAddress' => $request->Permanent,
                'fk_branc_id' => $request->Brance]
            );

          if($insertDate){


               $file = $request->file('empimgae');
      if($request->file('empimgae') != ""){
         $extension =  $request->file('empimgae')->getClientOriginalExtension(); 
   $fileName =  $autid.'.jpg';
                                                        
    Image::make( $file->getRealPath() )->save( base_path().'/public/employeeImg/'.$fileName);
          }



             Session::flash('success','Save Success');

          }else{

            Session::flash('error',$insertDate);

          }
          return redirect()->back();


    }

       
  
 public function Delete($id){

                $obj = DB::table('employeeinfo')->where('id', '=', $id)->delete();
             $path =  base_path().'/public/employeeImg/'.$id.'.jpg';
          if(file_exists($path)) {

              @unlink($path);
          }

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



      $branceNam = DB::table('branceinfo')->get();


            $data = DB::table('employeeinfo')
              ->join('branceinfo', 'branceinfo.id', '=', 'employeeinfo.fk_branc_id')
              ->select('branceinfo.name as brancename','employeeinfo.*')
              ->where('employeeinfo.id', '=', $getid)
              ->get();
         
          return view('Admin.Employee.EmployeeEdit',compact('mainlink','id','branceNam','sublink','Adminminlink','adminsublink','data'));

    }

    public function editsucc(Request $Request){

           $obj = DB::table('employeeinfo')
                    ->where('id', $Request->id)
                    ->update(['serialNo' => $Request->serial,'Name' => $Request->Employee,'fatherName' =>  $Request->Father,
                      'MotherName' => $Request->Mother,'contactNo' =>  $Request->Contact,'NIDno' =>  $Request->NID,'email' =>  $Request->Email,'permanentAddress' =>  $Request->Permanent,'presentAddress' =>  $Request->Present,'fk_user_id' =>  $Request->adminid,'fk_branc_id' =>  $Request->Brance]);


                      $file = $Request->file('empimage');
      if($Request->file('empimage') != ""){
         $extension =  $Request->file('empimage')->getClientOriginalExtension(); 
   $fileName =   $Request->id.'.jpg';
                                                        
    Image::make( $file->getRealPath() )->save( base_path().'/public/employeeImg/'.$fileName);
          }
          

             
                  if($obj){

                Session::flash('success','Save Success');
                }else{

                  Session::flash('error',$obj);

                }
                return redirect()->back();




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

      $showDatab = DB::table('employeeinfo')
            ->join('createadmin', 'createadmin.id', '=', 'employeeinfo.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'employeeinfo.fk_branc_id')
            ->select('employeeinfo.*', 'createadmin.name as adminname','branceinfo.name as branceName')
            ->orderBy('employeeinfo.serialNo','ASC')
            ->get();

      $adminwiseDat =  DB::table('employeeinfo')
            ->join('createadmin', 'createadmin.id', '=', 'employeeinfo.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'employeeinfo.fk_branc_id')
            ->select('employeeinfo.*', 'createadmin.name as adminname','branceinfo.name as branceName')
            ->orderBy('employeeinfo.serialNo','ASC')
            ->where('employeeinfo.fk_branc_id',$id->fk_brance_id)
            ->get();


      $salarytitle = DB::table('salarytitle')->get();


      return view('Admin.salarytitile.title',compact('mainlink','id','sublink','Adminminlink','adminsublink','showDatab','salarytitle','adminwiseDat'));


    }


    public function savitsaltitle(Request $Request){


          $insertDate = DB::table('salarytitle')->insert(
                [
                'titel' => $Request->Title
               ]
            );

           if($insertDate){

                Session::flash('success','Save Success');
                }else{

                  Session::flash('error',$obj);

                }
                return redirect()->back();


    }

    public function deletSaltitle(Request $Request,$getid)
    {

$obj = DB::table('salarytitle')->where('id',$getid)->delete();
  if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }

    }
    
    
      public function shwoSalTitle($brance,$emp,$month,$Year){


   $salarytitle = DB::table('salarytitle')->get();
      
$totalammount =  DB::table('session_emp_title')
             ->where('session_emp_title.fk_emp_id', '=', $emp)
             ->where('session_emp_title.month', '=', $month)
             ->where('session_emp_title.fk_brance_id', '=', $brance)
             ->where('session_emp_title.year', '=', $Year)
             ->sum('ammount');

          $data = DB::table('session_emp_title')
            ->join('employeeinfo', 'employeeinfo.id', '=', 'session_emp_title.fk_emp_id')
            ->select('session_emp_title.*','employeeinfo.Name')
            ->where('session_emp_title.fk_emp_id', '=', $emp)
             ->where('session_emp_title.month', '=', $month)
             ->where('session_emp_title.fk_brance_id', '=', $brance)
             ->where('session_emp_title.year', '=', $Year)
            
            ->get();
          return view('Admin.Employee.salarytitle',compact('data','salarytitle','totalammount'));
    }


  public function deletsessionSaltile(Request $Request,$getid)
    {

$obj = DB::table('session_emp_title')->where('id',$getid)->delete();
  if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }

    }


    public function saveSalaryColl(Request $request){

    $this->validate($request, [
                      'paidammount' => 'required',
                  
                   ]);


 $explode = explode('-', $request->date);
      $renewdate =  $explode[2].'-'.$explode[1].'-'.$explode[0];  



if($request->paidammount === $request->totalammout){
       $insertDate = DB::table('emp_salary_collection')->insert(
                [ 
                'date' =>   $renewdate, 
                'fk_emp_id' => $request->Employee, 
                'month' => $request->month, 
                'year' => $request->Year, 
                'paid_ammount' => $request->paidammount, 
                 'fk_brance_id' => $request->Brance, 
                 'fk_user_id' => $request->adminid]
            );

          if($insertDate){

                   Session::flash('success','Save Success');

          }else{

            Session::flash('error',$insertDate);

          }
        }else{
 Session::flash('error','Due Not Acceptable');

        }



        return redirect()->back();
    }
    



}
