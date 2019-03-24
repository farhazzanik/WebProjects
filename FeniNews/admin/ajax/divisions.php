<?php
	include '../../DB_Connect_/DB.php';
  	$db = new DB;
  	$db->tableName("divisions_info");
	if (isset($_POST["division"])) {
		$id = $db->autogenerat("divisions_info","id","15",5);
		$division = DB::s($_POST["division"]);
		if (!empty($division)) {
			$data = array(
  				'id' => $id,
  				'divisions_name' => $division
  				);
			if($db->insert($data)){
  				echo "<span class='fa fa-check' style='color:WHITE; font-size:16'> Division added</span>";
  			}else{
  				echo "<span class='fa fa-times' style='color:WHITE;'> Division added failed</span>";
  			}
		}else{
			echo "Fill out all field";
		}
	}
	if (isset($_POST["a"])) {
		$fetchDivision = $db->selectAll();
		?>
			<table class="table table-bordered table-hover whit">
				<tr>
					<td class="title" colspan="2">Division</td>
				</tr>
				<tr>
					<td><b>Division Name</b></td>
					<td><b>Action</b></td>
				</tr>
		<?php
		foreach ($fetchDivision as $division) {
		?>
			<tr>
				<td><?php echo $division["divisions_name"]; ?></td>
				<td>
					<div class="btn-group">
						<button class="btn btn-info btn-sm" type="button" name="edit" data-toggle="modal" data-target="#myModal" onclick="selectData('<?php echo $division["id"]; ?>')">
							<i class="fa fa-edit"></i> Edit
						</button>

						<button class="btn btn-danger btn-sm" type="button" name="edit" data-toggle="modal" data-target="#Modal" onclick="selectDeletedat('<?php echo $division["id"]; ?>','<?php echo $division["divisions_name"]; ?>')">
							<i class="fa fa-times"></i> Delete
						</button>
					</div>
				</td>
			</tr>
			
		<?php
		}
		?>
			</table>
		<?php
	}
	if (isset($_POST["bb"])) {
		$id = $_POST["bb"];
		$fetch = $db->selectById($id);
		echo $fetch[0]["divisions_name"];
	}
	if (isset($_POST["divc"])) {
		$divc = DB::s($_POST["divc"]);
		$divid = DB::s($_POST["divid"]);
		$db->with($divid);
		$dt = array('divisions_name' => $divc );
		if ($db->update($dt)) {
			echo "Division updated";
		}else{
			echo "Failed";
		}
	}
	if (isset($_POST["diddd"])) {
		$diddd = $_POST["diddd"];
		$db->with($diddd);
		if ($db->destroy()) {
			echo "Successful";
		} else {
			echo "Failed";
		}
		
		
	}
?>