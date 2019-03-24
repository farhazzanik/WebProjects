<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use DB;
use Session;
use Image;
use App\CreateAdminModel;
use Auth;
class CreateAdminCon extends Controller
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
        $submenu= DB::table('adminsubmenu') ->orderBy('serialno', 'ASC')->get();
        $branceNam = DB::table('branceinfo')->get();
      

     $ADminbranceNam = DB::table('branceinfo')
                ->join('createadmin', 'createadmin.fk_brance_id', '=', 'branceinfo.id')
                ->select('branceinfo.*')
                ->where('createadmin.id', $id->id)
                ->get();



              $adminwiseMain = DB::table('linkpiority')
                ->join('adminmainmenu', 'linkpiority.mainlinkid', '=', 'adminmainmenu.id')
                         ->groupBy('linkpiority.mainlinkid')
                ->where('linkpiority.adminid', $id->id)
                ->get();

        $adminwiseSub = DB::table('linkpiority')
                ->join('adminsubmenu', 'linkpiority.sublinkid', '=', 'adminsubmenu.id')
                 ->groupBy('linkpiority.sublinkid')
                ->where('linkpiority.adminid', $id->id)
                ->get();




    	return view('Admin.CreateAdmin.CreateAdmin',compact('branceNam','mainMenu','submenu','mainlink','id','sublink','Adminminlink','adminsublink','adminwiseMain','adminwiseSub','ADminbranceNam'));
    }



     public function store(Request $request){



			$this->validate($request, [
		        'Name' => 'required',
		        'email' => 'required',
		        'Password' => 'required',
		        'status' => 'required',
                'brancename' => 'required',
		    ]);



		
			$insertDate = DB::table('createadmin')->insert(
						    ['name' =>  $request->Name, 
						    'email' => $request->email, 
						    'password' => bcrypt($request->Password),
						  'Status' => $request->status,
                          'fk_brance_id' => $request->brancename]
						);


         $file = $request->file('img');
      if($request->file('img') != ""){
         $extension =  $request->file('img')->getClientOriginalExtension(); 
   $fileName =  CreateAdminModel::all()->last()->id.'.jpg';
                                                        // Resizing 340x340
    Image::make( $file->getRealPath() )->fit(400, 400)->save( base_path().'/public/AdminImg/'.$fileName);
    			}

                if($insertDate){

    					if(count($request->SublinkID) > 0){

    							for($i=0; $i<count($request->SublinkID); $i++){

    								$expolaid=explode('and',$request->SublinkID[$i]);
    								$fffff = DB::table('linkpiority')->insert(
										    ['adminid' => CreateAdminModel::all()->last()->id, 
										    'mainlinkid' => $expolaid[0], 
										    'sublinkid' => $expolaid[1] ]
										);

    							}
    					}

    				Session::flash('success','Save Success');
    			}else{

    				Session::flash('error',$insertDate);

    			}
    			return redirect()->route('CreateAdmin');



    }

    public function showallAdmin(){

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

       $showAdmin  = DB::table('createadmin')->get();

        return view('Admin.CreateAdmin.ShowAllAdmin',compact('showAdmin','mainlink','id','sublink','Adminminlink','adminsublink'));
    }

         public function Dalete($id){

                $obj = DB::table('createadmin')->where('id', '=', $id)->delete();
          

        if($obj== true){
                
             $obj = DB::table('linkpiority')->where('adminid', '=', $id)->delete();
             
                $path= base_path().'/public/AdminImg/'.$id.'.jpg';
                        if(file_exists($path)){
                            unlink($path);
                        }



                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }

    public function updateData($getid){

        $id     =   Auth::guard('admin')->user();

         $vale  =   DB::table('linkpiority')
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
        $submenu= DB::table('adminsubmenu') ->orderBy('serialno', 'ASC')->get();

          $selecValue  = DB::table('createadmin')
                 ->join('branceinfo', 'branceinfo.id', '=', 'createadmin.fk_brance_id')
                ->select('createadmin.*','branceinfo.name as brancename')
                 ->where('createadmin.id', '=', $getid)
                ->get();




     $adminwiseMain = DB::table('linkpiority')
                ->join('adminmainmenu', 'linkpiority.mainlinkid', '=', 'adminmainmenu.id')
                         ->groupBy('linkpiority.mainlinkid')
                ->where('linkpiority.adminid', $id->id)
                ->get();

        $adminwiseSub = DB::table('linkpiority')
                ->join('adminsubmenu', 'linkpiority.sublinkid', '=', 'adminsubmenu.id')
                 ->groupBy('linkpiority.sublinkid')
                ->where('linkpiority.adminid', $id->id)
                ->get();

  $branceNam = DB::table('branceinfo')->get();
      

    $ADminbranceNam = DB::table('branceinfo')
                ->join('createadmin', 'createadmin.fk_brance_id', '=', 'branceinfo.id')
                ->select('branceinfo.*')
                ->where('createadmin.id', $id->id)
                ->get();

    return view('Admin.CreateAdmin.UpdateAdmin',compact('mainMenu','submenu','selecValue','mainlink','id','sublink','Adminminlink','adminsublink','adminwiseMain','adminwiseSub','branceNam','ADminbranceNam'));

    }

    public function Success(Request $request){

                $obj = CreateAdminModel::find($request->id); 
                $obj->name = $request->Name;
                $obj->email = $request->email;
                $obj->password = bcrypt($request->Password);
                $obj->Status = $request->status;
                $obj->email = $request->email;
                $obj->fk_brance_id = $request->brancename;
                $obj->save();
                if($obj){


                        if(count($request->SublinkID) > 0){

                            $deleteData= DB::table('linkpiority')->where('adminid', '=', $request->id)->delete();

                                for($i=0; $i<count($request->SublinkID); $i++){

                                    $expolaid=explode('and',$request->SublinkID[$i]);
                                    $fffff = DB::table('linkpiority')->insert(
                                            ['adminid' => $request->id, 
                                            'mainlinkid' => $expolaid[0], 
                                            'sublinkid' => $expolaid[1] ]
                                        );

                                }
                        }



                        Session::flash('success',"Update Success");
                }else{
                             Session::flash('error',$obj);
                }
                return redirect()->route('ViewAdmin');


    }


}
