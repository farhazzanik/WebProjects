<?php
error_reporting(1);
@session_start();

		require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();
	
		if(isset($_POST["name"])){
						$explodeclass=explode('and',$_POST["ClassId"]);
						$explodegroup=explode('and',$_POST["groupID"]); 

					$a = [];
					$id = $_POST["id"];
					 $sql = "SELECT `student_account_info`.*,`running_student_info`.`class_roll`,`student_personal_info`.`student_name`
FROM `student_account_info` INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`student_account_info`.`studentID`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`student_account_info`.`studentID`
WHERE `student_account_info`.`studentID`='$id' AND `student_account_info`.`groupID`='$explodegroup[0]'
 AND `student_account_info`.`class_id`='$explodeclass[0]'
 GROUP BY `student_account_info`.`studentID`";
					$result = $db->select_query($sql);
					if($result){
							$fetch=$result->fetch_assoc();
							//$a  = array('name' =>$fetch['student_name'],'Sess'=>$fetch['session2']);
							//$msg=json_encode($a);
							$msg = $fetch['student_name'].'/'.$fetch['class_roll'];
							echo $msg;
							}
			}	
			
			if(isset($_POST["showData"])){
			
					$explodeclass=explode('and',$_POST["ClassId"]);
						$explodegroup=explode('and',$_POST["groupID"]); 
						$datachek="SELECT `student_account_info`.*,`add_fee`.`title` FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id`
WHERE `student_account_info`.`studentID`='".$_POST["id"]."' AND `student_account_info`.`class_id`='$explodeclass[0]'
AND `student_account_info`.`groupID`='$explodegroup[0]' AND `student_account_info`.`year`='".$_POST["year"]."'";
						$resultchek=$db->select_query($datachek);
						if($resultchek->num_rows > 0){
						
						?>
					
						<table width="77%" class="table table-bordered" style="width:100%;">
								<tr align="center">
										<td width="38%"><strong>Fee Title</strong></td>
										<td width="30%"><strong>Fee Ammount</strong></td>
										<td width="32%"><strong>Discount</strong></td>
								</tr>
								<tr>
										<td><select name="feetitle" id="feetitle" style="width:100%;
										 height:30px;" onchange="return showDATA()">
										 <option>Select One..</option>
										 		<?php 
														while($fetchchek=$resultchek->fetch_array()){
												?>
												<option value="<?php echo $fetchchek["fee_id"];?>"><?php echo $fetchchek["title"];?></option>
												
												<?php } ?>
										 </select></td>
										 <td>
										 	<input type="text" name="ammount" id="ammount"  style="width:100%; height:30px; text-align:center" readonly="" />
										 </td>
										  <td>
										 	<input type="text" name="discount" id="discount"  style="width:100%; height:30px; text-align:center" />
										 </td>
								</tr>
						
</table>
						
						
					<?php	}
			}
?>

<?php

		if(isset($_POST["forShammount"])){
			$explodeclass=explode('and',$_POST["ClassId"]);
						$explodegroup=explode('and',$_POST["groupID"]); 
			 	$showammount="SELECT `amount` FROM `add_fee` WHERE `id`='".$_POST["feeID"]."' AND `class_id`='$explodeclass[0]' AND `group_id`='$explodegroup[0]' AND `year`='".$_POST["year"]."'";
				$resultmount=$db->select_query($showammount);
					if($resultmount->num_rows > 0){
							$fetchammount=$resultmount->fetch_array();
								echo $fetchammount["amount"];
					}
		}
?>

<?php
		if(isset($_POST["moredata"])){
				$explodeclass=explode('and',$_POST["className"]);
				$explodegroup=explode('and',$_POST["groupname"]); 
			 	$sql = "REPLACE INTO `add_discount` (`student_id`,`class_id`,`year`,`feeid`,`discount`,`admin_id`,`date`,`group_id`)
VALUES ('".$_POST["stdId"]."','$explodeclass[0]','".$_POST["year"]."','".$_POST["feetitle"]."','".$_POST["discount"]."','".$_SESSION["id"]."','".date('d/m/Y')."','$explodegroup[0]')";
				$resulsql=$db->insert_query($sql);
					if(isset($db->sms)){
						echo $db->sms;
					}
		}
		
		if(isset($_POST["forView"])){
		
				$className=explode('and',$_POST["className"]);
					$groupname=explode('and',$_POST["groupname"]);
					$stdId=$_POST["stdId"];
					$year=$_POST["year"];
					$feeID=$_POST["feetitle"];
				 	$forcheksql="SELECT `add_discount`.*,`add_class`.`class_name`,`add_group`.`group_name`,`student_personal_info`.`student_name`
,`running_student_info`.`class_roll` FROM `add_discount` INNER JOIN `add_class`
ON `add_class`.`id`=`add_discount`.`class_id` INNER JOIN `add_group`
ON `add_group`.`id`=`add_discount`.`group_id` INNER JOIN `student_personal_info`
ON `student_personal_info`.`id`=`add_discount`.`student_id`
INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`add_discount`.`student_id`
WHERE `add_discount`.`student_id`='$stdId' AND `add_discount`.`class_id`='$className[0]' AND `add_discount`.`group_id`='$groupname[0]' AND `add_discount`.`year`='$year'";
				$resultSql=$db->select_query($forcheksql);
					if($resultSql->num_rows > 0){
					$fetchSql=$resultSql->fetch_array();
						?>
							<table class="table table-bordered table-hover" style=" margin-top:20px;">
									<tr>
											<td colspan="5"><input type="button" name="back" id="back" onclick="return backpage()" class="btn btn-sm btn-danger" value="BACK"/></td>
									</tr>
									
								<tr>
											<td colspan="5" align="center"><strong><span><?php echo $fetchSql["class_name"].'&nbsp;(&nbsp;'.$fetchSql["group_name"].'&nbsp;)' ?></span></strong></td>
									</tr>
									<tr>
											<td colspan="5" align="center"><strong><span><?php echo $fetchSql["student_name"].'&nbsp;(&nbsp;'.$fetchSql["class_roll"].'&nbsp;)' ?></span></strong></td>
									</tr>
									<tR>
											<td><strong>Title</strong></td>
											<td><strong>Taka</strong></td>
											<td><strong>Discount</strong></td>
											<td><strong>Net Ammount</strong></td>
											<td><strong>Action</strong></td>
										</tR>	
									<?php
											$forshowFeerelativedis="SELECT `add_discount`.*,`add_fee`.`title`,`amount` FROM `add_discount`
INNER JOIN `add_fee`ON `add_fee`.`id`=`add_discount`.`feeid`
WHERE `add_discount`.`class_id`='$className[0]' AND `add_discount`.`group_id`='$groupname[0]' AND `add_discount`.`year`='$year' AND `add_discount`.`student_id`='$stdId'";
											$resulforallviews=$db->select_query($forshowFeerelativedis);
												if($resulforallviews->num_rows > 0){
												$sl = 0;
														while($fetchForallViews=$resulforallviews->fetch_array()){ 
														$netammount = $fetchForallViews["amount"]-$fetchForallViews["discount"];
									
										$sl++;
										?>
											<tR>
											<td><strong><?php echo $sl.'&nbsp; |&nbsp;'.$fetchForallViews["title"];?></strong></td>
											<td><strong><?php echo $fetchForallViews["amount"];?></strong></td>
											<td><strong><?php echo $fetchForallViews["discount"];?></strong></td>
												<td><strong><?php echo $netammount ;?></strong></td>
											<td><button type="button" onclick="return deletefordata('<?php echo $fetchForallViews["feeid"]?>')" id="delete-<?php echo $fetchForallViews["feeid"]?>" name="delete" value="<?php echo $fetchForallViews["student_id"].'and'.$fetchForallViews["class_id"].'and'.$fetchForallViews["group_id"].'and'.$fetchForallViews["feeid"].'and'.$fetchForallViews["year"] ?>" >Delete</button></td>
										</tR>		
									<?php } } ?>
							</table>	
						
						<?php 
					}else {?>
						<table class="table table-bordered table-hover" style=" margin-top:20px;">
									<tr>
											<td><input type="button" name="back" id="back" onclick="return backpage()" class="btn btn-sm btn-danger" value="BACK"/></td>
									</tr>
									
									<tr>
											<td>
												<span class="text-danger"><strong>No Data Found !!!!</strong></span>
											</td>
									</tr>
							</table>
					<?php }
		}
		

?>

<?php

		if(isset($_POST["deletedata"])){
		
				$explodedata=explode('and',$_POST["value"]);
			 	$deletesql="DELETE FROM `add_discount`  WHERE `student_id`='$explodedata[0]' AND `class_id`='$explodedata[1]' AND `year`='$explodedata[4]' AND `feeid`='$explodedata[3]' AND `group_id`='$explodedata[2]'";
				$db->delete_query($deletesql);
		}
?>