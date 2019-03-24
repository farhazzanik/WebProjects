<?php
	include '../../DB_Connect_/DB.php';
  	$db = new DB;
  	$db->tableName("district_info");
	if (isset($_POST["division_id"])) {
		$id = $db->autogenerat("district_info","id","16",7);
		$division_id = DB::s($_POST["division_id"]);
		$district_name = DB::s($_POST["districtName"]);
		if (!empty($district_name)) {
			$data = array(
				'id' => $id, 
				'division_id' => $division_id,
				'district' => $district_name
				);
			if($db->insert($data)){
  				echo "<span class='fa fa-check' style='color:WHITE; font-size:16'> Districts added</span>";
  			}else{
  				echo "<span class='fa fa-times' style='color:WHITE;'> Districts added failed</span>";
  			}
		}else{
			echo "Fill out all field";
		}
	}	
?>
<?php
	if (isset($_POST["idd"])) {
		$idd = DB::s($_POST["idd"]);
		$divs = '<select  name="division_id" class="form-control" style="width: 100%;" id="division_id">';
		$query = "SELECT district_info.*,divisions_info.divisions_name FROM district_info INNER JOIN divisions_info ON district_info.division_id=divisions_info.id WHERE district_info.id='$idd'";
		$fetchnnn = $db->select($query);
		$divs.='<option value="'.$fetchnnn[0]["division_id"].'">'.$fetchnnn[0]["divisions_name"].'</option>';
		$result = $db->selectSub("divisions_info");
		foreach ($result as $value) {
			if($value["id"]!=$fetchnnn[0]["division_id"]){
				$divs.='<option value="'.$value["id"].'">'.$value["divisions_name"].'</option>';
			}
		}
		$divs.="</select>";
		$dist = $fetchnnn[0]["district"];
		echo $d = $divs."`".$dist;
	}
?>
<?php
	if (isset($_POST["disTrict"])) {
		$eid = DB::s($_POST['eiid']);
		$diviSion = DB::s($_POST['diviSion']);
		$disTrict = DB::s($_POST['disTrict']);
		$db->with($eid);
		$dt = array(
			'division_id' => $diviSion,
			'district' => $disTrict
			);
		if ($db->update($dt)) {
			echo "Districts updated";
		}else{
			echo "Failed";
		}
	}	
?>
<?php
	if (isset($_POST["diddd"])) {
		$diddd = $_POST["diddd"];
		$db->with($diddd);
		if($db->destroy()){
			echo "Deleted";
		}else{
			echo "Failed";
		}
	}
?>