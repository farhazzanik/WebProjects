<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;

use DB;
use Auth;
use Session;
use App\BranceInfo;
use Image;
class BranceCon extends Controller
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
     $allData =  DB::table('branceinfo')->get();

    	return view('Admin.Brance.Branceinfo',compact('mainlink','id','sublink','Adminminlink','adminsublink','allData'));
    }

     public function store(Request $request){



			$this->validate($request, [
		        'Brance' => 'required',
		        'Official' => 'required',
		        'mblNO' => 'required',
		        'email' => 'required',
		        'BranceAddress' => 'required',
            

		    ]);



		
			$insertDate = DB::table('branceinfo')->insert(
						    [ 'name' =>  $request->Brance, 
                'mobileNo' =>  $request->mblNO, 
						    'branceAdd' => $request->BranceAddress, 
						    'email' => $request->email,
						     'officialNo' => $request->Official,
						     'status' => $request->status]
						);


         $file = $request->file('img');
      if($request->file('img') != ""){
         $extension =  $request->file('img')->getClientOriginalExtension(); 
   $fileName =  BranceInfo::all()->last()->id.'.png';
                                                        // Resizing 340x340
    Image::make( $file->getRealPath() )->fit(856, 177)->save( base_path().'/public/imageHeader/'.$fileName);
    			}

                if($insertDate){

    					
    				Session::flash('success','Save Success');
    			}else{

    				Session::flash('error',$insertDate);

    			}
    			return redirect()->route('Brance');



    }


     public function Dalete($id){

        $obj = DB::table('branceinfo')->where('id', '=', $id)->delete();
        
        $path =  base_path().'/public/imageHeader/'.$id.'.png';
          if(file_exists($path)) {

              @unlink($path);
          }

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }

    public function update($getid){

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


        $selecValue =   DB::table('branceinfo')->where('id', '=', $getid)->get();
        return view('Admin.Brance.Updatebrance',compact('selecValue','mainlink','id','sublink','Adminminlink','adminsublink'));
    }


    public function updatesucc(Request $request){

         $obj = DB::table('branceinfo')->where('id', '=', $request->id)->get();

          if($obj){

                  $updates = DB::table('branceinfo')
                              ->where('id', $request->id)
                              ->update(['name' => $request->Brance,
                                'officialNo' => $request->Official,
                                'mobileNo' => $request->mblNO,
                                'email' => $request->email,
                                'branceAdd' => $request->BranceAddress,
                                'status' => $request->status]);

                if($request->img != ""){

                   $path =  base_path().'/public/imageHeader/'.$request->id.'.jpg';
                     
                            $extension =  $request->file('img')->getClientOriginalExtension(); 
                             $fileName =  $request->id.'.png';
                                                                                  // Resizing 340x340
                              Image::make($request->img->getRealPath())->fit(856, 177)->save( base_path().'/public/imageHeader/'.$fileName);

                      
                } 


                                if($updates){

              
            Session::flash('success','Save Success');
          }else{

            Session::flash('error',$updates);

          }

            return redirect()->back();
         


          }
    }



}
