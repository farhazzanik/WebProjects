<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>
    <link rel="stylesheet" href="{{URL::To('/')}}/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::To('/')}}/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  </head>
  <body>
        <div class="container col-lg-12 col-sm-12">
            <div class="header top-header col-lg-12">
                    <div class="col-lg-6 col-sm-12 text-center h-left-divs">
                            <span>Klienditeendus</span>
                          &nbsp;&nbsp;  <span><i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;+372 53631295</span>&nbsp;&nbsp;
                            <span><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;E-P 9:30-10:20</span>
                    </div>
                    <div class="col-lg-6 col-sm-12 text-center h-left-div">
                            <span>Hi,Mahfuzul Haque</span>
                           &nbsp;&nbsp; <a href="" style="background-color: orange;color: white; padding: 2px 20px;text-align: center;text-decoration: none;display: inline-block; border-radius: 20%; border: 1px white solid;"><i class="fa fa-unlock" aria-hidden="true"></i>&nbsp;Log Out</a>
                    </div>
            </div>
            <div class="header middle-header col-lg-12 text-center">
                    <ul>
                            <li>Add <i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li>Here <i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li>Random <i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li>Link to our Page <i class="fa fa-angle-right" aria-hidden="true"></i></li>
                    </ul>
            </div>


             <div class="header bottom-header col-lg-12 text-left">
                  <ul class="col-lg-offset-2">
                            <li><a href="{{URL::to('jsonFile')}}">Click here to import Data From Json Files..</a></li>
                            <li><a href="{{URL::to('user')}}">Users</a></li>
                            <li><a href="{{URL::to('loans')}}">Loans</a> </li>
                            <li><a href="{{URL::to('checkAge')}}">Check Age</a> </li>
                    </ul>
            </div>

             <div class="midcontent  col-lg-12 " id="tag_container">
              
                @include('paginateData');

            </div>
                


        </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{URL::To('/')}}/public/js/jquery-1.12.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{URL::To('/')}}/public/js/bootstrap.min.js" ></script>


    <script type="text/javascript">

    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });
    
    $(document).ready(function()
    {
        $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
  
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
  
            var myurl = $(this).attr('href');
            var page=$(this).attr('href').split('page=')[1];
  
            getData(page);
        });
  
    });
  
    function getData(page){
        $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#tag_container").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }
</script>


  </body>
</html>