  <?php
	error_reporting(1);
	@session_start();
	if($_SESSION["logstatus"] === "Active")
	{
	require_once("../db_connect/config.php");
    require_once("../db_connect/conect.php");
	date_default_timezone_set("Asia/Dhaka");
	$db = new database();
	

 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Show Result Sheet</title>

	<script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	 <script type="text/javascript">
             $(document).ready(function()
  {
        var checking_html = '<img src="search_group/loading.gif" /> Checking...';
       
        $('#className').change(function()
        {
            $('#item_result').html(checking_html);
                check_availability();
               Check_exam_type();
        });

         $('#tfclassName').change(function()
        {
            $('#item_result').html(checking_html);
                tfcheck_availability();
               Check_exam_type();
        });
    
 });

         //function to check username availability   
function check_availability()
{
        var class_name = $('#className').val();
        $.post("check_grou_name.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=0 )
                {
                    //show that the username is available
                    $('#groupname').html(result);
                    $('#item_result').html("");
                    $('#category_result').html('');
                }
                else
                {
                    //show that the username is NOT available
                    document.getElementById('category_result').style.color='RED';
                    $('#category_result').html('No Group Name Found');
                    $('#item_result').html("");
                    $('#groupname').html('');
                }
                
                $('#subject_type').html("");
                $('#sub_name').html("");
                $('#part_name').html('');
                $('#subjectcode').val('');
                 
        });

}

function tfcheck_availability(){

	 var class_name = $('#tfclassName').val();
        $.post("check_grou_name.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=0 )
                {
                    //show that the username is available
                    $('#tfgroupname').html(result);
                    $('#item_result').html("");
                    $('#category_result').html('');
                }
                else
                {
                    //show that the username is NOT available
                    document.getElementById('category_result').style.color='RED';
                    $('#category_result').html('No Group Name Found');
                    $('#item_result').html("");
                    $('#tfgroupname').html('');
                }
                
                $('#subject_type').html("");
                $('#sub_name').html("");
                $('#part_name').html('');
                $('#subjectcode').val('');
                 
        });

}
//function to check exam type availability  
function Check_exam_type()
{
        var class_name = $('#className').val();
        $.post("Check_exam_type.php", { className: class_name },
            function(result){
                //if the result is 1
                if(result !=0 )
                {
                    //show that the username is available
                    $('#examtype').html(result);
                    $('#checkingGroup').html("");
                    $('#category_result').html('');
                }
                else
                {
                    //show that the username is NOT available
                    $('#checkingGroup').html('No Exam  Name Found');
                    $('#item_result').html("");
                    $('#examtype').html('');
                }

        });

} 

function showstudent(){

	 var class_name = $('#className').val();
	 var groupname = $('#groupname').val();
	
	 var tfclass_name = $('#tfclassName').val();
	 var tfgroupname = $('#tfgroupname').val();


	 var status = 1;
	  var from = $('#from').val();
	 var to = $('#to').val();
	if(class_name == "Select One")
			{
					alert("Please Select Class Name");
					return false;
			}
			
			if(groupname == "Select Group")
			{
					alert("Please Select Exam Name");
					return false;
			}
			

			if(tfclass_name == "Select One")
			{
					alert("Please Select Class Name");
					return false;
			}
			
			if(tfgroupname == "Select Group")
			{
					alert("Please Select Exam Name");
					return false;
			}
			
			
		$.ajax({
				url:"transfersucc.php",
				type:"POST",
				data:{class_name:class_name,groupname:groupname,status:status,from:from,to:to,tfclass_name:tfclass_name,tfgroupname:tfgroupname},
				cache:false,
				success:function(data){
					//alert(data);
					$('#showMsg').html(data);
					
				}
			});

}
function check_all(){
		if($('#chkbx_all').is(':checked')){
				 		$('.check_elmnt').prop('checked', true);
						$('.roll').prop('disabled', false);
				 }else {
						 $('.roll').prop('disabled', true);
						$('.check_elmnt').prop('checked', false);
				 }
	}
	function byroollcheked(rollId){
					if($('#chek-'+rollId).is(':checked')){
				 		$('#rollNo-'+rollId).prop('disabled', false);
						
				 }else {
						$('#rollNo-'+rollId).prop('disabled', true);
				 }
		}




function Submit(){
	
			var counstudent = [];
			$('.check_elmnt').each(function(){
				if($(this).is(":checked"))
				{
					counstudent.push($(this).val());
				}
			
			});
	var totalsubject = [];
			$('.subjectid').each(function(){
				if($(this).is(":checked"))
				{

					totalsubject.push($(this).val());
				}
			
			});
			//alert(totalsubject);

			var transfer = "ddd";
		 var class_name = $('#className').val();
	 var groupname = $('#groupname').val();
	
	 var tfclass_name = $('#tfclassName').val();
	 var tfgroupname = $('#tfgroupname').val();
var from =parseInt($('#from').val());
			var to =parseInt($('#to').val());

			$.ajax({
				url:"transfersucc.php",
				type:"POST",
				data:{counstudent:counstudent,totalsubject:totalsubject,transfer:transfer,class_name:class_name,groupname:groupname,tfclass_name:tfclass_name,tfgroupname:tfgroupname},
				cache:false,
				success:function(data){
					// var fromInc=parseInt(from+to);
					// $('#from').val(fromInc);

					alert('Transfer Successfull');
					showstudent();
				}
			});
	}

	
</script>
    </head>

  <body>
  	<form name="teacherinfo" action="" method="post"  enctype="multipart/form-data" class="form-horizontal classtransfer" >
            <div class="col-md-8 col-md-offset-2" id="AddMarksStep1"><br/> <br/>
                <span class="glyphicon glyphicon-arrow-right text-justify text-uppercase text-warning" style="font-weight: bold; padding-top: 15px; font-size: 18px;"><strong style="padding-left:5px">Generate GPA </strong></span><br/>
			
                <table class="table table-responsive table-hover table-bordered" style="margin-top:10px;">
                    <tr>
                    	<td ><strong><span class="text-success" style="font-size: 15px;">Select Class</span></strong></td>
                        <td ><div class="col-md-8">
                        <select class="form-control" name="className" id="className" style="width:280px; border-radius:0px;">
                        <option>Select One</option>
                        <?php 
                            $select_class="SELECT * FROM `add_class` GROUP BY `id` ORDER BY `class_name` ASC";
                            $check_query=$db->select_query($select_class);
                            if($check_query){
                                while($fetch_class=$check_query->fetch_array())
                                {
                        ?>
                        <option value="<?php echo $fetch_class[0]?>"><?php echo $fetch_class[2];?></option><span id="item_result"></span>
                        <?php } } else {?>
                        <option></option>
                        <?php } ?>
                        </select></div>
                    </tr>
 					 <tr>
                    	<td ><strong><span class="text-success" style="font-size: 15px;">Select Group</span></strong></td>
                        <td ><div class="col-md-8">
                        <select name="groupname" id="groupname" class="form-control" style="width:280px; border-radius:0px;">
						
						</select></div>
                    </tr>

                    
					<tr>
                    	<td ><strong><span class="text-success" style="font-size: 15px;">Transfer Class</span></strong></td>
                        <td ><div class="col-md-8">
                        <select class="form-control" name="tfclassName" id="tfclassName" style="width:280px; border-radius:0px;">
                        <option>Select One</option>
                        <?php 
                            $select_class="SELECT * FROM `add_class` GROUP BY `id` ORDER BY `class_name` ASC";
                            $check_query=$db->select_query($select_class);
                            if($check_query){
                                while($fetch_class=$check_query->fetch_array())
                                {
                        ?>
                        <option value="<?php echo $fetch_class[0]?>"><?php echo $fetch_class[2];?></option><span id="item_result"></span>
                        <?php } } else {?>
                        <option></option>
                        <?php } ?>
                        </select></div>
                    </tr>
 					 <tr>
                    	<td ><strong><span class="text-success" style="font-size: 15px;">Transfer Group</span></strong></td>
                        <td ><div class="col-md-8">
                        <select name="tfgroupname" id="tfgroupname" class="form-control" style="width:280px; border-radius:0px;">
						
						</select></div>
                    </tr>
                    
            
				<tr>
					<Td colspan="2" align="center">
						 <input type="text"  name="from" id="from"   style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; height:25px;  text-align:center;">
-
<label for="to" class="text-warning">To Limit No - </label>
<input type="text" name="to" id="to"  style="width:120px; background:#F7071D; border:none; font-weight:bold; color:#fff; border-radius: 0px;  text-align:center;"/> 	&nbsp;&nbsp;&nbsp;<input type="button" name="submit" value="Show  Student" class="btn btn-danger btn-md"  style="width: 180px" onClick="return showstudent()"></input>
					</Td>
				</tr>
				<tr>
					<Td colspan="2" align="right">
								<strong style="font-weight:bold; font-size:15px"><span id="showMsg" class="text-danger"></span></strong>
								<strong id="runnigmsg" class="text-danger" style="font-weight:bold; font-size:15px"></strong>
								
					</Td>
				</tr>
				
              
                </table>
							
                </div>
				
				
		
     </form>
 <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>
