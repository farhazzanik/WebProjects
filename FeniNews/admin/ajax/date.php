<?php
	include '../../DB_Connect_/DB.php';
  	$db = new DB;
  	$db->tableName("date_info");
	if (isset($_POST["bdate"])) {
		$id = $db->autogenerat("date_info","id","13",10);
		$edate = DB::s($_POST["edate"]);
		$bdate = DB::s($_POST["bdate"]);
		if (!empty($bdate)) {
			$data = array(
				'id' => $id,
				'edate' => $edate,
				'bdate' => $bdate
				);
			if($db->insert($data)){
  				echo "<span class='fa fa-check' style='color:WHITE; font-size:16'> Bangla date added</span>";
  			}else{
  				echo "<span class='fa fa-times' style='color:WHITE;'> Bangla date added failed</span>";
  			}
  		}else{
  			echo "<span class='fa fa-times' style='color:WHITE;'> Fill out all field</span>";
  		}
	}
	if (isset($_POST["EDt"])) {
		$db->with(DB::s($_POST["eid"]));
		$edate = DB::s($_POST["EDt"]);
		$bdate = DB::s($_POST["BDt"]);
		$dt = array(
			'edate' => $edate,
			'bdate' => $bdate
			);
		if ($db->update($dt)) {
  			echo "<span class='fa fa-check' style='color:WHITE; font-size:16'> Date updated</span>";
  		}else{
  			echo "<span class='fa fa-times' style='color:WHITE;'> Date updated failed</span>";
  		}
	}
	if (isset($_POST["diid"])) {
		$diid = DB::s($_POST["diid"]);
		$db->with($diid);
		if ($db->destroy()) {
  			echo "<span class='fa fa-check' style='color:WHITE; font-size:16'> Date deleted</span>";
  		}else{
  			echo "<span class='fa fa-times' style='color:WHITE;'> Failed</span>";
  		}
	}
?>