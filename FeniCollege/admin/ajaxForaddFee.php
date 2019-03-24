<?php
@session_start();
error_reporting(1);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();
	
			if(isset($_POST["name"])){
						$explodeclass=explode('and',$_POST["ClassId"]);
						$explodegroup=explode('and',$_POST["groupID"]); 

					$a = [];
					$id = $_POST["id"];
					 $sql = "SELECT `running_student_info`.*,`student_personal_info`.`student_name` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`class_id`='$explodeclass[0]' AND `running_student_info`.`group_id`='$explodegroup[0]'
AND `running_student_info`.`student_id`='$id'";
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
					   $selectFees="SELECT * FROM `running_student_info` WHERE `student_id`='".$_POST["id"]."' AND `class_id`='$explodeclass[0]' AND `group_id`='$explodegroup[0]'";
					$resultFees=$db->select_query($selectFees);
						if(@$resultFees->num_rows>0){
								 $SelecByiffess="SELECT * FROM `add_fee` WHERE `class_id`='$explodeclass[0]' AND `group_id`='$explodegroup[0]' AND `year`='".$_POST["year"]."'";
									$resultbyfeess=$db->select_query($SelecByiffess);
									$count=$resultbyfeess->num_rows;
									if(@$resultbyfeess->num_rows>0){
				?>
				<table class="table-bordered" style="width:100%;">
					<tr>	<td > &nbsp; &nbsp; <input type="checkbox" value="checkbox" id="chkbx_all"  onclick="return enable_cb()"> &nbsp; <strong><span class="text-danger">Select All</span></strong></input></td>
						<td align="center" ><strong> Taka</strong></td>
						<td align="center"  ><strong>Total Taka</strong></td>
						
						</tr>

		<?php 
		$sl=0;
				while($fetch_fee=$resultbyfeess->fetch_array()){
			$sl++;
			if($sl=='1'){
		?>		
		<tr>	
		<td >&nbsp; &nbsp; <?php echo $sl."&nbsp;|" ?>  &nbsp;<input type="checkbox" id="check_elmnt" onclick="return totalShow()" class="check_elmnt" name="fee[]" value="<?php echo $fetch_fee[3].'and'.$fetch_fee[0];?>" /> &nbsp;<strong><span class="text-info" style="font-size:15px;"><?php echo $fetch_fee[1];?> </span></strong>
		<input type="hidden" name="forsum[]"  id="forsum-<?php echo $fetch_fee[0];?>" value="<?php echo  $fetch_fee[0]?>" />
		</td>
		<td align="center"><strong><?php echo  $fetch_fee[3]?></strong></td>
						<td rowspan="<?php echo $count;?>" align="center">
						
						<strong><span id="showresult"> </span></strong>
												</td>
					
						
						</tr>
						<?php } else {?>
			
	<tr>	
		<td >&nbsp; &nbsp; <?php echo $sl."&nbsp;|" ?>  &nbsp;<input type="checkbox" id="check_elmnt" onclick="return totalShow()" class="check_elmnt" name="fee[]" value="<?php echo  $fetch_fee[3].'and'.$fetch_fee[0];?>" /> &nbsp;<strong><span class="text-info" style="font-size:15px;"><?php echo $fetch_fee[1];?> </span></strong>
		<input type="hidden" name="forsum[]" id="forsum-<?php echo $fetch_fee[0];?>" value="<?php echo  $fetch_fee[0]?>" />
		</td>
				<td align="center"><strong><?php echo  $fetch_fee[3]?></strong></td>
						
						</tr>
			<?php } ?>
			
			
		<?php  } ?>	
		</table>	
				<?php 
		 }  }	}
	?>
	
	<?php
	
			if(isset($_POST["forsum"])){
			
			if(!empty($_POST["fess"])){
			$sum=0;
					for($a=0;$a < count($_POST["fess"]);$a++){
							$fessTotal=explode("and",$_POST['fess'][$a]);
							
							$sum=$sum+$fessTotal[0];
					}
					echo $sum;
					}
			}
	?>
	
	<?php  
	
			if(isset($_POST["moredata"])){
				$className=explode('and',$_POST["className"]);
				$groupname=explode('and',$_POST["groupname"]);
				$stdId=$_POST["stdId"];
				$year=$_POST["year"];
				
					if(!empty($_POST["fee"])){
				
							for($a=0;$a < count($_POST["fee"]);$a++){
					
								 $feeid=explode("and",$_POST['fee'][$a]);
								 	$insertSql="REPLACE INTO `student_account_info` (`studentID`,`class_id`,`groupID`,`fee_id`,`year`,`month`,`date`,`admin_id`) VALUES('$stdId','$className[0]','$groupname[0]','$feeid[1]','$year','".date('M')."','".date('d/m/Y')."','".$_SESSION["id"]."')";
									$resultsql=$db->insert_query($insertSql);
							}
							if(isset($db->sms)){
									echo $db->sms;
							}
					}
			}
	?>
	
	<?php
	
			if(isset($_POST["forView"])){
					$className=explode('and',$_POST["className"]);
					$groupname=explode('and',$_POST["groupname"]);
					$stdId=$_POST["stdId"];
					$year=$_POST["year"];
					$sql="SELECT `student_account_info`.*,`add_class`.`class_name`,`add_group`.`group_name`,`student_personal_info`.`student_name`
FROM `student_account_info` INNER JOIN `add_class` ON `add_class`.`id`=`student_account_info`.`class_id`
INNER JOIN `add_group` ON `add_group`.`id`=`student_account_info`.`groupID` INNER JOIN `student_personal_info`
ON `student_personal_info`.`id`=`student_account_info`.`studentID`
WHERE `student_account_info`.`class_id`='$className[0]' AND `student_account_info`.`groupID`='$groupname[0]' AND `student_account_info`.`year`='$year' AND `student_account_info`.`studentID`='$stdId'
GROUP BY `student_account_info`.`studentID`";
					$resultsql=$db->select_query($sql);
					
						if($resultsql->num_rows > 0){
						$fetchsql=$resultsql->fetch_array();
						?>
							<table class="table table-bordered table-hover" style=" margin-top:20px;">
									<tr>
											<td colspan="3"><input type="button" name="back" id="back" onclick="return backpage()" class="btn btn-sm btn-danger" value="BACK"/></td>
									</tr>
									
									<tr>
											<td colspan="3" align="center"><strong><span><?php echo $fetchsql["class_name"].'&nbsp;(&nbsp;'.$fetchsql["group_name"].'&nbsp;)' ?></span></strong></td>
									</tr>
									<tr>
											<td colspan="3" align="center">
											<?php
													$forroll="SELECT `class_roll` FROM `running_student_info` WHERE `student_id`='".$fetchsql["studentID"]."'";
													$resultRoll=$db->select_query($forroll);
														if($resultRoll->num_rows>0){
															$fetchRoll=$resultRoll->fetch_array();
														}
											?>
													<strong><span><?php echo $fetchsql["student_name"].'&nbsp;(&nbsp;'.$fetchRoll["class_roll"].'&nbsp;)';?></span></strong>
											</td>
									</tr>
									<?php
									 $fordata="SELECT `student_account_info`.*,`add_fee`.`amount`,`title` FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`studentID`='$stdId' AND 
`student_account_info`.`class_id`='$className[0]' AND `student_account_info`.`groupID`='$groupname[0]'";
									$resuldata=$db->select_query($fordata);
									$count=$resuldata->num_rows;
									if($resuldata->num_rows>0){
									$s=0;
									?>
									<tR>
											<td><strong>Title</strong></td>
											<td><strong>Taka</strong></td>
											<td><strong>Action</strong></td>
										</tR>	
									<?php 
									$total=0;
										 $countammount="SELECT `student_account_info`.*,`add_fee`.`amount`,`title` FROM `student_account_info`
INNER JOIN `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`studentID`='$stdId' AND 
`student_account_info`.`class_id`='$className[0]' AND `student_account_info`.`groupID`='$groupname[0]'";
										$resultammout=$db->select_query($countammount);
											while($fetchresult1=$resultammout->fetch_array()){
											$total=$total+$fetchresult1["amount"];
											}
											while($fetchResult=$resuldata->fetch_array()){
											
									$s++;
										?>	
										<tR>
											<td><?php echo $s.'&nbsp;|&nbsp;'.$fetchResult["title"];?></td>
											<td><?php echo $fetchResult["amount"];?></td>
											<td style="vertical-align:middle; text-align:center"><button type="button" onclick="return deletefordata('<?php echo $fetchResult["fee_id"]?>')" id="delete-<?php echo $fetchResult["fee_id"]?>" name="delete" value="<?php echo $fetchResult["studentID"].'and'.$fetchResult["class_id"].'and'.$fetchResult["groupID"].'and'.$fetchResult["fee_id"].'and'.$fetchResult["year"] ?>" >Delete</button></td>
										</tR>	
										
												<?php  }?>
													<tr>
													<td align="right"><strong>Total = </strong></td>
													<td><strong><?php echo $total;?></strong></td>
													<tD></tD>
													</tr>
												<?php } ?>
							</table>
							
						<?php  } else {
						
						
						?>
						
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
						 <?php } ?>
			
		<?php 	}
	?>
	
	
<?php

		if(isset($_POST["deletedata"])){
				$explodedata=explode('and',$_POST["value"]);
				 $deletdquery="DELETE FROM `student_account_info` WHERE `studentID`='$explodedata[0]' AND `class_id`='$explodedata[1]' AND `groupID`='$explodedata[2]' AND `fee_id`='$explodedata[3]' AND `year`='$explodedata[4]'";
				$resultdelet=$db->delete_query($deletdquery);
		}
?>