<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          
 
  
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }

    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 425px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }

 

    #hdTuto_search{

      display: none;
      width: 540px;
     
      margin-top: 5px;
      background-color: #ffffff;
     
      padding-left: 5px;
    }

    .list-gpfrm-list a{

      text-decoration: none !important;
     
      width: 100%;
      font-size: 16px;

    }

    .list-gpfrm li{

      cursor: pointer;
     
     
       
    }

    .list-gpfrm{

      list-style-type: none;

        background: #d4e8d7;

    }

    .list-gpfrm li:hover{

      color: black;

      background-color: #b1afaf;

    }
    .fstdive{
      position: absolute;
      z-index: 1000;

    }
    .snddive{
      position: absolute;
      z-index: 1;
      margin-top: 50px;
    }
  </style>


</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="./">Home</a></li>
        <li><a href="api.php">API</a></li>
         <li><a href="Propertise.php">Search Propertise</a></li>
       
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

  <form class="form-horizontal" method="post"  name="myForm" id="myForm" enctype="multipart/form-data" class="myForm">
  
<div class="container">    
  <h3>Search For Propertise</h3><br>
  <div class="row">

    <div class="col-sm-12 table-bordered ">
        <div class="col-lg-6 col-sm-12 col-lg-offset-2 fstdive"  >
          <br/>
          <input type="text" id="querystr" name="querystr" class="form-control" placeholder="Search here...."  autocomplete="off" style="border-radius: 0px;">
          <ul class="list-gpfrm" id="hdTuto_search"></ul>
        </div>
        

        <div class="col-sm-12  snddive" style="padding: 0px;" id="datashow">
            
        </div>
    </div>




    
    
  </div>
</div><br>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="propertise.js"></script>
<script type="text/javascript">
  
//autosearch
$(document).ready(function(){

  //Autocomplete search using PHP, MySQLi, Ajax and jQuery

    //generate suggestion on keyup

    $('#querystr').keyup(function(e){


      e.preventDefault();

     var textData = $('#querystr').val();
     var textAuto = 50;

      $.ajax({

        type: 'POST',

        url: 'ajaxSubmit.php',

        data: {textData:textData,textAuto:textAuto},

        dataType: 'json',

        success: function(response){
        
          if(response.error){

            $('#hdTuto_search').hide(100);

          }

          else{

            $('#hdTuto_search').show(100).html(response.data);

          }

        }

      });

    });



    //fill the input

    $(document).on('click', '.list-gpfrm-list', function(e){

      e.preventDefault();

      $('#hdTuto_search').hide();

      var fullname = $(this).data('fullname');

      $('#querystr').val(fullname);
      showData(fullname);

    });

    

  });

function showData(fulname){
  var fulname = fulname;
  var checkShowData = 50;
  if(fulname != ""){
  $.ajax({
           type: "POST",
            url: "ajaxSubmit.php",
            data: {fulname:fulname,checkShowData:checkShowData},
           
      success:function(data){
        $('#datashow').html("");
         $('#datashow').html(data);
          }
    });
}
}
</script>




</form>
</body>
</html>
