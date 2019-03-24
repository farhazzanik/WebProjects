<?php

   date_default_timezone_set('Asia/Dhaka');
   
$prefix=date('ymd');
		
		
		$position1=isset($_POST["position1"])?$_POST["position1"]:"0";
		$position2=isset($_POST["position2"])?$_POST["position2"]:"0";
		$position3=isset($_POST["position3"])?$_POST["position3"]:"0";
		$position4=isset($_POST["position4"])?$_POST["position4"]:"0";
		$position5=isset($_POST["position5"])?$_POST["position5"]:"0";
		$position6=isset($_POST["position6"])?$_POST["position6"]:"0";
		$position7=isset($_POST["position7"])?$_POST["position7"]:"0";
		$position8=isset($_POST["position8"])?$_POST["position8"]:"0";
		$position9=isset($_POST["position9"])?$_POST["position9"]:"0";
		//echo $position1.$position2.$position3.$position4.$position5.$position6.$position7.$position8.$position9;
		
		
	if (isset($_POST["save"])) {
	
		$id = $db->autogenerat("news_info","id","$prefix",15);
		
		$date = DB::s($_POST["date"]);
		$title = DB::s($_POST["title"]);
		$fbText = DB::s($_POST["fbText"]);
		$description = DB::s($_POST["description"]);
		$reporterName = DB::s($_POST["reporterName"]);
		
		$file = $_FILES["file"]["name"];
		$files = $_FILES["file"]["tmp_name"];
		$ext = DB::getClientExtension($file);
		$fileName = $id.".".$ext;
		$countM = count(@$_POST["mainM"]);
		$subM = count(@$_POST["subM"]);
		$countdivision = count(@$_POST["division"]);
		$countdistrict = count(@$_POST["district"]);
		if ($countM>0) {
			if (!empty($description) && !empty($title) && !empty($fbText)) {
				$db->tableName("news_info");
				$data = array(
					'id' => $id, 
					'date_english' => $date, 
					'title' => $title, 
					'fb_share_text' => $fbText, 
					'description' => $description, 
					'reporters_name' => $reporterName,
					'ext' => $ext
				);
				if($db->insert($data)){
					$sms = "News published";
					DB::storeAs($files, "newsImage", $fileName);
					//main link priority//
							/*for ($ml=0; $ml < $countdivision; $ml++) { 
								$query = "INSERT INTO news_division VALUES('$id','".$_POST['division'][$ml]."')";
								$db->insertQ($query);
							}*/
							//end of link menu priority

							//sublink priority
							/*for ($sl=0; $sl < $countdistrict; $sl++) { 
								$explode = explode(',', $_POST["district"][$sl]);
								$query = "INSERT INTO news_district VALUES('$id','".$explode[0]."','".$explode[1]."')";
								$db->insertQ($query);
							}*/
							//end of sublink priority
							// main menu priority
							for ($mm=0; $mm < $countM; $mm++) { 
								$query = "INSERT INTO news_main_menu VALUES('$id','".$_POST['mainM'][$mm]."')";
								$db->insertQ($query);
							}
							//end of main menu priority

							//sub menu priority
							for ($sm=0; $sm < $subM; $sm++) { 
								$explode = explode(',', $_POST["subM"][$sm]);
								$query = "INSERT INTO news_sub_menu VALUES('$id','".$explode[0]."','".$explode[1]."')";
								$db->insertQ($query);
							}
							//end of sub menu priority
							
							
						$position = "INSERT INTO position VALUES('$id','$position1','$position2','$position3','$position4','$position5','$position6','$position7','$position8','$position9')";
						$db->insertQ($position);
							
				}
			}else{
				$error = "Please fill out all field"; 
			}
		}else{
			$error = "Please select at least one menu"; 
		}
	}
?>
<form method="post"  enctype="multipart/form-data" >
<div class="col-md-12">
<?php
	if(isset($sms)){
?>
	<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <i class="icon fa fa-check"></i> <?php echo $sms; ?>
    </div>
<?php
	}else if(isset($error)){
?>
	<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       	<i class="icon fa fa-ban"></i> <?php echo $error; ?>
   </div>
<?php
	}
?>
	<table class="table table-bordered table-hover table-striped">
		<tr>
			<td colspan="2" class="title">Publish news</td>
		</tr>
		<tr>
			<td>Date</td> <!--id="datepicker"-->
			<td>
				<input type="text" name="date" class="form-control" placeholder="mm/dd/yyyy"  value="<?php echo date('l, d M Y, h:i a') ?>" >
			</td>
		</tr>
		<tr>
			<td>Title</td>
			<td>
				<input type="text" name="title" class="form-control" placeholder="Title" id="title" >
			</td>
		</tr>
		<tr>
			<td>FB share text</td>
			<td>
				<textarea class="form-control" placeholder="FB share text" id="fbText" name="fbText" style="resize: none;" rows="3" ></textarea>
			</td>
		</tr>
		<tr>
			<td>Description</td>
			<td>
				<textarea class="form-control" placeholder="Description" id="redactor" style="resize: none;" rows="3" name="description" ></textarea>
			</td>
		</tr>
		<tr>
			<td>Reporter's Name</td>
			<td>
				<input type="text" name="reporterName" class="form-control" placeholder="Reporter's Name" id="reporterName" >
			</td>
		</tr>
		<tr>
			<td>Select image</td>
			<td>
				<div class="form-inline"><input type="file" name="file" id="file" onchange="preview_image(this)" style="display: none;" >
					<label for="file" class="btn btn-success" style="width: 250px;">Choose image</label><img id="preview" style="margin-left: 20px; cursor: pointer;" data-toggle="modal" data-target="#imagem" onclick="selectimage()">
				</div>
				&nbsp; &nbsp; width: 800px x height: 440px
			</td>
		</tr>
		<tr>
			<!--<td colspan="" align="center">
				<span style="font-size: 17px;"><b>Select area</b></span><br>
				<input type="checkbox" name="checkboxfoall" id="checkAlllink" onclick="checkAllLink()"><label for="checkAlllink" style="font-size: 16px;">&nbsp; Select All</label>
			</td>-->
			<td colspan="2" align="center">
				<span style="font-size: 17px;"><b>Select menu</b></span><br>
				<input type="checkbox" name="checkboxforallM" id="checkAllmenu" onclick="checkAllMenu()" ><label for="checkAllmenu" style="font-size: 16px;">&nbsp; Select All</label>
			</td>
		</tr>
		<tr>
		<!--main link-->
			<!--<td colspan="" width="45%">
				<?php
					$resultMainLink = $db->select("SELECT * FROM divisions_info");
					foreach ($resultMainLink as $division) {
				?>
				<p style="background: #DEFADA;"><input type="checkbox" name="division[]" class="checkelementMl" onclick="checkSubL('<?php echo $division["id"] ?>')" id="mainL-<?php echo $division["id"] ?>" value="<?php echo $division["id"] ?>"  /><strong style="font-size: 16px;"> <?php echo $division["divisions_name"] ?></strong></p>
				<?php 
					$resultMSubLink = $db->select("SELECT * FROM district_info WHERE division_id='".$division["id"]."'");
				?>
					<p><?php foreach ($resultMSubLink as $district) {
						?><span style="margin-left: 15px;"><input type="checkbox" disabled="disabled" name="district[]" class="checkelementSl subL-<?php echo $division["id"]; ?>" id="subL-<?php echo $division["id"]; ?>" value="<?php echo $division["id"] ?>,<?php echo $district["id"] ?>" /><strong style="font-size: 15px;"> <?php echo $district["district"] ?></strong></span>  <?php } ?></p>
				<?php } ?>
			</td>-->

<!--end of main link-->


<!--main menu-->
			<td colspan="2">
				<?php
					if ($adminid!=306) {
						$resultMainMenu = $db->select("SELECT menu_priority.*,menu_info.* FROM menu_priority INNER JOIN menu_info ON menu_priority.main_menu_id=menu_info.id WHERE menu_priority.admin_id='$adminid'");
					}else{
						$resultMainMenu = $db->select("SELECT * FROM menu_info");
					}
					foreach ($resultMainMenu as $mainMenu) {
						if ($adminid!=306) {
							$resultSubMenu = $db->select("SELECT submenu_priority.*,submenu_info.* FROM submenu_priority INNER JOIN submenu_info ON submenu_priority.submenu_id=submenu_info.id WHERE submenu_priority.admin_id='$adminid' AND submenu_priority.main_menu_id='".$mainMenu["id"]."'");
						}else{
							$resultSubMenu = $db->select("SELECT * FROM submenu_info WHERE main_menu_id='".$mainMenu["id"]."'");
						}
				?>
				<p style="background: #DEFADA;"><input type="checkbox" name="mainM[]" onclick="checkAllSubMenu('<?php echo $mainMenu["id"]; ?>')" id="mainM-<?php echo $mainMenu["id"]; ?>" value="<?php echo $mainMenu["id"]; ?>" class="checkElementMm" /><strong style="font-size: 16px;"> <?php echo $mainMenu["menu_name"]; ?></strong></p>
					<p><?php foreach ($resultSubMenu as $subMenu) {
						?><span style="margin-left: 15px;"><input type="checkbox" name="subM[]" id="subM-<?php echo $mainMenu["id"]; ?>" value="<?php echo $mainMenu["id"]; ?>,<?php echo $subMenu["id"]; ?>" disabled="disabled" class="checkElementSm subM-<?php echo $mainMenu["id"]; ?>" /><strong style="font-size: 15px;"> <?php echo $subMenu["sub_menu_name"]; ?></strong></span>  <?php } ?></p>
				<?php } ?>
			</td>

		<!--end of main menu-->
		</tr>
		
		<tr>
			<td>Position</td>
			<td> 
			
				 <label class="checkbox-inline">
				  <input type="checkbox" name="position1" value="1"> হোম
				</label>
					 <label class="checkbox-inline">
				  <input type="checkbox" name="position2" value="1"> হোম লেপ্ট
				</label>
				<label class="checkbox-inline">
				  <input type="checkbox" name="position3" value="1"> শীর্ষ খবর
				</label>
				<label class="checkbox-inline">
				  <input type="checkbox" name="position4" value="1"> সর্বশেষ  
				</label>
					<label class="checkbox-inline">
				  <input type="checkbox" name="position5" value="1"> সর্বাধিক জনপ্রিয়  
				</label>
					<label class="checkbox-inline">
				  <input type="checkbox" name="position6" value="1"> আলোচিত খবর
				</label>
					<label class="checkbox-inline">
				  <input type="checkbox" name="position7" value="1"> অন্যরকম
				</label>
					<label class="checkbox-inline">
				  <input type="checkbox" name="position8" value="1"> ফটো গ্যালারি
				</label>
				<label class="checkbox-inline">
				  <input type="checkbox" name="position9" value="1"> চাকরির খবর
				</label>
				
				
				
				
		</tr>
		<tr>
			<td colspan="2" align="center">
				<button class="btn btn-info" type="submit" name="save" id="save" style="width: 140px;">
					<i class="fa fa-plus"></i> Save
				</button>
			</td>
		</tr>
	</table>
</div>
</form>

<!--Image modal-->
  <div class="modal fade" id="imagem" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Image preview =></b></h4>
        </div>
        <div class="modal-body"  align="center">
         	<img src="" id="prpr" class="img-responsive">
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-info" data-dismiss="modal">
        		<span class="fa fa-times"> </span> Close
        	</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--Image modal-->
	<script>
		function preview_image(e) {
			var file = e.files[0];
			var imagefile = file.type;		
			var type = ["image/jpeg","image/png","image/jpg","image/gif"];
			if(imagefile==type[0] || imagefile==type[1] || imagefile==type[2] ||imagefile==type[3]){
				var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(e.files[0]);
			}else{
				alert("Please select a vild image");
			}
            function imageIsLoaded(e) {
                $("#file").css('border-color','GREEN');
                $("#preview").attr('src',e.target.result);
				$("#preview").css('height','70px');
				$("#preview").addClass("img-responsive img-thumbnail");
            }
		}
	</script>  
	<script type="text/javascript">
		function selectimage() {
			var attra = $("#preview").attr('src');
			$("#prpr").attr('src', attra);
		}
	</script>  
<script type="text/javascript">
	function checkAllLink() {
		if ($("#checkAlllink").is(':checked')) {
			$(".checkelementSl").prop('disabled', false);
			$(".checkelementSl").prop('checked', true);
			$(".checkelementMl").prop('checked', true);
		}else{
			$(".checkelementSl").prop('disabled', true);
			$(".checkelementSl").prop('checked', false);
			$(".checkelementMl").prop('checked', false);
		}
	}
</script>

<script type="text/javascript">
	function checkAllMenu() {
		if ($("#checkAllmenu").is(':checked')) {
			$(".checkElementSm").prop('disabled', false);
			$(".checkElementSm").prop('checked', true);
			$(".checkElementMm").prop('checked', true);
		}else{
			$(".checkElementSm").prop('disabled', true);
			$(".checkElementSm").prop('checked', false);
			$(".checkElementMm").prop('checked', false);
		}
	}
</script>
<script type="text/javascript">
	function checkSubL(id) {
		if ($("#mainL-"+id).is(':checked')) {
			$(".subL-"+id).prop('disabled', false);
		}else{
			$(".subL-"+id).prop('disabled', true);
			$(".subL-"+id).prop('checked', false);
		}
	}
	function checkAllSubMenu(id) {
		if ($("#mainM-"+id).is(':checked')) {
			$(".subM-"+id).prop('disabled', false);
		}else{
			$(".subM-"+id).prop('disabled', true);
			$(".subM-"+id).prop('checked', false);
		}
	}
</script>