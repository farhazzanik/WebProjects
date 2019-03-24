  <?php


namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use Session;
use Image;
use DB;



class MemberAddCon extends Controller
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
      $selectMemnber =  DB::table('memberinfo')
                      ->orderBy('memberinfo.id', 'ASC')
                      ->where('memberinfo.fk_brance_Id',$id->fk_brance_id)
                      ->where('memberinfo.status','1')
                      ->get();


                      
      $packageType = DB::table('packagetype')
                      ->orderBy('packagetype.serialNo', 'ASC')
                      ->get();
       $selectArea = DB::table('areainfo')
                      ->orderBy('areainfo.id', 'ASC')
                      ->where('fk_branc_id',$id->fk_brance_id)
                      ->get();

    $data = DB::table('memeradd')
            ->join('memberinfo', 'memberinfo.id', '=', 'memeradd.memberName')
            ->join('areainfo', 'areainfo.id', '=', 'memeradd.AreaName')
            ->join('packagetype', 'packagetype.id', '=', 'memeradd.PackageName')
            ->join('nomineeinfo', 'nomineeinfo.Addid', '=', 'memeradd.Addid')
            ->join('createadmin', 'createadmin.id', '=', 'memeradd.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'memeradd.fk_brance_id')
            ->select('memeradd.*', 'nomineeinfo.*', 'packagetype.name as packname','areainfo.area_name','memberinfo.mem_name','createadmin.name as adminname','branceinfo.name as branceName')
            ->get();

  $adminWiseData = DB::table('memeradd')
            ->join('memberinfo', 'memberinfo.id', '=', 'memeradd.memberName')
            ->join('areainfo', 'areainfo.id', '=', 'memeradd.AreaName')
            ->join('packagetype', 'packagetype.id', '=', 'memeradd.PackageName')
            ->join('nomineeinfo', 'nomineeinfo.Addid', '=', 'memeradd.Addid')
            ->join('createadmin', 'createadmin.id', '=', 'memeradd.fk_user_id')
            ->join('branceinfo', 'branceinfo.id', '=', 'memeradd.fk_brance_id')
            ->select('memeradd.*', 'nomineeinfo.*', 'packagetype.name as packname','areainfo.area_name','memberinfo.mem_name','createadmin.name as adminname','branceinfo.name as branceName')
            ->where('memeradd.fk_brance_id',$id->fk_brance_id)
            ->get();
            



    $branceNam = DB::table('branceinfo')->get();

     $referenceBy = DB::table('employeeinfo') ->where('employeeinfo.fk_branc_id',$id->fk_brance_id)->get();

    	return view('Admin.memberaddmission.memberadmission',compact('mainlink','id','sublink','Adminminlink','adminsublink','selectMemnber','packageType','selectArea','data','branceNam','adminWiseData','referenceBy'));
    }


       public function withoutPrefix($table,$fildname,$prefix,$id_length)
          {
            
            $query  = DB::table('memeradd')->max('Addid');
            $prefix_length=strlen($prefix);
     
            $only_id=substr($query,$prefix_length);

            $new=(int)($only_id);
  
            $new++;
 
            $number_of_zero=$id_length-$prefix_length-strlen($new);
            $zero=str_repeat("0", $number_of_zero);
       
            $made_id=$prefix.$zero.$new;

            return   $made_id;

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



    public function save(Request $request){



      $this->validate($request, [
            
            'installment' => 'required',
            'owName' => 'required',
        ]);

     $explode= explode('and', $request->Packge);
     $date = date('y').$explode[0].$request->Member;
    return $autid=$this->withoutPrefix('memeradd','Addid',$date,'18');

      
       $insertDate = DB::table('memeradd')->insert(
                ['Addid' => $autid, 
                'todaydate' => $request->Todaydate,
                'memberName' => $request->Member, 
                'PackageName' => $explode[0],
                'status'  => $request->Status,
                'AreaName' => $request->Area, 
                'amount' => $request->installment, 
                'insNumb' => $request->number, 
                'Date' => $request->Expiration, 
                'comment' => $request->Comments, 
                'PackageExdate' =>  $request->PackageExdate, 
                'Periodic' =>  $request->Periodic, 
                'Monthly' =>  $request->Monthly,
                 'type' =>  $request->Type, 
                'referenceBy' => $request->Reference ,
                'fk_user_id' => $request->adminid,
                'fk_brance_id' => $request->Brance]
            );

      
       $objData = DB::table('nomineeinfo')->insert(
                ['Addid' => $autid, 
                'name' => $request->owName, 
                'email' => $request->Email, 
                'BirthDate' => $request->Birth, 
                'father_husband' => $request->Husband, 
                'mother_wife' => $request->Wife, 
                'occupation' => $request->Occupation,  
                'relation' => $request->Relation, 
                'ammounOfpart' => $request->Amountpart, 
                'preAdd' => $request->Present, 
                'permaAdd' => $request->Permanent, 
                'fk_user_id' => $request->adminid]
            );

        $objData1 = DB::table('comissioninfo')->insert(
                ['Addid' => $autid, 
                'emp_fk_id' => $request->Reference, 
                'pack_fk_id' => $explode[0], 
                'comission' =>  $explode[1], 
                'mem_fk_id' => $request->Member,
                'fk_user_id' => $request->adminid,
                'fk_brance_id' => $request->Brance]
            );





        if($insertDate){
        $data = DB::table('memeradd')
            ->join('memberinfo','memberinfo.id','=','memeradd.memberName')
            ->join('packagetype','packagetype.id','=','memeradd.PackageName')
            ->join('employeeinfo','employeeinfo.id','=','memeradd.referenceBy')
            ->select('memeradd.type as memtype','memberinfo.*','packagetype.name as packname','packagetype.commision','employeeinfo.contactNo as empcont')
            ->where('memeradd.Addid',$autid)
            ->get();
        if($data[0]->memtype == '1'){
            $type ='Weekly';
        }elseif($data[0]->memtype == '2'){
         $type ='Monthly';

        }elseif($data[0]->memtype == '3'){

          $type ='Yearly';
        }elseif($data[0]->memtype == '4'){
          $type ='General';
          
        }elseif($data[0]->memtype == '5'){

           $type ='Daily';
        }

      $from_number = "sopno cura";
      $text = "Name =".$data[0]->mem_name.',Packge Name ='.$data[0]->packname.',Type ='.$type;
      $to_numbers=$data[0]->con_no;
      $api_url = "http://107.20.199.106/restapi/sms/1/text/single";
      $msg=$this->send_msg($api_url, $from_number, $to_numbers, $text);


      $from_number1 = "sopno cura";
      $text1 = "Name =".$data[0]->mem_name.',Packge Name ='.$data[0]->packname.',Comission ='.$data[0]->commision;
      $to_numbers1 =$data[0]->con_no;
      $api_url1 = "http://107.20.199.106/restapi/sms/1/text/single";
      $msg=$this->send_msg($api_url1, $from_number1, $to_numbers1, $text1);




               $file = $request->file('memiimg');
      if($request->file('memiimg') != ""){
         $extension =  $request->file('memiimg')->getClientOriginalExtension(); 
   $fileName =  $autid.'mem.jpg';
                                                        // Resizing 340x340
    Image::make( $file->getRealPath() )->save( base_path().'/public/memberAddmission/'.$fileName);
          }


            $file = $request->file('Sign');
      if($request->file('Sign') != ""){
         $extension =  $request->file('Sign')->getClientOriginalExtension(); 
   $fileName =  $autid.'sign.jpg';
                                                        // Resizing 340x340
    Image::make( $file->getRealPath() )->save( base_path().'/public/memberAddmission/'.$fileName);
          }



             Session::flash('success','Save Success');

          }else{

            Session::flash('error',$insertDate);

          }
          return redirect()->back();


    }

     public function Delete($id){

          $obj = DB::table('memeradd')->where('Addid', '=', $id)->delete();
          $obj1 = DB::table('nomineeinfo')->where('Addid', '=', $id)->delete();
          $obj2 = DB::table('comissioninfo')->where('Addid', '=', $id)->delete();
          
          $path =  base_path().'/public/memberAddmission/'.$id.'mem.jpg';
          $pathhh =  base_path().'/public/memberAddmission/'.$id.'sign.jpg';

          if(file_exists($path)) {

              @unlink($path);
          }

        
           if(file_exists($pathhh)) {

              @unlink($pathhh);
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

       $selectMemnber =  DB::table('memberinfo')
                      ->orderBy('memberinfo.id', 'ASC')
                      ->get();
      $packageType = DB::table('packagetype')
                      ->orderBy('packagetype.serialNo', 'ASC')
                      ->get();
        $selectArea = DB::table('areainfo')
                      ->orderBy('areainfo.id', 'ASC')
                      ->where('fk_branc_id',$id->fk_brance_id)
                      ->get();
 $branceNam = DB::table('branceinfo')->get();

       $data = DB::table('memeradd')
            ->join('memberinfo', 'memberinfo.id', '=', 'memeradd.memberName')
            ->join('areainfo', 'areainfo.id', '=', 'memeradd.AreaName')
            ->join('packagetype', 'packagetype.id', '=', 'memeradd.PackageName')
            ->join('nomineeinfo', 'nomineeinfo.Addid', '=', 'memeradd.Addid')
            ->join('branceinfo', 'branceinfo.id', '=', 'memeradd.fk_brance_id')
            ->join('employeeinfo', 'employeeinfo.id', '=', 'memeradd.referenceBy')
            ->select('memeradd.*', 'nomineeinfo.*', 'packagetype.name as packname','areainfo.area_name','memberinfo.mem_name','branceinfo.name as branceName','employeeinfo.Name as empname')
            ->where('memeradd.Addid',$getid)
            ->get();

 $referenceBy = DB::table('employeeinfo')->get();
          return view('Admin.memberaddmission.editAddmission',compact('mainlink','id','sublink','Adminminlink','adminsublink','selectMemnber','packageType','selectArea','data','branceNam','referenceBy'));

    }

    public function succ(Request $Request){


           $obj = DB::table('memeradd')
                    ->where('Addid', $Request->upid)
                    ->update(['memberName' => $Request->Member, 'todaydate' => $request->Todaydate,'PackageName' => $Request->Packge,'AreaName' =>  $Request->Area, 'status'  => $Request->Status,'amount' => $Request->installment,'insNumb' =>  $Request->number,'Date' =>  $Request->Expiration,'comment' =>  $Request->Comments ,'fk_user_id' =>  $Request->adminid,'fk_brance_id' =>  $Request->Brance,'PackageExdate' =>  $Request->PackageExdate ,'Periodic' =>  $Request->Periodic,'Monthly' =>  $Request->Monthly, 'type' =>  $Request->Type,'referenceBy' => $Request->Reference]);


           $objj = DB::table('nomineeinfo')
                    ->where('Addid', $Request->upid)
                    ->update(['name' => $Request->owName,'email' => $Request->Email,'BirthDate' =>  $Request->Birth,'father_husband' => $Request->Husband,'mother_wife' =>  $Request->Wife,'occupation' =>  $Request->Occupation,'relation' =>  $Request->Relation,'ammounOfpart' =>  $Request->Amountpart,'preAdd' =>  $Request->Present,'permaAdd' =>  $Request->Permanent]);


                     $file = $Request->file('memiimg');
      if($Request->file('memiimg') != ""){
         $extension =  $Request->file('memiimg')->getClientOriginalExtension(); 
   $fileName =  $Request->upid.'mem.jpg';
                                                        // Resizing 340x340
    Image::make( $file->getRealPath() )->fit(400, 400)->save( base_path().'/public/memberAddmission/'.$fileName);
          }


            $file = $Request->file('Sign');
      if($Request->file('Sign') != ""){
         $extension =  $Request->file('Sign')->getClientOriginalExtension(); 
   $fileName =  $Request->upid.'sign.jpg';
                                                        // Resizing 340x340
    Image::make( $file->getRealPath() )->fit(400, 400)->save( base_path().'/public/memberAddmission/'.$fileName);
          }

  if($obj){




                Session::flash('success','Save Success');
                }else{

                  Session::flash('error',$obj);

                }
                return redirect()->back();



    }

    public function showReport($getid){
    $obj = DB::table('memeradd')
      ->join('memberinfo', 'memberinfo.id', '=', 'memeradd.memberName')
      ->join('packagetype', 'packagetype.id', '=', 'memeradd.PackageName')
      ->join('createadmin','createadmin.id','=','memeradd.fk_user_Id')
      ->select('memeradd.*','memeradd.type as memtype', 'memberinfo.*','packagetype.name as packname','createadmin.name as adminname')
      ->where('memeradd.Addid', '=', $getid)
      ->get();
      return view('Admin.memberaddmission.showReport',compact('obj'));
    }



    
  public function shwoMem(Request $request,$id1){


       if($request->ajax()){
                    $results  =  DB::table('memberinfo')
                      ->orderBy('memberinfo.id', 'ASC')
                      ->where('memberinfo.fk_brance_Id',$id1)
                      ->where('memberinfo.status','1')
                      ->get();
              return $results;
                         
                }

      
    }

    public function showrefer(Request $request,$id1){


       if($request->ajax()){
                    $results  = DB::table('employeeinfo') ->where('employeeinfo.fk_branc_id',$id1)->get();
              return $results;
                         
                }

      
    }


 public function showareaADd(Request $request,$id1){


       if($request->ajax()){
                    $results  = DB::table('areainfo') ->where('areainfo.fk_branc_id',$id1)->get();
              return $results;
                         
                }

      
    }


    


    
}
