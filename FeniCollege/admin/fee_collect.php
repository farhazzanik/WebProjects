<?php
// error_reporting(1);
  require_once("../db_connect/config.php");
  require_once("../db_connect/conect.php");
    global $msg;
  global $result_std_details;
  global $insert_fee_studnt;
  $db = new database();
  @$id=$db->escape($_POST['id']);
  if(isset($_POST['searchbutton']))
   {
      
      $year=$db->escape($_POST['year']);
      $class=$db->escape(isset($_POST['className'])?$_POST['className']:"");
      @$exploide=explode('and', $class);
      if(!empty($id) && !empty($class)){
      $select="SELECT * FROM `running_student_info` WHERE `student_id`='$id' AND `class_id`='".$exploide[0]."'";
      $result_s=$db->select_query($select);
      if($result_s)
      {
        $select_Std_details="SELECT `running_student_info`.`student_id`,`class_roll`,`student_personal_info`.`student_name`,`father_name`,`mother_name`,`contact_no`,`add_class`.`class_name`,`add_group`.`group_name`,`add_section`.`section_name`,`student_acadamic_information`.`session2`,`running_student_info`.`class_id` FROM `running_student_info` 
INNER JOIN `student_personal_info` ON `running_student_info`.`student_id`=`student_personal_info`.`id`
INNER JOIN `student_acadamic_information` ON `running_student_info`.`student_id`=`student_acadamic_information`.`id`
INNER JOIN `add_class` ON `running_student_info`.`class_id`=`add_class`.`id`
INNER JOIN `add_group` ON `running_student_info`.`group_id`=`add_group`.`id`
INNER JOIN `add_section` ON `running_student_info`.`section_id`=`add_section`.`id` WHERE `running_student_info`.`student_id`='$id' AND `running_student_info`.`class_id`='".$exploide[0]."'";
    $result_std_details=$db->select_query($select_Std_details);
    if ($result_std_details) {
      $fetch_Student_details=$result_std_details->fetch_array();
    }
      }
    }
   }
      $fetch[0]=$db->autogenerat('student_paid_table','voucher','Rec-','9');
      $fetcha[0]=$db->autogenerat('Student_due_table','id','Due-','9');
$fetchIncome[0]=$db->autogenerat('other_income','id','OTI-','9');
if(isset($_POST['add']))
  {
    
    if(!empty($_POST['stdId']) && !empty($_POST['classNameId'])&& !empty($_POST['paidAmount']))
    {
      $stduID=$_POST['stdId'];
      $voucher=$fetch[0];
      $DuID=$fetcha[0];
      $query="INSERT INTO `student_paid_table` (`student_id`,`voucher`,`class_id`,`paid_amount`,`date`,`admin_id`,`month`,`year`) VALUES ('".$_POST['stdId']."','".$fetch[0]."','".$_POST['classNameId']."','".$_POST['paidAmount']."','".date('d-m-Y')."','1','".date('M')."','".date('Y')."')";
      $resultisnsert=$db->insert_query($query);
      //print_r($query);
     $selectDueTable="SELECT * FROM `Student_due_table` WHERE `Student_due_table`.`student_id`='".$_POST['stdId']."'";
    $resultDueTable=$db->select_query($selectDueTable);
    if ($resultDueTable) {
    $fetchDue=$resultDueTable->fetch_array();
    if ($fetchDue['student_id']==$stduID)
     {
      $updateQuery="UPDATE `Student_due_table` SET `total_amount`='".$_POST['TotalDueAmount']."',`paid_amount`='".$_POST['paidAmount']."',`date`='".date('d-m-Y')."' where `student_id`='$stduID'";
      $update=$db->update_query($updateQuery);  
    }
    
    }
    else
    {
        $queryDue="INSERT INTO `Student_due_table` (`id`,`student_id`,`class_id`,`total_amount`,`paid_amount`,`date`) VALUES ('".$fetcha[0]."','".$_POST['stdId']."','".$_POST['classNameId']."','".$_POST['TotalDueAmount']."','".$_POST['paidAmount']."','".date('d-m-Y')."')";
      $resultisnsert=$db->insert_query($queryDue); 
    }
      
       $query_ass="INSERT INTO `other_income` (`id`,`date`,`title`,`description`,`amount`,`admin_id`) VALUES ('".$fetchIncome[0]."','".date('d/m/Y')."','Student Payment','Student ID :".$_POST['stdId']."','".$_POST['paidAmount']."','1')";
      $result_query=$db->insert_query($query_ass);
      //print_r($query);
      echo "<script>location='custome_create_fee.php?stdId=$stduID&VoucherId=$voucher&DuID=$DuID'</script>";
      $fetcha[0]=$db->autogenerat('Student_due_table','id','Due-','9');
       $fetch[0]=$db->autogenerat('student_paid_table','voucher','Rec-','9');
     	 $fetchIncome[0]=$db->autogenerat('other_income','id','OTI-','9');
    }
    else
    {
      $msg="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Please Fill Up TextField</strong></span>";
    }
  }

  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>
<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <script>
  	function chekGroup()
{

        var class_name = $('#className').val();
        $.post("check_grou_name.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=0 )
                {
                    //show that the username is available
                    $('#groupname').html(result);
                   
                }
                else
                {
                 
                    $('#groupname').html('');
                }
                
           
                 
        });
								$('#name').val('');
							$('#Roll').val('');
							$('#fatherName').val('');
							$('#MotherName').val('');
							$('#Session').val('');
							$('#Phone').val('');
							$('#Discount').val('');
							$('#total').val('');
							$('#TotalDueAmount').val('');
							$('#paidAmmount').val('');
							 $('#DueAmmount').val('');
								 $('#paidAmount').val('');
								 $('#ShoeDialouge').html('');
}

$(document).ready(function(){
	$('#stdId').keyup(function(){
			
		var fordiscountID = $(this).val();
			
		var ClassId=$('#className').val();
		var groupID=$('#groupname').val();
		var forDiscount = "dd";
		if(fordiscountID != ""){
			$.ajax({
				url : "autoComSTd.php",
				data : {forDiscount:forDiscount,fordiscountID:fordiscountID,ClassId:ClassId,groupID:groupID},
				type : "POST",
				success:function(data){
					
					$('#idlist').fadeIn();
					$('#idlist').html(data);
					$('#DueAmmount').val('');
						$('#paidAmount').val('');
				}
			});
		}
		
	});
	
		$(document).on('click','li',function(){
			$('#stdId').val($(this).text());
			$('#idlist').fadeOut();
			showIdby();
		});
});

function showIdby(){
				
var id =$('#stdId').val();
var name="nu";
var ClassId=$('#className').val();
var groupID=$('#groupname').val();
var lent =$('#stdId').val().length;
//alert(lent);
		
$('#ShoeDialouge').html('');
$('#sms').html('');
if(lent > 9){
		//alert("anik");
		 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxforFeecollect.php",
                    data: {id:id,name:name,ClassId:ClassId,groupID:groupID},
                    cache: false,
                    success: function(data) {
                    
				
                    	
							var a = data.split('/');
							
							var name = a[0];
							//alert(name);
							var roll = a[1];
							var  fatherName = a[2];
							var mothername  = a[3];
							var  session = a[5];
							var  contactno = a[4];
							$('#name').val(name);
							$('#Roll').val(roll);
							$('#fatherName').val(fatherName);
							$('#MotherName').val(mothername);
							$('#Session').val(session);
							$('#Phone').val(contactno);
							 showtotalInfo();
							 
							 
						}
						
					
					
                    });
	
    }
	else{
							$('#name').val('');
							$('#Roll').val('');
							$('#fatherName').val('');
							$('#MotherName').val('');
							$('#Session').val('');
							$('#Phone').val('');

	}
}

function  showtotalInfo(){
		var id =$('#stdId').val();
		var totalfees="feesss";
		var ClassId=$('#className').val();
		var groupID=$('#groupname').val();
		var year=$('#year').val();
		
		 $.ajax({
		 			
                    type: "POST",
                    url: "ajaxforFeecollect.php",
                    data: {id:id,totalfees:totalfees,ClassId:ClassId,groupID:groupID,year:year},
                    cache: false,
                    success: function(data) {
                    
						
                    		var b = data.split('/');
							
							var total = b[0];
							//alert(name);
							var discount = b[1];
							var dueAmmount = b[2];
							var paidAmmount = b[3];
							$('#Discount').val(discount);
							$('#total').val(total);
							$('#TotalDueAmount').val(dueAmmount);
							$('#paidAmmount').val(paidAmmount);
							showtotalInfo();
						}
						
					
					
                    });
	
}

function DueAmmountfunction(){
		var NowPaid = parseFloat($('#paidAmount').val());
		//alert(NowPaid);
		var TotalDueAmount = parseFloat($('#TotalDueAmount').val());
		//alert(TotalDueAmount);
		var dueAmmount = 0;
		 if(NowPaid < TotalDueAmount || NowPaid == TotalDueAmount){
				 dueAmmount = parseFloat(TotalDueAmount - NowPaid);
		 }
		else{
		
		$('#paidAmount').val(0);
		}
		// alert(dueAmmount);
		 $('#DueAmmount').val(dueAmmount);
		 
}


function ADDDATA(){

		var paidAmount = parseFloat($('#paidAmount').val());
		
		var negativeBlacne =parseFloat($('#TotalDueAmount').val());
		var dataADD= "ddd";
		if(paidAmount => 0){
				if(paidAmount < negativeBlacne || paidAmount == negativeBlacne){
				
		 $.ajax({
							type: "POST",
							url: "ajaxforFeecollect.php",
							data:$(".addDADA").serialize() + "&dataADD=" + dataADD,
							cache: false,
							success: function(data) {
										
									$('#ShoeDialouge').html(data);
									$('#FrstPage').hide();
									$('#SecoundPage').show();
									showVoucher();
								
								}
								
							
							
							});
							}else{
							
									alert("Sorry!!This ammount is too long..");
									return false;
							
							}
			}
}

function showVoucher(){
		var showVoucher = "voucher";
		 $.ajax({
							type: "POST",
							url: "ajaxforFeecollect.php",
							data:$(".addDADA").serialize() + "&showVoucher=" + showVoucher,
							cache: false,
							success: function(data) {
									$('#FrstPage').hide();
									$('#SecoundPage').show();
									
									$('#showSndPage').html(data);
									showVoucher();
								
								}
								
							
							
							});
}

function backPargge(){
										$('#FrstPage').show();
									$('#SecoundPage').hide();
									$('#showSndPage').html('');

}
  </script>
  
   <style>
	 
	.ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  float: left;
  display: none;
  min-width: 180px;
  _width: 160px;
  padding: 4px 0 0 5px;
  margin: 2px 0 0 15px;
  margin-left:15px;
  list-style: none;
  background-color: #ffffff;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;

  .ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;

    &.ui-state-hover, &.ui-state-active {
      color: #ffffff;
      text-decoration: none;
      background-color: #0088cc;
      border-radius: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      background-image: none;
    }
  }
}
 </style>
  </head>
	
  <body>
  	<form name="" action="" method="post"  enctype="multipart/form-data" class="form-horizontal addDADA">

  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1" id="FrstPage">
  	<table align="center" class="table table-responsive box" style="border:1px #CCCCCC solid; margin-top:30px; color: #000;">
  			<tr>
  				<td bgcolor="#f4f4f4" class="warning" colspan="4" bgcolor="#dddddd" align="center"><span style="font-size:22px; color:#333; display:block;">Fee Collect</span> </td>
  			</tr>
        <tr>
          <td bgcolor="#ffffff" class="" colspan="4"  align="center">
        							<div class="col-md-4"><select name="className" onChange="return chekGroup()" required id="className"  style="width:100%; height:30px;">
						<option>Select Class</option>
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
					
						
					</select></div>
					<div class="col-md-3"><select name="groupname" required id="groupname"  style="width:100%; height:30px;"></select></div>
					<div class="col-md-3"><input type="text" autocomplete="off" name="stdId"  onKeyUp="return showIdby()"  id="stdId" placeholder='Student ID' style="width:178px; height:30px;"/>
								<div id="idlist" class="ui-autocomplete"  style="text-align:left"></div></div>
					<div class="col-md-2"><input type="text" value="<?php echo date('Y')?>" style="width:100%; height:30px; padding-left:5px;" name="year" id="year"></input></div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><div class="col-md-3">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Name &nbsp; </span></div>
          <div class="col-md-9">
          <input type="text" name="name" id="name" class="form-control" readonly></input>
          </div> 
          </td>
          <td colspan="2"><div class="col-md-4">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Fhather Name&nbsp;</span></div>
          <div class="col-md-8">
          <input type="text" name="fatherName" id="fatherName" class="form-control"  disabled></input>
          </div></td>
        </tr>
        <tr>
          <td colspan="2"><div class="col-md-3">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Roll No &nbsp; </span></div>
          <div class="col-md-9">
              <input type="text" class="form-control" name="Roll" id="Roll" disabled="disabled" ></input>
          </div> 
          </td>
          <td colspan="2"><div class="col-md-4">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Mother Name &nbsp; </span></div>
          <div class="col-md-8">
          <input type="text" name="MotherName" id="MotherName" class="form-control"  disabled></input>
          </div></td>
        </tr>
        <tr>
          <td colspan="2"><div class="col-md-3">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Session &nbsp; </span></div>
          <div class="col-md-9">
          <input type="text" name="Session" id="Session" class="form-control" disabled></input>
          </div> 
          </td>
          <td colspan="2"><div class="col-md-4">&nbsp; <span class="text-justify text-info" style="font-size: 15px;">Phone &nbsp; :</span></div>
          <div class="col-md-8">
          <input type="text" name="Phone" id="Phone" class="form-control"  disabled></input>
          </div></td>
        </tr>
        <tr>
      
       
    
 <tr>
          <td align="right">
           </td>
          <td align="right">
                   <span class="text-justify text-warning"><strong>Total  Amount &nbsp; :- </strong></span>       </td>
          <td><div class="col-md-12">
                <input type="text" class="form-control" id="total" name="total" readonly></input>
           </div></td>
		   <td></td>
         </tr>
         <tr>
          <td align="right">
          </td>
          <td align="right">
                    <span class="text-justify text-warning"><strong>Total Discount Amount &nbsp; :- </strong></span>      </td>
          <td><div class="col-md-12">
                <input type="text" class="form-control" id="Discount" name="Discount"  readonly></input>
          </div></td>
		   <td></td>
        </tr>
        <tr>
          <td align="right">
          </td>
          <td align="right">
                    <span class="text-justify text-warning"><strong>Total Paid Amount &nbsp; :- </strong></span>      </td>
          <td><div class="col-md-12">
                <input type="text" class="form-control" name="paidAmmount" id="paidAmmount" readonly ></input>
          </div></td>
		   <td></td>
        </tr>
         <tr>
          <td align="right">
           </td>
          <td align="right">
                    <span class="text-justify text-warning"><strong>(-) Blance  &nbsp; :- </strong></span>        </td>
          <td> <div class="col-md-12">
                <input type="text" class="form-control" name="TotalDueAmount"  id="TotalDueAmount" readonly></input>
           </div>  </td>
		    <td></td>
         </tr>
      </table>

          <table class="table table-responsive table-hover" style="border:1px #CCCCCC solid; margin-top:30px; color: #000; margin-top: -20px;">
        
     

        <tr>
          <td align="right">
          </td>
          <td align="right">
                    <span class="text-justify text-warning"><strong>Now Paid  &nbsp; :- </strong></span>      </td>
          <td><div class="col-md-12">
                <input type="text" class="form-control" name="paidAmount" id="paidAmount" onKeyUp="return DueAmmountfunction()"></input>
          </div></td>
        </tr>
   
         <tr>
          <td align="right">
           </td>
          <td align="right">
                   <span class="text-justify text-warning"><strong>Due Ammount &nbsp; :- </strong></span>       </td>
          <td><div class="col-md-12">
                <input type="text" class="form-control" id="DueAmmount"  name="DueAmmount" readonly=""></input>
           </div></td>
         </tr>
		 
        <tr>
          <td colspan="3" align="right">
             <span id="ShoeDialouge"></span>
        </tr> 
         <tr>
          <td colspan="3" align="center">
            <input type="button" value="ADD" name="add" style="width: 150px;" class="btn btn-primary" onClick="return ADDDATA()" ></input>          </td>
        </tr>
      </table>
	</div>
	<div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1" id="showSndPage">
					
	</div>
  </form>
  
  
    <script src="bootstrap/js/bootstrap.min.js"></script>
     </body>
</html>
