  <?php
error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{		require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	$clId=$_GET["clID"];
	$gpId=$_GET["gpna"];
	$examId=$_GET["exId"];
	$Session=$_GET["session"];
	$studentRoll=$_GET["stdRoll"];
	
	  $sql="SELECT `result`.*,`student_personal_info`.`student_name`,`father_name`,`mother_name`,`add_class`.`class_name`,`add_group`.`group_name` FROM `result`  JOIN `student_personal_info`
ON `student_personal_info`.`id`=`result`.`STD_ID` JOIN `add_class` ON `add_class`.`id`=`result`.`classId` JOIN `add_group` ON `add_group`.`id`=`result`.`GroupID`
WHERE `result`.`classId`='$clId' AND `result`.`GroupID`='$gpId' AND `result`.`examId`='$examId' AND `result`.`session`='$Session' AND `result`.`std_roll`='$studentRoll'";
	//print $sql;
	$result=$db->select_query($sql);
	if($result){
			$fetch_r=$result->fetch_array();
	}
	
	
	$select_school="select * from project_info";
$cheke_school=$db->select_query($select_school);
if($cheke_school)
{
$fetch_school_information=$cheke_school->fetch_array();
}	
?>
<meta name="Description" content="<?php echo $fetch_school_information['meta_tag'] ?>" />
		 <title><?php print $fetch_school_information['title'] ?></title>
		<link rel="shortcut icon" href="../admin/all_image/<?php echo "shortcurt_iconSDMS2015";?>.png" />
<style type="text/css">
<!--
.style3 {font-size: 18px}
.style6 {font-size: 24px; font-weight: bold; }
.style17 {font-size: 24px; font-weight: bold; }
.style21 {font-size: 20px}

-->
</style>


<style media="print">
.dont-print{display:none;}
</style>
    
<body bgcolor="#f4f4f4">
<table  width="1100"  height="1500" border="0"     align="center" cellpadding="0"  cellspacing="0" bgcolor="#fff">

  <tr>
    <td valign="top">
	
	<table height="1300" width="1100"cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="all_image/school_mark_sheetSDMS2015.jpg" height="1500" width="1100"/>
            <table width="900" height="1290" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="margin-top:-1340px; background:none; position:relative;">
              <tr>
                <td width="888" height="92" align="left" valign="bottom"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
                  
					 <tr>
                      <td width="100%" colspan="3" align="center"><span><strong style="font-size:18px;"><?php
					  	$examName = "SELECT `exam_type` FROM `exam_type_info` WHERE `exam_id`='".$fetch_r["examId"]."'";
						$resultName = $db->select_query($examName);
							if($resultName->num_rows > 0){
								$fetchName = $resultName->fetch_array();
								
							}
							$selectSession="SELECT `session2` FROM `student_acadamic_information` WHERE `id`='".$fetch_r["STD_ID"]."'";
							$ressss = $db->select_query($selectSession);
							if($ressss->num_rows > 0){
								$fetchsss = $ressss->fetch_array();
								
							}
							echo $fetchName[0].'-'.$fetchsss[0]
					  ?></strong> </span></td>
                   
                    </tr>
					  <tr>
                      <td width="10%">Student ID- </td>
                      <td width="18%" align="left"><span style="font-size:18px; letter-spacing:2px;font-weight: bold;"><?php if(isset($fetch_r)){ echo $fetch_r["STD_ID"];} else { echo "";}?></span></td>
                      <td width="73%" valign="top"></td>
                    </tr>
                </table></td>
              </tr>
             
            
             
                <td height="127" align="center"><table width="100%" height="323" border="0" cellpadding="0" cellspacing="0">
				<tr>
                      <td><span class="style21">Class Name</span></td>
                      <td><span class="style21">:</span></td>
                      <td height="39"><span class="style21"><?php if(isset($fetch_r)){ echo $fetch_r["class_name"];} else{echo "";}?></span></td>
                    </tr>
                    <tr>
                      <td width="20%"><span class="style21">Group Name </span></td>
                      <td width="2%"><span class="style21">:</span></td>
                      <td width="50%" height="40"><span class="style21">
                       <?php if(isset($fetch_r)){ echo $fetch_r["group_name"];}else{echo "";}?>
                        
                      </span></td>
                      <td width="28%" rowspan="8" align="right" valign="middle">
					  
					  
					  <table width="90%" height="276" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
                          <tr>
                            <td width="48%" align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000;">Class Interval </td>
                            <td width="27%" align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000;">Grade</td>
                            <td width="25%" align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000;  border-right:1px solid #000000;">Point</td>
                          </tr>
                          <tr>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">80 - 100 </td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">A+</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">5.00</td>
                          </tr>
                          <tr>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">70 - 79</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">A</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">4.00</td>
                          </tr>
                          <tr>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">60 - 69 </td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">A-</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">3.50</td>
                          </tr>
                          <tr>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"> 50 - 59 </td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">B</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">3.00</td>
                          </tr>
                          <tr>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">40 - 49</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">C</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">2.00</td>
                          </tr>
                          <tr>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">33 - 39</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">D</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">1.00</td>
                          </tr>
                          <tr>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">00-32</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;">F</td>
                            <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;">0.00</td>
                          </tr>
                         
                      </table></td>
                    </tr>
                    <tr>
                      <td><span class="style21">Student's Name</span></td>
                      <td><span class="style21">:</span></td>
                      <td height="39"><span class="style21"> <?php if(isset($fetch_r)){ echo $fetch_r["student_name"];}else {echo "";}?></span></td>
                    </tr>
                    <tr>
                      <td><span class="style21">Father's Name </span></td>
                      <td><span class="style21">:</span></td>
                      <td height="37"><span class="style21">  <?php if(isset($fetch_r)){ echo $fetch_r["father_name"];} else {echo "";}?> </span></td>
                    </tr>
                    <tr>
                      <td><span class="style21">Mother's Name </span></td>
                      <td><span class="style21">:</span></td>
                      <td height="42"><span class="style21">  <?php if(isset($fetch_r)){ echo $fetch_r["mother_name"];}else {echo "";}?> </span></td>
                    </tr>
                  
					
					
                    <tr>
                      <td height="29" colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="28%" height="39" class="style21">Session</td>
                            <td width="2%" class="style21">:</td>
                            <td width="23%" class="style21"> <?php if(isset($fetch_r)){ echo $fetch_r["session"];} else {echo "";}?></td>
                            <td width="13%" class="style21"> </td>
                            <td width="2%" class="style21"></td>
                            <td width="32%" class="style21"></td>
                          </tr>
                      </table></td>
                    </tr>
					
					
					  <tr>
                      <td height="29" colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="28%" height="39" class="style21">Roll No. </td>
                            <td width="2%" class="style21">:</td>
                            <td width="23%" class="style21"> <?php if(isset($fetch_r)){ echo $fetch_r["std_roll"];}else {echo "";}?></td>
                            <td width="20%" class="style21">&nbsp;</td>
                            <td width="2%" class="style21">&nbsp;</td>
                            <td width="25%" class="style21">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
					
					     <tr>
                      <td height="29" colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="28%" height="39" class="style21">Result </td>
                            <td width="2%" class="style21">:</td>
                            <td width="23%" class="style21"> 
							
							<?php if(isset($fetch_r)){ 
														if($fetch_r["CGPA"] == "0.00" ){?>
														<span><strong >FAILED</strong></span>
														<?php } else {?>
														<span><strong >PASSED</strong></span>
														<?php }
													}?>
													
							
							</td>
                            <td width="20%" class="style21">&nbsp;</td>
                            <td width="2%" class="style21">&nbsp;</td>
                            <td width="25%" class="style21">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
					
                    
                </table></td>
              </tr>
              <tr>
                <td height="436" align="center"><table width="100%" height="354" cellpadding="0" cellspacing="0">
                    <tr>
                      
                      <td width="8%" align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000;"><span class="style3">Subject Code </span></td>
                      <td width="37%" align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000;"><span class="style3">Name of Subject </span></td>
                      <td width="7%" align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000;"><span class="style3">Full Mark</span></td>
                      <td width="9%" align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000;"><span class="style3">Marks Obtained </span></td>
                      <td width="9%" align="center"style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000;"><span class="style3">Letter Grade </span></td>
                      <td width="10%" align="center"style="border-bottom:1px solid #000000; border-left:1px solid #000000;border-top:1px solid #000000;"><span class="style3">Grade Point (GP) </span></td>
                      <td width="10%" align="center"style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000;"><span class="style3">GPA (WithOut Optional) </span></td>
					   <td width="12%" align="center"style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;border-top:1px solid #000000;"><span class="style3">GPA</span></td>
                    </tr>
                   <?php 
				   
			   $ssssssubMarksheet="SELECT `gnerate_marks`.*,`add_subject_info`.`subject_name`,`subject_code` FROM `gnerate_marks`
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`gnerate_marks`.`subjectID` WHERE `gnerate_marks`.`ClassID`='$clId' 
AND `gnerate_marks`.`ExamID`='$examId'
AND `gnerate_marks`.`GroupID`='$gpId' AND `gnerate_marks`.`session`='$Session' AND `gnerate_marks`.`studentID`='$fetch_r[STD_ID]' AND 
`gnerate_marks`.`studentRoll`='$fetch_r[std_roll]' AND `add_subject_info`.`select_subject_type`='OptionalSubject' ORDER BY `add_subject_info`.`subject_code` ASC ";	
						$sssssresuMarksheet=$db->select_query($ssssssubMarksheet);
						//print $sssssresuMarksheet->num_rows;
						
				   
				   	$fstnumrows="SELECT `gnerate_marks`.*,`add_subject_info`.`subject_name`,`subject_code` FROM `gnerate_marks`
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`gnerate_marks`.`subjectID` WHERE `gnerate_marks`.`ClassID`='$clId' 
AND `gnerate_marks`.`ExamID`='$examId'
AND `gnerate_marks`.`GroupID`='$gpId' AND `gnerate_marks`.`session`='$Session' AND `gnerate_marks`.`studentID`='$fetch_r[STD_ID]' AND 
`gnerate_marks`.`studentRoll`='$fetch_r[std_roll]' AND `add_subject_info`.`select_subject_type`='GroupSubject' ORDER BY `add_subject_info`.`subject_code` ASC ";	
						$fstresult=$db->select_query($fstnumrows);
						
						//print $fstresult->num_rows ;
				   
				   
				   
				   
				   
				   
				   	print	$subMarksheet="SELECT `gnerate_marks`.*,`add_subject_info`.`subject_name`,`subject_code` FROM `gnerate_marks`
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`gnerate_marks`.`subjectID` WHERE `gnerate_marks`.`ClassID`='$clId' 
AND `gnerate_marks`.`ExamID`='$examId'
AND `gnerate_marks`.`GroupID`='$gpId' AND `gnerate_marks`.`session`='$Session' AND `gnerate_marks`.`studentID`='$fetch_r[STD_ID]' AND 
`gnerate_marks`.`studentRoll`='$fetch_r[std_roll]' AND `add_subject_info`.`select_subject_type`='CompulsorySubject' ORDER BY `add_subject_info`.`subject_code` ASC ";	
						$resuMarksheet=$db->select_query($subMarksheet);
						
						//print $resuMarksheet->num_rows;
						
						 $rowspant = $sssssresuMarksheet->num_rows+$fstresult->num_rows+$resuMarksheet->num_rows;
						if($resuMarksheet){
							$sl=0;
							$c=0;
							//$count = $resuMarksheet->num_rows;
							
								while($fetchShet=$resuMarksheet->fetch_array()){
				   		$sl++;
				  
					
                  
			 				if($c==0)
							{
							
						
				 ?>
                    <tr>
                      
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["subject_code"];?></td>
                      <td align="left" style="border-bottom:1px solid #000000; border-left:1px solid #000000; padding-left:10px;"><?php echo $fetchShet["subject_name"];?>&nbsp;&nbsp;</td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["fullMarks"];?></td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["obtainMarks"];?></td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["letterGrade"];?></td>
                      <td align="center"style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["gradePoint"];?></td>
                      <td  rowspan="<?php echo $rowspant;?>" align="center"style="border-bottom:1px solid #000000; border-left:1px solid #000000; "><span class="style17"><?php echo $fetch_r["witoutOptional"];?> </span></td>
					  <td    rowspan="<?php echo $rowspant;?>" align="center"style="border-bottom:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000;"><span class="style17"><?php echo $fetch_r["CGPA"];?>  </span></td>
                    </tr>
                    <?php }
									else
									{ 
							?>
                    <tr>
                     
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["subject_code"];?></td>
                      <td align="left" style="border-bottom:1px solid #000000; border-left:1px solid #000000; padding-left:10px;"><?php echo $fetchShet["subject_name"];?>&nbsp;&nbsp;</td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["fullMarks"];?></td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["obtainMarks"];?></td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["letterGrade"];?></td>
                      <td align="center"style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["gradePoint"];?></td>
                    </tr>
                    <?php
								
									}
							$c++;
                    } } ?>
                   	
					 <?php 
				   		$subMarksheet="SELECT `gnerate_marks`.*,`add_subject_info`.`subject_name`,`subject_code` FROM `gnerate_marks`
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`gnerate_marks`.`subjectID` WHERE `gnerate_marks`.`ClassID`='$clId' 
AND `gnerate_marks`.`ExamID`='$examId'
AND `gnerate_marks`.`GroupID`='$gpId' AND `gnerate_marks`.`session`='$Session' AND `gnerate_marks`.`studentID`='$fetch_r[STD_ID]' AND 
`gnerate_marks`.`studentRoll`='$fetch_r[std_roll]' AND `add_subject_info`.`select_subject_type`='GroupSubject' ORDER BY `add_subject_info`.`subject_code` ASC ";	
						$resuMarksheet=$db->select_query($subMarksheet);
						if($resuMarksheet){
							$sl=0;
							$c=0;
							//$count = $resuMarksheet->num_rows;
							
								while($fetchShet=$resuMarksheet->fetch_array()){
				   		$sl++;
				  
					
                  
			 				if($c==0)
							{
							
						
				 ?>
				 
				 
				 
				 
				 
                    <tr>
                      
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["subject_code"];?></td>
                      <td align="left" style="border-bottom:1px solid #000000; border-left:1px solid #000000; padding-left:10px;"><?php echo $fetchShet["subject_name"];?>&nbsp;&nbsp;</td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["fullMarks"];?></td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["obtainMarks"];?></td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["letterGrade"];?></td>
                      <td align="center"style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["gradePoint"];?></td>
                     
                    </tr>
                    <?php }
									else
									{ 
							?>
                    <tr>
                      
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["subject_code"];?></td>
                      <td align="left" style="border-bottom:1px solid #000000; border-left:1px solid #000000; padding-left:10px;"><?php echo $fetchShet["subject_name"];?>&nbsp;&nbsp;</td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["fullMarks"];?></td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["obtainMarks"];?></td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["letterGrade"];?></td>
                      <td align="center"style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["gradePoint"];?></td>
                    </tr>
                    <?php
								
									}
							$c++;
                    } } ?>
					
					
					
					 <?php 
				   		$subMarksheet="SELECT `gnerate_marks`.*,`add_subject_info`.`subject_name`,`subject_code` FROM `gnerate_marks`
INNER JOIN `add_subject_info` ON `add_subject_info`.`id`=`gnerate_marks`.`subjectID` WHERE `gnerate_marks`.`ClassID`='$clId' 
AND `gnerate_marks`.`ExamID`='$examId'
AND `gnerate_marks`.`GroupID`='$gpId' AND `gnerate_marks`.`session`='$Session' AND `gnerate_marks`.`studentID`='$fetch_r[STD_ID]' AND 
`gnerate_marks`.`studentRoll`='$fetch_r[std_roll]' AND `add_subject_info`.`select_subject_type`='OptionalSubject' ORDER BY `add_subject_info`.`subject_code` ASC ";	
						$resuMarksheet=$db->select_query($subMarksheet);
						if($resuMarksheet){
							$sl=0;
							$c=0;
							//$count = $resuMarksheet->num_rows;
							
								while($fetchShet=$resuMarksheet->fetch_array()){
				   		$sl++;
				  
					
                  
			 				if($c==0)
							{
							
						
				 ?>
				 
				 
				 
				 
				 
                    <tr>
                     
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["subject_code"];?></td>
                      <td align="left" style="border-bottom:1px solid #000000; border-left:1px solid #000000; padding-left:10px;"><?php echo $fetchShet["subject_name"];?>&nbsp;&nbsp;</td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["fullMarks"];?></td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["obtainMarks"];?></td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["letterGrade"];?></td>
                      <td align="center"style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["gradePoint"];?></td>
                     
                    </tr>
                    <?php }
									else
									{ 
							?>
                    <tr>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php print $sl;?></td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["subject_code"];?></td>
                      <td align="left" style="border-bottom:1px solid #000000; border-left:1px solid #000000; padding-left:10px;"><?php echo $fetchShet["subject_name"];?>&nbsp;&nbsp;</td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["fullMarks"];?></td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["obtainMarks"];?></td>
                      <td align="center" style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["letterGrade"];?></td>
                      <td align="center"style="border-bottom:1px solid #000000; border-left:1px solid #000000;"><?php echo $fetchShet["gradePoint"];?></td>
                    </tr>
                    <?php
								
									}
							$c++;
                    } } ?>
					
					
                   	
								
              
                </table></td>
              </tr>
              <tr>
                <td height="211" align="center" valign="bottom">
				<table width="100%" height="33%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:-130px;">
                    <tr>
                      <td width="50%" height="57" valign="top"><strong><p> --------------------</p>Compared by</span></strong></td>
                      <td width="23%" align="center" valign="top">
                       </td>
                      
                      <td width="24%" align="center" valign="top"><strong><p> -------------------------</p>
                        Headmaster </strong></td>
                    </tr>
                </table>
				</td>
              </tr>
            </table>
</td>
      </tr>
    </table>
	

</body>

<center>

<input type="button" value="Print" onClick="window.print()" class="dont-print" style="margin-top:100px; width:150px; height:40px; text-align:center;">
</center>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

