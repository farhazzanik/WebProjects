<style type="text/css">
	td{
		font-size: 16px;
	}
</style>
<?php
	include '../../DB_Connect_/DB.php';
  	$db = new DB;
  	$db->tableName("menu_info");
  	if (isset($_POST["mainMenu"])) {
  		$id = $db->autogenerat("menu_info","id","11",5);
  		$mainMenu = DB::s($_POST["mainMenu"]);
  		if(!empty($mainMenu)){
  			$data = array(
  				'id' => $id,
  				'menu_name' => $mainMenu
  				);
  			if($db->insert($data)){
  				echo "<span class='fa fa-check' style='color:WHITE; font-size:16'> Menu added</span>";
  			}else{
  				echo "<span class='fa fa-times' style='color:WHITE;'> Menu added failed</span>";
  			}
  		}else{
  			echo "<span class='fa fa-times' style='color:WHITE;'> Fill out all field</span>";
  		}
  	}
  	if (isset($_POST["a"])) {
  		?>
  			<table class="table table-bordered table-hover whit">
  				<tr>
  					<td class="title" align="center" colspan="2">Main Menu</td>
  				</tr>
  				<tr>
  					<td width="70%"><b>Menu Name</b></td>
  					<td><b>Action</b></td>
  				</tr>
  				<?php
  					$resultMainMenu = $db->selectAll();
  					foreach ($resultMainMenu as $menu) {
  				?>
  					<tr>
  						<td><?php echo $menu["menu_name"]; ?></td>
  						<td>
  							<div class="btn-group"><button class="btn btn-info btn-sm" type="button" onclick="selectMenuData('<?php echo $menu["id"]; ?>','<?php echo $menu["menu_name"] ?>')"  data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i> Edit</button>

  							<button class="btn btn-danger btn-sm" type="button" onclick="selectMenudelte('<?php echo $menu["id"]; ?>','<?php echo $menu["menu_name"] ?>')"  data-toggle="modal" data-target="#Modal"><i class="fa fa-times"></i> Delete</button></div>
  						</td>
  					</tr>
  				<?php
  					}
  				?>
  			</table>
  		<?php
  	}
  	if (isset($_POST["m"])) {
  		$m = DB::s($_POST["m"]);
  		$mid = DB::s($_POST["mid"]);
  		$db->with(DB::s($_POST["mid"]));
  		if(!empty($m)){
  			$dt = array(
  				'menu_name' => $m 
  			);
  			if ($db->update($dt)) {
  				echo "<span class='fa fa-check' style='color:WHITE; font-size:16'> Menu updated</span>";
  			}else{
  				echo "<span class='fa fa-times' style='color:WHITE;'> Menu updated failed</span>";
  			}
  		}else{
  			echo "<span class='fa fa-times' style='color:WHITE;'> Fill out all field</span>";
  		}
  	}
  	if(isset($_POST["didd"])){
  		$did = DB::s($_POST["didd"]);
  		$db->with($did);
  		if ($db->destroy()) {
  			echo "<span class='fa fa-check' style='color:WHITE; font-size:16'> Menu deleted</span>";
  		}else{
  			echo "<span class='fa fa-times' style='color:WHITE;'> Failed</span>";
  		}
  	}
?>