<?php

namespace App\Http\Controllers\frontendcon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;
class frontendCon extends Controller
{
    //

    public function index(){
  
   $allrest = DB::table('restaurent_info')->orderBy('id','DESC')->get();
   $discountpro = DB::table('product_info')->where('discount','!=','')->paginate(8);
    	return view('User.index',compact('allrest','discountpro'));
    }

  function fetch_data(Request $request)
    {
     if($request->ajax())
     {
         
      $discountpro = DB::table('product_info')->where('discount','!=','')->paginate(8);
      return view('User.pagination_data', compact('discountpro'));
     }
    }
    public function restuarantview($id){
    	
    	$resname = DB::select("SELECT * FROM `restaurent_info` WHERE `id`='$id'");
    	$itemname = DB::select("SELECT `product_info`.`item_id`,`item_information`.`item_name` FROM `product_info` INNER JOIN `item_information`
ON `item_information`.`id` = `product_info`.`item_id`  WHERE `product_info`.`res_id`='$id' GROUP BY `product_info`.`item_id`");

    	$totalcount = DB::select("SELECT COUNT(`id`) AS total FROM `product_info` WHERE `res_id`='$id'");
    	$indcount = DB::select("SELECT `item_id`,COUNT(`id`) AS indtotal FROM `product_info`  WHERE `res_id`='$id' GROUP BY `item_id`");
    	$resid = $id;

    	$allproduct = DB::select("SELECT * FROM `product_info` WHERE `res_id`='$id' ORDER BY `id` ASC ");
    	return view('User.resview',compact('itemname','totalcount','indcount','resid','allproduct','resname'));
    }

    public function showreswise($itemid,$resid){

    	 
    	$itemname = DB::select("SELECT * FROM `item_information` WHERE `id`='$itemid'");
    	$itewisepro = DB::select("SELECT * FROM `product_info` WHERE `res_id`='$resid' AND `item_id`='$itemid' ORDER BY `id` ASC ");

    	return view('User.showreswise',compact('itemname','itemid','itewisepro','resid'));
    }
    public function showallprowiseres($resid){
    	
    		 $itemname = DB::select("SELECT `product_info`.`item_id`,`item_information`.`item_name` FROM `product_info` INNER JOIN `item_information`
ON `item_information`.`id` = `product_info`.`item_id`  WHERE `product_info`.`res_id`='$resid' GROUP BY `product_info`.`item_id`");
    	 $allproduct = DB::select("SELECT * FROM `product_info` WHERE `res_id`='$resid' ORDER BY `id` ASC ");
    		return view('User.showallprowiseres',compact('itemname','allproduct','resid'));
    }
     public function deleteshoping($ids){

        $obj = DB::table('shopping_cart')->where('id', '=', $ids)->delete();
        
      

    }

    public function addshoppingcard($itmid,$proid,$resid){
  // session()->forget('res_id');
        // Session::get('res_id')
    		try { 

    		 $session_id=Session::getId();
    		if(Session::get('res_id') === $resid){

    		 $insertDate = DB::table('shopping_cart')->insert(
						    [ 
						     'res_id' =>  $resid,
                             'item_id' =>  $itmid,
                             'pro_id' =>  $proid,
                             'session_id' =>  $session_id
						   ]);

    		 if($insertDate)
            {
    	       session(['res_id' => $resid]);

            }
        }else{
                return 'Not add'; 
        }
  
    	} catch (\Exception  $e) {
            $data='error///Something Went Wrong!';
    	}
    }

public function newaddshoppingcard($itmid,$proid,$resid){

    try { 
           $forgetss = session()->forget('res_id');
           $session_id=Session::getId();
           $delshopingcard = DB::table('shopping_cart')->where('session_id', '=', $session_id)->delete();
           $insertDate = DB::table('shopping_cart')->insert(
                            [ 
                             'res_id' =>  $resid,
                             'item_id' =>  $itmid,
                             'pro_id' =>  $proid,
                             'session_id' =>  $session_id
                           ]);
          if($insertDate)
                {
                   session(['res_id' => $resid]);

                }


             
          
      
        } catch (\Exception  $e) {
            $data='error///Something Went Wrong!';
        }
}
public function fullnewshoppingcard($itmid,$proid,$resid){
            try { 

             $session_id=Session::getId();
            
             $insertDate = DB::table('shopping_cart')->insert(
                            [ 
                             'res_id' =>  $resid,
                             'item_id' =>  $itmid,
                             'pro_id' =>  $proid,
                             'session_id' =>  $session_id
                           ]);
             if($insertDate)
{
    session(['res_id' => $resid]);

}
  
        } catch (\Exception  $e) {
            $data='error///Something Went Wrong!';
        }
    }



    public function incshoping($resid,$itmid,$proid){

    		try { 

    		 $session_id=Session::getId();
    		
    		 $insertDate = DB::table('shopping_cart')->insert(
						    [ 
						     'res_id' =>  $resid,
                             'item_id' =>  $itmid,
                             'pro_id' =>  $proid,
                             'session_id' =>  $session_id
						   ]);
    		 if($insertDate)
{
	session(['res_id' => $resid]);

}
  
    	} catch (\Exception  $e) {
            $data='error///Something Went Wrong!';
    	}
    }


    public function proload(){
    	 $session_id=Session::getId();
    	
    	  $data = DB::Select("SELECT COUNT(`shopping_cart`.`id`) AS toalpro,`shopping_cart`.*,`product_info`.`pro_name`,`product_info`.`price`,`product_info`.`discount` FROM `shopping_cart` 
INNER JOIN `product_info` ON `product_info`.`id` = `shopping_cart`.`pro_id` where `shopping_cart`.`session_id`='$session_id' AND `shopping_cart`.`res_id`='".Session::get('res_id')."'  GROUP BY `shopping_cart`.`pro_id`");
    	return view('User.proload',compact('data'));
    }

    public function loadSuborder(){

        $session_id=Session::getId();

          $data = DB::Select("SELECT `shopping_cart`.`pro_id`,SUM(`product_info`.`price`) AS pricetotal FROM `shopping_cart`
INNER JOIN `product_info` ON `product_info`.`id` =  `shopping_cart`.`pro_id` WHERE
`shopping_cart`.`res_id`='".Session::get('res_id')."' AND `shopping_cart`.`session_id`='$session_id'");
        
        $resname = DB::select("SELECT * FROM `restaurent_info` WHERE `id`='".Session::get('res_id')."'");

        $vat = ($data[0]->pricetotal*$resname[0]->vat)/100;
        $service = ($data[0]->pricetotal*$resname[0]->service)/100;
        $nettotal = $data[0]->pricetotal+$vat+$service+$resname[0]->deliveryfee;
          return response()->json(['subtotal'=>$data[0]->pricetotal,'vat'=>$vat,'service'=>$service,'nettotal' => $nettotal]);
    }

    public function Checkout(){
       return view('User.order');
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



    public function ordersubmit(Request $request){


        $this->validate($request, [
               
            ]);


            try {
            
            $date = date('y');
          $autid=$this->withoutPrefix('order_product_details','order_id',$date,'10');
            $session_id=Session::getId();
        
           $data = DB::Select("SELECT COUNT(`shopping_cart`.`id`) AS toalpro,`shopping_cart`.*,`product_info`.`pro_name`,`product_info`.`price`,`product_info`.`discount` FROM `shopping_cart` 
INNER JOIN `product_info` ON `product_info`.`id` = `shopping_cart`.`pro_id` where `shopping_cart`.`session_id`='$session_id' AND `shopping_cart`.`res_id`='".Session::get('res_id')."'  GROUP BY `shopping_cart`.`pro_id`"); 

           $resname = DB::select("SELECT * FROM `restaurent_info` WHERE `id`='".Session::get('res_id')."'");

          for ($i=0; $i <count($data) ; $i++) { 

             $net = $data[$i]->price - $data[$i]->discount;
            $prwispri = ($net*$data[$i]->toalpro);
            $vat = ($prwispri*$resname[0]->vat)/100;
            $service = ( $prwispri*$resname[0]->service)/100;

               $insertDate = DB::table('order_product_details')->insert(
                            [ 
                             'order_id' => $autid,
                             'pro_id' => $data[$i]->pro_id,
                             'qnt' =>  $data[$i]->toalpro,
                             'price' => $net,
                             'vat' =>  $vat,
                             'service' =>  $service,
                             'delivery' =>  $resname[0]->deliveryfee

                           ]);
          }

  $guest =   Auth::guard('guest')->user();
         
               $ss = DB::table('order_table')->insert(
                            [ 
                             'order_id' => $autid,
                             'customerid' =>  $guest->id,
                             'orderinfo' =>  $request->orderinfo,
                             'ordertype' => $request->ordertype,
                             'res_id' =>   $resname[0]->id,
                             'date' =>   $request->date,
                             'time' =>   $request->time,
                             'action' => '',

                           ]);  

               $rcv = DB::table('reciverinfo')->insert(
                            [ 
                             'order_id' => $autid,
                             'recvnam' =>  $request->recvname,
                             'rcvno' =>  $request->recvno,
                             'houseno' => $request->hn,
                             'flat' =>    $request->flat,
                             'road' =>    $request->road,
                             'area' =>   $request->area

                           ]);  
           
           

            if($insertDate){

                




                    Session::flash('success','Order Success');
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
