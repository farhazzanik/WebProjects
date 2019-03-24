<?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");

	$db = new database();
	global $msg;
	global $table;
	
	
	
	$fetch[1]='';
	$fetch[2]='';
	$fetch[8]='';
	$fetch[4]='';
	$fetch[3]='';
	$fetch[5]="";
	$prefix=date("y"."m"."d");
	$fetch[0]=$db->withoutPrefix('add_fee','id',"34".$prefix,'12');
	
	global $chek;

//add dat......................................
if(isset($_POST['add']))
	{
		$explode_Class[0]='';
		$explode_Class[1]='';
		$exploide_gropu[0]='';
		$exploide_gropu[1]='';
		$id = $db->escape($_POST['id']);
		$title = $db->escape($_POST['title']); 
		$detisls = $db->escape($_POST['details']);
		$amount = $db->escape($_POST['amount']);
		$durationto = $db->escape($_POST['duration1']);
		$durationfrom = $db->escape($_POST['duration2']);
		$classname=$db->escape(isset($_POST['className'])?$_POST['className']:"");
		$explode_Class=explode("and",$classname);
		//print_r($explode_Class);
		$class_section=$db->escape(isset($_POST['groupname'])?$_POST['groupname']:"");
		$exploide_gropu=explode("and",$class_section);
		$year=$db->escape($_POST['year']);
		//print_r($exploide_gropu);
		
		if(!empty($id) && !empty($year) && !empty($title) && !empty($amount))
		{
			$query="INSERT INTO `add_fee` (`id`,`title`,`details`,`amount`,`duration_to`,`duration_from`,`class_id`,`group_id`,`year`) VALUES ('".$fetch[0]."','$title','$detisls','$amount','$durationto','$durationfrom','$explode_Class[0]','$exploide_gropu[0]','$year')";
			$resultisnsert=$db->insert_query($query);
			$fetch[0]=$db->withoutPrefix('add_fee','id',"34".$prefix,'12');


		}
		else
		{
			$msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
		}
	}
	//end add data.........................
//post delete data......................................
if(isset($_POST['Delete']))
	{
		$id=$db->escape($_POST['id']);
		$query="DELETE FROM `add_fee` WHERE `id`='$id'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->withoutPrefix('add_fee','id',"34".$prefix,'12');
		print "<script>location='Add_fee.php'</script>";
		
	}
//post end delete data.........................................

//post update data..........................................
if(isset($_POST['Update']))
	{
		$explode_Class[0]='';
		$explode_Class[1]='';
		$exploide_gropu[0]='';
		$exploide_gropu[1]='';
		$id = $db->escape($_POST['id']);
		$title = $db->escape($_POST['title']); 
		$detisls = $db->escape($_POST['details']);
		$amount = $db->escape($_POST['amount']);
		$durationto = $db->escape($_POST['duration1']);
		$durationfrom = $db->escape($_POST['duration2']);
		$classname=$db->escape(isset($_POST['className'])?$_POST['className']:"");
		$explode_Class=explode("and",$classname);
		//print_r($explode_Class);
		$class_section=$db->escape(isset($_POST['groupname'])?$_POST['groupname']:"");
		$exploide_gropu=explode("and",$class_section);
		//print_r($exploide_gropu);
		$year=$db->escape($_POST['year']);
		if(!empty($id)&& !empty($year) && !empty($title) && !empty($amount))
		{
			$query="REPLACE INTO `add_fee` (`id`,`title`,`details`,`amount`,`duration_to`,`duration_from`,`class_id`,`group_id`,`year`) VALUES ('$id','$title','$detisls','$amount','$durationto','$durationfrom','$explode_Class[0]','$exploide_gropu[0]','$year')";
			$resultisnsert=$db->update_query($query);
			//print_r($query);
				$src_text=$db->escape($_GET['edit']);
		$query="SELECT `add_fee`.*,`add_class`.`id`,`class_name`,`add_group`.`id`,`group_name` FROM `add_fee` JOIN `add_class` ON `add_fee`.`class_id`=`add_class`.`id` JOIN `add_group`  ON `add_group`.`class_id`=`add_class`.`id` WHERE `add_fee`.`id`='$src_text' AND `add_class`.`id`='".$_GET["cs"]."' AND `add_group`.`id`='".$_GET["gp"]."'";
		$chek=$db->select_query($query);
		if($chek)
			{
				$fetch=$chek->fetch_array();
			}


		}
		else
		{
			$msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
		}
	}
//end post update data...........................
//view data...............................	
	if(isset($_POST['View']))
	{
		$query="select * from add_fee";
		$result=$db->select_query($query);
		if($result)
		{
			$select_class="SELECT `add_fee`.*,`add_class`.`class_name` FROM `add_fee` INNER JOIN `add_class` ON `add_class`.`id`= `add_fee`.`class_id` GROUP BY `add_fee`.`class_id` ORDER BY `add_class`.`class_name` ASC";
			$result_class=$db->select_query($select_class);
			if($result_class)
			{
				$table="<div class='col-md-10 col-md-offset-1' style='margin-top:30px'>"."<table class='table table-responsive table-hover table-bordered' align='center' style='margin-top:-20px;'>";
        $table.="<tr class='warning' >"."<td align='left' colspan='7'>"."<a href='Add_fee.php' class='btn btn-primary'>"."<span class='link text-center'>Back<span>"."</a>"."<span class='text-success' style='font-size:18px; padding-left:380px; font-weight:blod;'>ফি সমূহ</span>"."</td>"."</tr>";
		while($fetch_class=$result_class->fetch_array()){
					$table.="<tr>"."<td colspan='7' align='center'>"."<span class='text-Warning' style='font-size:15px; font-weight:blod;'>".$fetch_class[9]."</span>"."</td>"."</tr>";
					$selec_group="SELECT `add_fee`.*,`add_group`.`group_name` FROM `add_fee` INNER JOIN  `add_group` ON `add_group`.`id`=`add_fee`.`group_id` WHERE `add_fee`.`class_id`='".$fetch_class[6]."' GROUP BY `add_fee`.`group_id` ORDER BY `add_group`.`group_name` ASC";
					$result_group=$db->select_query($selec_group);
					if($result_group)
					{
					while($fetch_group=$result_group->fetch_array()){
					$table.="<tr class='info'>"."<td colspan='7' align='center'>"."<span class='text-danger' style='font-size:15px; font-weight:blod;'>".$fetch_group[9]."</span>"."</td>"."</tr>";
					$select_all="SELECT `add_fee`.* FROM `add_fee` WHERE `class_id`='".$fetch_group[6]."' AND `group_id`='".$fetch_group[7]."' ORDER BY `duration_from` DESC";
					$result_all=$db->select_query($select_all);
					
					if($result_all)
					{
						$count=mysqli_num_fields($result_all);
						while($fetch_all=$result_all->fetch_array()){
						$table.="<tr>";
						for($i=1;$i<=$count-4;$i++)
						{
							$table.="<td>".$fetch_all[$i]."</td>";
						}
						$table.="<td>".$fetch_all[8]."</td>"."<td>";
						$table.="<a href='?edit=$fetch_all[0]&gp=$fetch_all[7]&cs=$fetch_all[6]'class='btn btn-primary'onclick='return confirm_click()' style='width:80px'>Edit</a>"."</td>";
									
						$table.="</tr>";
						
						
						}
							
					}
						
						}
					
					}
					
				}
				
				$table.="</table>"."<div>";
			
			
			}
		
		}
		
		
	}

//end view data.....................................

//link edit data...................................	

	if(isset($_GET['edit']))
	{
		$src_text=$db->escape($_GET['edit']);
		$queryg="SELECT `add_fee`.*,`add_class`.`id`,`class_name`,`add_group`.`id`,`group_name` FROM `add_fee` JOIN `add_class` ON `add_fee`.`class_id`=`add_class`.`id` JOIN `add_group`  ON `add_group`.`class_id`=`add_class`.`id` WHERE `add_fee`.`id`='".$_GET["edit"]."' AND `add_class`.`id`='".$_GET["cs"]."' AND `add_group`.`id`='".$_GET["gp"]."'";
		
		$chek=$db->select_query($queryg);
		if($chek)
			{
				
				$fetch=$chek->fetch_array();
				
			}
	}
//end link edit data..........................
	//link dlt data.....................................
	if(isset($_GET['dlt']))
	{
		$linid=$db->escape($_GET['dlt']);
		$query="DELETE FROM `add_fee` WHERE `id`='$linid'";
		$delete=$db->delete_query($query);
		$fetch[0]=$db->withoutPrefix('add_fee','id',"34".$prefix,'12');
		print "<script>location='Add_fee.php'</script>";

	}
//end link delete data........................

	if(isset($_POST['Exit']))
	{
		print exit();
	}

	if(isset($_POST['Clear']))
	{
		print "<script>location='Add_fee.php'</script>";
	}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>
    
	<link rel="stylesheet" type="text/css" href="textEdit/css/style.css" />
	<link rel="stylesheet" href="textEdit/redactor/redactor.css" />
	<script type="text/javascript" src="textEdit/lib/jquery-1.9.0.min.js"></script>
	<script src="textEdit/redactor/redactor.min.js"></script>

	  <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">

   
     <script src="datespicker/bootstrap-datepicker.js"></script>

    
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
    	  $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });

    	    $(document).ready(function () {
                
                $('#example2').datepicker({
                    format: "dd/mm/yyyy"
                });  
            
            });

    	$(document).ready(
		function()
		{
			$('#radactor').redactor();
		}
	);

    	function confirm_click()
    	{
    		$confirm_click=confirm('Are You Confirm Update');
    		if($confirm_click===true)
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    	}

    	function confirm_delete()
    	{
    		$confirm_click=confirm('Are You Confirm Delete');
    		if($confirm_click===true)
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    	}
 
 //check group name 
  $(document).ready(function()
  {
		var checking_html = '<img src="search_group/loading.gif" /> Checking...';
		$('#className').change(function()
		{
			$('#item_result').html(checking_html);
				check_availability();
		});	
  });

//function to check username availability	
function check_availability()
{
		var class_name = $('#className').val();
		$.post("check_grou_name.php", { className: class_name },
			function(result){
				//if the result is 1
				if(result !=1 )
				{
					//show that the username is available
					$('#groupname').html(result);
					$('#item_result').html("");
					$('#category_result').html('');
				}
				else
				{
					//show that the username is NOT available
					$('#category_result').html('No Group Name Found');
					$('#item_result').html("");
					$('#select').html('');
				}
		});

}  




</script>
  </head>
	
  <body>
  	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal">		<?php 
		if(isset($_POST["View"]))
		{
			if($result)
			{
				echo $table;
			}
			else
			{
				 echo "<span class='text-danger' style='font-size:22px;'>"."<strong>"."No Record  Found"."<a href='Add_fee.php'>"."Go Back"."</a>"."<strong>"."</span>";
			}
		}
		else
		{
?>

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-8 col-md-8 col-sm-offset-2 col-md-offset-2">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Add Fee Title </span> </td>
  			</tr>
			
			
						
						
				

			<tr>
				<td class="info">Title</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					<input type="hidden" readonly="" class="form-control" name="id" value="<?php echo $fetch[0];?>" />
						<input type="text"  placeholder="Title" class="form-control" name="title" value="<?php echo $fetch[1];?>" />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
						
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span ></td>
			</tr>
			<tr>
				<td class="info">Year</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
					
						<input type="text"  placeholder="2016" class="form-control" name="year" value="<?php echo $fetch[8];?>" />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
						
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span ></td>
			</tr>
			<tr>
				<td class="info">Details</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12">
						<textarea class="form-control" id="radactor" name="details" placeholder="Details"><?php echo $fetch[2];?></textarea>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span ></td>
			</tr>
			<tr>
				<td class="info">Amount</td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<input type="text" placeholder="Amount" class="form-control" name="amount" value="<?php echo $fetch[3];?>" />
						<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span ></td>
			</tr>
			<tr>
				<td class="info">Duration</td>
				<td class="info">:</td>
				<td class="info" colspan="2">
					<div class="col-lg-5 col-md-5 has-info">
						<input type="text" value="<?php echo $fetch[4];?>" id="example1"  class="form-control" placeholder="Duration" name="duration1"  />
						
					</div>
						<div class="col-md-1 col-lg-1"><strong class="text-danger">To</strong></div>
					<div class="col-lg-5 col-md-5 has-info">
						<input type="text" id="example2"  class="form-control" placeholder="Duration" name="duration2" value="<?php echo $fetch[5];?>" />
						
					</div>
				
			</tr>
			<tr>
				<td class="info"> Class Name  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<select name="className" id="className" class="form-control">
						
						<?php 
									if($chek)
									{
								?>
								
									<option  value="<?php echo "$fetch[9]and$fetch[10]"?>"><?php echo $fetch[10]?></option>
								<?php  }  else {?>
									<option>Select One...</option>
								<?php
								  }  ?>
							<?php 
								$select_section = "SELECT * FROM `add_class`";
								$cheked_query=$db->select_query($select_section);
								if($cheked_query)
								{
									while($fetchsection=$cheked_query->fetch_array())
								{
							?>
							<option value="<?php echo "$fetchsection[0]and$fetchsection[2]"?>"><?php echo $fetchsection[2];?></option>
							<?php }  } ?>
						</select>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			<tr>
				<td class="info"> Group Name  </td>
				<td class="info">:</td>
				<td class="info">
					<div class="col-lg-12 has-warning">
						<select name="groupname" id="groupname" class="form-control">
							<?php 
									if($chek)
									{
								?>
								
									<option  value="<?php echo "$fetch[11]and$fetch[12]"?>"><?php echo $fetch[12]?></option>
								<?php  }?>
						</select>
					</div>
				</td>
				<td class='info'><span class="text-danger text-justify"><strong></strong></span></td>
			</tr>
			<tr>	
  				<td class="danger" colspan="4" bgcolor="#dddddd" align="center"><span>
  					<?php 
  						if(isset($msg))
  						{
  							echo "<strong>".$msg."</strong>";
  						}
  						else 
  						{
  							 echo "<strong>".$db->sms."<strong>";
  						}



  					?>

  				</span> </td>
  			</tr>
			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4"align="center" >
				<?php 
					if(!$chek)
					{
				?>
					<input type="submit" value="Add" name="add" class="btn btn-primary btn-sm" style="width:80px;" />
					<?php } else {?>
					<input type="submit" value="Update" name="Update" onClick="return confirm_click()" class="btn btn-primary btn-sm" style="width:80px;"/>
					<?php } ?>
					<input type="submit" value="View" name="View" class="btn btn-primary btn-sm" style="width:80px;"/>
								
					<input type="submit" value="Clear" name="Clear" class="btn btn-primary btn-sm" style="width:80px;"/>
					<input type="submit" value="Exit" name="Exit" class="btn btn-primary btn-sm" style="width:80px;"/>
				</td>
  			</tr>
  	</table>
	
	</div>
  	
	<?php } ?>
	</form>
  
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
