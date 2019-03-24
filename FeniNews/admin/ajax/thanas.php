<?php
	include '../../DB_Connect_/DB.php';
  	$db = new DB;
  	$db->tableName("thanas_info");
  	if(isset($_POST["division_id"])){
  		$division_id = DB::s($_POST["division_id"]);
  		$queryDistrict = "SELECT * FROM district_info WHERE division_id='$division_id'";
  		$fetchDistrict = $db->select($queryDistrict);
  		foreach ($fetchDistrict as $key => $District) {
  			?>
  				<option value="<?php echo $District["id"] ?>"><?php echo $District["district"] ?></option>
  			<?php
  		}
  	}
  	if (isset($_POST["thanas"])) {
  		$id = $db->autogenerat("thanas_info","id","17",10);
  		$thanas = DB::s($_POST["thanas"]);
  		$districts_id = DB::s($_POST["districts_id"]);
  		$division = DB::s($_POST["division"]);
  		if (!empty($thanas)) {
  			$data = array(
	  			'id' => $id, 
	  			'division_id' => $division,
	  			'district_id' => $districts_id,
	  			'thana_name'  => $thanas
  			);
  			if($db->insert($data)){
  				echo "<span class='fa fa-check' style='color:WHITE; font-size:16'> Thana added</span>";
  			}else{
  				echo "<span class='fa fa-times' style='color:WHITE;'> Thana added failed</span>";
  			}
  		}
  	}
  	if(isset($_POST["EID"])){
  		$eid = $_POST["EID"];
  		$queryForDivisionDistrict = "SELECT thanas_info.*,divisions_info.divisions_name,district_info.district FROM thanas_info INNER JOIN divisions_info ON thanas_info.division_id=divisions_info.id INNER JOIN district_info ON thanas_info.district_id=district_info.id WHERE thanas_info.id='$eid'";

  		$fetchForDivisionDistrict = $db->select($queryForDivisionDistrict);

  		$divisionOption = '<select  name="division_id" class="form-control" style="width: 100%;" id="division_id" onchange="selectDistrictChange()">';

  		$divisionOption.='<option value="'.$fetchForDivisionDistrict[0]["division_id"].'">'.$fetchForDivisionDistrict[0]["divisions_name"].'</option>';

		$result = $db->selectSub("divisions_info");
		foreach ($result as $value) {
			if ($value["id"]!=$fetchForDivisionDistrict[0]["division_id"]) {
				$divisionOption.='<option value="'.$value["id"].'">'.$value["divisions_name"].'</option>';
			}
		}
  		$divisionOption.='</select>';
  		$districtOption = '<select  name="district_id" class="form-control" style="width: 100%;" id="districts_id">';
  		$districtOption.='<option value="'.$fetchForDivisionDistrict[0]["district_id"].'">'.$fetchForDivisionDistrict[0]["district"].'</option>';
  		$fetchDdistrict = $db->select("SELECT * FROM district_info WHERE division_id='".$fetchForDivisionDistrict[0]["division_id"]."'");
  		foreach ($fetchDdistrict as $Ddistrict) {
  			if ($Ddistrict["id"]!=$fetchForDivisionDistrict[0]["district_id"]) {
  				$districtOption.='<option value="'.$Ddistrict["id"].'">'.$Ddistrict["district"].'</option>';
  			}
  		}
  		$districtOption.='</select>';


  		echo $fetchForDivisionDistrict[0]["thana_name"].'`'.$districtOption.'`'.$divisionOption;
  	}
  	if (isset($_POST["iddd"])) {
  		$iddd = DB::s($_POST["iddd"]);
  		$diViSion = DB::s($_POST["diViSion"]);
  		$DisTRict = DB::s($_POST["DisTRict"]);
  		$ThaNas = DB::s($_POST["ThaNas"]);
  		$db->with($iddd);
  		if (!empty($ThaNas)) {
  			$dt = array(
  				'division_id' => $diViSion,
  				'district_id' => $DisTRict,
  				'thana_name' => $ThaNas
  			);
  			if ($db->update($dt)) {
				echo "Thana info updated";
			}else{
				echo "Failed";
			}
  		}else{
  			echo "Fill out all fileds";
  		}
  	}
  	if (isset($_POST["diddd"])) {
  		$db->with(DB::s($_POST["diddd"]));
  		if($db->destroy()){
  			echo "Deleted";
  		}else{
  			echo "Failed";
  		}
  	}
 ?>