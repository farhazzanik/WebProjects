<?php
	if (isset($_POST["creat"])) {
		$id = $db->autogenerat("admin_info","id","14",10);
		$name = DB::s($_POST["admin_name"]);
		$email = DB::s($_POST["email"]);
		$phone = DB::s($_POST["phone"]);
		$password = DB::s($_POST["password"]);
		$rpassword = DB::s($_POST["rpassword"]);
		if(isset($_FILES['file'])){
			$image = $_FILES['file']['name'];
			@$extension = strtolower(end(explode('.',$image)));
		}
		$crypted = $db->encryptt($password);
		$allowed = array("jpg","png","jpeg");
		$file = $_FILES['file']['tmp_name'];
		$filname = $id.".".$extension;
		$countMl = count(@$_POST['mainL']);
		$countSl = count(@$_POST["subL"]);
		$countMm = count(@$_POST["mainM"]);
		$countSm = count(@$_POST["subM"]);
		if (!empty($name) && !empty($email) && !empty($password)) {
			if ($password == $rpassword) {
				if (in_array($extension, $allowed)) {
					$data = array(
							'id' => $id,
							'name' => $name,
							'phone' => $phone,
							'email' => $email,
							'password' => $crypted,
							'ext' => $extension 
						);
						$db->tableName("admin_info");
						if ($db->insert($data)) {
							$sms = "<span style='color:GREEN; font-size:16px;'>Admin Created</span>";
							DB::storeAs($file,"images",$filname);

							//main link priority//
							for ($ml=0; $ml < $countMl; $ml++) { 
								$query = "INSERT INTO main_link_priority VALUES('$id','".$_POST['mainL'][$ml]."')";
								$db->insertQ($query);
							}
							//end of link menu priority

							//sublink priority
							for ($sl=0; $sl < $countSl; $sl++) { 
								$explode = explode(',', $_POST["subL"][$sl]);
								$query = "INSERT INTO sub_link_priority VALUES('$id','".$explode[0]."','".$explode[1]."')";
								$db->insertQ($query);
							}
							//end of sublink priority
							// main menu priority
							for ($mm=0; $mm < $countMm; $mm++) { 
								$query = "INSERT INTO menu_priority VALUES('$id','".$_POST['mainM'][$mm]."')";
								$db->insertQ($query);
							}
							//end of main menu priority

							//sub menu priority
							for ($sm=0; $sm < $countSm; $sm++) { 
								$explode = explode(',', $_POST["subM"][$sm]);
								$query = "INSERT INTO submenu_priority VALUES('$id','".$explode[0]."','".$explode[1]."')";
								$db->insertQ($query);
							}
							//end of sub menu priority

						}else{
							$sms = "<span style='color:RED; font-size:16px;'>Failed</span>";
						}
				}else{
					$sms = "<span style='color:RED; font-size:16px;'>This image is not allowed</span>";
				}
			}else{
				$sms = "<span style='color:RED; font-size:16px;'>Password not matched</span>";
			}
		}else{
			$sms = "<span style='color:RED; font-size:16px;'>Please fill out all field</span>";
		}
	}
?>
<form method="post" enctype="multipart/form-data">
<div class="col-md-12">
	<table class="table table-bordered table-hover whit">
		<tr>
			<td class="title" colspan="2">Create admin</td>
		</tr>
		<?php
			if (isset($sms)) {
			?>
				<tr>
					<td colspan="2" align="center"><?php echo $sms; ?></td>
				</tr>
			<?php
			}
		?>
		<tr>
			<td width="50%">Name</td>
			<td>
				<div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="name" placeholder="Name" name="admin_name">
                </div>
			</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>
				<div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-at"></i>
                  </div>
                  <input type="email" class="form-control pull-right" id="email" placeholder="Email" name="email">
                </div>
			</td>
		</tr>
		<tr>
			<td>Phone Number</td>
			<td>
				<div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="name" placeholder="Phone Number" name="phone">
                </div>
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>
				<div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-gear"></i>
                  </div>
                  <span id="status"></span>
                  <input type="password" class="form-control pull-right" id="password" placeholder="Password" name="password">
                </div>
			</td>
		</tr>
		<tr>
			<td>Re-type Password</td>
			<td>
				<div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-gear"></i>
                  </div><span id="status1"></span>
                  <input type="password" class="form-control pull-right" id="rpassword" name="rpassword" placeholder="Re-type Password">
                </div>
			</td>
		</tr>
		<tr>
			<td>Image</td>
			<td>
				<input type="file" name="file" id="file" style="display: none;">
				<label class="btn btn-default form-control" for="file">Choose Image</label>
			</td>
		</tr>
		<tr>
			<td colspan="" align="center">
				<span style="font-size: 17px;"><b>Link Priority</b></span><br>
				<input type="checkbox" name="checkboxfoall" id="checkAlllink" onclick="checkAllLink()"><label for="checkAlllink" style="font-size: 16px;">&nbsp; Select All</label>
			</td>
			<td colspan="" align="center">
				<span style="font-size: 17px;"><b>Menu Priority</b></span><br>
				<input type="checkbox" name="checkboxforallM" id="checkAllmenu" onclick="checkAllMenu()" ><label for="checkAllmenu" style="font-size: 16px;">&nbsp; Select All</label>
			</td>
		</tr>
		<tr>
		<!--main link-->
			<td colspan="">
				<?php
					if($adminid!=306){
						$resultMainLink = $db->select("SELECT main_link_priority.*,main_link_info.* FROM main_link_priority INNER JOIN main_link_info ON main_link_priority.main_link_id=main_link_info.id WHERE main_link_priority.admin_id='".$adminid."'");
					}else if($adminid==306){
						$resultMainLink = $db->select("SELECT * FROM  main_link_info");
					}
					foreach ($resultMainLink as $mainLink) {
				?>
				<p style="background: #DEFADA;"><input type="checkbox" name="mainL[]" class="checkelementMl" onclick="checkSubL('<?php echo $mainLink["id"] ?>')" id="mainL-<?php echo $mainLink["id"] ?>" value="<?php echo $mainLink["id"] ?>"  /><strong style="font-size: 16px;"> <?php echo $mainLink["link_name"] ?></strong></p>
				<?php 
					if($adminid!=306){
						$resultMSubLink = $db->select("SELECT sub_link_priority.*,sub_link_info.* FROM sub_link_priority INNER JOIN sub_link_info ON sub_link_priority.sub_link_id=sub_link_info.id WHERE sub_link_priority.main_link_id='".$mainLink["id"]."' AND sub_link_priority.admin_id='".$adminid."'");
					}else if($adminid==306){
						$resultMSubLink = $db->select("SELECT * FROM sub_link_info WHERE main_link='".$mainLink["id"]."'");
					}
				?>
					<p><?php foreach ($resultMSubLink as $subLink) {
						?><span style="margin-left: 15px;"><input type="checkbox" disabled="disabled" name="subL[]" class="checkelementSl subL-<?php echo $mainLink["id"]; ?>" id="subL-<?php echo $mainLink["id"]; ?>" value="<?php echo $mainLink["id"] ?>,<?php echo $subLink["id"] ?>" /><strong style="font-size: 15px;"> <?php echo $subLink["sublink_name"] ?></strong></span>  <?php } ?></p>
				<?php } ?>
			</td>

<!--end of main link-->


<!--main menu-->
			<td colspan="">
				<?php
					if($adminid!=306){
						$resultMainMenu = $db->select("SELECT menu_priority.*,menu_info.* FROM menu_priority INNER JOIN menu_info ON menu_priority.main_menu_id=menu_info.id WHERE menu_priority.admin_id='".$adminid."'");
					}else if($adminid==306){
						$resultMainMenu = $db->select("SELECT * FROM  menu_info");
					}
					foreach ($resultMainMenu as $mainMenu) {
						if($adminid!=306){
							$resultSubMenu = $db->select("SELECT submenu_priority.*,submenu_info.* FROM submenu_priority INNER JOIN submenu_info ON submenu_priority.submenu_id=submenu_info.id WHERE submenu_priority.main_menu_id='".$mainMenu["id"]."' AND submenu_priority.admin_id='".$adminid."'");
						}else if($adminid==306){
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
			<td colspan="2" align="center">
				<button class="btn btn-info" style="width: 120px;" type="submit" name="creat">
					<i class="fa fa-plus"></i> Create
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
	$("#password").keyup(function() {
		var password = $("#password").val();
		var rpassword = $("#rpassword").val();
		if (password.length<6) {
			$("#status").show("slow");
			$("#password").css('border-color', 'RED');
			$("#status").html("<span style='color:RED'>Must be 6 charecter</span>");
		}else{
			$("#password").css('border-color', 'GREEN');
			$("#status").hide("slow");
		}
		if (rpassword) {
			if (rpassword == password && password.length>5) {
				$("#password").css('border-color', 'GREEN');
				$("#rpassword").css('border-color', 'GREEN');
				$("#status").hide("slow");
			}
		}
	});
	$("#rpassword").keyup(function() {
		var password = $("#password").val();
		var rpassword = $("#rpassword").val();
		if (password.length>5) {
			if (password == rpassword) {
				$("#password").css('border-color', 'GREEN');
				$("#rpassword").css('border-color', 'GREEN');
				$("#status1").hide("slow");
			}else{
				$("#status1").html("<span style='color:RED'>Password not matched</span>");
				$("#password").css('border-color', 'RED');
				$("#rpassword").css('border-color', 'RED');
			}
		}else{
			$("#status").show("slow");
			$("#password").css('border-color', 'RED');
			$("#status").html("<span style='color:RED'>Must be 6 charecter</span>");
		}
	});
</script>