<?php
	 include '../../DB_Connect_/DB.php';
  	$db = new DB;
  	$db->tableName("newspaper");
  	if (isset($_POST["description"])) {
      $ext = null;
  		$id = $db->autogenerat("newspaper","id","4",9);
  		$title = DB::es($_POST["title"]);
  		$description = $_POST["description"];
  		$reporterName = DB::es($_POST["reporterName"]);
  		if(isset($_FILES["file"])){
  			$file = $_FILES["file"]["name"];
  			$file_tmp = $_FILES["file"]["tmp_name"];
  			$ext = DB::getClientExtension($file);
  			$imgId = $id.".".$ext;
  		}
  		$allowed = array("jpg","jpeg","png","gif");
  		if (!empty($description) && !empty($title)) {
        if (!empty($ext)) {
          if(in_array($ext, $allowed)){
            if(DB::storeAs($file_tmp, "../newspaper", $imgId)){
            }else{
              $sms = "Something went wrong please try again";
            }
          }else{
            $sms = "This image isn't allowed";
          }
        }
  			$data = array(
  				'id' => $id, 
  				'title' => $title,
  				'description' => $description,
  				'reporter' => $reporterName,
  				'ext' => $ext
  				);
  			if ($db->insert($data)) {
  				$sms = "Successful";
  			} else {
  				$sms = "Failed";
  			}
  			echo $sms;
  		} else {
  			echo "Please Fill Out Fields";
  		}
  		
  	}
  	
?>
<?php
  if(isset($_POST["descriptioneditID"])){
    $descriptioneditID = DB::es($_POST["descriptioneditID"]);
    $descriptionE = $_POST["descriptionE"];
    $db->with($descriptioneditID);
    $dt = array(
        'description' => $descriptionE
      );
    if($db->update($dt)){
      echo "Edited successful";
    }else{
      echo "Something went wrong please try again";
    }
  }
?>
<?php
  if(isset($_POST["titleEditiD"])){
    $titleEditiD = DB::es($_POST["titleEditiD"]);
    $titleEdit = DB::es($_POST["titleEdit"]);
    $reporterName = DB::es($_POST["reporterName"]);
    $db->with($titleEditiD);
    $dt = array(
        'title' => $titleEdit,
        'reporter' => $reporterName
      );
    if($db->update($dt)){
      echo "Edited successful";
    }else{
      echo "Something went wrong please try again";
    }
  }
?>
<?php
  if(isset($_POST["deleteID"])){
    $ext = DB::es($_POST["ext"]);
    $deleteID = DB::es($_POST["deleteID"]);
    $db->with($deleteID);
    $location = "../../newspaper/".$deleteID.".".$ext;
    if($db->destroy()){
      DB::fileDelete($location);
      echo "Deleted successfully";
    }else{
      echo "Something went wrong please try again";
    }
  }
?>