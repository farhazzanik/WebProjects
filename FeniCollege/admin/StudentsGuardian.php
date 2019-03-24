<?php
session_start();


	  require_once("../db_connect/conect.php");
	$db = new database();
	function send_msg($api_url,$from_number, $to_numbers, $text)
	{		
		$post_data = json_encode(array("from" => $from_number, "to" => $to_numbers, "text" => $text));
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type:application/json", "Accept: application/json", "Authorization: Basic am95cHVyOkNnZjN4Wk1C"));
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		
		curl_exec($ch);
		
		if($errno = curl_errno($ch)) 
		{
		    $error_message = curl_strerror($errno);
		    $error_message = "cURL error ({$errno}):\n {$error_message}";
		}
		else
			$error_message = true;
	 
		curl_close($ch);
		
		return $error_message;
		
		}
if (isset($_POST["add"])) 
{
	$type=$_POST["type"];
	$massage=$_POST["details"];

	$query1 = "SELECT * FROM project_info";
	$sql1=$db->select_query($query1);	
	$fetc=mysqli_fetch_assoc($sql1);
	$query = "SELECT running_student_info.student_id,running_student_info.class_id,student_personal_info.contact_no FROM running_student_info INNER JOIN student_personal_info ON running_student_info.student_id=student_personal_info.id WHERE running_student_info.class_id='$type' order by id asc";
	$sql=$db->select_query($query);
	if($sql)
	while($fetch = mysqli_fetch_array($sql))
		if(isset($fetch["contact_no"])&&$fetch["contact_no"]!="")
		$to_numbers[] = "+88".$fetch["contact_no"];

		// $to_numbers = array('0' => "+8801820018772",'1'=>"+8801840241895");
	if(isset($to_numbers))

	// Array ( [0] => 8801712790374 [1] => 8801711789184 )
	$from_number = $fetc["institute_name"];
	$text = $massage;
	$api_url = "http://107.20.199.106/restapi/sms/1/text/single";
	
	$mss=send_msg($api_url, $from_number, $to_numbers, $text);
	
		if ($mss) {
		echo "Send Success";
	}
	
	//////////////////////////////////////////////////////////////////////////////////
	//////////////////Do Not Modify Under Codes. Entry Prohabited/////////////////////
	//////////////////////////////////////////////////////////////////////////////////

	
	}
$query="select * from add_class";
$sql=$db->select_query($query);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Bar counchil membar information</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<form method="post" enctype="multipart/form-data" action="">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<table class="table table-bordered" style="margin-top:15px;">
			<tr>
				<td>
					<span style="font-size: 20px;">Send Massage</span>
				</td>
			</tr>
			<tr>
				<td>
					<table class=" table table-bordered" style="margin-bottom: 0px;">
						<tr>
							<td width="15%;">Type</td>
							<td>
								<select name="type" class="form-control" required="">
								<option disabled="" selected="">select one</option>
									<?php
while ($fetch=mysqli_fetch_assoc($sql))
 {
	


									?>
									<option value="<?php  echo $fetch["id"]?>"><?php echo  $fetch["class_name"]?></option>
									<?php
}
									?>
								</select>
							</td>
						</tr>
		

							<tr>
							<td width="15%;">Massage</td>
							<td>
								<textarea class="form-control" name="details" style="height:300px">
									
								</textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<?php
									if (isset($msg)) {
										echo $msg;
									}else{
										echo $db->sms;
									}
								?>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
<input type="submit" name="add" class="btn btn-success" style="width: 120px;" value="Send">
<input type="submit" name="view" class="btn btn-danger" style="width: 120px;" value="Reset">
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>




</form>
</body>
</html>