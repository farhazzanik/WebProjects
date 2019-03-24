<?php
	include("db_mysql_connect_folder/dateBaseConnectionPage.php");
$select_project_info=mysql_query("SELECT `institute_name` FROM `project_info`");
$fetch_project_info=mysql_fetch_array($select_project_info);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Show Your Result</title>
<style type="text/css">
*{margin:0px; padding:0px;}
</style>
<script type="text/javascript">
//    var a = Math.ceil(Math.random() * 10);
//    var b = Math.ceil(Math.random() * 10);       
//    var c = a + b
//    function DrawBotBoot()
//    {
//        document.write("What is "+ a + " + " + b +"? ");
//       // document.write("<input id='BotBootInput' type='text' maxlength='2' size='2'/>");
//    }    
//    function ValidBotBoot(){
//        var d = document.getElementById('BotBootInput').value;
//        if (d != c) return false;        
//        return false;
//        
//    }
    </script>
</head>

<body style="background:#eee">
<div style="background:#FFFFFF; width:720px; height:auto; margin:auto; margin-top:7px;">
<form name="showResult" method="post" action="result.php">

<p>&nbsp;</p>
<table width="589" height="226" border="0" align="center" cellpadding="0" cellspacing="0" style="border:#494949 2px solid; margin:auto;">
  <tbody>
    <tr>
      <td height="64" colspan="5" align="center" style="border-bottom:1px solid;"><h2>Chhagalnaiya Mohila College</h2></td>
    </tr>
    
    <tr>
      <td width="47">&nbsp;</td>
      <td width="185"><strong>Class</strong></td>
      <td width="28" align="center"><h4>:</h4></td>
      <td width="234"><select name="class" required id="class" style="width:200px; height:30px;">
        <option>Select One</option>
        <?php
		  $select_class=mysql_query("SELECT `Class_Name` FROM `class_add`");
		  while($fetch_class=mysql_fetch_array($select_class))
		  {?>
		  <option><?php echo $fetch_class["Class_Name"] ?></option>
		 <?php
		  }
		  ?>
      </select></td>
      <td width="51">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><strong>Exam Type</strong></td>
      <td align="center"><h4>:</h4></td>
      <td><select name="examType" required id="examType" style="width:200px; height:30px;">
      <?php
	  $select_examType=mysql_query("SELECT `exam_type` FROM `exam_type_info`");
	  while($fetch_examinfo=mysql_fetch_array($select_examType))
	  {?>
      
      <option><?php echo $fetch_examinfo["exam_type"] ?></option>
	 <?php
	  }
	  ?>
</select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><strong>Session</strong></td>
      <td align="center"><h4>:</h4></td>
      <td><select name="session" required id="session" style="width:200px; height:30px;">
        <option><?php echo $year ?></option>
 
      	  <?php 
			$y=date('Y');
			$previous=$y-10;
			for($year=$y;$year>=$previous;$year--)
			{?>
			
			<option><?php print $year-1;?>-<?php print $year;?></option>
			
			<?php }
		?>
      </select></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="35">&nbsp;</td>
      <td><strong>Roll No</strong></td>
      <td align="center"><h4>:</h4></td>
      <td><input name="rollNo" type="text" required="required" id="rollNo" style="width:197px; height:26px;"></td>
      <td>&nbsp;</td>
    </tr>
   <!-- <tr>
      <td height="35">&nbsp;</td>
      <td>&nbsp;<b><script type="text/javascript">DrawBotBoot()</script></b></td>
      <td align="center"><h4>:</h4></td>
      <td><input name="BotBootInput" type="text" required="required" id="BotBootInput" style="width:197px; height:26px;"></td>
      <td>&nbsp;</td>
    </tr>-->
    <tr>
      <td height="40" colspan="4" align="right"><h4>
        <input type="reset" name="reset" id="reset" value="  Reset  " style="height:25px;">
        <input name="submit" type="submit" autofocus id="submit" value="  Submit  " style="height:25px;" onClick="alert(ValidBotBoot());">
      </h4></td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td align="center">Developed By: <a href="https://www.sbit.com.bd">Skill Based Information Technology (SBIT)</a></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>


</form>
