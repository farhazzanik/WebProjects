<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
 
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  
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

   #list-gpfrm{

     
    
      
    }

    #list-gpfrm li{

      cursor: pointer;
      list-style: none;
      height: 40px;
      margin-left: -40px;
      width: 100%;
    }

    .list-gpfrm li:hover{
      color: black;
      background-color: #b1afaf;

    }
   .fstdive{
      position: absolute;
      z-index: 100;
      display: block;
      overflow: hidden;
     

    }
   
  </style>
</head>
<body>

        <!-- Nav bar Section -->

        <div class="container-fluid" style="padding: 0px; margin: 0px;">
            <section>
              <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                  
                  <ul class="nav navbar-nav">
                     <li @php if(Route::currentRouteName() === '/') { @endphp class="active" @php  } @endphp><a href="{{URL::to('/')}}">Home</a></li>
                     <li @php if(Route::currentRouteName() === 'groupWorkHours') { @endphp class="active" @php  } @endphp><a href="{{URL::to('groupWorkHours')}}">Group Workhours Report</a></li>
                     <li @php if(Route::currentRouteName() === 'comWorkHours') { @endphp class="active" @php  } @endphp><a href="{{URL::to('comWorkHours')}}">Workhours according to company</a></li>
                  </ul>
                </div>
              </nav>
            </section>

            <!-- End Nav bar Section -->
           
            <!-- Erro Message Show -->
            @if(Session::has('error'))

                <div class="alert alert-danger">{{Session::get('error')}} <br/></div>

            @endif
             <!-- End Erro Message Show -->
