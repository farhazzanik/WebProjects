<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Food Forti</title>
  

 <link rel="stylesheet" href="{!! asset('public/frontend/style.css') !!}" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<!------ Include the above in your HEAD tag ---------->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<link rel="stylesheet" href="{!! asset('public/frontend/css/bootstrap.min.css') !!}" />
    


              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="{!! asset('public/frontend/js/bootstrap.min.js') !!}"></script>
   
    <script>

var modal = document.getElementById('id01');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}



var modal = document.getElementById('id02');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


</script>


</head>

  <body>

  	<div class="container" style="border:1px solid lightgray; padding: 0;">

   

   @include('User.menu')

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">

    	  <section id="slider">
      
       <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
     <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
  </ol>

  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="{{URL::to('/')}}/public/frontend/img/slide1.jpg" style="width:100%; ">
      <div class="carousel-caption">
        
       
       
        </div>
      </div>
      <div class="item">
        <img src="{{URL::to('/')}}/public/frontend/img/slide2.jpg" style="width:100%;  " >
        <div class="carousel-caption">
          
        
        </div>
      </div>
       <div class="item">
        <img src="{{URL::to('/')}}/public/frontend/img/slide3.jpg"  style="width:100%; ">
        <div class="carousel-caption">
          
        
        </div>
      </div>

       <div class="item">
        <img src="{{URL::to('/')}}/public/frontend/img/slide4.jpg"  style="width:100%; ">
        <div class="carousel-caption">
          
        
        </div>
      </div>
     
    </div>

 
</div>
        
     
      
    </section>
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
    	<h3 style="text-align: center; font-family: serif;">Special Offer</h3><br>
     
      <hr>

	
    </div>


     <div id="table_data" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:50px; " >
      @include('User.pagination_data')
  
    </div>

<script type="text/javascript">
  $(document).ready(function(){

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault(); 
  var page = $(this).attr('href').split('page=')[1];
  fetch_data(page);
 });

 function fetch_data(page)
 {
  $.ajax({
   url:"index/fetch_data?page="+page,
   success:function(data)
   {
    $('#table_data').html(data);
   }
  });
 }
 
});
</script>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
    

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<h3 style="padding: 0px 10px;">Our Restaurant</h3><hr>
    	
      @if(count($allrest) >0 )
      @foreach($allrest as $show)
    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="margin-top: 10px;">

      <div class="imga">
  <img src="{{URL::to('/')}}/public/resturant/{{$show->id}}logo.png"  class="images" style="height: 180px;">
  <div class="overlay">
    <div class="text"><a href="{{URL::To('restuarantview')}}/{{$show->id}}" style="text-decoration: none; background: orange; padding: 4px; font-family: times; font-size:14px; color: #fff; font-weight: bold;">{{$show->res_name}}</a></div>
  </div>
</div>


</div>
@endforeach
@endif
	
    </div>
    	
    </div>

 @include('User.footer')