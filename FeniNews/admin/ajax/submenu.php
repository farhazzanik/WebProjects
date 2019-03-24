<style type="text/css">
	td{
		font-size: 16px;
	}
</style>
<?php
	include '../../DB_Connect_/DB.php';
  	$db = new DB;
  	$db->tableName("submenu_info");
  	if (isset($_POST["mainMenuId"])) {
  		$id = $db->autogenerat("submenu_info","id","12",5);
  		$mainMenuId = DB::s($_POST["mainMenuId"]);
  		$submenuName = DB::s($_POST["submenuName"]);
  		if (!empty($submenuName)) {
  			$data = array(
  				'id' => $id, 
  				'main_menu_id' => $mainMenuId,
  				'sub_menu_name' => $submenuName
  				);
  			if($db->insert($data)){
  				echo "<span class='fa fa-check' style='color:WHITE; font-size:16'> Sub menu added</span>";
  			}else{
  				echo "<span class='fa fa-times' style='color:WHITE;'> Sub menu added failed</span>";
  			}
  		}else{
  			echo "<span class='fa fa-times' style='color:WHITE;'> Fill out all field</span>";
  		}
  	}
  	if (isset($_POST["a"])) {
  		?>
  			<table class="table table-bordered table-hover whit" style="margin-bottom: 0px;">
	  			<tr>
	  				<td class="title" colspan="3">Sub menu</td>
	  			</tr>
	  			<tr>
	  				<td><b>Main Menu Name</b></td>
	  				<td><b>Sub Menu Name</b></td>
	  				<td><b>Action</b></td>
	  			</tr>
  		<?php
	  		$queryG = "SELECT menu_info.* FROM menu_info INNER JOIN submenu_info ON menu_info.id=submenu_info.main_menu_id GROUP BY submenu_info.main_menu_id";
	  		$fetchG = $db->select($queryG);
	  		foreach ($fetchG as  $main) {
	  			$querySm = "SELECT submenu_info.*,menu_info.menu_name FROM submenu_info INNER JOIN menu_info ON submenu_info.main_menu_id=menu_info.id WHERE submenu_info.main_menu_id='".$main["id"]."'";
	  			$fetchSM = $db->select($querySm);
  		?>
  			<tr>
  				<td colspan="3" align="center" class="bg-info"><?php echo $main["menu_name"]; ?>
  				</td>
  			</tr>
  			<tr>
  				<td colspan="3">
  					<table class="table table-bordered table-hover" style="margin-bottom: 0px;">
  					<?php
  						foreach ($fetchSM as $sub) {
  					?>
  						<tr>
  							<td align="center"><?php echo $sub["menu_name"] ?></td>
  							<td align="center"><?php echo $sub["sub_menu_name"] ?></td>
  							<td align="center">
  								<div class="btn-group">
  									<button class="btn btn-info btn-sm" type="button" onclick="selectSubMenuData('<?php echo $sub["id"] ?>','<?php echo $sub["main_menu_id"] ?>','<?php echo $sub["menu_name"] ?>','<?php echo $sub["sub_menu_name"] ?>')"  data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"> </i> Edit</button>

  									<button class="btn btn-danger btn-sm" type="button" onclick="selectSMenudelte('<?php echo $sub["id"]; ?>','<?php echo $sub["sub_menu_name"] ?>')"  data-toggle="modal" data-target="#Modal"><i class="fa fa-times"> </i> Delete</button>
  								</div>
  							</td>
  						</tr>
  					<?php
  						}
  					?>
  					</table>
  				</td>
  			</tr>
  		<?php
  			}
  		?>
  			</table>
  		<?php
  	}
  	if (isset($_POST["sid"])) {
  		$sid = DB::s($_POST["sid"]);
  		$mid = DB::s($_POST["mid"]);
  		$snn = DB::s($_POST["snn"]);
  		$db->with(DB::s($_POST["sid"]));
  		if (!empty($snn)) {
  			$dt = array(
  				'main_menu_id' => $mid,
  				'sub_menu_name' => $snn
  				);
  			if ($db->update($dt)) {
  				echo "<span class='fa fa-check' style='color:WHITE; font-size:16'> Sub-menu updated</span>";
  			}else{
  				echo "<span class='fa fa-times' style='color:WHITE;'> Sub Menu updated failed</span>";
  			}
  		}else{
  			echo "<span class='fa fa-times' style='color:WHITE;'> Fill out all field</span>";
  		}
  	}
  	if (isset($_POST["deleteId"])) {
  		$deleteId = DB::s($_POST["deleteId"]);
  		$db->with($deleteId);
  		if ($db->destroy()) {
  			echo "<span class='fa fa-check' style='color:WHITE; font-size:16'> Sub menu deleted</span>";
  		}else{
  			echo "<span class='fa fa-times' style='color:WHITE;'> Failed</span>";
  		}
  	}
?>