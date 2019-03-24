
 
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px; padding: 30px;   background: #2E363E; ">

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="">
      <h4 style="color: #fff;">QUICK CONTACT</h4><br>
      <p style="color: lightgray;">
       Old Town,Tallinn,Estonia.<br>
        <br>Phone: +372 5363 1295

        <br><br>Email : Mahfuzkhan2125@gmail.com
      
      <br><br>
        Office Time: Sat-Wed 8:30 AM to 4:30 PM<br><br>

          Only Admission Office is open on Thursday 10:00 AM to 4:00 PM</p>
      </div>

  


<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
   <h4 style="color: #fff;" >IMPORTANTS LINKS</h4><br>
   <a href="#" style="color: lightgray; text-decoration: none;">Service and Policy</a><br><br>
   <a href="#" style="color: lightgray; text-decoration: none;">Termp & Policy</a><br><br>
   <a href="#" style="color: lightgray; text-decoration: none;">About Us</a><br><br>
   <a href="#" style="color: lightgray; text-decoration: none;">Contact us</a><br><br>
   <a href="#" style="color: lightgray; text-decoration: none;">Order Now</a>
   
      
    </div>

<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
   <h4 style="color: #fff;">CONNECT WITH US</h4><br>
   <style type="text/css">
     .icone:hover{background: darkorange; transition: all 0.5s ease-in; border-radius: 50%;}
   </style>

  <a href="#"><i class="fab fa-facebook icone" style="color: lightgray; font-size: 25px; padding: 10px;"></i></a>
  <a href="#"><i class="fab fa-twitter-square icone" style="color: lightgray; font-size: 25px; padding: 10px;"></i></a>
 <a href="#"> <i class="fab fa-youtube-square icone" style="color: lightgray; font-size: 25px; padding: 10px;"></i></a>
  <a href="#"><i class="fab fa-google-plus-square icone" style="color: lightgray; font-size: 25px; padding: 10px;"></i></a><br><br><br><br><br><br>


  <a href="#" style="float: right;"><i class="fas fa-arrow-up" style="color: #fff; padding: 10px; background: orange; font-weight: bold;"></i></a>
   
      
    </div>




    </div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0; padding: 0 50px; background: #1B2025;">

  
  <p style="margin-top: 40px; float: right; color: lightgray;">Copyright &copy 2019.<span style="color: orange;">HelloFood.com</span> || All rights reserved.<br>Design & Developed  By Mahfuzul Haque </p>




</div>



</div>






    <div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" 
class="close" title="Close Modal">&times;</span>
<div class="df"  style="max-width: 700px; margin:0 auto;">

  <form action="{{URL::to('createuser')}}" class="modal-content animate" method="POST" style="border-top: 5px solid green; background: #f4f4f4">
           {{ csrf_field() }}
   <center><img src="{{URL::to('/')}}/public/frontend/img/z13.png"  class="img-responsive" style="height: 100px; margin-top: 10px;"></center>

    <div class="container">
       <label>Name :</label><br>
      <input type="text" name="name" placeholder="Enter Your Name" class="form-control" style="max-width: 500px;border-radius: 0px"><br>

    	<label>Email :</label><br>
    	<input type="text" name="Email" placeholder="Email" class="form-control" style="max-width: 500px;border-radius: 0px"><br>


        <label>Phone No :</label><br>
      <input type="text" name="Phone" placeholder="Phone" class="form-control" style="max-width: 500px;border-radius: 0px"><br>

    	<label>Password :</label><br>
    	<input type="password" name="password" placeholder="Password" class="form-control" style="max-width: 500px;border-radius: 0px"><br>
<br/>
    
    </div>
    <div class="" style="text-align: right; margin-bottom: 5px; margin-right: 5px;">
        <input type="submit" name="login" value="Login" style="border-radius: 0px; text-align: right;" class="btn btn-success">
   
    </div>

   
  </form>
</div>

</div>



    <div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" 
class="close" title="Close Modal">&times;</span>
<div class="df"  style="max-width: 700px; margin:0 auto;">

  <form action="{{URL::to('userchek')}}"  class="modal-content animate" method="POST" style="border-top: 5px solid green; background: #f4f4f4">
     {{ csrf_field() }}
   <center><img src="{{URL::to('/')}}/public/frontend/img/z13.png"  class="img-responsive" style="height: 100px; margin-top: 10px;"></center>

    <div class="container">

      <label>Email :</label><br>
      <input type="text" name="name" placeholder="Enter Your Email" class="form-control" style="max-width: 500px; border-radius: 0px;"><br>
      <label>Password :</label><br>
      <input type="password" name="password" placeholder="Password" class="form-control" style="max-width: 500px; border-radius: 0px;"><br>
     
     <br><br>

      <input type="submit" name="login" value="Login" class="btn btn-success" style=" border-radius: 0px;">
   
    </div>

   
  </form>
</div>

</div>





  </body>
</html>