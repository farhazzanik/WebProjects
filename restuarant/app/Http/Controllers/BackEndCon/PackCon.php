<?php

namespace App\Http\Controllers\BackEndCon;

use Illuminate\Http\Request;
use App\Http\Controllers\BackEndCon\Controller;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use DB;
use Session;
use Image;
use Auth;
use App\pack;
use App\product;
use Input;

class PackCon extends Controller
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
         $selres = DB::table('restaurent_info')
                ->orderBy('id', 'asc')
                ->get();
   
        $date = date('y');
		  $autid=$this->withoutPrefix('pack_info','id',$date,'10');

 $rest  = DB::table('restaurent_info')->get();
			return  view('Admin.package.package',compact('mainMenu','mainlink','id','sublink','Adminminlink','adminsublink','selres','autid','rest'));
		}


 public function withoutPrefix($table,$fildname,$prefix,$id_length)
          {
            
            $query  = DB::table($table)->max($fildname);
            $prefix_length=strlen($prefix);
     
            $only_id=substr($query,$prefix_length);

            $new=(int)($only_id);
  
            $new++;
 
            $number_of_zero=$id_length-$prefix_length-strlen($new);
            $zero=str_repeat("0", $number_of_zero);
       
            $made_id=$prefix.$zero.$new;

            return   $made_id;

        }


		 public function showcatpack(Request $request,$id1){


       if($request->ajax()){

            $results  = DB::table('category_info') ->where('item_id',$id1)->get();
              return $results;
                         
                }

      
    }


    public function showrespack(Request $request,$id1){

    	 if($request->ajax()){

            $results  = DB::table('restaurent_info') ->where('itemid',$id1)->get();
              return $results;
                         
                }
    }


    public function savepack(Request $request){

    

    	try {
    		
        
          
          	  $insertDate = DB::table('product_info')->insert(
						    [ 
						     'pack_id' =>  $request->packid,
                             'item_id' =>  $request->ItemName,
                             'res_id' =>  $request->Restaurant,
                             'cat_id' =>  $request->Category,
                             'pro_type' =>  $request->Product,
                             'pro_name' =>  $request->Food,
                             'price' =>  $request->Price,
                             'discount' =>  $request->Discount,
                             'details' =>  $request->Details,
                             'status' => '0'
						   ]);
        

        if($request->file('file') != ''){
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'public/pro/';
            $filename =product::all()->last()->id. '.jpg';
            $request->file('file')->move($dir, $filename);
        }
        
         if($insertDate){
                  $data='success///0';
            }else{
                $data='error///Something Went Wrong!';
            }
       

        return $data;




    	} catch (\Exception  $e) {
            $data='error///Something Went Wrong!';
    	}

    	


    }
public function editpacksuc(Request $request){

        $insertDate = DB::table('product_info')
         ->where('id', $request->id)
          ->update(['pro_name' =>$request->pro,'details' =>$request->det,'price' =>$request->price,'discount' =>$request->dis]);

           if($request->file('file') != ''){
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'public/pro/';
            $filename =$request->id. '.jpg';
            $request->file('file')->move($dir, $filename);
        }


}
    public function subpacksuc(Request $request){


    	try {
    		
    		 $ins = DB::table('pack_info')->insert(
						    [ 

						     'id' =>  $request->packid,
						      'res_id' =>  $request->resid
                            
						   ]);

            
          
          	  $insertDate = DB::table('product_info')	->where('pack_id', $request->packid)
                            ->update([  'status' => '1'
						   ]);

          
		   

		    if($insertDate){
                $data='success///0';
            }else{
                $data='error///Something Went Wrong!';
            }
        

        return $data;




    	} catch (\Exception  $e) {
            $data='error///Something Went Wrong!';
    	}

    }

     public function ShowCurrentproduct(Request $request)
    {
       
        $alldate  = DB::table('product_info')
         		->join('item_information','item_information.id','=','product_info.item_id')
         		
         		->join('restaurent_info','restaurent_info.id','=','product_info.res_id')

         		->where('product_info.res_id','=',$request->packid)
            ->where('product_info.item_id','=',$request->ItemName)
                ->select('product_info.*','item_information.item_name','restaurent_info.res_name')
                ->orderBy('id','DESC')
                ->get();


        
        foreach ($alldate as $data) {
           

            echo '<tr id="item-'.$data->id.'"><td  style="width: 10px">'.$data->res_name.'</td><td>'.$data->item_name.'</td><td  id="pro-'.$data->id.'">'.$data->pro_name.'</td><td id="det-'.$data->id.'">'.substr($data->details,0,40).'</td><td id="price-'.$data->id.'">'.$data->price.'</td><td id="dis-'.$data->id.'">'.$data->discount.'</td><td id="net-'.$data->id.'">'.$netd=($data->price - $data->discount).'</td>';
            echo '<td id="ac-'.$data->id.'"><a class="btn btn-danger btn-mini" onclick="deteDate(';
            echo "'".$data->id."'";
            echo ');">Delete</a>';
            echo '&nbsp;<a class="btn btn-info btn-mini" onclick="edit(';
            echo "'".$data->id."'";
            echo ",";
            echo "'".$data->pro_name."'";
            echo ",";
            echo "'".$data->details."'";
            echo ",";
            echo "'".$data->price."'";
            echo ",";
            echo "'".$data->discount."'";
            echo ');">Edit</a></td>';
            echo '</tr>';
        }

       

      
    }

 public function delpack($id){

        $obj = DB::table('product_info')->where('id', '=', $id)->delete();
        
        $path =  base_path().'/public/pro/'.$id.'.jpg';
          if(file_exists($path)) {

              @unlink($path);
          }

        if($obj== true){
                    return response()->json(['success'=>true,'status'=>'Delete Successfully']);

            }else {

                    return response()->json(['error'=>true,'status'=>'Delete Unsuccessfully']);

            }


    }

     public function ajaxImage(Request $request)
    {
        if ($request->isMethod('get'))
              return view('Admin.ajaxImageUpload');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'public/uploads/';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $request->file('file')->move($dir, $filename);
            return $filename;
        }
    }

    public function deleteImage($filename)
    {
        File::delete('uploads/' . $filename);
    }


}
