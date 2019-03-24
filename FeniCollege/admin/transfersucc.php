<?php
	error_reporting(1);
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();

		if(isset($_POST["status"])){
			
		$ClassId=$_POST["class_name"];
		$groupname=explode('and',$_POST["groupname"]);
		$tfgroupname=explode('and',$_POST["tfgroupname"]);
		
		$from=$db->escape($_POST["from"]);
		$to=$db->escape($_POST["to"]);

		  $sql = "SELECT `running_student_info`.*,`student_personal_info`.`student_name` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`class_id`='$ClassId' AND `running_student_info`.`group_id`='$groupname[0]' ORDER BY 
`running_student_info`.`class_roll` ASC LIMIT $from,$to";
		//print $sql;
		$chek=$db->select_query($sql);
		if($chek){
				?>
<table width="510" align="center"  class="table table-bordered  table-responsive table-hover" style="margin-top:30px;">
		<tr align="center">
				<td width="77">Select All<BR/>
					<input id="chkbx_all"  onclick="return check_all()" type="checkbox"  />
		  </td>
				<td width="147">Name</td>
				<td width="121">Roll No</td>
			
		</tr>
		<?php
				    
				while($fetchForAl=$chek->fetch_array()){

		?>
		<tr>
				<td align="center"><?php
			//print $fetchForAl[0];

				 	$subjectshow = "SELECT `subject_registration_table`.*,`add_subject_info`.`subject_code`,`add_subject_info`.`select_subject_type` FROM `subject_registration_table` INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`subject_registration_table`.`subject_id` WHERE `subject_registration_table`.`class_id`='$ClassId' AND `subject_registration_table`.`group_id`='$groupname[0]' AND `subject_registration_table`.`std_id`='$fetchForAl[0]'";


		$resultsubject=$db->select_query($subjectshow);
		while($fetchsql = $resultsubject->fetch_array()){
			//echo  $fetchsql["subject_code"];

				$sss = "SELECT * FROM `add_subject_info` WHERE `class_id`='".$_POST["tfclass_name"]."' and group_id='$tfgroupname[0]' AND `subject_code`='".$fetchsql["subject_code"]."' and `add_subject_info`.`select_subject_type`='".$fetchsql["select_subject_type"]."' ";
			$fet5ndsyb=$db->select_query($sss);
			$selectcode = $fet5ndsyb->fetch_array();
		if($selectcode){
 		?>
 		<input type="checkbox" style="display: none;" class="subjectid" id="subid" name="subid[]" value="<?php echo "$fetchForAl[student_id]and$selectcode[id]";?>" checked>

 		<?php
			}

		}?><input type="checkbox" class="check_elmnt counstudent" name="chek[]" id="chek-<?php echo $fetchForAl["student_id"];?>" value="<?php echo "$fetchForAl[student_id]and$fetchForAl[class_roll]";?>" /></td>
				<td><?php echo $fetchForAl["student_name"];?></td>
				<td align="center"><?php echo $fetchForAl["class_roll"];?></td>
			
		</tr>
		<?php }  ?>
			<tr>
				<td colspan="5" align="right">
					<span id="smsforR"></span>
				</td>
			</tr>
		<tr>
			<td colspan="5" align="right">
				<input type="button" name="submit" id="submit" value="Submit" class="btn btn-primary btn-defualt btn-sm" style="width:150px;" onclick="return Submit()"/>
			</td>
		</tr>
</table>

				<?php
				
		}


	}

	if(isset($_POST["transfer"])){

		//print $counstudent = count($_POST["counstudent"]);
	$tfgroupname=explode('and',$_POST["tfgroupname"]);

		for ($i=0; $i < count($_POST["counstudent"]) ; $i++) { 
			
			 $studenrollandid=explode("and",$_POST['counstudent'][$i]);
			//print $studenrollandid[1];
			 $deltsql = "DELETE FROM `running_student_info` WHERE `student_id`='$studenrollandid[0]'";
			 $executedel = $db->delete_query($deltsql);
  $delsubsql = "DELETE FROM `subject_registration_table` WHERE `std_id`='".$studenrollandid[0]."'";
			 $exdelsubsql = $db->delete_query($delsubsql);



			   $sqlinsert = "INSERT INTO `running_student_info` (`student_id`,`class_id`,`class_roll`,`group_id`,`section_id`,`datev`,`year`)VALUES('".$studenrollandid[0]."','".$_POST["tfclass_name"]."','".$studenrollandid[1]."','".$tfgroupname[0]."','Null','".date('d/m/Y')."','".date('Y')."')";
			 $db->insert_query($sqlinsert);

			 $suc=0;
		}
//print count($_POST["totalsubject"]);
		for ($x=0; $x < count($_POST["totalsubject"]); $x++) { 

			print count($_POST["totalsubject"]);

  $totalsubject=explode("and",$_POST['totalsubject'][$x]);
print "<script>alert($totalsubject);</script>";


		 $sqlsubins = "INSERT INTO `subject_registration_table`(`std_id`,`class_id`,`group_id`,`subject_id`) VALUES ('$totalsubject[0]','".$_POST["tfclass_name"]."','".$tfgroupname[0]."','".$totalsubject[1]."')";
		 			$db->insert_query($sqlsubins);
		 			$succ=0;
			}

			if($suc=0 and $succ=0){

				print  "Transfer Successfull";
			}

	}	
	

?>