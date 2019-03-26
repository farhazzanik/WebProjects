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
        <li class="active"><a href="#">Home</a></li>
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
  
<div class="container text-center">    
  <h3>Property Admin Area</h3><br>
  <div class="row">
    <div class="col-sm-12 ">
        

        <table class="table table-bordered">
              <tr>
                  <td>County</td>
                  <td>
                    <div class="col-lg-6">
                    <input type="text" name="County" id="County" placeholder="Ex:Estonia" class="form-control input-sm" style="border-radius: 0px;">
                    </div>

                  </td>
              </tr>

               <tr>
                  <td>Country</td>
                  <td>
                    <div class="col-lg-6">
                    <input type="text" name="Country" id="Country" placeholder="Ex:Estonia" class="form-control input-sm" style="border-radius: 0px;">
                    </div>

                  </td>
              </tr>


               <tr>
                  <td>Town</td>
                  <td>
                    <div class="col-lg-6">
                    <input type="text" name="Town" id="Town" placeholder="Ex:Estonia" class="form-control input-sm" style="border-radius: 0px;">
                    </div>

                  </td>
              </tr>

               <tr>
                  <td>Postcode</td>
                  <td>
                    <div class="col-lg-6">
                    <input type="text" name="Postcode" id="Postcode" placeholder="Ex:3900" class="form-control input-sm" style="border-radius: 0px;">
                    </div>

                  </td>
              </tr>

               <tr>
                  <td>Description</td>
                  <td>
                    <div class="col-lg-6">
                    <textarea name="Description" id="Description" rows="5"  class="form-control input-sm"></textarea>
                    </div>

                  </td>
              </tr>

              <tr>
                  <td>Display Address</td>
                  <td>
                    <div class="col-lg-6">
                    <textarea name="Address" id="Address" rows="5"  class="form-control input-sm"></textarea>
                    </div>

                  </td>
              </tr>

               <tr>
                  <td>Image</td>
                  <td>
                    <div class="col-lg-6">
                    <input type="file" name="file" id="file" accept="image/*">
                    </div>

                  </td>
              </tr>

               <tr>
                  <td>Number of bedrooms</td>
                  <td>
                    <div class="col-lg-6">
                      <select name="bedrooms" id="bedrooms" class="form-control input-sm " style="border-radius: 0px;">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                      </select>
                    </div>

                  </td>
              </tr>


               <tr>
                  <td>Number of bathrooms</td>
                  <td>
                    <div class="col-lg-6">
                      <select name="bathrooms" id="bathrooms" class="form-control input-sm" style="border-radius: 0px;">
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                      </select>
                    </div>

                  </td>
              </tr>


                 <tr>
                  <td>Price</td>
                  <td>
                    <div class="col-lg-6">
                    <input type="text" name="Price" id="Price" placeholder="Ex:1000.00" class="form-control input-sm" style="border-radius: 0px;"  onkeypress="return isNumberKey(event,this.id)">
                    </div>

                  </td>
              </tr>

               <tr>
                  <td>Property Type</td>
                  <td>
                    <div class="col-lg-6">
                      <select name="Property" id="Property" class="form-control input-sm" style="border-radius: 0px;">
                          <option>House</option>
                          <option>Apartment</option>
                          <option>Hostel</option>
                      </select>
                    </div>

                  </td>
              </tr>

              <tr>
                 
                  <td colspan="2" align="text-center">
                   
                    <input type="button" onclick="DataAdd()" name="submit" value="Submit" class="btn btn-success btn-sm" style="border-radius: 0px;">
                  </td>
              </tr>


        </table>

        <table id="example" class="table table-striped table-bordered" >
        <thead>

            <tr>
                <th>County</th>
                <th>Country</th>
                <th>Town</th>
                <th>Postcode</th>
                <th>Description</th>
                <th>Display Address</th>
                <th>Image</th>
                <th>Number of bedrooms</th>
                <th>Number of bathrooms</th>
                 <th>Price</th>
                <th>Property Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tbody">
            
           
           
           
          
        </tbody>
     
    </table>
     
    </div>
    
    
  </div>
</div><br>




 <script src="action.js"></script>
   <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
             <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
                <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
</form>
</body>
</html>
