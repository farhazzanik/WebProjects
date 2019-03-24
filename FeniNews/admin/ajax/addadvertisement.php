<?php
	include '../../DB_Connect_/DB.php';
  	$db = new DB;
  	$db->tableName("advertisement");
  	if (isset($_POST["positionn"])) {
  		$positionn = DB::es($_POST["positionn"]);
  		$fetchSize = $db->select("SELECT size FROM advertisementposition WHERE position='$positionn'");
  		foreach ($fetchSize as $size) {
  			echo "<option>".$size["size"]."</option>";
  		}
  	}
    if (isset($_POST["title"])) {
      $ext = "";
      $id = $db->autogenerat("advertisement","id",99,9);
      $title = DB::es($_POST["title"]);
      $link = DB::es($_POST["link"]);
      $description = DB::es($_POST["description"]);
      $position = DB::es($_POST["position"]);
      $sizee = DB::es($_POST["sizee"]);
      if (isset($_FILES["file"])) {
        $file = $_FILES["file"]["name"];
        $file_tmp = $_FILES["file"]["tmp_name"];
        $ext = DB::getClientExtension($file);
        $imgId = $id.".".$ext;
      }
      $allowed = array('jpeg','jpg','png','gif');
      if (in_array($ext,$allowed)) {
        if(DB::storeAs($file_tmp, "../advertisement", $imgId)){
          $data = array(
            'id' =>   $id, 
            'title' =>  $title,
            'link' => $link,
            'description' => $description,
            'position' => $position,
            'size' => $sizee,
            'ext' => $ext
            );
          if ($db->insert($data)) {
            echo "Advertisement published";
          } else {
            echo "Somthing went wrong please try again";
          }
        }else{
          echo "Somthing went wrong please try again";
        }
      }else{
        echo "This file is not allowed";
      }
    }
?>