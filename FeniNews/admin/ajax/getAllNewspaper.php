<?php
	include '../../DB_Connect_/DB.php';
  	$db = new DB;
  	$db->tableName("newspaper");
	if(isset($_POST['pn'])){
		$perPage = preg_replace('#[^0-9]#', '', DB::es($_POST['perPage']));
		$last = preg_replace('#[^0-9]#', '', DB::es($_POST['last']));
		$pn = preg_replace('#[^0-9]#', '', DB::es($_POST['pn']));
		if ($pn < 1) { 
	    	$pn = 1; 
		} else if ($pn > $last) { 
	    	$pn = $last; 
		}
		$limit = 'LIMIT ' .($pn - 1) * $perPage .',' .$perPage;
		$sql = "SELECT * FROM newspaper ORDER BY id DESC $limit";
		$fetchData = $db->select($sql);
		?>
			<table class="table table-bordered">
				<tr class="title">
					<td>Sl.</td>
					<td>Title</td>
					<td>Description</td>
					<td>Image</td>
					<td>Reporter's name</td>
					<td>Action</td>
				</tr>
		<?php
		$x=0;
		foreach ($fetchData as $data) {
			$x++;
			?>
				<tr>
					<td><?php echo $x; ?></td>
					<td><?php echo $data["title"]; ?></td>
					<td>
						<button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#decriptionModal" onclick="selectDescription('<?php echo $data["id"]; ?>')">
							<i class="fa fa-edit"> Edit</i>
						</button>
					</td>
					<td>
						<img src="../newspaper/<?php echo $data["id"] ?>.<?php echo $data["ext"] ?>" alt="<?php echo $data["title"]; ?>" width="200"><br>
						 <a href="index.php?a=changeImage&id=<?php echo $data["id"] ?>&ext=<?php echo $data["ext"] ?>&ref=newspaper&refpath=newspaper" class="btn btn-info btn-sm" style="width: 120px;">
			              <i class="fa fa-edit"></i> Change
			            </a>
					</td>
					<td><?php echo $data["reporter"]; ?></td>
					<td>
						<div class="btn-group">
							<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal" onclick="getTitleReport('<?php echo $data["id"] ?>','<?php echo $data["title"] ?>','<?php echo $data["reporter"] ?>')" >
								<i class="fa fa-edit"> Edit</i>
							</button>
							<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" onclick="selectDeleteId('<?php echo $data["id"] ?>','<?php echo $data["ext"] ?>')">
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
	if (isset($_POST["descriptionID"])) {
		$descriptionID = DB::es($_POST["descriptionID"]);
		$fetchdescription = $db->selectFieldById("description",$descriptionID);
		echo $fetchdescription[0][0];
	}
?>