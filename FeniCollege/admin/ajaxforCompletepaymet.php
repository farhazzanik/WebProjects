<?php
	error_reporting(1);
@session_start();
	require_once("../db_connect/config.php");
	require_once("../db_connect/conect.php");
	$db = new database();
	
	
	
		  		if(isset($_POST["paybalAMmount"])){
				
						if(!empty($_POST["id"])){
									$paybalAMMount="SELECT * FROM `teacher_payable_master_table` WHERE `teacher_id`='".$_POST["id"]."'";
									$result = $db->select_query($paybalAMMount);
									if($result ->num_rows > 0){
											$fetchResult = $result->fetch_array();
											$msg = $fetchResult['pay_amount'];
												echo $msg;
									}
						}
				}
				
				
				if(isset($_POST["AddandDelete"])){
				 $makeid=$db->autogenerat('teacher_payment_history','id','PID-','9');
  								$makeidCost=$db->autogenerat('other_cost','id','OTC-','9');
					
							
						if(!empty($_POST["paidAmount"])){
							
							   
						
								$insert_fee="INSERT INTO `teacher_payment_history` (`id`,`teacher_id`,`date`,`year`,`current_amount`,`payment_amout`,`user_id`) VALUES('$makeid','".$_POST['teacherId']."','".date('d/m/Y')."','".date('Y')."','".$_POST['totalpayable']."','".$_POST['paidAmount']."','".$_SESSION["id"]."')";
       								 $check_insert=$db->insert_query($insert_fee);
									  $makeid=$db->autogenerat('teacher_payment_history','id','PID-','9');
									 if(isset($check_insert)){
									 
									 		  $updatess="UPDATE teacher_payable_master_table SET `payable_date`='".date('d/m/Y')."',`pay_amount`='".$_POST["duammmount"]."' where teacher_id='".$_POST['teacherId']."'";
											   $update=$db->update_query($updatess);
									 		 $insert_cost="INSERT INTO `other_cost` (`id`,`date`,`title`,`description`,`amount`,`admin_id`) VALUES('$makeidCost','".date('d/m/Y')."','Teacher Payment','CostFor-".$_POST['teacherName']."','".$_POST['paidAmount']."','".$_SESSION["id"]."')";
      										  $check_insertAA=$db->insert_query($insert_cost);
											  	$makeidCost=$db->autogenerat('other_cost','id','OTC-','9');
												
												if(isset($db->sms)){
												echo $db->sms;
												}
									 }
						}else {
								echo "<span class='text-center text-danger glyphicon glyphicon-remove'><strong>Please Fill Up Important Fields..!!</strong></span>";
						}
				}
				
				
				?>
				<?php
						if(isset($_POST["showDAta"])){
						 $projectinof = "SELECT * FROM `project_info`";
				$resultSql=$db->select_query($projectinof);
					if($resultSql ->num_rows  > 0 ){
					$fetchSql = $resultSql->fetch_array(); }
					
					$forInformation ="SELECT `teacher_payment_history`.*,`teachers_information`.`teachers_name`,`teachers_information`.`designation`,`email`
FROM `teacher_payment_history` INNER JOIN `teachers_information` ON `teachers_information`.`teachers_id`=`teacher_payment_history`.`teacher_id`
WHERE `teacher_payment_history`.`teacher_id`='".$_POST["teacherId"]."'";
					$resultFormation = $db->select_query($forInformation);
							if($resultFormation->num_rows > 0){
									$fetchFormation =$resultFormation->fetch_array();
									 $forAlltitle = "SELECT `teacher_payable_table`.`title`,`teacher_payable_table`.`amount`,`add_payment_title`.`payment_title`
FROM `teacher_payable_table` INNER JOIN `add_payment_title` ON `add_payment_title`.`id`=`teacher_payable_table`.`title`
WHERE `teacher_payable_table`.`id`='".$fetchFormation["teacher_id"]."'";
											$resultForTitla = $db->select_query($forAlltitle);
							}
							$foraccountannaem = "SELECT `Name` FROM `admin_users` WHERE `id`='".$fetchFormation["user_id"]."'";
								$foaccountresult = $db->select_query($foraccountannaem);
									if($foaccountresult->num_rows > 0){
										$fetchforamm=$foaccountresult->fetch_array();
									}
					
						?>
							<table class="table table-bordered col-md-12  col-lg-12" style="margin-top:10px;">
									<tr>
											<td height="91" align="center" colspan="3"><strong><span style="font-size:15px;"><?php echo $fetchSql["institute_name"];?></span><br/>
											<span style="font-size:13px;"><?php echo $fetchSql["phone_number"];?></span>&nbsp;,<span style="font-size:13px;">&nbsp; &nbsp;<?php echo $fetchSql["email"];?></span><br/>
												<span style="font-size:13px;"><?php echo $fetchSql["location"];?></span>
									  </strong></td>
									</tr>		
									<tr>
										<td colspan="3">
												<table style="width:100%;" align="center">
														<tr>
											<td><span style="padding-left:10px;">Date</span></td>
												<td align="center">:</td>
												<td><span style="padding-left:10px;"><?php echo date('d/m/Y');?></span></td>
											<td><span style="padding-left:10px;">Teacher Name</span></td>
											<td align="center">:</td>
											<td><span style="padding-left:10px;"><?php echo $fetchFormation["teachers_name"];?></span></td>
											
									</tr>
									<tr>
											<td><span style="padding-left:10px;">Voucer ID</span></td>
												<td align="center">:</td>
												<td><span style="padding-left:10px;"><?php echo $fetchFormation["id"];?></span></td>
											<td><span style="padding-left:10px;">Designation </span></td>
											<td align="center">:</td>
											<td><span style="padding-left:10px;"><?php echo $fetchFormation["designation"];?></span></td>
											
									</tr>
									<tr>
											<td><span style="padding-left:10px;">Accountant Name</span></td>
											<td>:</td>
											<td><span style="padding-left:10px;"><?php echo $fetchforamm["Name"];?></span></td>
											<td><span style="padding-left:10px;">Email</span></td>
											<td align="center">:</td>
											<td><span style="padding-left:10px;"><?php echo $fetchFormation["email"];?></span></td>
											
									</tr>
												</table>
										</td>
									</tr>
									
									<tr>
										<td><span style="padding-left:10px;"><strong>Sl</strong></span></td>
										<td><span style="padding-left:10px;"><strong>Title</strong></span></td>
										<td><span style="padding-left:10px;"><strong>Taka</strong></span></td>
									</tr>
									
									<?php 
											if($resultForTitla->num_rows  >0 ){
											$sl = 0;
											$total = 0;
													while($fetchFortitle = $resultForTitla->fetch_array()){
													$total =$total+$fetchFortitle["amount"];
													$sl++;
									?>
									<tr>
											<td><span style="padding-left:10px;"><?php echo $sl;?></span></td>
										<td><span style="padding-left:10px;"><?php echo $fetchFortitle["payment_title"];?></span></td>
										<td><span style="padding-left:10px;"><?php echo $db->my_money_format($fetchFortitle["amount"]);?></span></td>
										</tr>	
											<?php } ?>
													<tR>
														<td colspan="2" align="right"><span style="padding-left:10px;">Total Ammount</span></td>
													<td><span style="padding-left:10px;"><?php echo $db->my_money_format($total);
												


													?></span></td>
												</tR>
												
												<?php 
														$forPayableAmmount ="SELECT `pay_amount` FROM `teacher_payable_master_table` WHERE `teacher_id`='".$fetchFormation["teacher_id"]."'" ;
														$resultPaymbalAMmount = $db->select_query($forPayableAmmount);
															if($resultPaymbalAMmount->num_rows > 0){
																	$fetchPaybalAmmount =$resultPaymbalAMmount->fetch_array();
															}
												?>
													
												<?php 
														 $forPaidAmmount ="SELECT SUM(`payment_amout`) FROM `teacher_payment_history` WHERE `teacher_id`='".$fetchFormation["teacher_id"]."' AND `year`='".date('Y')."'";
														$resultPaidAmmount = $db->select_query($forPaidAmmount);
															if($resultPaidAmmount->num_rows > 0){
																$fetchpaidAmmon= $resultPaidAmmount->fetch_array();
																
															}
												?>
													<tR>
														<td colspan="2" align="right"><span style="padding-left:10px;">Paid Ammount</span></td>
													<td><span style="padding-left:10px;"><?php echo $db->my_money_format($fetchpaidAmmon[0])?></span></td>
												</tR>
												<tR>
														<td colspan="2" align="right"><span style="padding-left:10px;">Due Ammount</span></td>
													<td><span style="padding-left:10px;"><?php echo $db->my_money_format($fetchPaybalAmmount["pay_amount"]);?></span></td>
												</tR>
											<?php  }?>
									
							</table>
						<?php }
				?>
				
				<?php
/*function my_money_format($num){
    $money=explode('.',$num);
    if(strlen($money[1])==0)
        $money[1]='00';
    if(strlen($money[0])==0)
        $money[0]='0';    
    if(strlen($money[0])>2){
        $taka=$money[0];
        $thousand=substr($taka, -3);
        $taka=substr($taka,0,strlen($taka)-3);
        $i=0;
        while(strlen($taka)>0){
            if(strlen($taka)>1){
                $pp[$i]=substr($taka, -2);
                $taka=substr($taka,0,strlen($taka)-2);
            }else{
                $pp[$i]=substr($taka, -1);
                $taka=substr($taka,0,strlen($taka)-1);
            }
            $i++;
        }
        for($j=sizeof($pp)-1;$j>=0;$j--)
            $taka_add .=$pp[$j].',';
        return $taka_add.$thousand.".".$money[1];
    }else
        return $money[0].".".$money[1];    
}    */
?>