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

<?php
	
  require_once("db_connect/config.php");
   require_once("db_connect/conect.php");
	
	$db = new database();


	$path = 'http://api.zoopla.co.uk/api/v1/property_listings.xml?postcode=3900&area=Oxford&api_key=j9asqq3kygar9d8p6zzb2cgx';

		$xmlfile = file_get_contents($path);
		$ob= simplexml_load_string($xmlfile);
		$json  = json_encode($ob);
		$configData = json_decode($json, true);

		for ($i=0; $i < count($configData) ; $i++) { 

			if($configData["listing"][$i]["post_town"] !="" && $configData["listing"][$i]["price"]){
			$county = $db->escape($configData["county"]);
			$country = $db->escape($configData["country"]);
			$post_town = $db->escape($configData["listing"][$i]["post_town"]);
			$description = $db->escape($configData["listing"][$i]["description"]);
			$details_url = $db->escape($configData["listing"][$i]["details_url"]);
			$displayable_address = $db->escape($configData["listing"][$i]["displayable_address"]);
			$image_url = $db->escape($configData["listing"][$i]["image_url"]);
			$thumbnail_url = $db->escape($configData["listing"][$i]["thumbnail_url"]);
			$latitude = $db->escape($configData["listing"][$i]["latitude"]);
			$longitude = $db->escape($configData["listing"][$i]["longitude"]);
			$num_bedrooms = $db->escape($configData["listing"][$i]["num_bedrooms"]);
			$num_bathrooms = $db->escape($configData["listing"][$i]["num_bathrooms"]);
			$price = $db->escape($configData["listing"][$i]["price"]);
			$property_type = $db->escape($configData["listing"][$i]["property_type"]);
			$status = $db->escape($configData["listing"][$i]["status"]);

		 $replaceQuery = "REPLACE INTO  `api_table` (`county`,`country`,`town`,`description`,`details_url`,`displayable_address`,`image_url`,`thumbnail_url`,`latitude`,`longitude`,`num_bedrooms`,`num_bathrooms`,`price`,`property_type`,`status`)VALUES('".$county."','".$country."','".$post_town."','".$description."','".$details_url."','".$displayable_address."','".$image_url."','".$thumbnail_url."','".$latitude."','".$longitude."','".$num_bedrooms."','".$num_bathrooms."','".$price."','".$property_type."','".$status."')";
			$insert =  $db->insert_query($replaceQuery);
			}
		}
if($insert) {

	print "Data Insert Successfully";
}else{
	print "There is some Problem";
}

	
	$showSql="SELECT * FROM `api_table` ORDER BY id ASC";
 	$result_data = $db->select_query($showSql);	

		if($result_data->num_rows > 0)	{
			?>
					<table id="example" class="table table-striped table-bordered" >
			        <thead>

			            <tr>
			                <th>County</th>
			                <th>Country</th>
			                <th>Town</th>
			                <th>Description</th>
			                <th>Details URL</th>
			                <th>Displayable Address</th>
			                <th>Image url</th>
			                <th>Thumbnail Url</th>
			                <th>Latitude</th>
			                <th>Longitude</th>
			                 <th>Number of bedrooms</th>
			                <th>Number of bathrooms</th>
			                 <th>Price</th>
			                <th>Property Type</th>
			                <th>Status</th>
			            </tr>
			        </thead>
			        <tbody id="tbody">
			            
			           <?php 
while($fetch_Data = $result_data->fetch_object()){
			           ?>
			           <tr>
			           		<td><?php echo $fetch_Data->county; ?></td>
			           		<td><?php echo $fetch_Data->country; ?></td>
			           		<td><?php echo $fetch_Data->town; ?></td>
			           		<td><?php echo substr( $fetch_Data->description, 0,100); ?></td>
			           		<td><?php echo $fetch_Data->details_url; ?></td>
			           		<td><?php echo $fetch_Data->displayable_address; ?></td>
			           		<td><img src="<?php echo $fetch_Data->image_url; ?>" style="height: 80px; width: 80px;"></td>
			           		<td><img src="<?php echo $fetch_Data->thumbnail_url; ?>" style="height: 80px; width: 80px;"></td>
			           		<td><?php echo $fetch_Data->latitude; ?></td>
			           		<td><?php echo $fetch_Data->longitude; ?></td>
			           		<td><?php echo $fetch_Data->num_bedrooms; ?></td>
			           		<td><?php echo $fetch_Data->num_bathrooms; ?></td>
			           		<td><?php echo $fetch_Data->price; ?></td>
			           		<td><?php echo $fetch_Data->property_type; ?></td>
			           		<td><?php echo $fetch_Data->status; ?></td>
			           </tr>
			          <?php } ?> 
			          
			        </tbody>
			     
			    </table>

			<?php 
		}
	
?>
<script type="text/javascript">
	  $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} );
</script>
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
             <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
                <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>