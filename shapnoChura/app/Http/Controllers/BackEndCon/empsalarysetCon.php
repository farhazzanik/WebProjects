<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Session;
use Auth;
use DB;
class empsalarysetCon extends Controller
{
 
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
    $AllEmployee = DB::table('employeeinfo')
            ->orderBy('employeeinfo.serialNo', 'ASC')
           ->where('fk_branc_id',$id->fk_brance_id)
            ->get();



         $showAllData  = DB::table('emp_salary_setup')
            ->join('createadmin', 'createadmin.id', '=', 'emp_salary_setup.fk_user_id')
           ->join('employeeinfo', 'employeeinfo.id', '=', 'emp_salary_setup.fk_emp_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'emp_salary_setup.fk_brance_id')
            ->select('emp_salary_setup.*', 'createadmin.name as adminname','employeeinfo.Name as empname','branceinfo.name as branceName')
            ->get();

       $adminWiseData  = DB::table('emp_salary_setup')
            ->join('createadmin', 'createadmin.id', '=', 'emp_salary_setup.fk_user_id')
           ->join('employeeinfo', 'employeeinfo.id', '=', 'emp_salary_setup.fk_emp_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'emp_salary_setup.fk_brance_id')
            ->select('emp_salary_setup.*','createadmin.name as adminname','employeeinfo.Name as empname','branceinfo.name as branceName')
            ->where('emp_salary_setup.fk_brance_id',$id->fk_brance_id)
            ->get();


			return  view('Admin.Employee.employesalary',compact('mainMenu','mainlink','id','sublink','Adminminlink','adminsublink','branceNam','AllEmployee','showAllData','adminWiseData'));
    }

       public function showrefer(Request $request,$id1){


       if($request->ajax()){
                    $results  = DB::table('employeeinfo') ->where('employeeinfo.fk_branc_id',$id1)->get();
              return $results;
                         
                }

      
    }

 public function Delete($id){


        $obj = DB::table('emp_salary_setup')->where('id', '=', $id)->delete();
        
     
          $objs = DB::table('session_emp_title')->where('fk_emp_id', '=', $id)->delete();
     

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }



    public function save(Request $request){

                  $this->validate($request, [
                          'date' => 'required',
                          'Employee' => 'required',
                          'ammount' => 'required',
                         ]);




              $olddate = DB::table('emp_salary_setup')
              ->where('emp_salary_setup.fk_emp_id',$request->Employee)
              ->get();

                if(count($olddate) > 0){


                          $oldta = DB::table('emp_old_salary')->insert(
                          [ 'fk_emp_id' => $olddate[0]->fk_emp_id, 
                         
                          'ammount' => $olddate[0]->ammount,
                          'date' =>  date('d/m/Y') ,
                          'fk_user_id' => $request->adminid,
                          'fk_brance_id' => $request->Brance]
                      );

              $dekete = DB::table('emp_salary_setup')->where('id', '=', $olddate[0]->id)->delete();



                }

                  $insertDate = DB::table('emp_salary_setup')->insert(
                [ 'fk_emp_id' =>  $request->Employee, 
                'status' =>  $request->Status, 
                'ammount' => $request->ammount,
                'date' =>  $request->date ,
                'fk_user_id' => $request->adminid,
                'fk_brance_id' => $request->Brance]
            );


                if($insertDate){

              
            Session::flash('success','Save Success');
          }else{

            Session::flash('error',$insertDate);

          }
        
          return redirect()->back();
        

    }



     public function edit($getid){
    $id =   Auth::guard('admin')->user();

 

             $AllEmployee = DB::table('employeeinfo')
            ->orderBy('employeeinfo.serialNo', 'ASC')
           ->where('fk_branc_id',$id->fk_brance_id)
            ->get();



            $showAllData  = DB::table('emp_salary_setup')
            ->join('createadmin', 'createadmin.id', '=', 'emp_salary_setup.fk_user_id')
            ->join('employeeinfo', 'employeeinfo.id', '=', 'emp_salary_setup.fk_emp_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'emp_salary_setup.fk_brance_id')
            
            ->select('emp_salary_setup.*', 'createadmin.name as adminname', 'employeeinfo.Name as empname','branceinfo.name as branceName')
            ->where('emp_salary_setup.id', '=', $getid)
            ->get();

         
   $branceNam = DB::table('branceinfo')->get();



        
         return view('Admin.Employee.editempolyeesalray',compact('showAllData','AllEmployee','branceNam','id'));
    }

    public function editsucc(Request $Request){

   // return $Request->Employee;



         $olddate = DB::table('emp_salary_setup')
              ->where('emp_salary_setup.fk_emp_id',$Request->Employee)
              ->get();

                if(count($olddate) > 0){


                          $oldta = DB::table('emp_old_salary')->insert(
                          [ 'fk_emp_id' => $olddate[0]->fk_emp_id, 
                         
                          'ammount' => $olddate[0]->ammount,
                          'date' =>  date('d/m/Y') ,
                          'fk_user_id' => $Request->adminid,
                          'fk_brance_id' => $Request->Brance]
                      );

              $dekete = DB::table('emp_salary_setup')->where('id', '=', $olddate[0]->id)->delete();



                }



  $obj = DB::table('emp_salary_setup')->insert(
                [ 'fk_emp_id' =>  $Request->Employee, 
                'status' =>  $Request->Status, 
                'ammount' => $Request->ammount,
                'date' =>  $Request->date ,
                'fk_user_id' => $Request->adminid,
                'fk_brance_id' => $Request->Brance]
            );



    // $obj = DB::table('emp_salary_setup')
    //                 ->where('id', $Request->id)
    //                 ->update(['fk_emp_id' => $Request->Employee,'status' => $Request->Status,'ammount' =>  $Request->ammount,
    //                   'date' => $Request->date,'fk_user_id' => $Request->adminid,'fk_brance_id' => $Request->Brance]);
                  if($obj){

                Session::flash('success','Save Success');

                }else{

                  Session::flash('error',$obj);

                }
                return redirect()->back();

    }

    public function salarycolleblade(){

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
    $AllEmployee = DB::table('employeeinfo')
            ->orderBy('employeeinfo.serialNo', 'ASC')
           ->where('fk_branc_id',$id->fk_brance_id)
            ->get();



  $showAllData  = DB::table('emp_salary_collection')
            ->join('createadmin', 'createadmin.id', '=', 'emp_salary_collection.fk_user_id')
              ->join('emp_salary_setup', 'emp_salary_setup.fk_emp_id', '=', 'emp_salary_collection.fk_emp_id')
           ->join('employeeinfo', 'employeeinfo.id', '=', 'emp_salary_collection.fk_emp_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'emp_salary_collection.fk_brance_id')
            ->select('emp_salary_collection.*', 'createadmin.name as adminname','employeeinfo.Name as empname','employeeinfo.contactNo','branceinfo.name as branceName','emp_salary_setup.ammount','employeeinfo.id as adminid')
             ->orderBy('emp_salary_collection.date', 'DESC')
            ->get();

       $adminWiseData  = DB::table('emp_salary_collection')
            ->join('createadmin', 'createadmin.id', '=', 'emp_salary_collection.fk_user_id')
           ->join('employeeinfo', 'employeeinfo.id', '=', 'emp_salary_collection.fk_emp_id')
 ->join('emp_salary_setup', 'emp_salary_setup.fk_emp_id', '=', 'emp_salary_collection.fk_emp_id')

 

            ->join('branceinfo', 'branceinfo.id', '=', 'emp_salary_collection.fk_brance_id')
            ->select('emp_salary_collection.*', 'createadmin.name as adminname','employeeinfo.Name as empname','employeeinfo.contactNo','branceinfo.name as branceName','emp_salary_setup.ammount','employeeinfo.id as adminid')
             ->orderBy('emp_salary_collection.date', 'DESC')
            ->where('emp_salary_collection.fk_brance_id',$id->fk_brance_id)
            ->get();


$salarytitle = DB::table('salarytitle')->get();


   return  view('Admin.Employee.salarycollblade',compact('mainMenu','mainlink','id','sublink','Adminminlink','adminsublink','branceNam','AllEmployee','showAllData','adminWiseData','salarytitle'));

    }


    public function showContact(Request $request,$getid){

       if($request->ajax()){
         
         $resultquery = DB::table('employeeinfo')
         ->where('id',$getid)
         ->get();
       return response()->json( array('contact' => $resultquery[0]->contactNo) );
       }

    }


     public function showSalaryemp(Request $request,$getid){

       if($request->ajax()){
         
         $ammount = DB::table('emp_salary_setup')
          ->where('status','1')
         ->where('fk_emp_id',$getid)
         ->get();
       return $ammount[0]->ammount;
       }

    }


   public function salaryPaidEmp(Request $request){

 $explode = explode('-', $request->date);
      $renewdate =  $explode[2].'-'.$explode[1].'-'.$explode[0];  



      
               
   $insertDate = DB::table('session_emp_title')->insert(
                [ 'Data' =>  $request['date'], 
                'fk_emp_id' =>  $request['emp'], 

                 'fk_title_id' => $request['Title'],
                'month' => $request['month'],
                'year' =>  $request['Year'],
                 'ammount' =>  $request['ammount'] ,
                'fk_user_id' => $request['adminid'],
                'fk_brance_id' => $request['brance']
             ]
            );


          
        

    }





 public function SalayDelete($id){


        $obj = DB::table('emp_salary_collection')->where('id', '=', $id)->delete();
        
          $objs = DB::table('session_emp_title')->where('fk_emp_id', '=', $id)->delete();
     

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }

    

    public function showSlaraypaidreport($id,$month,$date){
      
       $employeinfo = DB::table('employeeinfo')->where('id',$id)->get();
      $emp_salary_collection = DB::table('emp_salary_collection')

                                ->where('fk_emp_id',$id)
                                ->where('month',$month)
                                ->where('year', '=',$date)
                                ->get();

         $session_emp_title = DB::table('session_emp_title')
                                ->where('session_emp_title.fk_emp_id',$id)
                                ->where('session_emp_title.month',$month)
                                ->where('session_emp_title.year', '=',$date)
                                ->get();

                                $salarytitle =  DB::table('salarytitle')->Get();
        $employeinfosal = DB::table('emp_salary_setup')->where('fk_emp_id',$id)->get();
      return view('Admin.Employee.employesalarypaid',compact('employeinfo','emp_salary_collection','employeinfosal','session_emp_title','salarytitle'));
    }

    

}
