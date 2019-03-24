<?php
    error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{	
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	  $sqlForTest="SELECT `boardexamresult`.*,`student_personal_info`.`student_name`,`father_name`,`mother_name`,gender,`date_of_brith`,
`student_address_info`.`permanent_house_name`,`permanent_village`,`permanent_PO`,`permanent_post_code`,`permanent_upazila`,
`permanent_distric`,`distributedtestomoniallist`.* FROM `boardexamresult` JOIN `student_personal_info` ON `student_personal_info`.`id`=`boardexamresult`.`StudentId`
 JOIN `student_address_info` ON `student_address_info`.`id`=`boardexamresult`.`StudentId` INNER JOIN `distributedtestomoniallist`
 ON `distributedtestomoniallist`.`studentId`=`boardexamresult`.`StudentId`  WHERE `boardexamresult`.`StudentId`='".$_GET["stdid"]."'";
	$resultForAll=$db->select_query($sqlForTest);
		if($resultForAll){
				$fetchForall=$resultForAll->fetch_array();
		}
?>
<html>
	<head>
		<title>
			Testimonial
		</title>
		<style media="print">
.dont-print{display:none;}
        </style>
		<style type="text/css"> 
		
		*{padding:0px; margin:0px;}.style5 {font-size: 24px}
.style12 {font-family: "Times New Roman", Times, serif}
.style14 {font-size: 24px; font-family: "Times New Roman", Times, serif; }
        .style16 {font-size: 16px; font-weight: bold; font-family: "Times New Roman", Times, serif; }
.style17 {font-size: 16px}
        .style19 {font-size: 18px; font-weight: bold; font-family: "Times New Roman", Times, serif; }
        </style>
	</head>
	
	<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	<body>
	<center>
	<div style="width:1500px; margin-left:20px; margin-top:20px;">
	<div style="float:left; clear:right; width:480px;">
	  <table style="width:100%"  height="145" border="0" cellpadding="0" cellspacing="0" >
        <tr>
          <td height="38" colspan="3" align="center"><span style="font-size:16px; color:#000000; font-family:sans-serif">Government of the People's Repulic of Bangladesh</span><br/>
		  <span style="color:#6ABF15; font-size:16px">Office of the Principle</span> </td>
        </tr>
        <tr>
          <td width="71" height="62" align="center">&nbsp;<img src="all_image/logoSDMS2015.png" style="height:60px; width:60px"/></td>
          <td width="307" align="center">&nbsp;<span style="font-size:20px; font-weight:bold; letter-spacing:1; color:#940320; font-family:sans-serif">Feni Govt.College,Feni</span><br/>
		    <span style=" font-size:16px">Estd. - 1922</span>		  </td>
          <td width="94" align="center">&nbsp;<img src="all_image/logoSDMS2015.png" style="height:60px; width:60px"/></td>
        </tr>
        <tr>
          <td colspan="3" align="center">&nbsp; <a href="#" style="background:#011263; padding-top:10px; padding-bottom:10px; padding-left:10px; padding-right:10px; border-radius:20px; font-size:18px; letter-spacing:2; color:#FFFFFF; font-weight:bold; font-family:sans-serif; text-decoration:none "><strong>Testimonial </strong></a></td>
        </tr>
      </table>
	  <table style="width:100%"  height="44" border="0" cellpadding="0" cellspacing="0">
	  	<tr>
			<td width="49%" height="42"><span style="font-size:16px; padding-left:5px;">No -&nbsp;<?php
					if(isset($fetchForall)){
						echo $fetchForall["StudentId"];
					}
					else {
						echo "";
					}
			?></span></td>
			<td width="8%"></td>
			<td width="13%"><span style="font-size:16px; padding-left:5px;">Date : </span></td>
			<td width="49%"><span style="padding-left:5px;">
			<?php
					if(isset($fetchForall)){
						echo $fetchForall["date"];
					}
					else {
						echo "";
					}
			?>
			</span></td>
		</tr>
  </table>
  
	  <table style="width:100%"  height="462" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="41%" height="50"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i>&nbsp;Name Of the student</i></span></td>
					<td width="59%"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i><?php
					if(isset($fetchForall)){
						echo $fetchForall["student_name"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
				
				<tr>
					<td width="41%" height="39"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i>&nbsp;Father's Name</i></span></td>
					<td width="59%">
					<span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i>
					<?php
					if(isset($fetchForall)){
						echo $fetchForall["father_name"];
					}
					else {
						echo "";
					}
			?>
			</i></span>
			
			
					</td>
			
				</tr>  
				
				<tr>
					<td width="41%" height="41"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i>&nbsp;Mother's Name </i></span></td>
					<td width="59%">
				<span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i>	<?php
					if(isset($fetchForall)){
						echo $fetchForall["mother_name"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
				<tr>
					<td width="41%" height="46"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"><i>&nbsp;Name of the Examinition </i></span></td>
					<td width="59%">		<span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i><?php
					if(isset($fetchForall)){
						echo $fetchForall["Title"].'Examinition';
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
				<tr>
					<td width="41%" height="46"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i>&nbsp;Year </i></span></td>
					<td width="59%"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i>	<?php
					if(isset($fetchForall)){
						echo $fetchForall["year"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
				<tr>
					<td width="41%" height="41"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i>&nbsp;  <?php
	  		if($fetchForall["Title"]=='HSC')
			{
	  ?>
	  Group Name 
	  <?php } else {?>Honours Subject <?php  } ?> </i></span></td>
					<td width="59%"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i><?php
					if(isset($fetchForall)){
						echo $fetchForall["GroupName"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
			
	  
				<tr>
					<td width="41%" height="44"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i>&nbsp;Examinition Roll No. </i></span></td>
					<td width="59%"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i><?php
					if(isset($fetchForall)){
						echo $fetchForall["RollNo"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
	
				<tr>
					<td width="41%" height="42"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i>&nbsp;Reg No. </i></span></td>
					<td width="59%"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i><?php
					if(isset($fetchForall)){
						echo $fetchForall["RegNo"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
				
				<tr>
					<td width="41%" height="48"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i>&nbsp;Session. </i></span></td>
					<td width="59%"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i><?php
					if(isset($fetchForall)){
						echo $fetchForall["Session"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
				
				<tr>
					<td width="41%" height="63"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i>&nbsp;Result : C.G.P.A </i></span></td>
					<td width="59%"><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:14px;"><i><?php
					if(isset($fetchForall)){
						echo $fetchForall["GPA"];
					}
					else {
						echo "";
					}
			?></i></span></td>
			
				</tr>  
	  </table>
	  
	  </div>
	  <div style="float:left; margin-left:5px; width:990px; ">
	  <?php
	  		if($fetchForall["Title"]=='HSC')
			{
	  ?>

		
		
	  <img src="all_image/testimonialSDMS2015.jpg" height="850" width="900"/>
	   <table width="900" height="700" border="0"  style="margin-top:-850px; background:none; position:relative; margin-left:120px; "  cellpadding="0" cellspacing="0" >
        <tr>
          <td height="308" colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td height="237" colspan="3"><p style="text-align:justify"><i><span style="padding-left:5px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;">Certified   &nbsp;&nbsp;that &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php
					if(isset($fetchForall)){
						echo $fetchForall["student_name"];
					}
					else {
						echo "";
					}
			?>   </span><br/><br/>
		<span  style="padding-left:10px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;"> Son/Daughter of &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php
					if(isset($fetchForall)){
						echo $fetchForall["father_name"];
					}
					else {
						echo "";
					}
			?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; and &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		<?php
					if(isset($fetchForall)){
						echo $fetchForall["mother_name"];
					}
					else {
						echo "";
					}
			?>
		</span><br/><br/>
		<span   style="padding-left:10px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px; word-spacing:9px;">was a student of <?php
					if(isset($fetchForall)){
						echo $fetchForall["Title"];
					}
					else {
						echo "";
					}
			?>  Classes this College 
		during the academic session <?php
					if(isset($fetchForall)){
						echo $fetchForall["Session"];
					}
					else {
						echo "";
					}
			?>.</span><br/><br/>
		 
		<span   style="padding-left:10px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px; word-spacing:9px;">
		<?php
				if( $fetchForall["gender"] == "Male")
				{
					echo "He";
				}
				else {
					echo "She";
				}
		?>
			
			
		 passed the  <?php
					if(isset($fetchForall)){
						echo $fetchForall["Title"];
					}
					else {
						echo "";
					}
			?> Examination of the Board of intermediate and secondery <br/><br/>education, Comilla in  <?php
					if(isset($fetchForall)){
						echo $fetchForall["year"];
					}
					else {
						echo "";
					}
			?> bearing Roll Feni-1,No  <?php
					if(isset($fetchForall)){
						echo $fetchForall["RollNo"];
					}
					else {
						echo "";
					}
			?> and Registrantion No  <?php
					if(isset($fetchForall)){
						echo $fetchForall["RegNo"];
					}
					else {
						echo "";
					}
			?> <br/><br/>
	<span   style="padding-left:10px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px; word-spacing:9px;"  >of session  <?php
					if(isset($fetchForall)){
						echo $fetchForall["Session"];
					}
					else {
						echo "";
					}
			?>	in  <?php
					if(isset($fetchForall)){
						echo $fetchForall["GroupName"];
					}
					else {
						echo "";
					}
			?>	 group and Secured CGPA   <?php
					if(isset($fetchForall)){
						echo $fetchForall["GPA"];
					}
					else {
						echo "";
					}
			?>	  in the scale <br/><br/> of GPA 5.00.<br/><br/>
		 
		 <span style="padding-left:10px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px; word-spacing:9px;">To the best of knowladge,<?php
				if( $fetchForall["gender"] == "Male")
				{
					echo "He";
				}
				else {
					echo "She";
				}
		?> bears a good moral character.So far as I know <br/><br/> <?php
			if( $fetchForall["gender"] == "Male")
				{
					echo "He";
				}
				else {
					echo "She";
				}
		?>
		
		
	did not take part in any activities ,
		 subversive of the sate of college discipline.</span><br/><br/>
		 <span style="padding-left:10px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px; word-spacing:9px">I wish
		  <?php
			if( $fetchForall["gender"] == "Male")
				{
					echo "him";
				}
				else {
					echo "her";
				}
		?>
		
		
		  every success in life.</span></i></p></td>
        </tr>
        <tr>
          <td width="123" height="217">&nbsp;</td>
          <td width="335">&nbsp;</td>
          <td width="510">&nbsp;</td>
        </tr>
      </table>
	  
	 
	  <?php } else {?>  <img src="all_image/testimonialSDMS2015.jpg" height="850" width="900"/>
	   <table width="900" height="700" border="0"  style="margin-top:-850px; background:none; position:relative; margin-left:120px; "  cellpadding="0" cellspacing="0" >
        <tr>
          <td height="308" colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td height="237" colspan="3" style="text-align:justify"><i><span style="padding-left:10px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;">Certified   &nbsp;&nbsp;that &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php
					if(isset($fetchForall)){
						echo $fetchForall["student_name"];
					}
					else {
						echo "";
					}
			?>  </span><br/><br/>
		<span  style="padding-left:10px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px; word-spacing:9px;"> Father's Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
					if(isset($fetchForall)){
						echo $fetchForall["father_name"];
					}
					else {
						echo "";
					}
			?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mother's Name&nbsp;&nbsp;&nbsp; <?php
					if(isset($fetchForall)){
						echo $fetchForall["mother_name"];
					}
					else {
						echo "";
					}
			?> </span><br/><br/>
		<span   style="padding-left:10px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px; word-spacing:9px;">was a student of  <?php
					if(isset($fetchForall)){
						echo $fetchForall["Title"];
					}
					else {
						echo "";
					}
			?>  Class in <?php
					if(isset($fetchForall)){
						echo $fetchForall["GroupName"];
					}
					else {
						echo "";
					}
			?>  department 
		<span  style="padding-left:10px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px; word-spacing:9px;"> of this college during the <br/><br/>academic session <?php
					if(isset($fetchForall)){
						echo $fetchForall["Session"];
					}
					else {
						echo "";
					}
			?> .</span><br/><br/>
		  
		<span   style="padding-left:10px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px; word-spacing:9px;"> <?php
			if( $fetchForall["gender"] == "Male")
				{
					echo "He";
				}
				else {
					echo "She";
				}
		?>
		
		 passed <?php
					if(isset($fetchForall)){
						echo $fetchForall["Title"];
					}
					else {
						echo "";
					}
			?>   Examination of the National University in <?php
					if(isset($fetchForall)){
						echo $fetchForall["year"];
					}
					else {
						echo "";
					}
			?>  bearing <br/><br/>
	<span   style="padding-left:10px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px; word-spacing:9px;" >	 Roll No  <?php
					if(isset($fetchForall)){
						echo $fetchForall["RollNo"];
					}
					else {
						echo "";
					}
			?>
			and Registration No   <?php
					if(isset($fetchForall)){
						echo $fetchForall["RegNo"];
					}
					else {
						echo "";
					}
			?>  and Secured CGPA    <?php
					if(isset($fetchForall)){
						echo $fetchForall["GPA"];
					}
					else {
						echo "";
					}
			?>  (out of 4).<br/><br/>
		 
		 <span style="padding-left:10px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;">To the best of knowladge, <?php
			if( $fetchForall["gender"] == "Male")
				{
					echo "he";
				}
				else {
					echo "she";
				}
		?> bears a good moral character.So far as I know <?php
			if( $fetchForall["gender"] == "Male")
				{
					echo "he";
				}
				else {
					echo "she";
				}
		?> did <br/><br/>not take part in any activities ,
		 subversive of the sate of college discipline.</span><br/><br/>
		 <span style="padding-left:10px;font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:16px;">I wish <?php
			if( $fetchForall["gender"] == "Male")
				{
					echo "him";
				}
				else {
					echo "her";
				}
		?> every success in life.</span></i></td>
        </tr>
        <tr>
          <td width="123" height="217">&nbsp;</td>
          <td width="335">&nbsp;</td>
          <td width="510">&nbsp;</td>
        </tr>
      </table>
	  
	  
	  <?php } ?>
	  </div>
</div>
<p>&nbsp;</p>
	</center>
</html>
</body>
        	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>


