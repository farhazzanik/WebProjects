 <?php
    error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{	
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	
		$sqlforTitle="SELECT * FROM `project_info`";
	$chke=$db->select_query($sqlforTitle);
	if($chke){
			$fetch_tiitle=$chke->fetch_array();
	}
	
	if($_GET["date"] != "" && $_GET["stdid"]!="" ){
	  $inserSql="REPLACE INTO `distributedtestomoniallist` (`date`,`studentId`) VALUES ('".date('d/m/Y')."','".$_GET["stdid"]."')";
														$resultsql=$db->update_query($inserSql);
														
	}
	  $sqlForTest="SELECT `statictestomonialinfo`.*,`distributedtestomoniallist`.* FROM `statictestomonialinfo`
INNER JOIN `distributedtestomoniallist` ON `distributedtestomoniallist`.`studentId`=`statictestomonialinfo`.`boardResultID`
WHERE `statictestomonialinfo`.`boardResultID`='".$_GET["stdid"]."'";
	$resultForAll=$db->select_query($sqlForTest);
		if($resultForAll){
				$fetchForall=$resultForAll->fetch_array();
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Testimonial</title>


<style type="text/css">
*{padding:0px; margin:0px;}
body{font-family: "Times New Roman", Times, serif; font-size:18px;}


</style>
</head>
<body>
<div style="height:765px; width:1080px; background-image:url(all_image/THR-0002.jpg); background-repeat: no-repeat; margin:15px;">
  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="6%" height="53">&nbsp;</td>
      <td width="87%">&nbsp;</td>
      <td width="7%">&nbsp;</td>
    </tr>
    <tr>
      <td height="160">&nbsp;</td>
      <td><table width="99%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="18%" rowspan="5" align="center"><img src="all_image/gov.jpg" /></td>
          <td width="65%" align="center" height="10"><span style="color:#990000; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold; letter-spacing:1px;">Government of the People's Republic of Bangladesh</span> </td>
          <td width="17%" rowspan="5" align="center"><img src="all_image/logoSDMS2015.png" /></td>
        </tr>
        <tr>
          <td align="center" height="12"><span style="color:#006600; font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; letter-spacing:1px;">Office of the Principal</span> </td>
          </tr>
        <tr>
          <td align="center" height="22"><span style="color:#990000; font-family:Arial, Helvetica, sans-serif; font-size:40px; font-weight:bold; letter-spacing:1px;">Feni Govt. College, Feni </span></td>
          </tr>
        <tr>
          <td height="27"  align="center" valign="top"><span style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; letter-spacing:1px;">Estd.- 1922 </span></td>
          </tr>
        <tr>
          <td rowspan="2" align="center"> <span style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:26px; font-weight:bold; letter-spacing:1px; background:#482257; color:#FFFFFF; padding:10px; border-radius:15px;">Testimonial </span></td>
          </tr>
        <tr>
          <td height="35" align="left" valign="bottom"> &nbsp;&nbsp;Sl. No. : <?php
					if(isset($fetchForall)){
						echo $fetchForall["boardResultID"];
					}
					else {
						echo "";
					}
			?> </td>
          <td align="right" valign="bottom">Date : <?php
					if(isset($fetchForall)){
						echo $fetchForall["date"];
					}
					else {
						echo "";
					}
			?> </td>
        </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="385">&nbsp;</td>
      <td valign="top"><table width="100%" height="379" border="0" cellpadding="0" cellspacing="0" style="margin-left:30px;">
        <tr>
          <td>&nbsp;</td>
        </tr>
       
        <tr>
          <td> <span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:18px; letter-spacing:1px; text-align:justify; word-spacing:6px;"><i> Certified that <strong><?php
					if(isset($fetchForall)){
						echo $fetchForall["studentName"];
					}
					else {
						echo "";
					}
			?> </strong></i></span></td>
        </tr>
        <tr>
          <td><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:18px; letter-spacing:1px;word-spacing:6px;"><i> Son/Daughter of <strong><?php
					if(isset($fetchForall)){
						echo $fetchForall["fatherName"];
					}
					else {
						echo "";
					}
			?></strong> and <strong><?php
					if(isset($fetchForall)){
						echo $fetchForall["motherName"];
					}
					else {
						echo "";
					}
			?></strong></i></span></td>
        </tr>
        <tr>
          <td><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:18px; letter-spacing:1px; word-spacing:6px;"><i>was a student of<strong> <?php
					if(isset($fetchForall)){
						echo $fetchForall["Title"];
					}
					else {
						echo "";
					}
			?> </strong> Classes of this College during the academic session<strong> <?php
					if(isset($fetchForall)){
						echo $fetchForall["Session"];
					}
					else {
						echo "";
					}
			?>.</strong></i></span></td>
        </tr>
        <tr>
          <td><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:18px; letter-spacing:1px; word-spacing:9px;"><i><?php
				if( $fetchForall["gender"] == "Male")
				{
					echo "He";
				}
				else {
					echo "She";
				}
		?>	passed the<strong> <?php
					if(isset($fetchForall)){
						echo $fetchForall["Title"];
					}
					else {
						echo "";
					}
			?></strong> Examination under the Board of Intermediate and Secondary</i></span></td>
        </tr>
        <tr>
          <td><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:18px; letter-spacing:1px; word-spacing:10px;"><i>Education, Comilla in <strong><?php
					if(isset($fetchForall)){
						echo $fetchForall["year"];
					}
					else {
						echo "";
					}
			?> </strong>bearing Roll Feni-1, No.<strong> <?php
					if(isset($fetchForall)){
						echo $fetchForall["RollNo"];
					}
					else {
						echo "";
					}
			?></strong> and Registrantion No</i></span></td>
        </tr>
        <tr>
          <td><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:18px; letter-spacing:1px; word-spacing:7px;"><i><strong><?php
					if(isset($fetchForall)){
						echo $fetchForall["RegNo"];
					}
					else {
						echo "";
					}
			?> </strong>in <strong><?php
					if(isset($fetchForall)){
						echo $fetchForall["GroupName"];
					}
					else {
						echo "";
					}
			?>	 </strong>group and secured GPA <strong><?php
					if(isset($fetchForall)){
						echo $fetchForall["GPA"];
					}
					else {
						echo "";
					}
			?> </strong>on the scale of 5.00.</i></span></td>
        </tr>
        <tr>
          <td height="20">&nbsp;</td>
        </tr>
        <tr>
          <td><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:18px; letter-spacing:1px;word-spacing:5px;"><i>To the best of my knowledge <?php
				if( $fetchForall["gender"] == "Male")
				{
					echo "he";
				}
				else {
					echo "she";
				}
		?> bears a good moral character and did not take part   </i></span>
            </td>
        </tr>
		  <tr>
          <td><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:18px; letter-spacing:1px;word-spacing:5px;"><i>in any activities subversive of the state or of discipline.</i></span></td>
        </tr>
		
		
        <tr>
          <td></td>
        </tr>
        <tr>
          <td><span style="font-family:sans-serif, fantasy, monospace; padding-left:5px; font-size:18px; letter-spacing:1px;word-spacing:5px;"><i>I wish <?php
			if( $fetchForall["gender"] == "Male")
				{
					echo "him";
				}
				else {
					echo "her";
				}
		?>	every success in life.</i></span></td>
        </tr>
       
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="105">&nbsp;</td>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>...............................................</td>
          <td>&nbsp;</td>
          <td align="center">...............................................</td>
        </tr>
        <tr>
          <td width="25%" align="center"><span style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; letter-spacing:1px;">Writer</span></td>
          <td width="50%">&nbsp;</td>
          <td width="25%" align="center"><span style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; letter-spacing:1px;">Principal</span></td>
        </tr>
        <tr>
          <td align="center"></td>
          <td>&nbsp;</td>
          <td align="center"><span style="color:#000; font-family:Arial, Helvetica, sans-serif; font-size:18px;  ">Feni Govt. College, Feni </span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>


</body>
</html>

	<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>