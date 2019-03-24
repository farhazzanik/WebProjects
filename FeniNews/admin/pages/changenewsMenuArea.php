<?php
	$db->tableName("news_info");
	$s = 0;
	$newsid = htmlentities(htmlspecialchars($_GET["newsid"]));
	$fetchNews = $db->selectById($newsid);
	if (isset($_POST["save"])) {
		$districtDeletequery = "DELETE FROM news_district WHERE news_id='".$newsid."'";
      	$db->deleteQ($districtDeletequery);

      	$divisionDeletequery = "DELETE FROM news_division WHERE news_id='".$newsid."'";
      	$db->deleteQ($divisionDeletequery);
      
      	$mainmenuDeletequery = "DELETE FROM news_main_menu WHERE news_id='".$newsid."'";
      	$db->deleteQ($mainmenuDeletequery);
      	$submenuDeletequery = "DELETE FROM news_sub_menu WHERE news_id='".$newsid."'";
      	$db->deleteQ($submenuDeletequery);
      	$countM = count(@$_POST["mainM"]);
		$subM = count(@$_POST["subM"]);
		$countdivision = count(@$_POST["division"]);
		$countdistrict = count(@$_POST["district"]);
		if ($countM>0) {
			for ($ml=0; $ml < $countdivision; $ml++) { 
				$query = "INSERT INTO news_division VALUES('$newsid','".$_POST['division'][$ml]."')";
				$db->insertQ($query);
			}
			//end of link menu priority

			//sublink priority
			for ($sl=0; $sl < $countdistrict; $sl++) { 
				$explode = explode(',', $_POST["district"][$sl]);
				$query = "INSERT INTO news_district VALUES('$newsid','".$explode[0]."','".$explode[1]."')";
				$db->insertQ($query);
			}
			//end of sublink priority
			// main menu priority
			for ($mm=0; $mm < $countM; $mm++) { 
				$query = "INSERT INTO news_main_menu VALUES('$newsid','".$_POST['mainM'][$mm]."')";
				$s = $db->insertQ($query);
			}
			//end of main menu priority

			//sub menu priority
			for ($sm=0; $sm < $subM; $sm++) { 
				$explode = explode(',', $_POST["subM"][$sm]);
				$query = "INSERT INTO news_sub_menu VALUES('$newsid','".$explode[0]."','".$explode[1]."')";
				$db->insertQ($query);
			}
			//end of sub menu priority

		}else{
			$error = "Please select at least one menu"; 
		}
	}
	if ($s) {
		$sms = "Menu and area updated";
	}
?>
<form method="post">
<div class="col-lg-12 col-md-12">
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
	<table class="table table-bordered table-striped table-hover">
		<tr>
			<td class="title" colspan="2">Edit: <?php echo $fetchNews[0]["title"]; ?></td>
		</tr>
		<tr>
			<td colspan="" align="center">
				<span style="font-size: 17px;"><b>Select area</b></span><br>
				<input type="checkbox" name="checkboxfoall" id="checkAlllink" onclick="checkAllLink()"><label for="checkAlllink" style="font-size: 16px;">&nbsp; Select All</label>
			</td>
			<td colspan="" align="center">
				<span style="font-size: 17px;"><b>Select menu</b></span><br>
				<input type="checkbox" name="checkboxforallM" id="checkAllmenu" onclick="checkAllMenu()" ><label for="checkAllmenu" style="font-size: 16px;">&nbsp; Select All</label>
			</td>
		</tr>
		<tr>
		<!--main link-->
			<td colspan="" width="45%">
				<?php
					$resultMainLink = $db->select("SELECT * FROM divisions_info");
					$c = 0;
					foreach ($resultMainLink as $division) {
				?>
				<p style="background: #DEFADA;"><input type="checkbox" name="division[]" class="checkelementMl" onclick="checkSubL('<?php echo $division["id"] ?>')" id="mainL-<?php echo $division["id"] ?>" value="<?php echo $division["id"] ?>"  /><strong style="font-size: 16px;"> <?php echo $division["divisions_name"] ?></strong></p>
				<?php 
					$resultMSubLink = $db->select("SELECT * FROM district_info WHERE division_id='".$division["id"]."'");
				?>
					<p><?php foreach ($resultMSubLink as $district) {
						?><span style="margin-left: 15px;"><input type="checkbox" disabled="disabled" name="district[]" class="checkelementSl subL-<?php echo $division["id"]; ?>" id="subL-<?php echo $division["id"]; ?>" value="<?php echo $division["id"] ?>,<?php echo $district["id"] ?>" /><strong style="font-size: 15px;"> <?php echo $district["district"] ?></strong></span>  <?php } ?></p>
				<?php $c++; } ?>
			</td>

<!--end of main link-->


<!--main menu-->
			<td colspan="">
				<?php
					$resultMainMenu = $db->select("SELECT * FROM menu_info");
					foreach ($resultMainMenu as $mainMenu) {
						$resultSubMenu = $db->select("SELECT * FROM submenu_info WHERE main_menu_id='".$mainMenu["id"]."'");
				?>
				<p style="background: #DEFADA;"><input type="checkbox" name="mainM[]" onclick="checkAllSubMenu('<?php echo $mainMenu["id"]; ?>')" id="mainM-<?php echo $mainMenu["id"]; ?>" value="<?php echo $mainMenu["id"]; ?>" class="checkElementMm" /><strong style="font-size: 16px;"> <?php echo $mainMenu["menu_name"]; ?></strong></p>
					<p><?php foreach ($resultSubMenu as $subMenu) {
						?><span style="margin-left: 15px;"><input type="checkbox" name="subM[]" id="subM-<?php echo $mainMenu["id"]; ?>" value="<?php echo $mainMenu["id"]; ?>,<?php echo $subMenu["id"]; ?>" disabled="disabled" class="checkElementSm subM-<?php echo $mainMenu["id"]; ?>" /><strong style="font-size: 15px;"> <?php echo $subMenu["sub_menu_name"]; ?></strong></span>  <?php } ?></p>
				<?php } ?>
			</td>

		<!--end of main menu-->
		</tr>
		<tr>
			<td colspan="2" align="center">
				<button type="submit" class="btn btn-info" name="save" style="width: 160px;">
					<i class="fa fa-edit"> Edit</i>
				</button>
			</td>
		</tr>
	</table>
</div>

</form>
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
			$(".subL-"+id).prop('checked', true);
		}else{
			$(".subL-"+id).prop('disabled', true);
			$(".subL-"+id).prop('checked', false);
		}
	}
	function checkAllSubMenu(id) {
		if ($("#mainM-"+id).is(':checked')) {
			$(".subM-"+id).prop('disabled', false);
			$(".subM-"+id).prop('checked', true);
		}else{
			$(".subM-"+id).prop('disabled', true);
			$(".subM-"+id).prop('checked', false);
		}
	}
</script>