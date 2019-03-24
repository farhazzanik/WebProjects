<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Food Forti</title>
  <link rel="stylesheet" href="{!! asset('public/frontend/css/bootstrap.min.css') !!}" />

 <link rel="stylesheet" href="{!! asset('public/frontend/style.css') !!}" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">



</head>

  <body>

  	<div class="container" style="border:1px solid lightgray; padding: 0;">

     @include('user.menu')

<style type="text/css">
  .hero-image {
  background-image: url("{{URL::to('/')}}/public/resturant/{{$resid}}Banner.jpg");
  background-color: #cccccc;
  height: 500px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
  width: 100%;
  height: 350px;
 opacity: 0.5;
}

</style>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hero-image" style="">
      <center><img src="{{URL::to('/')}}/public/resturant/{{$resid}}logo.png" class="img-responsive" style="height: 150px; border-radius: 10px; margin-top:70px; "></center>
      
      <p style="font-weight: bold; text-align: center; font-size: 28px; color: white">{{$resname[0]->res_name}}</p>
      <p style="float: left; font-weight: bold; color: white;">Delivery Fee: {{$resname[0]->deliveryfee}}  TK</p>
     
      <p style="float: right; font-weight: bold; color: white;">Delivery Time :{{$resname[0]->deliverytime}}</p><br>
      <p style="text-align: center; font-weight: bold; font-size: 16px; color: white;">Minimum Order : 100TK</p>

      
    </div>

<!-- 
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px; ">
      <p style="font-weight: bold; font-size: 18px;">Enjoy Food From Your Favourite Resturants :</p>
      <p style="float: right;"><input type="search" name="search" placeholder="Search Any Item" style="height: 30px; max-width: 600px; border:none; border:1px solid darkorange; padding: 5px; border-right: none;"><label><a href="#"><i class="fas fa-search" style="background: orange; border:1px solid orange;padding: 7px; color: #fff; width: 40px; text-align: center;"></i></a></label></p>
      
    </div> -->

<style type="text/css">
  #menusli{
     
       font-family: "Times New Roman", Times, serif;
       font-kerning: normal;
       font-weight: bold;
       text-align: center;
       display: block;

       

  }
   #menusli:hover{
    color: red;
    cursor: pointer;

   }
  #menudiv{
    text-align: center; 
   -webkit-transition: border-bottom 0.5s; /* For Safari 3.1 to 6.0 */
   transition: border-bottom 0.5s;

  }
  #menudiv:hover{
      border-bottom:5px red solid;
  }

  #leftsidelist{list-style: none; display: inline-block; width: 100%; height: 35px; background-color: red; padding-left: 10px; padding-top: 5px; cursor: pointer; }

   #leftsidelist a{text-decoration: none; color:#2E363E; font-family: times; font-size: 16px; color: white}
    
    #leftsidelists{list-style: none; display: inline-block; width: 100%; height: 35px;  padding-left: 10px; padding-top: 5px; cursor: pointer; }
    #leftsidelists a{text-decoration: none; color:black; font-family: times; font-size: 16px;}
    #leftsidelists a:hover{
        color: red;
    }
    #midsidelist{
      list-style: none; display: inline-block; width: 100%; height: 35px;   padding-top: 15px; color: black; }
     #midsidelist a{text-decoration: none; color:black; font-family: times; font-size: 16px;}

     #innerdiv{padding: 0px;}
</style>
<form method="POST">
   {{ csrf_field() }}
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs" style=" border-bottom:2px red solid; margin-top: 50px;">
       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="menudiv" style="border-bottom: 5px red solid">
        <li style="list-style: none; display: inline-block; "id="menusli"><a href="#"  style="text-decoration: none; font-size: 20px;" ><i class="fas fa-bars"></i> &nbsp;&nbsp;Menus</a></li>
      </div>
 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="menudiv">
        <li style="list-style: none; display: inline-block; " id="menusli"><a href="#" style="text-decoration: none; font-size: 20px;"><i class="fas fa-comment-dots"></i>&nbsp;&nbsp;Reviews</a></li>
      </div>
       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="menudiv">
        <li style="list-style: none; display: inline-block; " id="menusli"><a href="#" style="text-decoration: none; font-size: 20px;"><i class="far fa-file-alt"></i>&nbsp;&nbsp;Information</a></li>
      </div>
       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="menudiv">
          <li style="list-style: none; display: inline-block;" id="menusli"><a href="#" class="mb-0" style="text-decoration: none; font-size: 20px;"><i class="fas fa-utensils"></i>&nbsp;&nbsp;Reservation</a></li>
        </div>
       
      
      
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 visible-xs" style=" border-bottom:2px red solid; margin-top: 50px;">
       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="menudiv">
        <li style="list-style: none; display: inline-block; "id="menusli"><a href="#"  style="text-decoration: none; font-size: 12px;" ><i class="fas fa-bars"></i> &nbsp;&nbsp;Menus</a></li>
      </div>
 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="menudiv">
        <li style="list-style: none; display: inline-block; " id="menusli"><a href="#" style="text-decoration: none; font-size: 10px;"><i class="fas fa-comment-dots"></i>&nbsp;&nbsp;Reviews</a></li>
      </div>
       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="menudiv">
        <li style="list-style: none; display: inline-block; " id="menusli"><a href="#" style="text-decoration: none; font-size: 10px;"><i class="far fa-file-alt"></i>&nbsp;&nbsp;Information</a></li>
      </div>
       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="menudiv">
          <li style="list-style: none; display: inline-block;" id="menusli"><a href="#" class="mb-0" style="text-decoration: none; font-size: 10px;"><i class="fas fa-utensils"></i>&nbsp;&nbsp;Reservation</a></li>
        </div>
       
      
      
    </div>


      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">

      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="col-xs-12">
         <p style="float: right;"><input type="search" name="search" placeholder="Search Any Item" style="height: 30px; max-width: 600px; border:none; border:1px solid darkorange; padding: 5px; border-right: none;"><label><a href="#"><i class="fas fa-search" style="background: orange; border:1px solid orange;padding: 7px; color: #fff; width: 40px; text-align: center;"></i></a></label></p>
</div>

  <li id="leftsidelist" class="ss" onclick="showbodyproduct('ss','{{$resid}}')"> <div class="col-xs-9" style="padding: 0px;"><a>View ALL </a> </div>
        <div class="col-xs-3" align="right" style="padding: 0px; "><a>{{$totalcount[0]->total}}  </a>&nbsp;&nbsp;&nbsp;</div> </li>
      
      @if(count($itemname) > 0)
      @foreach($itemname as $showdat)
    <li id="leftsidelists" class="leftsidelists-{{$showdat->item_id}} listcss" onclick="showbodyproduct('{{$showdat->item_id}}','{{$resid}}')">


        <div class="col-xs-9" style="padding: 0px;"><a>{{$showdat->item_name}}</a></div>
        <div class="col-xs-3" align="right" style="padding: 0px;">

          @if(count($indcount) > 0)
          @foreach($indcount as $showind)
          @if($showind->item_id == $showdat->item_id)
             <a>{{$showind->indtotal}}</a>
          @endif
          @endforeach
          @endif
        &nbsp;&nbsp;&nbsp;</div> </li>
    @endforeach
    @endif
      
      
    </div>


    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="showMidprodiv">
     

     @if(count($itemname) > 0)
      @foreach($itemname as $showdat)
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-bottom: 2px black solid">
        <p style="font-size: 18px; color: black; text-align: center; font-weight: bold;">{{$showdat->item_name}}</p>
      </div>
        @if(count($allproduct) > 0)
        @foreach($allproduct as $showpro)
           @if($showpro->item_id == $showdat->item_id)
         
         
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="col-xs-8" id="innerdiv"><li id="midsidelist">{{$showpro->pro_name}}</li>
            <p id="text-{{$showpro->id}}" style="text-align: justify; color: #707070; font-size: 12px;">
{{  $ss=substr(strip_tags($showpro->details), 0, 50) }}
      
        @if( strlen(strip_tags($showpro->details)) > 50)
          <a  onclick="showmoretext('{{$showpro->id}}','{{$showpro->details}}','{{$ss}}')" style="text-decoration: none; color: green; cursor: pointer;">...See More</a>

        @endif

            </p></div>
           <div class="col-xs-4" id="innerdiv" style="text-align: right;"><li id="midsidelist"> {{$showpro->price - $showpro->discount}} Tk
            <img  onclick="return addcart('{{$showpro->item_id}}','{{$showpro->id}}','{{$resid}}')" src="{{URL::to('/')}}/public/frontend/img/plus.png" style="cursor: pointer;"> 

 </li></div>
       </div>
        @endif
       @endforeach
       @endif

       @endforeach
       @endif
 
      
  </div>

     <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" style="border:1px #ccc solid">
      <p style="font-size: 18px; text-align: center; padding-top: 10px; color:black; border-bottom: 1px #ccc solid; padding-bottom: 5px;font-family: "Times New Roman", Times, serif;">My Order</p>

      <div id="proload" class="col-xs-12" style="border-bottom:1px #ccc solid; padding-bottom: 10px; ">
        

      </div>


       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

      <div class="col-xs-9" id="innerdiv"><li id="midsidelist">Subtotal</li></div>
      <div class="col-xs-3" id="innerdiv"><li id="midsidelist" class="subtotal">90tk </li></div>
      <div class="col-xs-9" id="innerdiv"><li id="midsidelist">VAT {{$resname[0]->vat}}%</li></div>
      <div class="col-xs-3" id="innerdiv"><li id="midsidelist" class="vat"> </li></div>
      <div class="col-xs-9" id="innerdiv"><li id="midsidelist">Service Charge {{$resname[0]->service}}%</li></div>
      <div class="col-xs-3" id="innerdiv"><li id="midsidelist" class="service"> </li></div>
      <div class="col-xs-9" id="innerdiv"><li id="midsidelist">Delivery Fee </li></div>
    <div class="col-xs-3" id="innerdiv"><li id="midsidelist">{{$resname[0]->deliveryfee}}  </li></div>

       <div class="col-xs-9" id="innerdiv"><li id="midsidelist"><b>Total</b></li></div>
    <div class="col-xs-3" id="innerdiv"><li id="midsidelist" class="nettotal"><b></b> </li></div>

       </div>

 <div class="col-xs-12" style="border-bottom:1px #ccc solid ">
       <h4 style="text-align: center; background: red; padding: 10px;"><a href="{{URL::To('Checkout')}}" style="text-decoration: none; color: #fff;">Go to Checkout</a></h4>
      </div>
    </div>


   
  </div>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <link rel="stylesheet" href="{!! asset('public/frontend/js/bootstrap.min.js') !!}" />
    <meta name="_token" content="{!! csrf_token() !!}" />


   <script type="text/javascript">
    showshopingcart();

      function showbodyproduct(itemid,resid){
        
        $(".listcss").css({"background-color":"white", "color": "red"});
           $(".listcss a").css({"color": "black"});

          if(itemid =='ss'){
          $( "#leftsidelist" ).animate({
          backgroundColor: "red",
          color: "#fff",
          
        }, 500 );
          $("#showMidprodiv").fadeOut();
            $("#showMidprodiv").load("{{URL::to('showallprowiseres')}}"+'/'+resid).fadeIn("slow");
           $(".listcss").css({"background-color":"white"});
           $("#leftsidelist a").css({ "color": "white"});
          }else {
            $("#showMidprodiv").fadeOut();

             $("#showMidprodiv").load("{{URL::to('showreswise')}}"+'/'+itemid+'/'+resid).fadeIn("slow");

             $("#leftsidelist").css({"background-color":"white", "color": "red"});
             $("#leftsidelist a").css({ "color": "black"});
            $(".leftsidelists-"+itemid+" a").css({ "color": "white"});
         
           $( ".leftsidelists-"+itemid ).animate({
          backgroundColor: "red",
          color: "#fff",
          
        }, 500 );
           

          }

      }

      function showmoretext(id,text,ss){

              $('#text-'+id).html(text+'<a  onclick="showlesstext('+id+',\'' + ss + '\',\'' + text + '\')"  style="text-decoration: none; color: green; cursor: pointer;">..See Less</a>');
           
      }
      function showlesstext(id,shottext,longtex){
        $('#text-'+id).html(shottext+'<a  onclick="showlesstext('+id+',\'' + longtex + '\',\'' + shottext + '\')"  style="text-decoration: none; color: green; cursor: pointer;">..See More</a>');
       
      }

      function addcart(itemid,proid,resid){
var ss = $('#sesionres').val();

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })
       if(ss != ''){

        if(ss == resid) {

           $.ajax({
            url: "{{url('addshoppingcard')}}/"+itemid+'/'+proid+'/'+resid,
            data: {},
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
              
            showshopingcart();
           
            },
            error: function (data) {
              alert(data.status);
            }
        });

        }else{

          if(confirm("You Are in another Restaurant do you want to delete previous foods?")){
              

           $.ajax({
            url: "{{url('newaddshoppingcard')}}/"+itemid+'/'+proid+'/'+resid,
            data: {},
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
              
            showshopingcart();
           
            },
            error: function (data) {
              alert(data.status);
            }
        });

         } else{
        return false;
    }
        }

           


       }else{

          $.ajax({
            url: "{{url('fullnewshoppingcard')}}/"+itemid+'/'+proid+'/'+resid,
            data: {},
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
              
            showshopingcart();
           
            },
            error: function (data) {
              alert(data.status);
            }
        });

       }



      }
     function showshopingcart(){
      
            $("#proload").load("{{URL::to('proload')}}");
            loadSuborder();
     }

     function loadSuborder(){

          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

         $.ajax({
            url: "{{url('loadSuborder')}}",
            data: {},
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
              $('.subtotal').html(data.subtotal);
               $('.vat').html(data.vat);
           $('.service').html(data.service);
            $('.nettotal').html(data.nettotal);
            },
            error: function (xhr, status, error) {
             
            }
        });
     }

     
     function deleteshoping(id){

       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

         $.ajax({
            url: "{{url('deleteshoping')}}/"+id,
            data: {},
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
            showshopingcart();
           
            },
            error: function (xhr, status, error) {
              alert('Something went wrong ..!!');
            }
        });
     }

     function incshoping(resid,itemid,proid){


       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
            })

         $.ajax({
            url: "{{url('incshoping')}}/"+resid+'/'+itemid+'/'+proid,
            data: {},
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
            showshopingcart();
           
            },
            error: function (xhr, status, error) {
              alert('Something went wrong ..!!');
            }
        });

     }
   </script>
@include('User.footer')




