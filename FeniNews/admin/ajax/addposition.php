<?php
	include '../../DB_Connect_/DB.php';
  	$db = new DB;
  	$db->tableName("advertisementposition");
  	if (isset($_POST["sizee"])) {
  		$id = $db->autogenerat("advertisementposition","id","6",9);
  		$position = DB::es($_POST["position"]);
  		$sizee = DB::es($_POST["sizee"]);
  		if (!empty($position) && !empty($sizee)) {
  			$data = array(
  				'id' => $id,
  				'position' => $position,
  				'size' => $sizee
  				);
  			if ($db->insert($data)) {
  				echo "Added successfully";
  			}else{
  				echo "Something went wrong please try again";
  			}
  		}else{
  			echo "Please fill out all fields";
  		}
  	}
?>
<?php
	if (isset($_POST["a"])) {
		$fetchall = $db->selectAll();
		?>
			<table class="table table-bordered">
			<thead>
				<tr>
					<th>SL</th>
					<th>Position</th>
					<th>Size</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
		<?php
		$x = 0;
		foreach ($fetchall as $value) {
			$x++;
		?>
			<tr>
				<td><?php echo $x; ?></td>
				<td><?php echo $value["position"] ?></td>
				<td><?php echo $value["size"] ?></td>
				<td>
					<div class="btn-group">
						<button type="button" class="btn btn-info btn-sm" onclick="selectEdit('<?php echo $value["id"] ?>')">
							<i class="fa fa-edit" > Edit</i>
						</button>
						<button type="button" class="btn btn-danger btn-sm" onclick="selectDelete('<?php echo $value["id"] ?>')" >
							<i class="fa fa-times"> Delete</i>
						</button>
					</div>
				</td>
			</tr>
		<?php
		}
		?>
		</tbody>
		</table>
	<?php
	}
?>
<?php
	if (isset($_POST["selectId"])) {
		$selectId = DB::es($_POST["selectId"]);
		$fetchId = $db->selectById($selectId);
		foreach ($fetchId as $idd) {
		?>
			<input type="hidden" name="id" id="editID" value="<?php  echo $idd["id"]; ?>" />
			<b>Position:</b><br/>
			<input type="text" name="positionsss" class="form-control" id="positionsss" value="<?php echo $idd["position"];  ?>" /><br/>
			<b>Size:</b><br/>
			<input type="text" name="sizzze" class="form-control" id="sizzze" value="<?php echo $idd["size"];  ?>" />
		<?php
		}
	}
?>
<?php
	if (isset($_POST["editId"])) {
		$editID = DB::es($_POST["editId"]);
		$editpositions = DB::es($_POST["editpositions"]);
		$editsize = DB::es($_POST["editsize"]);
		$db->with($editID);
		$dt = array(
				'position' => $editpositions,
				'size' => $editsize
			);
		if($db->update($dt)){
			echo "Edited successfully";
		}else{
			echo "Something went wrong please try again";
		}
	}
?>
<?php
	if (isset($_POST["deleteID"])) {
		$db->with(DB::es($_POST["deleteID"]));
		if ($db->destroy()) {
			echo "Deleted successfully";
		}else{
			echo "Something went wrong please try again";
		}
	}
?>