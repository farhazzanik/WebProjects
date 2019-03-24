<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use DB;
use Session;
use Image;
use Auth;
use App\resturant;


class RestaurentCon extends Controller
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

			
    	$mainMenu  = DB::table('item_information')
                ->orderBy('id', 'asc')
                ->get();
 $alldate  = DB::table('restaurent_info')
         		
                ->select('restaurent_info.*')
                ->get();
       
			return  view('Admin.restaurent.restaurent',compact('mainMenu','mainlink','id','sublink','Adminminlink','adminsublink','alldate'));
		}



    public function edisucresinfo(Request $request){

    	$this->validate($request, [
		        'RestaurentName' => 'required',
		        'contactno' => 'required',
		      
		    ]);
 $id =   Auth::guard('admin')->user();
    	try {
    		
            
          
          
		    $insertDate = DB::table('restaurent_info')
		    ->where('id', $request->id)
                            ->update([
						    
                             'res_name' =>  $request->RestaurentName,
                             'mail_location' =>  $request->MainLocation,
                             'sub_location' =>  $request->SubLocation,
                             'email' =>  $request->email,
                             'phone' =>  $request->contactno,
                             'address' =>  $request->address,
                             'commission' =>  $request->Commission,
                             'google_map' =>  $request->GoogleMap,
                             'referanceby' =>  $request->ReferanceBy,
                             'openingtime' =>  $request->OpeningTime,
                             'closingtime' =>  $request->ClosingTime,
                             'itemid' =>  $request->ItemName,
                             'type_of_company' => $request->typeofcom,
                             'rating' =>  $request->Rating,
                             'fk_admin_id' =>  $id->id,
                             'deliveryfee' =>  $request->Deliveryfee,
                             'deliverytime' =>  $request->Deliverytime,
                             'vat' =>  $request->Vat,
                             'service' => $request->Charge
						   ]);


		   	 $file = $request->file('Contact');
      if($request->file('Contact') != ""){
         $extension =  $request->file('Contact')->getClientOriginalExtension(); 
   $fileName =  $request->id.'con.jpg';
                                                        // Resizing 340x340
    Image::make( $file->getRealPath() )->save( base_path().'/public/resturant/'.$fileName);
    			}


      if($request->file('logo') != ""){
         $extension1 =  $request->file('logo')->getClientOriginalExtension(); 
   $fileName1 =  $request->id.'logo.png';
                                                        // Resizing 340x340
    Image::make( $request->file('logo') ->getRealPath() )->save( base_path().'/public/resturant/'.$fileName1);
    			}


    			   if($request->file('Banner') != ""){
         $extension2 =  $request->file('Banner')->getClientOriginalExtension(); 
   $fileName2 =  $request->id.'Banner.jpg';
                                                        // Resizing 340x340
    Image::make( $request->file('Banner') ->getRealPath() )->save( base_path().'/public/resturant/'.$fileName2);
    			}

		    if($insertDate){

		    

    				Session::flash('success','Save Success');
    			}else{

    				Session::flash('error',$insertDate);

    			}




    	} catch (\Exception  $e) {
            Session::flash('error','Data Insert Unsuccessfully');
    		return redirect()->back();
    	}

    	return redirect()->back();


    }

     public function delrest($id){

        $obj = DB::table('restaurent_info')->where('id', '=', $id)->delete();
        
        $path =  base_path().'/public/resturant/'.$id.'con.jpg';
        $path1 =  base_path().'/public/resturant/'.$id.'logo.png';
        $path2 =  base_path().'/public/resturant/'.$id.'Banner.jpg';
          if(file_exists($path)) {

              @unlink($path);
          }
          if(file_exists($path1)) {

              @unlink($path1);
          }
          if(file_exists($path2)) {

              @unlink($path2);
          }

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }

    public function editres($ids){


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

			
    	$mainMenu  = DB::table('item_information')
                ->orderBy('id', 'asc')
                ->get();
   $alldate  = DB::table('restaurent_info')
         		
                ->select('restaurent_info.*')
                ->where('restaurent_info.id',$ids)
                ->get();
       
			return  view('Admin.restaurent.editrestaurent',compact('mainMenu','mainlink','id','sublink','Adminminlink','adminsublink','alldate'));

    }



    public function saveres(Request $request){

    	$this->validate($request, [
		        'RestaurentName' => 'required',
		        'contactno' => 'required',
		      
		    ]);
 $id =   Auth::guard('admin')->user();
    	try {
    		
            
          
          
		    $insertDate = DB::table('restaurent_info')->insert(
						    [ 
                             'res_name' =>  $request->RestaurentName,
                             'mail_location' =>  $request->MainLocation,
                             'sub_location' =>  $request->SubLocation,
                             'email' =>  $request->email,
                             'phone' =>  $request->contactno,
                             'address' =>  $request->address,
                             'commission' =>  $request->Commission,
                             'google_map' =>  $request->GoogleMap,
                             'referanceby' =>  $request->ReferanceBy,
                             'openingtime' =>  $request->OpeningTime,
                             'closingtime' =>  $request->ClosingTime,
                             'itemid' =>  $request->ItemName,
                             'type_of_company' => $request->typeofcom,
                             'rating' =>  $request->Rating,
                             'fk_admin_id' =>  $id->id,
                               'deliveryfee' =>  $request->Deliveryfee,
                             'deliverytime' =>  $request->Deliverytime,
                             'vat' =>  $request->Vat,
                             'service' => $request->Charge
						   ]);


		   

		    if($insertDate){

		    	 $file = $request->file('Contact');
      if($request->file('Contact') != ""){
         $extension =  $request->file('Contact')->getClientOriginalExtension(); 
   $fileName =  resturant::all()->last()->id.'con.jpg';
                                                        // Resizing 340x340
    Image::make( $file->getRealPath() )->save( base_path().'/public/resturant/'.$fileName);
    			}


      if($request->file('logo') != ""){
         $extension1 =  $request->file('logo')->getClientOriginalExtension(); 
   $fileName1 =  resturant::all()->last()->id.'logo.png';
                                                        // Resizing 340x340
    Image::make( $request->file('logo') ->getRealPath() )->save( base_path().'/public/resturant/'.$fileName1);
    			}


    			   if($request->file('Banner') != ""){
         $extension2 =  $request->file('Banner')->getClientOriginalExtension(); 
   $fileName2 =  resturant::all()->last()->id.'Banner.jpg';
                                                        // Resizing 340x340
    Image::make( $request->file('Banner') ->getRealPath() )->save( base_path().'/public/resturant/'.$fileName2);
    			}

    				Session::flash('success','Save Success');
    			}else{

    				Session::flash('error',$insertDate);

    			}




    	} catch (\Exception  $e) {
            Session::flash('error','Data Insert Unsuccessfully');
    		return redirect()->back();
    	}

    	return redirect()->back();


    }
}
