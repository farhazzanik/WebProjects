
<?php

   require_once("db_connect/config.php");
   require_once("db_connect/conect.php");
	
	$db = new database();

	if(isset($_POST["submit"]) && $_POST["submit"] != ""){


			$County = $db->escape($_POST["County"]);
			$Country = $db->escape($_POST["Country"]);
			$Town = $db->escape($_POST["Town"]);
			$Postcode = $db->escape($_POST["Postcode"]);
			$Description = $db->escape($_POST["Description"]);
			$Address = $db->escape($_POST["Address"]);
			$bedrooms = $db->escape($_POST["bedrooms"]);
			$bathrooms = $db->escape($_POST["bathrooms"]);
			$Price = $db->escape($_POST["Price"]);
			$Property = $db->escape($_POST["Property"]);

			if($County != "" && $Country != ""){ //put any variable which need to not empty

				 $insertQuery ="INSERT INTO `adminarea` (`county`,`country`,`town`,`postcode`,`Description`,`Address`,
         `bedrooms`,`bathrooms`,`Price`,`Type`) VALUES('".$County."','".$Country."','".$Town."','".$Postcode."','".$Description."','".$Address."','".$bedrooms."','".$bathrooms."','".$Price."','".$Property."')";
         		$insert =  $db->insert_query($insertQuery);
         		if($insert){

					 if(isset($_FILES["file"])){
			  			$file = $_FILES["file"]["name"];
			  			$file_tmp = $_FILES["file"]["tmp_name"];
			  			
			  			$ext = $db->getClientExtension($file);
			  			$imgId = $db->lastid().".png";//i used default extension here due to i don't add extention in data ase
						
			  			$allowed = array("jpg","jpeg","png","gif");

			  			   if(in_array($ext,$allowed)){


					  		 $strfimg="image/".$imgId;
					  		 move_uploaded_file($_FILES["file"]["tmp_name"],$strfimg);
							@chmod($strfimg,0644);

						if($ext == "png"){
							
								list($imgw,$imgh) = getimagesize($strfimg);
								$src_x = ($imgw / 2) - (400/2);
								$src_y = ($imgh / 2) - (400/2);
								$im = imagecreatefrompng($strfimg);
								$tci = imagecreatetruecolor(400, 400);
								$im2=imagecopyresampled($tci, $im, 0, 0, $src_x, $src_y, 400, 400, 400, 400);
								imagepng($tci, $strfimg);
							
							}elseif($ext == "gif") {
								
								list($imgw,$imgh) = getimagesize($strfimg);
								$src_x = ($imgw / 2) - (400/2);
								$src_y = ($imgh / 2) - (400/2);
								$im = imagecreatefromgif($strfimg);
								$tci = imagecreatetruecolor(400, 400);
								$im2=imagecopyresampled($tci, $im, 0, 0, $src_x, $src_y, 400, 400, 400, 400);
								imagegif($tci, $strfimg);
							}else {
								list($imgw,$imgh) = getimagesize($strfimg);
								$src_x = ($imgw / 2) - (400/2);
								$src_y = ($imgh / 2) - (400/2);
								$im = imagecreatefromjpeg($strfimg);
								$tci = imagecreatetruecolor(400, 400);
								$im2=imagecopyresampled($tci, $im, 0, 0, $src_x, $src_y, 400, 400, 400, 400);
								imagejpeg($tci, $strfimg);
							}

					
					  			  
			           
			       			 }


			  		}
			  		echo "Data Insert Successfully";
         		}else{
					echo "There Is Some Problem";
         		}

			  		

			}else{

				echo  "Please Fill Out Valuable Field";
			}
	}

	
	if(isset($_POST["deleID"]) && $_POST["deleID"] != ""){

		$sql = "DELETE FROM `adminarea` WHERE `id`='".$_POST["deleID"]."'";
		$resutlsql =  $db->insert_query($sql);
		$src = 'image/'.$_POST["deleID"].'.png';
		if(file_exists($src)){
			unlink($src);
		}
		
		echo "Data Delete Successfully";

	}

	
	if(isset($_POST["editone"]) && $_POST["editone"] != ""){



			$County = $db->escape($_POST["County"]);
			$Country = $db->escape($_POST["Country"]);
			$Town = $db->escape($_POST["Town"]);
			$Postcode = $db->escape($_POST["Postcode"]);
			$Description = $db->escape($_POST["Description"]);
			$Address = $db->escape($_POST["Address"]);
			$bedrooms = $db->escape($_POST["bedrooms"]);
			$bathrooms = $db->escape($_POST["bathrooms"]);
			$Price = $db->escape($_POST["Price"]);
			$Property = $db->escape($_POST["Property"]);

			if($County != "" && $Country != ""){ //put any variable which need to not empty

				   $update_query ="UPDATE `adminarea` SET `county`='".$County."',`country`='".$Country."',`town`='".$Town."',`postcode`='".$Postcode."',`Description`='".$Description."',`Address`='".$Address."',`bedrooms`='".$bedrooms."',`bathrooms`='".$bathrooms."' ,`Price`='".$Price."' ,`Type`='".$Property."' WHERE `id`='".$_POST["getID"]."'";
         		$insert =  $db->update_query($update_query);
         		

					 if(isset($_FILES["file"])){
			  			$file = $_FILES["file"]["name"];
			  			$file_tmp = $_FILES["file"]["tmp_name"];
			  			
			  			$ext = $db->getClientExtension($file);
			  			$imgId = $_POST["getID"].".png";//i used default extension here due to i don't add extention in data ase
						
			  			$allowed = array("jpg","jpeg","png","gif");
			  			   if(in_array($ext,$allowed)){
					  				

					  		 $strfimg="image/".$imgId;
					  		 move_uploaded_file($_FILES["file"]["tmp_name"],$strfimg);
							@chmod($strfimg,0644);

						if($ext == "png"){
							
								list($imgw,$imgh) = getimagesize($strfimg);
								$src_x = ($imgw / 2) - (400/2);
								$src_y = ($imgh / 2) - (400/2);
								$im = imagecreatefrompng($strfimg);
								$tci = imagecreatetruecolor(400, 400);
								$im2=imagecopyresampled($tci, $im, 0, 0, $src_x, $src_y, 400, 400, 400, 400);
								imagepng($tci, $strfimg);
							
							}elseif($ext == "gif") {
								
								list($imgw,$imgh) = getimagesize($strfimg);
								$src_x = ($imgw / 2) - (400/2);
								$src_y = ($imgh / 2) - (400/2);
								$im = imagecreatefromgif($strfimg);
								$tci = imagecreatetruecolor(400, 400);
								$im2=imagecopyresampled($tci, $im, 0, 0, $src_x, $src_y, 400, 400, 400, 400);
								imagegif($tci, $strfimg);
							}else {
								list($imgw,$imgh) = getimagesize($strfimg);
								$src_x = ($imgw / 2) - (400/2);
								$src_y = ($imgh / 2) - (400/2);
								$im = imagecreatefromjpeg($strfimg);
								$tci = imagecreatetruecolor(400, 400);
								$im2=imagecopyresampled($tci, $im, 0, 0, $src_x, $src_y, 400, 400, 400, 400);
								imagejpeg($tci, $strfimg);
							}

			           
			       			 }


			  		}
			  		
         		

			  		

			}else{

				echo  "Please Fill Out Valuable Field";
			}
	}


	if(isset($_POST["LoadPropertise"])){

	 $showSql="SELECT * FROM `api_table` ORDER BY id ASC";
 	$result_data = $db->select_query($showSql);	

		if(isset($result_data) && $result_data !="")	{
			$i = 0;
			while($fetch_Data = $result_data->fetch_object()){
				$i++;
				if($i == 1){
		?> 
			<div class="col-lg-12 col-xs-12" >
				<br/><p style="font-size: 24px; font-weight: bold;">Total Properties : <?php echo $result_data->num_rows;?>
				</p> 
			</div>
		<?php } ?>
			<div class="col-lg-12 col-xs-12 table-bordered" style="padding: 0px;margin-top: 10px;">
				<div class="col-lg-3 col-xs-12" style="padding: 0px; ">
					<img src="<?php echo $fetch_Data->image_url; ?>" style="height: 300px; width: 300px; margin:5px;" class="img-thumbnail">
				</div>

				<div class="col-lg-9 col-xs-12" style="padding: 0px; ">
					<p style=" padding-left: 30px; padding-top: 30px; font-weight: bold; font-size: 24px;">$ <?php echo $fetch_Data->price; ?></p>
					<span class="text-warning" style="padding-left: 30px;"><?php echo $fetch_Data->property_type; ?> &nbsp;&nbsp;<?php echo $fetch_Data->status; ?></span>
					<br/>
					<br/>
					<span class="text-warning" style="padding-left: 30px; color: grey"><?php echo $fetch_Data->displayable_address; ?> </span>

					<br/><br/>
					<p style="padding-left: 30px; padding-top: 5px; text-align: justify; font-size: 16px;">
						<?php
							echo substr($fetch_Data->description, 0,300);
						?>
					</p>
				</div>
			</div>
		<?php
 } } }


 if(isset($_POST["textAuto"])){

 		$results = array('error' => false, 'data' => '');

 

		$querystr =  $db->escape($_POST['textData']);

 

		if(empty($querystr)){

			$results['error'] = true;

		}else{

			$lengthoftext = strlen($querystr);
			

			$sql = "SELECT * FROM api_table WHERE town LIKE '%$querystr%' GROUP BY `town`";

			$sqlquery = $db->select_query($sql);

 

			if(isset($sqlquery) && !empty($sqlquery)){

				while($ldata = $sqlquery->fetch_array()){

					$results['data'] .= "

						<li class='list-gpfrm-list' data-fullname='".$ldata['town'].",".$ldata['county']."'>".$ldata['town'].",".$ldata['county']."</li>";

				}

			}

			else{

				$sql = "SELECT * FROM api_table WHERE displayable_address LIKE '%$querystr%'";

				$sqlquery = $db->select_query($sql);

				if(isset($sqlquery) && !empty($sqlquery)){

				while($ldata = $sqlquery->fetch_array()){

					$results['data'] .= "

						<li class='list-gpfrm-list' data-fullname='".$ldata['displayable_address']."'>".$ldata['displayable_address']."</li>";

				}

			}else{



				$results['data'] = "<li class='list-gpfrm-list'>No found data matches Records</li>";
			}

			}


			
			

		}

 

		echo json_encode($results);
 }


 if(isset($_POST["checkShowData"])){
 	$fulname =  $db->escape($_POST["fulname"]);
 	$explode = explode(',', $fulname);
 	 $sql = "SELECT * FROM api_table WHERE town LIKE '%$explode[0]%'";
    $sqlquery = $db->select_query($sql);
 
 

	if(isset($sqlquery) && !empty($sqlquery)){
			$i = 0;
		while($fetch_Data = $sqlquery->fetch_object()){
				$i++;
		?> 
		<input type="hidden" name="latitude[0]" class="latitude" id="latitude" value="<?php echo $fetch_Data->latitude."__".$fetch_Data->longitude."__".$fetch_Data->image_url."__".$fetch_Data->displayable_address.'__'.$fetch_Data->price?>">
		<?php if($i == 1){ ?>

			<div class="col-lg-12 col-xs-12" style="margin-top: 5px;" >
				<div class="col-sm-12 col-lg-4" style="padding: 0px;">
					<br/><p style="font-size: 24px; font-weight: bold;">Total Properties : <?php echo $sqlquery->num_rows;?>
				</p> 
				</div>

				

				<div class="col-lg-8 col-sm-12" style="padding: 0px;">


   <div id="mapid">  </div>

  

						 <br/>

				</div>
			</div>
		<?php } ?>
			<div class="col-lg-12 col-xs-12 table-bordered" style="padding: 0px;margin-top: 10px;">
				<div class="col-lg-3 col-xs-12" style="padding: 0px; ">
					<img src="<?php echo $fetch_Data->image_url; ?>" style="height: 300px; width: 300px; margin:5px;" class="img-thumbnail">
				</div>

				<div class="col-lg-9 col-xs-12" style="padding: 0px; ">
					<p style=" padding-left: 30px; padding-top: 30px; font-weight: bold; font-size: 24px;">$ <?php echo $fetch_Data->price; ?></p>
					<span class="text-warning" style="padding-left: 30px;"><?php echo $fetch_Data->property_type; ?> &nbsp;&nbsp;<?php echo $fetch_Data->status; ?></span>
					<br/>
					<br/>
					<span class="text-warning" style="padding-left: 30px; color: grey"><?php echo $fetch_Data->displayable_address; ?> </span>

					<br/><br/>
					<p style="padding-left: 30px; padding-top: 5px; text-align: justify; font-size: 16px;">
						<?php
							echo substr($fetch_Data->description, 0,300);
						?>
					</p>
				</div>
			</div>
		<?php
 } } else{

 	$fulname =  $db->escape($_POST["fulname"]);
 
 	$sql = "SELECT * FROM api_table WHERE displayable_address LIKE '%$fulname%'";
    $sqlquery = $db->select_query($sql);
 
 

	if(isset($sqlquery) && !empty($sqlquery)){
			$i = 0;
		while($fetch_Data = $sqlquery->fetch_object()){
				$i++;
		?> 
		<input type="hidden" name="latitude[0]" class="latitude" id="latitude" value="<?php echo $fetch_Data->latitude."__".$fetch_Data->longitude."__".$fetch_Data->image_url."__".$fetch_Data->displayable_address.'__'.$fetch_Data->price?>">
		<?php if($i == 1){ ?>

			<div class="col-lg-12 col-xs-12" style="margin-top: 5px;" >
				<div class="col-sm-12 col-lg-4" style="padding: 0px;">
					<br/><p style="font-size: 24px; font-weight: bold;">Total Properties : <?php echo $sqlquery->num_rows;?>
				</p> 
				</div>

				

				<div class="col-lg-8 col-sm-12" style="padding: 0px;">


   <div id="mapid">  </div>

  

						 <br/>

				</div>
			</div>
		<?php } ?>
			<div class="col-lg-12 col-xs-12 table-bordered" style="padding: 0px;margin-top: 10px;">
				<div class="col-lg-3 col-xs-12" style="padding: 0px; ">
					<img src="<?php echo $fetch_Data->image_url; ?>" style="height: 300px; width: 300px; margin:5px;" class="img-thumbnail">
				</div>

				<div class="col-lg-9 col-xs-12" style="padding: 0px; ">
					<p style=" padding-left: 30px; padding-top: 30px; font-weight: bold; font-size: 24px;">$ <?php echo $fetch_Data->price; ?></p>
					<span class="text-warning" style="padding-left: 30px;"><?php echo $fetch_Data->property_type; ?> &nbsp;&nbsp;<?php echo $fetch_Data->status; ?></span>
					<br/>
					<br/>
					<span class="text-warning" style="padding-left: 30px; color: grey"><?php echo $fetch_Data->displayable_address; ?> </span>

					<br/><br/>
					<p style="padding-left: 30px; padding-top: 5px; text-align: justify; font-size: 16px;">
						<?php
							echo substr($fetch_Data->description, 0,300);
						?>
					</p>
				</div>
			</div>
		<?php
 } } 
 }
 ?>

    <script type="text/javascript">
    	
    	var latitude = [];
		$('.latitude').each(function(){latitude.push($(this).val());});
var mymap = L.map('mapid').setView([latitude[0].split('__')[0], latitude[0].split('__')[1]], 13);

		for (var i = 0; i < latitude.length; i++) {
		
			 var marker = L.marker([latitude[i].split('__')[0], latitude[i].split('__')[1]]).addTo(mymap);
			 
			marker.bindPopup("<div style='width:150px; height:80px;'><div style='width:70px; width:70px; float:left;clear:right;'><img src="+latitude[i].split('__')[2]+" height='100%;' width='100%'></img></div><div style='width:80px; height:80px; float:right; padding-left:5px;'><span style=''>"+latitude[i].split('__')[3]+"<br/>"+latitude[i].split('__')[4]+"</span></div></div>").openPopup();
	}

      
       

        
        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFoZnV6OSIsImEiOiJjanRwb3RoOWgwNmJ4NGVzNzFwdXZ3anNsIn0.Sd334xoVhnFUf29HLio80Q', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1IjoibWFoZnV6OSIsImEiOiJjanRwb3RoOWgwNmJ4NGVzNzFwdXZ3anNsIn0.Sd334xoVhnFUf29HLio80Q'
        }).addTo(mymap);
      </script>


<?php
 }
?>