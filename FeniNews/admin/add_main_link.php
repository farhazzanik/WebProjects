<?php
	$db->tableName("main_link_info");
	
	
	if(isset($_POST["add"])){
		$id = $db->autogenerat("main_link_info","id","360",5);
		
		$link_name = DB::s($_POST["link_name"]);
		$page_name = DB::s($_POST["page_name"]);
		$route_name = DB::s($_POST["route_name"]);
		$data = array(
			'id' => $id,
			'link_name' => $link_name,
			'page_name' => $page_name,
			'route_name' => $route_name
		);
		if (!empty($route_name)) {
			if ($db->insert($data)) {
				$sms = "<span style='color:WHITE;'>Main link added</span>";
			} else {
				$error = "<span style='color:WHITE;'>Main link added failed</span>";
			}
		} else {
			$error = "<span style='color:WHITE;'>Fill up all field</span>";
		}
		
		
	}

	if(isset($_POST["view"])){
		$display = "display:none";
		$result = $db->selectAll();
		$table = "<table class='table table-bordered table-hover whit'><tr><td colspan='4'><input type='submit' class='btn btn-sm btn-link' value='Refresh' name='view' /><a href='index.php?a=mainLink' class='btn btn-sm btn-link'>Back</a></td></tr><tr class='title'><td colspan='4'><b>Main Link</b></td></tr><tr><td><b>Link Name</b></td><td><b>Page Name</b></td><td><b>Route Name</b></td><td><b>Action</b></td></tr>";
		foreach ($result as $value) {
			$d = $value["id"];
			$table.= "<tr><td>".$value["link_name"]."</td><td>".$value["page_name"]."</td><td>".$value["route_name"]."</td><td><a href='index.php?a=mainLink&id=".$d."' class='btn btn-info'>Edit</a></td></tr>";
		}
		$table.= "</table>";
	}
	if (isset($_GET["id"])) {
		$val = $db->selectById($_GET["id"]);
	}
	if (isset($_POST["save"])) {
		$db->with(DB::s($_GET["id"]));
		$link_name = DB::s($_POST["link_name"]);
		$page_name = DB::s($_POST["page_name"]);
		$route_name = DB::s($_POST["route_name"]);
		$dt = array(
			'link_name' => $link_name,
			'page_name' => $page_name,
			'route_name' => $route_name
		);
		if ($db->update($dt)) {
			$sms = "<span style='color:WHITE;'>Main link edited</span>";
			$val = $db->selectById($_GET["id"]);
		} else {
			$error = "<span style='color:WHITE;'>Main link edited failed</span>";
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
			<td colspan="2" class="title">Main Link</td>
		</tr>
		<tr>
			<td>Link name</td>
			<td>
				<input type="text" class="form-control input-md"  name="link_name" placeholder="Link name" <?php if (isset($val)){ ?> value="<?php echo $val[0]["link_name"]; ?>"<?php } ?> />
			</td>
		</tr>
		<tr>
			<td>Page name</td>
			<td>
				<input type="text" class="form-control input-md"  name="page_name" placeholder="Page name" <?php if (isset($val)){ ?> value="<?php echo $val[0]["page_name"]; ?>"<?php } ?> />
			</td>
		</tr>
		<tr>
			<td>Route name</td>
			<td>
				<input type="text" class="form-control input-md"  name="route_name" placeholder="Route name" <?php if (isset($val)){ ?> value="<?php echo $val[0]["route_name"]; ?>"<?php } ?> />
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