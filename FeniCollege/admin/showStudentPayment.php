<?php
    error_reporting(1);
	@session_start();
    require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	 $db = new database();
	 
			?>
			<?php
			if(isset($_POST["forDaily"])){
			
			$dailyAmmount = "SELECT * FROM `student_paid_table` WHERE `date`='".$_POST["date"]."' ORDER BY `student_paid_table`.`student_id` ASC";
			$resultAmmount = $db->select_query($dailyAmmount);
				if($resultAmmount->num_rows  > 0){
						
			?>
			<Div class="col-md-12 col-lg-12" style="margin-top:10px;">
			<table class="table table-bordered">
				<tr>
					<td width="24">Sl</td>
					<td width="106">Voucher No</td>
					<td width="199">Class Name</td>
					<td width="341">Student Name(Roll No)</td>
					<td width="116">Paid Ammount</td>
					<td width="155">Due Ammount</td>
					<td width="119">Total Ammount</td>
				</tr>
				<?php   
						$sl=0;
						$total = 0;
						
						while($fetchDailyAmmount = $resultAmmount->fetch_array()){
						$sl++;
					
						$total = $total+$fetchDailyAmmount["paid_amount"];
						
						
					     	$totalAmmountbyStudent = "SELECT `student_account_info`.`fee_id`,`studentID`,`add_fee`.`amount`,SUM(`add_fee`.`amount`) FROM `student_account_info`
INNER JOIN  `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`studentID`='".$fetchDailyAmmount["student_id"]."'";
				$resultAmmountBystudent   = $db->select_query($totalAmmountbyStudent);
						if($resultAmmountBystudent  -> num_rows >0){
								$fetchAmmountBystudent  = $resultAmmountBystudent->fetch_array();
								
						}
						
						if($fetchAmmountBystudent["studentID"] === $fetchDailyAmmount["student_id"] ){
								
								$subtotal = $subtotal+$fetchDailyAmmount["paid_amount"];
								$dueammount = $fetchAmmountBystudent[3]-$subtotal;
								$totalAmmount = $dueammount+$fetchDailyAmmount["paid_amount"];
							
								//$totaldueAmmount  =$totaldueAmmount+$totalAmmount;
						}
						 /*  $fetchAmmountBystudent[3];
						   $forDailydueAmmount = "SELECT * FROM `student_paid_table` WHERE `student_id`='".$fetchDailyAmmount["student_id"]."'  and  `date`='".$_POST["date"]."'";
						$resultDailyDueAmmount = $db->select_query($forDailydueAmmount);
						$count = $resultDailyDueAmmount ->num_rows;
								if($resultDailyDueAmmount ->num_rows  > 0){
								$a=0;
										while($fetchResultDueAmmount =$resultDailyDueAmmount ->fetch_array()){
										$a++;
										if($a==$count){
											print $fetchResultDueAmmount[4];
										$subAmmount = $subAmmount+$fetchResultDueAmmount[4];
											//	print "$subAmmount"."<br/>"; 	
												if($a==1){
												  $totalAmmount = $fetchAmmountBystudent[3]-$fetchResultDueAmmount["paid_amount"];
													$td = "<td width='349'>".$db->my_money_format($totalAmmount)."</td>";
												}else{
												
												
													$totalPlusAmmount = $fetchAmmountBystudent[3]-$subAmmount;
													$td = "<td width='349'>".$db->my_money_format($totalPlusAmmount)."</td>";
												
												}
												}	
												
										}
								}*/
						
					
						
				?>
			
			<div class="container">
 
  <div class="modal fade" id="myModal-<?php echo $fetchDailyAmmount["voucher"]?>" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Student Payment Voucher</h4>
        </div>
        <div class="modal-body" style="height:300px;">
		<?php
			 $projectinof = "SELECT * FROM `project_info`";
				$resultSql=$db->select_query($projectinof);
					if($resultSql ->num_rows  > 0 ){
					$fetchSql = $resultSql->fetch_array();
					}
						
					  $forDetailsSql = "SELECT `student_paid_table`.*,`student_personal_info`.`student_name`,`running_student_info`.`class_roll`
FROM `student_paid_table` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`student_paid_table`.`student_id`
INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`student_paid_table`.`student_id`
WHERE `student_paid_table`.`voucher`='".$fetchDailyAmmount["voucher"]."'";
					$resultFordetailsSql = $db->select_query($forDetailsSql);
						if($resultFordetailsSql->num_rows  > 0){
								$fetchForDetals = $resultFordetailsSql->fetch_array();
						}
		
		?>
         		<div class=" col-lg-12 col-md-12">
				
								<div class="col-lg-12 col-md-12 table-bordered" style="text-align:center; margin-top:10px;">
								<strong><span style="font-size:15px;"><?php echo $fetchSql["institute_name"];?></span><br/>
											<span style="font-size:13px;"><?php echo $fetchSql["phone_number"];?></span>&nbsp;,<span style="font-size:13px;">&nbsp; &nbsp;<?php echo $fetchSql["email"];?></span><br/>
												<span style="font-size:13px;"><?php echo $fetchSql["location"];?></span>
									  </strong>
								</div>
								
								<div class="col-lg-6 col-md-6 table-bordered" style="margin-top:0px;">
									<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["date"];?></span></Div>
										
											<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Voucher ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;: </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["voucher"];?></span></Div><?php
																
																	$forName = "SELECT `Name` FROM `admin_users` WHERE `id`='".$fetchForDetals["admin_id"]."'";
														$resultName=$db->select_query($forName);
														if($resultName->num_rows > 0){
																	$fetchName = $resultName->fetch_array();
														} ?>
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Reciver Name &nbsp;&nbsp;&nbsp; : </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php 
													
														echo $fetchName["Name"];?></span></Div>
										
								</div>
								<Div class="col-lg-6 col-md-6 table-bordered" style="margin-top:0px;">
								<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Student ID  &nbsp;&nbsp; :</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["student_id"];?></span></Div>
										
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["student_name"];?></span></Div>
										
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Roll &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["class_roll"];?></span></Div>
								
								</Div>
					
					<Div class="col-lg-9 col-md-9 table-bordered"  style="text-align:center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;Description</strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong>Ammount</strong></Div>
								<?php 
									 $forTitle="SELECT `student_account_info`.*,`add_fee`.`amount`,SUM(`add_fee`.`amount`) FROM `student_account_info` INNER JOIN `add_fee`
ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`studentID`='".$fetchForDetals["student_id"]."'";
											$resultForTitle = $db->select_query($forTitle);
									if($resultForTitle->num_rows > 0){
											$fetchfortitla = $resultForTitle->fetch_array();}
											$dueAmmount = $fetchfortitla[9]-$fetchForDetals[4];
								?>
								
						
								<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Total Ammount</strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo $db->my_money_format($totalAmmount);//$db->my_money_format($fetchfortitla[9]);?></strong></strong></Div>
					<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Paid Ammount This Voucher</strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo  $db->my_money_format($fetchDailyAmmount["paid_amount"]);//$db->my_money_format($fetchForDetals[4]);?></strong></strong></Div>
					
						<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Due Ammount </strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo $db->my_money_format($dueammount);//$db->my_money_format($dueAmmount);?></strong></strong></Div>
					
					
				</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
				
				<tr>
					<td width="24"><?php echo $sl;?></td>
					<td width="106"><a href="#" data-toggle="modal" data-target="#myModal-<?php echo $fetchDailyAmmount["voucher"]?>"><?php echo $fetchDailyAmmount["voucher"];?></a></td>
					<td width="199"><?php 
							$forClassName= "SELECT `class_name` FROM `add_class` WHERE `id`='".$fetchDailyAmmount["class_id"]."'";
							$resulclassName = $db->select_query($forClassName);
								if($resulclassName->num_rows > 0){
										$fetchClassName = $resulclassName->fetch_array();
								}
					
					echo $fetchClassName["class_name"];?></td>
					<td width="341"><?php
							$forStudentNameAnoroll="SELECT `running_student_info`.`class_roll`,`student_personal_info`.`student_name` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`student_id`='".$fetchDailyAmmount["student_id"]."'";
							$resulforStudent=$db->select_query($forStudentNameAnoroll);
								if($resulforStudent->num_rows > 0){
								
								$fetcForstudent =$resulforStudent->fetch_array();
								}
					 echo $fetcForstudent["student_name"].'('.$fetcForstudent["class_roll"].')';?></td>
					<td width="116"><?php echo  $db->my_money_format($fetchDailyAmmount["paid_amount"]);?></td>
					<td width="155"><?php echo $db->my_money_format($dueammount);?></td>
					<td width="119"><?php echo $db->my_money_format($totalAmmount);?></td>
				</tr>
				<?php }?>
				<tr>
					<td colspan="4"  align="right"><strong>Total Paid  Ammount</strong></td>
					<td colspan="3"><strong><?php echo $db->my_money_format($total);?></strong></td>
				
				</tr>
				<?php } else { ?>
				<tr>
					<td  colspan="6" align="right">
						<span><strong class="text-danger">No Data Have Found !!!</strong></span>
					</td>
					
				</tr>
				<?php } ?>
			</table>
			</Div>
			<?php }
	 
	 ?>
	<?php   	if(isset($_POST["monthlyreport"])){
			
			 $dailyAmmount = "SELECT * FROM `student_paid_table` WHERE `date` BETWEEN '".$_POST["frsdate"]."' AND '".$_POST["snddate"]."' ORDER BY `student_paid_table`.`student_id` ASC";
			$resultAmmount = $db->select_query($dailyAmmount);
				if($resultAmmount->num_rows  > 0){
						
			?>
			<Div class="col-md-12 col-lg-12" style="margin-top:10px;">
			<table class="table table-bordered">
				<tr>
					<td width="24">Sl</td>
					<td width="106">Voucher No</td>
					<td width="199">Class Name</td>
					<td width="341">Student Name(Roll No)</td>
					<td width="116">Paid Ammount</td>
					<td width="155">Due Ammount</td>
					<td width="119">Total Ammount</td>
				</tr>
				<?php   
						$sl=0;
						$total = 0;
						
						while($fetchDailyAmmount = $resultAmmount->fetch_array()){
						$sl++;
					
						$total = $total+$fetchDailyAmmount["paid_amount"];
						
						
					     	$totalAmmountbyStudent = "SELECT `student_account_info`.`fee_id`,`studentID`,`add_fee`.`amount`,SUM(`add_fee`.`amount`) FROM `student_account_info`
INNER JOIN  `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`studentID`='".$fetchDailyAmmount["student_id"]."'";
				$resultAmmountBystudent   = $db->select_query($totalAmmountbyStudent);
						if($resultAmmountBystudent  -> num_rows >0){
								$fetchAmmountBystudent  = $resultAmmountBystudent->fetch_array();
								
						}
						
						if($fetchAmmountBystudent["studentID"] === $fetchDailyAmmount["student_id"] ){
								
								$subtotal = $subtotal+$fetchDailyAmmount["paid_amount"];
								$dueammount = $fetchAmmountBystudent[3]-$subtotal;
								$totalAmmount = $dueammount+$fetchDailyAmmount["paid_amount"];
							
								//$totaldueAmmount  =$totaldueAmmount+$totalAmmount;
						}
						 /*  $fetchAmmountBystudent[3];
						   $forDailydueAmmount = "SELECT * FROM `student_paid_table` WHERE `student_id`='".$fetchDailyAmmount["student_id"]."'  and  `date`='".$_POST["date"]."'";
						$resultDailyDueAmmount = $db->select_query($forDailydueAmmount);
						$count = $resultDailyDueAmmount ->num_rows;
								if($resultDailyDueAmmount ->num_rows  > 0){
								$a=0;
										while($fetchResultDueAmmount =$resultDailyDueAmmount ->fetch_array()){
										$a++;
										if($a==$count){
											print $fetchResultDueAmmount[4];
										$subAmmount = $subAmmount+$fetchResultDueAmmount[4];
											//	print "$subAmmount"."<br/>"; 	
												if($a==1){
												  $totalAmmount = $fetchAmmountBystudent[3]-$fetchResultDueAmmount["paid_amount"];
													$td = "<td width='349'>".$db->my_money_format($totalAmmount)."</td>";
												}else{
												
												
													$totalPlusAmmount = $fetchAmmountBystudent[3]-$subAmmount;
													$td = "<td width='349'>".$db->my_money_format($totalPlusAmmount)."</td>";
												
												}
												}	
												
										}
								}*/
						
					
						
				?>
			
			<div class="container">
 
  <div class="modal fade" id="myModal-<?php echo $fetchDailyAmmount["voucher"]?>" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Student Payment Voucher</h4>
        </div>
        <div class="modal-body" style="height:300px; text-align:left">
		<?php
			 $projectinof = "SELECT * FROM `project_info`";
				$resultSql=$db->select_query($projectinof);
					if($resultSql ->num_rows  > 0 ){
					$fetchSql = $resultSql->fetch_array();
					}
						
					  $forDetailsSql = "SELECT `student_paid_table`.*,`student_personal_info`.`student_name`,`running_student_info`.`class_roll`
FROM `student_paid_table` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`student_paid_table`.`student_id`
INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`student_paid_table`.`student_id`
WHERE `student_paid_table`.`voucher`='".$fetchDailyAmmount["voucher"]."'";
					$resultFordetailsSql = $db->select_query($forDetailsSql);
						if($resultFordetailsSql->num_rows  > 0){
								$fetchForDetals = $resultFordetailsSql->fetch_array();
						}
		
		?>
         		<div class=" col-lg-12 col-md-12">
				
								<div class="col-lg-12 col-md-12 table-bordered" style="text-align:center; margin-top:10px;">
								<strong><span style="font-size:15px;"><?php echo $fetchSql["institute_name"];?></span><br/>
											<span style="font-size:13px;"><?php echo $fetchSql["phone_number"];?></span>&nbsp;,<span style="font-size:13px;">&nbsp; &nbsp;<?php echo $fetchSql["email"];?></span><br/>
												<span style="font-size:13px;"><?php echo $fetchSql["location"];?></span>
									  </strong>
								</div>
								
								<div class="col-lg-6 col-md-6 table-bordered" style="margin-top:0px;">
									<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["date"];?></span></Div>
										
											<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Voucher ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;: </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["voucher"];?></span></Div><?php
																
																	$forName = "SELECT `Name` FROM `admin_users` WHERE `id`='".$fetchForDetals["admin_id"]."'";
														$resultName=$db->select_query($forName);
														if($resultName->num_rows > 0){
																	$fetchName = $resultName->fetch_array();
														} ?>
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Reciver Name &nbsp;&nbsp;&nbsp; : </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php 
													
														echo $fetchName["Name"];?></span></Div>
										
								</div>
								<Div class="col-lg-6 col-md-6 table-bordered" style="margin-top:0px;">
								<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Student ID  &nbsp;&nbsp; :</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["student_id"];?></span></Div>
										
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["student_name"];?></span></Div>
										
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Roll &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["class_roll"];?></span></Div>
								
								</Div>
					
					<Div class="col-lg-9 col-md-9 table-bordered"  style="text-align:center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;Description</strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong>Ammount</strong></Div>
								<?php 
									 $forTitle="SELECT `student_account_info`.*,`add_fee`.`amount`,SUM(`add_fee`.`amount`) FROM `student_account_info` INNER JOIN `add_fee`
ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`studentID`='".$fetchForDetals["student_id"]."'";
											$resultForTitle = $db->select_query($forTitle);
									if($resultForTitle->num_rows > 0){
											$fetchfortitla = $resultForTitle->fetch_array();}
											$dueAmmount = $fetchfortitla[9]-$fetchForDetals[4];
								?>
								
						
								<Div class="col-lg-9 col-md-9 table-bordered" style="text-align:left"><strong>&nbsp;&nbsp;Total Ammount</strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"  style="text-align:left"><strong><strong>&nbsp;&nbsp;<?php echo $db->my_money_format($totalAmmount);?></strong></strong></Div>
					<Div class="col-lg-9 col-md-9 table-bordered"  style="text-align:left"><strong>&nbsp;&nbsp;Paid Ammount This Voucher</strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"  style="text-align:left"><strong><strong>&nbsp;&nbsp;<?php echo $db->my_money_format($fetchDailyAmmount["paid_amount"]);//$db->my_money_format($fetchForDetals[4]);?></strong></strong></Div>
					
						<Div class="col-lg-9 col-md-9 table-bordered"  style="text-align:left"><strong>&nbsp;&nbsp;Due Ammount </strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"  style="text-align:left"><strong><strong>&nbsp;&nbsp;<?php echo $db->my_money_format($dueammount);//$db->my_money_format($dueAmmount);?></strong></strong></Div>
					
					
				</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
				
				<tr>
					<td width="24"><?php echo $sl;?></td>
					<td width="106"><a href="#" data-toggle="modal" data-target="#myModal-<?php echo $fetchDailyAmmount["voucher"]?>"><?php echo $fetchDailyAmmount["voucher"];?></a></td>
					<td width="199"><?php 
							$forClassName= "SELECT `class_name` FROM `add_class` WHERE `id`='".$fetchDailyAmmount["class_id"]."'";
							$resulclassName = $db->select_query($forClassName);
								if($resulclassName->num_rows > 0){
										$fetchClassName = $resulclassName->fetch_array();
								}
					
					echo $fetchClassName["class_name"];?></td>
					<td width="341"><?php
							$forStudentNameAnoroll="SELECT `running_student_info`.`class_roll`,`student_personal_info`.`student_name` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`student_id`='".$fetchDailyAmmount["student_id"]."'";
							$resulforStudent=$db->select_query($forStudentNameAnoroll);
								if($resulforStudent->num_rows > 0){
								
								$fetcForstudent =$resulforStudent->fetch_array();
								}
					 echo $fetcForstudent["student_name"].'('.$fetcForstudent["class_roll"].')';?></td>
					<td width="116"><?php echo $db->my_money_format($fetchDailyAmmount["paid_amount"]);?></td>
					<td width="155"><?php echo $db->my_money_format($dueammount);?></td>
					<td width="119"><?php echo $db->my_money_format($totalAmmount);?></td>
				</tr>
				<?php }?>
				<tr>
					<td colspan="4"  align="right"><strong>Total Paid  Ammount</strong></td>
					<td colspan="3"><strong><?php echo $db->my_money_format($total);?></strong></td>
				
				</tr>
				<?php } else { ?>
				<tr>
					<td  colspan="6" align="right">
						<span><strong class="text-danger">No Data Have Found !!!</strong></span>
					</td>
					
				</tr>
				<?php } ?>
			</table>
			</Div>
			<?php }
	 
	 ?>
	 
	 <?php
			if(isset($_POST["showEarlypost"])){
			
			$dailyAmmount = "SELECT * FROM `student_paid_table` WHERE  RIGHT(`date`,4)='".$_POST["years"]."' ORDER BY `student_paid_table`.`student_id` ASC";
			$resultAmmount = $db->select_query($dailyAmmount);
				if($resultAmmount->num_rows  > 0){
						
			?>
			<Div class="col-md-12 col-lg-12" style="margin-top:10px;">
			<table class="table table-bordered">
				<tr>
					<td width="24">Sl</td>
					<td width="106">Voucher No</td>
					<td width="199">Class Name</td>
					<td width="341">Student Name(Roll No)</td>
					<td width="116">Paid Ammount</td>
					<td width="155">Due Ammount</td>
					<td width="119">Total Ammount</td>
				</tr>
				<?php   
						$sl=0;
						$total = 0;
						
						while($fetchDailyAmmount = $resultAmmount->fetch_array()){
						$sl++;
					
						$total = $total+$fetchDailyAmmount["paid_amount"];
						
						
					     	$totalAmmountbyStudent = "SELECT `student_account_info`.`fee_id`,`studentID`,`add_fee`.`amount`,SUM(`add_fee`.`amount`) FROM `student_account_info`
INNER JOIN  `add_fee` ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`studentID`='".$fetchDailyAmmount["student_id"]."'";
				$resultAmmountBystudent   = $db->select_query($totalAmmountbyStudent);
						if($resultAmmountBystudent  -> num_rows >0){
								$fetchAmmountBystudent  = $resultAmmountBystudent->fetch_array();
								
						}
						
						if($fetchAmmountBystudent["studentID"] === $fetchDailyAmmount["student_id"] ){
								
								$subtotal = $subtotal+$fetchDailyAmmount["paid_amount"];
								$dueammount = $fetchAmmountBystudent[3]-$subtotal;
								$totalAmmount = $dueammount+$fetchDailyAmmount["paid_amount"];
							
								//$totaldueAmmount  =$totaldueAmmount+$totalAmmount;
						}
						 /*  $fetchAmmountBystudent[3];
						   $forDailydueAmmount = "SELECT * FROM `student_paid_table` WHERE `student_id`='".$fetchDailyAmmount["student_id"]."'  and  `date`='".$_POST["date"]."'";
						$resultDailyDueAmmount = $db->select_query($forDailydueAmmount);
						$count = $resultDailyDueAmmount ->num_rows;
								if($resultDailyDueAmmount ->num_rows  > 0){
								$a=0;
										while($fetchResultDueAmmount =$resultDailyDueAmmount ->fetch_array()){
										$a++;
										if($a==$count){
											print $fetchResultDueAmmount[4];
										$subAmmount = $subAmmount+$fetchResultDueAmmount[4];
											//	print "$subAmmount"."<br/>"; 	
												if($a==1){
												  $totalAmmount = $fetchAmmountBystudent[3]-$fetchResultDueAmmount["paid_amount"];
													$td = "<td width='349'>".$db->my_money_format($totalAmmount)."</td>";
												}else{
												
												
													$totalPlusAmmount = $fetchAmmountBystudent[3]-$subAmmount;
													$td = "<td width='349'>".$db->my_money_format($totalPlusAmmount)."</td>";
												
												}
												}	
												
										}
								}*/
						
					
						
				?>
			
			<div class="container">
 
  <div class="modal fade" id="myModal-<?php echo $fetchDailyAmmount["voucher"]?>" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Student Payment Voucher</h4>
        </div>
        <div class="modal-body" style="height:300px;">
		<?php
			 $projectinof = "SELECT * FROM `project_info`";
				$resultSql=$db->select_query($projectinof);
					if($resultSql ->num_rows  > 0 ){
					$fetchSql = $resultSql->fetch_array();
					}
						
					  $forDetailsSql = "SELECT `student_paid_table`.*,`student_personal_info`.`student_name`,`running_student_info`.`class_roll`
FROM `student_paid_table` INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`student_paid_table`.`student_id`
INNER JOIN `running_student_info` ON `running_student_info`.`student_id`=`student_paid_table`.`student_id`
WHERE `student_paid_table`.`voucher`='".$fetchDailyAmmount["voucher"]."'";
					$resultFordetailsSql = $db->select_query($forDetailsSql);
						if($resultFordetailsSql->num_rows  > 0){
								$fetchForDetals = $resultFordetailsSql->fetch_array();
						}
		
		?>
         		<div class=" col-lg-12 col-md-12">
				
								<div class="col-lg-12 col-md-12 table-bordered" style="text-align:center; margin-top:10px;">
								<strong><span style="font-size:15px;"><?php echo $fetchSql["institute_name"];?></span><br/>
											<span style="font-size:13px;"><?php echo $fetchSql["phone_number"];?></span>&nbsp;,<span style="font-size:13px;">&nbsp; &nbsp;<?php echo $fetchSql["email"];?></span><br/>
												<span style="font-size:13px;"><?php echo $fetchSql["location"];?></span>
									  </strong>
								</div>
								
								<div class="col-lg-6 col-md-6 table-bordered" style="margin-top:0px;">
									<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["date"];?></span></Div>
										
											<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Voucher ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;: </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["voucher"];?></span></Div><?php
																
																	$forName = "SELECT `Name` FROM `admin_users` WHERE `id`='".$fetchForDetals["admin_id"]."'";
														$resultName=$db->select_query($forName);
														if($resultName->num_rows > 0){
																	$fetchName = $resultName->fetch_array();
														} ?>
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Reciver Name &nbsp;&nbsp;&nbsp; : </span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php 
													
														echo $fetchName["Name"];?></span></Div>
										
								</div>
								<Div class="col-lg-6 col-md-6 table-bordered" style="margin-top:0px;">
								<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Student ID  &nbsp;&nbsp; :</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["student_id"];?></span></Div>
										
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["student_name"];?></span></Div>
										
										<Div>	<span style="font-size:13px; font-weight:500;">&nbsp;Roll &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span>
										<span style="font-size:13px; font-weight:500">&nbsp;&nbsp;<?php echo $fetchForDetals["class_roll"];?></span></Div>
								
								</Div>
					
					<Div class="col-lg-9 col-md-9 table-bordered"  style="text-align:center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;Description</strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong>Ammount</strong></Div>
								<?php 
									 $forTitle="SELECT `student_account_info`.*,`add_fee`.`amount`,SUM(`add_fee`.`amount`) FROM `student_account_info` INNER JOIN `add_fee`
ON `add_fee`.`id`=`student_account_info`.`fee_id` WHERE `student_account_info`.`studentID`='".$fetchForDetals["student_id"]."'";
											$resultForTitle = $db->select_query($forTitle);
									if($resultForTitle->num_rows > 0){
											$fetchfortitla = $resultForTitle->fetch_array();}
											$dueAmmount = $fetchfortitla[9]-$fetchForDetals[4];
								?>
								
						
								<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Total Ammount</strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo $db->my_money_format($totalAmmount);//$db->my_money_format($fetchfortitla[9]);?></strong></strong></Div>
					<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Paid Ammount This Voucher</strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo  $db->my_money_format($fetchDailyAmmount["paid_amount"]);//$db->my_money_format($fetchForDetals[4]);?></strong></strong></Div>
					
						<Div class="col-lg-9 col-md-9 table-bordered"><strong>&nbsp;&nbsp;Due Ammount </strong></strong></Div>
					<Div class="col-lg-3 col-md-3 table-bordered"><strong><strong>&nbsp;&nbsp;<?php echo $db->my_money_format($dueammount);//$db->my_money_format($dueAmmount);?></strong></strong></Div>
					
					
				</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
				
				<tr>
					<td width="24"><?php echo $sl;?></td>
					<td width="106"><a href="#" data-toggle="modal" data-target="#myModal-<?php echo $fetchDailyAmmount["voucher"]?>"><?php echo $fetchDailyAmmount["voucher"];?></a></td>
					<td width="199"><?php 
							$forClassName= "SELECT `class_name` FROM `add_class` WHERE `id`='".$fetchDailyAmmount["class_id"]."'";
							$resulclassName = $db->select_query($forClassName);
								if($resulclassName->num_rows > 0){
										$fetchClassName = $resulclassName->fetch_array();
								}
					
					echo $fetchClassName["class_name"];?></td>
					<td width="341"><?php
							$forStudentNameAnoroll="SELECT `running_student_info`.`class_roll`,`student_personal_info`.`student_name` FROM `running_student_info`
INNER JOIN `student_personal_info` ON `student_personal_info`.`id`=`running_student_info`.`student_id`
WHERE `running_student_info`.`student_id`='".$fetchDailyAmmount["student_id"]."'";
							$resulforStudent=$db->select_query($forStudentNameAnoroll);
								if($resulforStudent->num_rows > 0){
								
								$fetcForstudent =$resulforStudent->fetch_array();
								}
					 echo $fetcForstudent["student_name"].'('.$fetcForstudent["class_roll"].')';?></td>
					<td width="116"><?php echo  $db->my_money_format($fetchDailyAmmount["paid_amount"]);?></td>
					<td width="155"><?php echo $db->my_money_format($dueammount);?></td>
					<td width="119"><?php echo $db->my_money_format($totalAmmount);?></td>
				</tr>
				<?php }?>
				<tr>
					<td colspan="4"  align="right"><strong>Total Paid  Ammount</strong></td>
					<td colspan="3"><strong><?php echo $db->my_money_format($total);?></strong></td>
				
				</tr>
				<?php } else { ?>
				<tr>
					<td  colspan="6" align="right">
						<span><strong class="text-danger">No Data Have Found !!!</strong></span>
					</td>
					
				</tr>
				<?php } ?>
			</table>
			</Div>
			<?php }
	 
	 ?>