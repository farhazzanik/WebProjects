<?php
	include '../../DB_Connect_/DB.php';
  	$db = new DB;
  	$db->tableName("advertisement");
  	if (isset($_POST["rrr"])) {
  		$fetchAdd = $db->selectAll();
  		?>
  			<table class="table table-bordered table-responsive" id="dataa">
  				<tr>
  					<td>Title</td>
  					<td>Link</td>
  					<td>Description</td>
  					<td>Position</td>
  					<td>Size</td>
  					<td>Image</td>
  					<td>Action</td>
  				</tr>
  				<?php
  					foreach ($fetchAdd as $adds) {
  					?>
  						<tr>
  							<td><?php echo $adds["title"] ?></td>
		  					<td><?php echo $adds["link"] ?></td>
		  					<td><?php echo $adds["description"] ?></td>
		  					<td><?php echo $adds["position"] ?></td>
		  					<td><?php echo $adds["size"] ?></td>
		  					<td>
		  						<img src="../advertisement/<?php echo $adds["id"] ?>.<?php echo $adds["ext"] ?>" alt="<?php echo $adds["title"]; ?>" height="120" width="160"><br>
								 <a href="index.php?a=changeImage&id=<?php echo $adds["id"] ?>&ext=<?php echo $adds["ext"] ?>&ref=advertisement&refpath=advertisement" class="btn btn-info btn-sm" style="width: 120px;" >
					              <i class="fa fa-edit"></i> Change
					            </a>
		  					</td>
		  					<td>
		  						<div class="btn-group">
		  							<button type="button" class="btn btn-danger btn-sm" onclick="selectDelete('<?php echo $adds["id"] ?>','<?php echo $adds["ext"] ?>')">
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
  if (isset($_POST["deleteID"])) {
    $deleteID = DB::es($_POST["deleteID"]);
    $ext = DB::es($_POST["deleteExt"]);
    $location = "../../advertisement/".$deleteID.".".$ext;
    $db->with($deleteID);
    if ($db->destroy()) {
      DB::fileDelete($location);
      echo "Deleted successfully";
    }else{
      echo "Somthing went wrong please try again";
    }
  }
?>