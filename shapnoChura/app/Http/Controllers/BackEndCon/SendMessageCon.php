<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use Auth;
use DB;
use Session;
class SendMessageCon extends Controller
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

      $pack = DB::table('packagetype')->get();
    		return view('Admin.Message.sendmessage',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','pack'));
    }

    public function showcon($id,$brance){

            if($id=='emp'){
               
                  $data =DB::table('employeeinfo')->where('fk_branc_id',$brance)->get();
                  $type = 'emp';
                
            }elseif ($id=='mem') {
              
                $data =DB::table('memberinfo')
                  ->where('fk_brance_Id',$brance)
                  ->where('status','1')
                  ->get();
                    $type = 'mem';
            }

            return view('Admin.Message.ShowConNo',compact('data','type'));

    }



function sender($url,$key,$mobile,$senderId,$sms)
{
  $data = json_encode(array('api_key' => $key,'type'=>'unicode', 'contacts' => $mobile,'senderid'=>$senderId, 'msg' => $sms));
  $ch = curl_init();
  curl_setopt ($ch, CURLOPT_URL, $url);
  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type:application/json", "Accept: application/json", "Authorization: Basic c2JpdDpORXdRNXJRTw=="));
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    $dd=curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    //http_build_query($data). "\n";
  $contents = curl_exec($ch);
  if (curl_errno($ch)) {
    echo curl_error($ch);
    echo "\n<br />";
    $contents = '';
  } else {
    curl_close($ch);
  }
}


    public function sendSuccess(Request $Request){

       

            if(isset($Request->conno)){

                  for ($i=0; $i < count($Request->conno); $i++) { 
                     $key='R60002955aeb2527c26bd5.91135862';
                  
                     $mobile  =$Request->conno[$i]; //Receiver's country code+number
                  $senderId='8804445629106';// sender id number
                  $sms=$Request->text; //Double quotes are good for new line characters e.g. \n
                  //$sms = urlencode($sms); //Very Important Otherwise spaces shall not be parsed correctly
                  ini_set('allow_url_fopen',1);
                  $url = "http://users.sendsmsbd.com/smsapi?";
                  $succ=$this->sender($url,$key,$mobile,$senderId,$sms);

                  }
              }

                 


        if($succ){

         Session::flash('success','Sent Success');

          }else{

            Session::flash('error',$succ);

          }
          return redirect()->back();
    }

  public function packwisemsg(){

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

      $pack = DB::table('packagetype')->get();
      return view('Admin.Message.packmesg',compact('mainlink','id','sublink','Adminminlink','adminsublink','branceNam','pack'));
  }

  public function packwisSent($id,$brance,$reg){

      if($reg =='6'){
        $data = DB::table('memeradd')
                ->join('memberinfo','memeradd.memberName','=','memberinfo.id')
                ->where('memeradd.fk_brance_id',$brance)
                ->where('memeradd.PackageName',$id)
                ->where('memeradd.status','1')
                ->select('memberinfo.mem_name','memberinfo.con_no')
                ->get();
      }else{
           $data = DB::table('memeradd')
                ->join('memberinfo','memeradd.memberName','=','memberinfo.id')
                ->where('memeradd.fk_brance_id',$brance)
                ->where('memeradd.PackageName',$id)
                ->where('memeradd.type',$reg)
                ->where('memeradd.status','1')
                ->select('memberinfo.mem_name','memberinfo.con_no')
                ->get();

      }

        return view('Admin.Message.ShowpackConNo',compact('data'));
  }


  public function packsendSucc(Request $Request){

       $from_number = "sopno cura";
      $text = $Request->text;
       $to_numbers=$Request->conno;
      $api_url = "http://107.20.199.106/restapi/sms/1/text/single";
      $msg=$this->send_msg($api_url, $from_number, $to_numbers, $text);

        
        if($msg){

         Session::flash('success','Sent Success');

          }else{

            Session::flash('error',$msg);

          }
          return redirect()->back();

  }

}
