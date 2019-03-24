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

<!------ Include the above in your HEAD tag ---------->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>



              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

   <link rel="stylesheet" href="{!! asset('public/frontend/js/bootstrap.min.js') !!}" />

  <body>

  	<div class="container" style="border:1px solid lightgray; padding: 0;">

     @include('User.menu')

   <form id="order" class="form-vertical" action="{{URl::to('ordersubmit')}}" method="post">
         {{ csrf_field() }}

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px; padding: 0 50px;">
         @include('error.msg')
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style=" max-width: 500px; border: 1px solid navy;">

          <h3 style="text-align: center; font-family: times; background: darkorange; padding: 10px;">Order Information</h3>
          <input type="radio" name="orderinfo" value="1"> <label>Home Delevery</label><br><p style="font-size: 12px; color: gray;">Your Order Will be delivered to this address.</p>
           <input type="radio" name="orderinfo" value="2"> <label>Pickup Delevery</label><br><p style="font-size: 12px; color: gray;">Your will pick up on the order yourshelf at resturant.</p>
      
    </div>



     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="border: 1px solid navy; max-width: 500px; height: 230px; float: right;">

          <h3 style="text-align: center; font-family: times; background: darkorange; padding: 10px;">Order Type</h3>
          <input type="radio" name="ordertype" id="ordertype" onclick="checktype('1')" value="1" > <label>Relular Order</label><br><p style="font-size: 12px; color: gray;">Get the food as soon as possible.</p>
           <input type="radio" name="ordertype" id="ordertype"  onclick="checktype('2')" value="2" > <label>Pre-Order</label><br><p style="font-size: 12px; color: gray;">Schedule your delevery time.<br/>
            <div id="datetime" ></div>

           </p>
      
    </div>
    </div>
<script type="text/javascript">
  function checktype(id){
   

    if(id =='1'){
      $('#datetime').html('');
    }else{
$('#datetime').html('<input type="text" name="date" value="<?php echo date('d-m-Y') ?>"/>&nbsp;&nbsp;<input type="text" name="time" value="<?php echo date('h:i') ?>"/>');
    }
  }

</script>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <center>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin-top: 50px;">
        <a href="#" style="text-align: center;border: 1px solid blue; padding: 10px;text-decoration: none; background: lightgreen; font-weight: bold; ">Add New Address</a>
      
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="margin-top: 50px;">

      <a href="#" style="text-align: center;border: 1px solid blue; padding: 10px;text-decoration: none; font-weight: bold; ">Previous Address</a>
      
    </div>
    </center>
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px; background: #f4f4f4; padding: 20px; border-top: 2px solid green;">

     
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Receiver Name</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Receiver Name" name="recvname">
    </div>
    <div class="form-group col-md-6">
      <label>Receiver Number</label>
      <input type="text" class="form-control" id="inputPassword4" placeholder="Receiver Number" name="recvno">
    </div>
  </div>
  <div class="form-group col-md-12">
    <label>House Name/Number</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="House Name/Number" name="hn">
  </div>
  <div class="form-group col-md-12">
    <label>Flat/Floor</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Flat/Floor" name="flat">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label>Road/Landmark</label>
      <input type="text" class="form-control" id="inputCity" placeholder="Road/Landmark" name="road">
    </div>
    <div class="form-group col-md-6">
      <label>Select Area</label>
      <select id="inputState" name="area" class="form-control">
        <option>Feni</option>
        <option>Comilla</option>
        <option>Chittagong</option>
        <option>Noakali</option>
       

      </select>
    </div>

    <center><input type="submit" name="next" value="Submit" class="btn btn-danger" style="margin-top: 20px; border-radius: 0px;"></center>
  
</form>

</div>
</div>
      



 @include('User.footer')