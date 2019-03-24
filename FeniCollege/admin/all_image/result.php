<?php
	include("db_mysql_connect_folder/dateBaseConnectionPage.php");

$select_project_info=mysql_query("SELECT `institute_name` FROM `project_info`");
$fetch_project_info=mysql_fetch_array($select_project_info);

if(isset($_POST["submit"]))
{
	$class=mysql_escape_string($_POST["class"]);	
	$examType=mysql_escape_string($_POST["examType"]);	
	$session=mysql_escape_string($_POST["session"]);	
	$rollNo=mysql_escape_string($_POST["rollNo"]);
	
	if(!empty($class) && !empty($examType) && !empty($session) && !empty($rollNo))
	{
		$select_student=mysql_query("SELECT `GPA` FROM  `students_gpa` WHERE `Class`='$class' AND `Class_roll`='$rollNo' AND `Exam_type`='$examType' AND `Year`='$session'");
		if(mysql_affected_rows()>0)
		{
			$fetch_studentGP=mysql_fetch_array($select_student);
			$result="Your GPA = $fetch_studentGP[GPA]";
		}
		else
		{
			$message="<span style='color:red; font-size:18px;'>RESULT NOT FOUND!</span>";	
		}
	}
	else
	{
		print "<script>alert('Please Fill Up All Information.')</script>";	
	}
	
}
?>
<form name="result" method="post" >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td height="40" align="center"><h1>Chhagalnaiya Mohila College</h1></td>
    </tr>
  </tbody>
</table>

<table width="794" border="0" align="center" cellpadding="0" cellspacing="1" style="margin:auto;">
  <tbody>
    <tr>
      <td height="37" colspan="4" align="center" style=" border-bottom:2px #2E2C2C solid;"><h2><?php echo $examType; ?> (<?php echo $session;  ?>)</h2><h4><strong><?php echo $class ?></strong></h4></td>
    </tr>
    <tr>
      <td height="24">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <?php
		$select_student_result=mysql_query("SELECT * FROM `result` WHERE `Roll`='$rollNo' AND `Session`='$session' AND `Class`='$class' AND `Exam_Type`='$examType'");
		
		if(mysql_affected_rows()>0)
		{
			$fetch=mysql_fetch_array($select_student_result);
			$select_student_info=mysql_query("SELECT * FROM `student_infomation` WHERE `studentID`='$fetch[STD_ID]' AND `roll`='$rollNo'");
			$fetch_student_info=mysql_fetch_array($select_student_info);
	?>
    <tr>
      <td width="12%" height="24" bgcolor="#EEEEEE">&nbsp;&nbsp;Student ID</td>
      <td width="27%" bgcolor="#EEEEEE">&nbsp;&nbsp;<?php echo $fetch["STD_ID"] ?></td>
      <td width="22%" bgcolor="#EEEEEE">&nbsp;&nbsp;Name</td>
      <td width="39%" bgcolor="#EEEEEE">&nbsp;&nbsp;<?php echo $fetch["Name"] ?></td>
    </tr>
    <tr>
      <td height="24" bgcolor="#EEEEEE">&nbsp;&nbsp;Roll No</td>
      <td bgcolor="#EEEEEE">&nbsp;&nbsp;<?php echo $fetch["Roll"] ?></td>
      <td bgcolor="#EEEEEE">&nbsp;&nbsp;Father's Name</td>
      <td bgcolor="#EEEEEE">&nbsp;&nbsp;<?php echo $fetch_student_info["fathersName"] ?></td>
    </tr>
    <tr>
      <td height="24" bgcolor="#EEEEEE">&nbsp;&nbsp;Group</td>
      <td bgcolor="#EEEEEE">&nbsp;&nbsp;<?php echo $fetch["Group"] ?></td>
      <td bgcolor="#EEEEEE">&nbsp;&nbsp;Mother's Name</td>
      <td bgcolor="#EEEEEE">&nbsp;&nbsp;<?php echo $fetch_student_info["mothersName"] ?></td>
    </tr>
    <tr>
      <td height="24" bgcolor="#EEEEEE">&nbsp;&nbsp;GPA</td>
      <td bgcolor="#EEEEEE"><b>&nbsp;&nbsp;<?php  if($fetch["Total_GPA"]!="0.00"){echo $fetch["Total_GPA"]; }else{echo "<span style='color:RED;'>Fail</span>"; } ?></b></td>
      <td bgcolor="#EEEEEE">&nbsp;&nbsp;GPA(Without Optional)</td>
      <td bgcolor="#EEEEEE"><b>&nbsp;&nbsp;<?php echo $fetch["GPAWithOutOptional"] ?></b></td>
    </tr>
    
    
    <?php
		}
		else
		{ ?>
			<tr>
              <td colspan="3" bgcolor="#EEEEEE" align="center" style="color:red; font-size:18px;"><?php print "No Result Found!!!" ?></td>
            </tr>
            <tr>
              <td colspan="3" bgcolor="#EEEEEE" align="center" style="color:red; font-size:18px;"><a href="showResult.php">Go Back</a></td>
            </tr>
		<?php }
	?>
  </tbody>
</table>




<?php
		$select_student_result=mysql_query("SELECT * FROM `result` WHERE `Roll`='$rollNo' AND `Session`='$session' AND `Class`='$class' AND `Exam_Type`='$examType'");
		if(mysql_affected_rows()>0)
		{
			$fetch=mysql_fetch_array($select_student_result);
			
	?>

<table width="793" border="0" align="center" cellpadding="0" cellspacing="1" style="margin:auto;">
  <tbody>
    <tr>
      <td height="44" colspan="3" align="center" style="margin:auto; "><h2 style="border-bottom:2px solid;"><strong>Subject-Wise Grade/ Mark Sheet</strong></h2></td>
    </tr>
    <tr>
      <td width="70" height="32" bgcolor="#AFB7BE">&nbsp;Code</td>
      <td width="407" bgcolor="#AFB7BE">&nbsp;Subject</td>
      <td width="227" bgcolor="#AFB7BE">&nbsp;Grade</td>
    </tr>
    <?php
		$select_subject=mysql_query("SELECT * FROM `marksheet` WHERE `Student_id`='$fetch[STD_ID]' AND `Exam_type`='$examType' AND `Class`='$class' AND `Year`='$session' AND `Student_roll`='$rollNo' ORDER BY `Subject_code` ASC");
		while($fetch_subjcet_mark=mysql_fetch_array($select_subject))
		{
				$count++;
		?>
		<tr>
		<?php 
		$color=$count%2;
		if($color==0){
			
			
		?>
		  <td height="25" <?php if($fetch_subjcet_mark['Letter_grade']=="F"){ ?> bgcolor="#FF0004" style="color:#FFFFFF"<?php } else{ ?>bgcolor="#EEEEEE"<?php } ?>>&nbsp;&nbsp;<?php print $fetch_subjcet_mark['Subject_code']; ?></td>
	      <td height="25" <?php if($fetch_subjcet_mark['Letter_grade']=="F"){ ?> bgcolor="#FF0004" style="color:#FFFFFF"<?php } else{ ?>bgcolor="#EEEEEE"<?php } ?>>&nbsp;&nbsp;<?php print $fetch_subjcet_mark['Subject_name']; ?></td>
		  <td height="25" <?php if($fetch_subjcet_mark['Letter_grade']=="F"){ ?> bgcolor="#FF0004" style="color:#FFFFFF"<?php } else{ ?>bgcolor="#EEEEEE"<?php } ?>>&nbsp;&nbsp;<?php print $fetch_subjcet_mark['Letter_grade']; ?></td>
		  <?php
		}
		else
		{
		  ?>
          <td height="25" <?php if($fetch_subjcet_mark['Letter_grade']=="F"){ ?> bgcolor="#FF0004" style="color:#FFFFFF"<?php } else{ ?>bgcolor="#DEE1E4"<?php } ?>>&nbsp;&nbsp;<?php print $fetch_subjcet_mark['Subject_code']; ?></td>
	      <td height="25" <?php if($fetch_subjcet_mark['Letter_grade']=="F"){ ?> bgcolor="#FF0004" style="color:#FFFFFF"<?php } else{ ?>bgcolor="#DEE1E4"<?php } ?>>&nbsp;&nbsp;<?php print $fetch_subjcet_mark['Subject_name']; ?></td>
             <td height="25" <?php if($fetch_subjcet_mark['Letter_grade']=="F"){ ?> bgcolor="#FF0004" style="color:#FFFFFF"<?php } else{ ?>bgcolor="#DEE1E4"<?php } ?>>&nbsp;&nbsp;<?php print $fetch_subjcet_mark['Letter_grade']; ?></td>
		</tr>
   	 <?php
		}
	}
	?>
  </tbody>
</table>
<div style="margin:auto; padding-left:600px;">
<p ><input type="button" name="Print" value="PRINT" onClick="window.print()"></p>
</div>
 <?php
		}
		?>
</div>

<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td align="center" bgcolor="#C4C4C4">Developed By: <a href="https://www.sbit.com.bd">Skill Based Information Technology (SBIT)</a></td>
    </tr>
  </tbody>
</table>

</form>
<p>&nbsp;</p>
</body>
</html>