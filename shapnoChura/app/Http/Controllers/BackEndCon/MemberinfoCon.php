<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use Session;
use Image;
use DB;
class MemberinfoCon extends Controller
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

      $showAllData = DB::table('memberinfo')
            ->join('createadmin', 'createadmin.id', '=', 'memberinfo.fk_user_Id')
            ->join('branceinfo', 'branceinfo.id', '=', 'memberinfo.fk_brance_Id')
            ->select('memberinfo.*', 'createadmin.name as AdminName' , 'branceinfo.name as branceName')
            ->get();

        $adminDataWise = DB::table('memberinfo')
            ->join('createadmin', 'createadmin.id', '=', 'memberinfo.fk_user_Id')
            ->join('branceinfo', 'branceinfo.id', '=', 'memberinfo.fk_brance_Id')
            ->select('memberinfo.*', 'createadmin.name as AdminName' , 'branceinfo.name as branceName')
            ->where('memberinfo.fk_brance_Id',$id->fk_brance_id)
            ->get();



         $branceNam = DB::table('branceinfo')->get();


    	return view('Admin.MemberInfo.memberinfo',compact('mainlink','id','sublink','Adminminlink','adminsublink','showAllData','branceNam','adminDataWise'));
    }

       public function viewmember(){
  
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

      $showAllData = DB::table('memberinfo')
            ->join('createadmin', 'createadmin.id', '=', 'memberinfo.fk_user_Id')
            ->join('branceinfo', 'branceinfo.id', '=', 'memberinfo.fk_brance_Id')
            ->select('memberinfo.*', 'createadmin.name as AdminName' , 'branceinfo.name as branceName')
            ->get();

        $adminDataWise = DB::table('memberinfo')
            ->join('createadmin', 'createadmin.id', '=', 'memberinfo.fk_user_Id')
            ->join('branceinfo', 'branceinfo.id', '=', 'memberinfo.fk_brance_Id')
            ->select('memberinfo.*', 'createadmin.name as AdminName' , 'branceinfo.name as branceName')
            ->where('memberinfo.fk_brance_Id',$id->fk_brance_id)
            ->get();



         $branceNam = DB::table('branceinfo')->get();


      return view('Admin.MemberInfo.viewmember',compact('mainlink','id','sublink','Adminminlink','adminsublink','showAllData','branceNam','adminDataWise'));
    }

     public function withoutPrefix($table,$fildname,$prefix,$id_length)
          {
            
            $query  = DB::table('memberinfo')->max('id');
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
            
            'Employee' => 'required',
            
            'Brance' => 'required',
               'memid' => 'required',
        ]);

        $date = date('y');
        
     //$autid=$this->withoutPrefix('memberinfo','id',$date,'5');
     
     $explodedates = explode('-', $request->ApplicationD);
    $ApplicationD = $explodedates[2].'-'.$explodedates[1].'-'.$explodedates[0];

       $insertDate = DB::table('memberinfo')->insert(
                ['id' => $request->memid, 
                                


                'appDate' => $ApplicationD, 
                'add_fee' => $request->Fee, 
                'share_no' => $request->ShareNum, 
                'share_price' => $request->SharePrice, 
                

                'mem_name' => $request->Employee, 
                'father_name' => $request->Father, 
                'mother_name' => $request->Mother, 
                

                'nid_no' => $request->NID, 
                'con_no' => $request->Contact, 
             
                'gender' => $request->Gender, 
                'status' => $request->Status,
                'birthdate' => $request->AppBirth, 
                'pre_add' => $request->Present,
                'perma_add' => $request->Permanent,

                'n_name' => $request->NoName, 
                'n_age' => $request->ageN, 
             
                'n_nidNO' => $request->NoNID, 
                'n_presentAdd' => $request->NomineePresent, 
                'n_permanenAdd' => $request->NomineePermanent,
                'n_relation' => $request->Relation,

                'occupation'  => $request->Occupation,

                'fk_user_Id' => $request->adminid ,
                'fk_brance_Id' => $request->Brance,
                'husname' => $request->Husband,
               'bd' => $request->bd]
            ); 


        if($insertDate){


                $file = $request->file('memiimg');
      if($request->file('memiimg') != ""){
         $extension =  $request->file('memiimg')->getClientOriginalExtension(); 
         
   $fileName = $request->memid.'mem.jpg';
                                                        
    Image::make( $file->getRealPath() )->save( base_path().'/public/memberImg/'.$fileName);
          }


            $file = $request->file('Nomineeimg');
      if($request->file('Nomineeimg') != ""){
         $extension =  $request->file('Nomineeimg')->getClientOriginalExtension(); 
   $fileName =  $request->memid.'nom.jpg';
                                                       
    Image::make( $file->getRealPath() )->save( base_path().'/public/memberImg/'.$fileName);
          }




 $file = $request->file('Sign');
      if($request->file('Sign') != ""){
         $extension =  $request->file('Sign')->getClientOriginalExtension(); 
   $fileName =  $request->memid.'Sign.jpg';
                                                        
    Image::make( $file->getRealPath() )->save( base_path().'/public/memberImg/'.$fileName);
          }





             Session::flash('success','Save Success');

          }else{

            Session::flash('error',$insertDate);

          }
          return redirect()->back();



    }
    public function Delete($id){

                $obj = DB::table('memberinfo')->where('id', '=', $id)->delete();
          
          $path =  base_path().'/public/memberImg/'.$id.'mem.jpg';
          $pathh =  base_path().'/public/memberImg/'.$id.'nom.jpg';
          $pathhd =  base_path().'/public/memberImg/'.$id.'Sign.jpg';
    
          if(file_exists($path)) {

              @unlink($path);
          }


          if(file_exists($pathhd)) {

              @unlink($pathhd);
          }

            if(file_exists($pathh)) {

              @unlink($pathh);
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

      $data = DB::table('memberinfo')
              ->join('branceinfo', 'branceinfo.id', '=', 'memberinfo.fk_brance_Id')
              ->select('memberinfo.*','branceinfo.name as branceName')
              ->where('memberinfo.id', '=', $getid)->get();

      $branceNam = DB::table('branceinfo')->get();



          return view('Admin.MemberInfo.Editmemberinfo',compact('mainlink','id','sublink','Adminminlink','adminsublink','data','branceNam'));

    }

     public function succ(Request $request){
         
    $explodedates = explode('-', $request->ApplicationD);
    $ApplicationD = $explodedates[2].'-'.$explodedates[1].'-'.$explodedates[0];

           $obj = DB::table('memberinfo')
                    ->where('id', $request->id)
                    ->update([


                'appDate' => $ApplicationD, 
                'add_fee' => $request->Fee, 
                'share_no' => $request->ShareNum, 
                'share_price' => $request->SharePrice, 
                

                'mem_name' => $request->Employee, 
                'father_name' => $request->Father, 
                'mother_name' => $request->Mother, 
                

                'nid_no' => $request->NID, 
                'con_no' => $request->Contact, 
             
                'gender' => $request->Gender, 
                 'status' => $request->Status,
                'birthdate' => $request->AppBirth, 
                'pre_add' => $request->Present,
                'perma_add' => $request->Permanent,
                'occupation'  => $request->Occupation,
                'n_name' => $request->NoName, 
                'n_age' => $request->ageN, 
             
                'n_nidNO' => $request->NoNID, 
                'n_presentAdd' => $request->NomineePresent, 
                'n_permanenAdd' => $request->NomineePermanent,
                'n_relation' => $request->Relation,
                 'fk_user_Id' => $request->adminid ,
                'fk_brance_Id' => $request->Brance,
                 'husname' => $request->Husband, 'bd' => $request->bd 


                      ]);


                $file = $request->file('memiimg');
      if($request->file('memiimg') != ""){
         $extension =  $request->file('memiimg')->getClientOriginalExtension(); 
   $fileName =  $request->id.'mem.jpg';
                                                        // Resizing 340x340
    Image::make( $file->getRealPath() )->save( base_path().'/public/memberImg/'.$fileName);
          }


            $file = $request->file('Nomineeimg');
      if($request->file('Nomineeimg') != ""){
         $extension =  $request->file('Nomineeimg')->getClientOriginalExtension(); 
   $fileName =  $request->id.'nom.jpg';
                                                        
    Image::make( $file->getRealPath() )->save( base_path().'/public/memberImg/'.$fileName);
          }


  $file = $request->file('Sign');
      if($request->file('Sign') != ""){
         $extension =  $request->file('Sign')->getClientOriginalExtension(); 
   $fileName =  $request->id.'Sign.jpg';
                                                        
    Image::make( $file->getRealPath() )->save( base_path().'/public/memberImg/'.$fileName);
          }




             
                  if($obj){

                Session::flash('success','Save Success');
                }else{

                  Session::flash('error',$obj);

                }
                return redirect()->back();




    }

    public function showReport($getid){

          return view('Admin.Memberinfo.showReport');
    }

    
function send_msg($api_url,$from_number, $to_numbers, $text)
  {   
    $post_data = json_encode(array("from" => $from_number, "to" => $to_numbers, "text" => $text));
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type:application/json", "Accept: application/json", "Authorization: Basic c2JpdDo1WVRwZlhxbw=="));
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    
    curl_exec($ch);
    
    if($errno = curl_errno($ch)) 
    {
        $error_message = curl_strerror($errno);
        $error_message = "cURL error ({$errno}):\n {$error_message}";
    }
    else
      $error_message = true;
   
    curl_close($ch);
    
    return $error_message;
    
    }


    public function Send($getid){

      $users = DB::table('memberinfo')->where('id',$getid)->get();
      $from_number = "sopno cura";
      $text = "Registration Successfully";
      $to_numbers=$users[0]->con_no;
      $api_url = "http://107.20.199.106/restapi/sms/1/text/single";
      $msg=$this->send_msg($api_url, $from_number, $to_numbers, $text);

                  if($msg){

                Session::flash('success','Send Success');
                }else{

                  Session::flash('error',$msg);

                }
                return redirect()->back();
  }

  public function view($getid){

       $data = DB::table('memberinfo')
              ->join('branceinfo', 'branceinfo.id', '=', 'memberinfo.fk_brance_Id')
              ->select('memberinfo.*','branceinfo.name as branceName')
              ->where('memberinfo.id', '=', $getid)->get();

      return view('Admin.MemberInfo.viewInformation',compact('data'));
  }








}
