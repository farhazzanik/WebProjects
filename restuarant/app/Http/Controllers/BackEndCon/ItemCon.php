<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;
use DB;
use Session;
use Image;
use Auth;
use App\AreaModel;
use App\cat;
class ItemCon extends Controller
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

       
			return  view('Admin.item.item',compact('mainMenu','mainlink','id','sublink','Adminminlink','adminsublink'));
		}


    public function store(Request $request){

    	$this->validate($request, [
		        'ItemName' => 'required',
		      
		    ]);

    	try {
    		
            
          
          
		    $insertDate = DB::table('item_information')->insert(
						    [ 
                             'item_name' =>  $request->ItemName
						   ]);


		   

		    if($insertDate){

		    	 $file = $request->file('img');
      if($request->file('img') != ""){
         $extension =  $request->file('img')->getClientOriginalExtension(); 
   $fileName =  AreaModel::all()->last()->id.'.jpg';
                                                        // Resizing 340x340
    Image::make( $file->getRealPath() )->save( base_path().'/public/item/'.$fileName);
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


     public function Dalete($id){

        $obj = DB::table('item_information')->where('id', '=', $id)->delete();
        
        $path =  base_path().'/public/item/'.$id.'.jpg';
          if(file_exists($path)) {

              @unlink($path);
          }

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }

     public function showDate($id){


    	   $data = DB::table('item_information')->where('id', '=', $id)->get();
            return view('Admin.item.itemmodel',compact('data'));
    }







    public function itemupdatesuc(Request $request){

    	$this->validate($request, [
		        'ItemName' => 'required',
		      
		    ]);

    	try {
    		
            
          
          
		    $insertDate = DB::table('item_information')
		   ->where('id', $request->id)
                            ->update([
						    
                             'item_name' =>  $request->ItemName
						   ]);

 $file = $request->file('img');
      if($request->file('img') != ""){
         $extension =  $request->file('img')->getClientOriginalExtension(); 
   $fileName = $request->id.'.jpg';
                                                        // Resizing 340x340
    Image::make( $file->getRealPath() )->save( base_path().'/public/item/'.$fileName);
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



      public function category(){
        
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

         $alldate  = DB::table('category_info')
         		->join('item_information','item_information.id','=','category_info.item_id')
                ->select('category_info.*','item_information.item_name')
                ->get();

       
			return  view('Admin.category.category',compact('mainMenu','mainlink','id','sublink','Adminminlink','adminsublink','alldate'));
		}

	public function savecate(Request $request){

				$this->validate($request, [
		        'ItemName' => 'required',
		        'CategoryNameEng' => 'required',

		      
		    ]);

    	try {
    		
            
          
          
		    $insertDate = DB::table('category_info')->insert(
						    [ 
                             'item_id' =>  $request->ItemName,
                             'category_name_eng' =>  $request->CategoryNameEng,
                             'category_name_ban' =>  $request->CategoryNameBn
						   ]);


		   

		    if($insertDate){

		    	 $file = $request->file('img');
      if($request->file('img') != ""){
         $extension =  $request->file('img')->getClientOriginalExtension(); 
   $fileName =  cat::all()->last()->id.'.jpg';
                                                        // Resizing 340x340
    Image::make( $file->getRealPath() )->save( base_path().'/public/cat/'.$fileName);
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



     public function deletecat($id){

        $obj = DB::table('category_info')->where('id', '=', $id)->delete();
        
        $path =  base_path().'/public/cat/'.$id.'.jpg';
          if(file_exists($path)) {

              @unlink($path);
          }

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }



     public function catmodel($id){


    	    $data  = DB::table('category_info')
         		->join('item_information','item_information.id','=','category_info.item_id')
                ->select('category_info.*','item_information.item_name')
                ->where('category_info.id', '=', $id)
                ->get();

                $mainMenu  = DB::table('item_information')
                ->orderBy('id', 'asc')
                ->get();

            return view('Admin.category.catmodel',compact('data','mainMenu'));
    }



public function catupdatesuc(Request $request){

				$this->validate($request, [
		        'ItemName' => 'required',
		        'CategoryNameEng' => 'required',

		      
		    ]);

    	try {
    		
            
          
          
		    $insertDate = DB::table('category_info')
		    		  ->where('id', $request->id)
                            ->update([
                             'item_id' =>  $request->ItemName,
                             'category_name_eng' =>  $request->CategoryNameEng,
                             'category_name_ban' =>  $request->CategoryNameBn
						   ]);


		   

		    if($insertDate){

		    	 $file = $request->file('img');
      if($request->file('img') != ""){
         $extension =  $request->file('img')->getClientOriginalExtension(); 
   $fileName = $request->id.'.jpg';
                                                        // Resizing 340x340
    Image::make( $file->getRealPath() )->save( base_path().'/public/cat/'.$fileName);
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
