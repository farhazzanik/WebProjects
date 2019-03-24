<?php
	include '../../DB_Connect_/DB.php';
  	$db = new DB;
  	$db->tableName("photo_gallery");
  	if(isset($_POST["title"]) && isset($_FILES["file"])){
  		$id = $db->autogenerat("photo_gallery","id","3",9);
  		$title = DB::es($_POST["title"]);
  		$file = $_FILES["file"]["name"];
		$file_tmp = $_FILES["file"]["tmp_name"];
		$ext = DB::getClientExtension($file);
		$imgId = $id.".".$ext;
		$allowed = array("jpg","jpeg","png","gif");
		if(in_array($ext, $allowed)){
			if(DB::storeAs($file_tmp, "../Gallery", $imgId)){
				$data = array(
					'id' =>		$id, 
					'title' =>  $title,
					'ext' => $ext
					);
				if ($db->insert($data)) {
					echo "Image uploaded";
				} else {
					echo "Somthing went wrong please try again";
				}
				
			}else{
				echo "Somthing went wrong please try again";
			}
		}else{
			echo "Please select a valid image";
		}
  	}
  	if(isset($_POST["a"])){
  		$fetchAll = $db->selectAll();
  	?>
  	<table class="table table-bordered table-hover whit">
  		<tr class="title">
  			<td colspan="4" align="center">Photo Gallery</td>
  		</tr>
  		<tr>
  			<td>SL</td>
  			<td width="25%;">Title</td>
  			<td width="40%">Photo</td>
  			<td>Action</td>
  		</tr>
  	<?php
  		$x = 0;
  		foreach ($fetchAll as $All) {
  			$x++;
  	?>
  		<tr>
  			<td><?php echo $x; ?></td>
  			<td><?php echo $All["title"]; ?></td>
  			<td>
  				<img src="../Gallery/<?php echo $All["id"].".".$All["ext"] ?>" alt="" height="160"><br>
  				<a href="index.php?a=changeImage&id=<?php echo $All["id"] ?>&ext=<?php echo $All["ext"]; ?>&ref=photo_gallery&refpath=Gallery" class="btn btn-info btn-sm" style="width: 120px;">
              <i class="fa fa-edit"></i> Change
            </a>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#linkModal" style="width: 150px;" onclick="getLink('<?php echo $All["id"] ?>','<?php echo $All["ext"]; ?>')">
            	<i class="fa fa-link"> Get Image Link</i>
            </button>
  			</td>
  			<td>
  				<div class="btn-group">
  					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" onclick="selectEdit('<?php echo $All["id"]; ?>','<?php echo $All["title"]; ?>')">
	  					<i class="fa fa-edit"> Edit</i>
	  				</button>
	  				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"  onclick="selectDelete('<?php echo $All["id"]; ?>','<?php echo $All["ext"]; ?>')">
	  					<i class="fa fa-times"> Delete</i>
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
?>
<?php
	if(isset($_POST["editid"])){
		$editid = DB::es($_POST["editid"]);
		$db->with($editid);
		$edittitle = DB::es($_POST["edittitle"]);
		$dt = array(
			'title' => $edittitle
			);
		if ($db->update($dt)) {
			echo "Edited successfully";
		} else {
			echo "Somthing went wrong please try again";
		}
		
	}
?>
<?php
	if(isset($_POST["deleteid"])){
		$deleteid = DB::es($_POST["deleteid"]);
		$ext = DB::es($_POST["ext"]);
		$db->with($deleteid);
		if ($db->destroy()) {
			$db->fileDelete("../../Gallery/".$deleteid.".".$ext);
			echo "Deleted successfully";
		} else {
			echo "Somthing went wrong please try again";
		}
		
	}
?>