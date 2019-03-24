<?php
	$db->tableName("sub_link_info");
	if(isset($_POST["add"])){
		$id = $db->autogenerat("sub_link_info","id","370",5);
		$main_link = DB::s($_POST["main_link"]);
		$sublink_name = DB::s($_POST["sublink_name"]);
		$page_name = DB::s($_POST["page_name"]);
		$route_name = DB::s($_POST["route_name"]);
		$data = array(
			'id' => $id,
			'main_link' => $main_link,
			'sublink_name' => $sublink_name,
			'page_name' => $page_name,
			'route_name' => $route_name
		);
		if (!empty($route_name)) {
			if ($db->insert($data)) {
				$sms = "<span style='color:WHITE;'>Sub link added</span>";
			} else {
				$error = "<span style='color:WHITE;'>Sub link added failed</span>";
			}
		} else {
			$error = "<span style='color:WHITE;'>Fill up all field</span>";
		}
	}
	if(isset($_POST["view"])){
		$display = "display:none";
		$query = "SELECT sub_link_info.*,main_link_info.link_name FROM sub_link_info INNER JOIN main_link_info ON sub_link_info.main_link=main_link_info.id";
		$result = $db->select($query);
		$table = "<table class='table table-bordered table-hover whit'><tr><td colspan='5'><input type='submit' class='btn btn-sm btn-link' value='Refresh' name='view' /><a href='index.php?a=subLink' class='btn btn-sm btn-link'>Back</a></td></tr><tr class='title'><td colspan='5'><b>Main Link</b></td></tr><tr><td><b>Main Link Name</b></td><td><b>Sub Link Name</b></td><td><b>Page Name</b></td><td><b>Route Name</b></td><td><b>Action</b></td></tr>";
		foreach ($result as $value) {
			$d = $value["id"];
			$table.= "<tr><td>".$value["link_name"]."</td><td>".$value["sublink_name"]."</td><td>".$value["page_name"]."</td><td>".$value["route_name"]."</td><td><a href='index.php?a=subLink&id=".$d."' class='btn btn-info'>Edit</a></td></tr>";
		}
		$table.= "</table>";
	}
	if(isset($_GET["id"])){
		$query = "SELECT sub_link_info.*,main_link_info.link_name FROM sub_link_info INNER JOIN main_link_info ON sub_link_info.main_link=main_link_info.id WHERE sub_link_info.id='".DB::s($_GET["id"])."'";
		$val = $db->select($query);
	}
	if (isset($_POST["save"])) {
		$db->with(DB::s($_GET["id"]));
		$main_link = DB::s($_POST["main_link"]);
		$sublink_name = DB::s($_POST["sublink_name"]);
		$page_name = DB::s($_POST["page_name"]);
		$route_name = DB::s($_POST["route_name"]);
		$dt = array(
			'main_link' => $main_link,
			'sublink_name' => $sublink_name,
			'page_name' => $page_name,
			'route_name' => $route_name
		);
		if ($db->update($dt)) {
			$sms = "<span style='color:WHITE;'>Sub link edited</span>";
			$query = "SELECT sub_link_info.*,main_link_info.link_name FROM sub_link_info INNER JOIN main_link_info ON sub_link_info.main_link=main_link_info.id WHERE sub_link_info.id='".DB::s($_GET["id"])."'";
			$val = $db->select($query);
		} else {
			$error = "<span style='color:WHITE;'>Sub link edited failed</span>";
		}
	}
?>
<form method="post" action="">
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
	<table class="table table-bordered table-hover whit" style="<?php echo $display; ?>">
		<tr>
			<td colspan="2" class="title">Sub Link</td>
		</tr>
		<tr>
			<td>Main Link</td>
			<td>
				<select  name="main_link" class="form-control select2" style="width: 100%;">
					<?php
						if (isset($val)) {
					?>
						<option value="<?php echo $val[0]["main_link"] ?>"><?php echo $val[0]["link_name"] ?></option>
                  	<?php
                  		}
						$result = $db->selectSub("main_link_info");
						foreach ($result as $value) {
					?>
					<option value="<?php echo $value["id"] ?>"><?php echo $value["link_name"] ?></option>
					<?php
						}
					?>
                </select>
			</td>
		</tr>
		<tr>
			<td>Sublink name</td>
			<td>
				<input type="text" class="form-control input-md"  name="sublink_name" placeholder="Link name" <?php if(isset($val)){ ?> value="<?php echo $val[0]["sublink_name"]; ?>" <?php } ?> />
			</td>
		</tr>
		<tr>
			<td>Page name</td>
			<td>
				<input type="text" class="form-control input-md"  name="page_name" placeholder="Page name"  <?php if(isset($val)){ ?> value="<?php echo $val[0]["page_name"]; ?>" <?php } ?>  />
			</td>
		</tr>
		<tr>
			<td>Route name</td>
			<td>
				<input type="text" class="form-control input-md"  name="route_name" placeholder="Route name" <?php if(isset($val)){ ?> value="<?php echo $val[0]["route_name"]; ?>" <?php } ?> />
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<?php
					if (isset($_GET["id"])) {
						$name = "save";
						$va = "Edit";
					}else{
						$name = "add";
						$va = "Save";
					}
				?>
				<button type="submit" class="btn btn-info" name="<?php echo $name; ?>" >
					<span class="fa fa-plus"></span>  <?php echo $va; ?>
				</button>
				<button type="submit" class="btn btn-info" name="view" >
					<span class="fa  fa-history"></span>  View
				</button>
			</td>
		</tr>
	</table>
	<?php
		if (isset($table)) {
			echo $table;
		}
	?>
</div>
</form>
