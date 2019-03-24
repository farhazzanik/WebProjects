<?php
	include '../../DB_Connect_/DB.php';
  	$db = new DB;
	if (isset($_POST["refpath"])) {
		$table = DB::s($_POST["ref"]);
		$db->tableName($table);
		$file = $_FILES["file"]["name"];
		$file_tmp = $_FILES["file"]["tmp_name"];
		$ext = DB::getClientExtension($file);
		$imageId = DB::s($_POST["imageId"]);
		$folder = DB::s($_POST["refpath"]);
		if($db->selectAll()){
			$imageName = $imageId.".".$ext;
			$db->with($imageId);
			$dt = array('ext' => $ext);
			if (DB::storeAs($file_tmp,"../".$folder,$imageName)) {
				$db->update($dt);
				echo "<span class='text-success'>Image Changed</span>";
			}else{
				echo "<span class='text-success'>Failed</span>";
			}
		}
	}
?>