
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title></title>
  <script type="text/javascript" src="../js/vendor/jquery-1.11.3.min.js"></script>
	  <script src="textEdit/redactor/redactor.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="datespicker/datepicker.css">
    <link rel="stylesheet" href="datespicker/bootstrap.min.css">

   
     <script src="datespicker/bootstrap-datepicker.js"></script>




   
	<script>
	
	 $(document).ready(function(){
	$('#teacherId').keyup(function(){
	
		var teacherID = $(this).val();
		var forTeacherPaybalSeettion = "dd";
		if(teacherID != ""){
			$.ajax({
				url : "autoComSTd.php",
				data : {teacherID:teacherID,forTeacherPaybalSeettion:forTeacherPaybalSeettion},
				type : "POST",
				success:function(data){
					
					$('#idlist').fadeIn();
					$('#idlist').html(data);
				
				}
			});
		}
		
	});
	
		$(document).on('click','li',function(){
			$('#teacherId').val($(this).text());
			$('#idlist').fadeOut();
			showAccountINfor();
			
		});
});

 $(document).ready(function(){
	$('#struffID').keyup(function(){
	//	alert('dddd');
		var struffID = $(this).val();
		
		var forSturffPayableSetting = "dd";
		if(struffID != ""){
			$.ajax({
				url : "autoComSTd.php",
				data : {struffID:struffID,forSturffPayableSetting:forSturffPayableSetting},
				type : "POST",
				success:function(data){
					//alert(data);
					$('#stflist').fadeIn();
					$('#stflist').html(data);
				
				}
			});
		}
		
	});
	
		$(document).on('click','li',function(){
			$('#struffID').val($(this).text());
			$('#stflist').fadeOut();
			showstrffAccountinfo();
			
		});
});
		
		 $(document).ready(function(){
	$('#Student').keyup(function(){
	//	alert('dddd');
		var Student = $(this).val();
		
		var forSTudenDUereport = "dd";
		if(Student != ""){
			$.ajax({
				url : "autoComSTd.php",
				data : {Student:Student,forSTudenDUereport:forSTudenDUereport},
				type : "POST",
				success:function(data){
					//alert(data);
					$('#stdlist').fadeIn();
					$('#stdlist').html(data);
				
				}
			});
		}
		
	});
	
		$(document).on('click','li',function(){
			$('#Student').val($(this).text());
			$('#stdlist').fadeOut();
			shoDueAmmount();
			
		});
});
			
				/*<!-- $(document).ready(function () {
                 
                    $('#years').datepicker({
                         minViewMode: 2,
         format: 'yyyy'
                    }).on('changeDate', function(e){
					$(this).datepicker('hide');
					
				}); 
				
				
                });-->*/
				
				
				
				
				/*$("#example12").datepicker( {
					format: "yyyy",
					viewMode: "years", 
					minViewMode: "years"
				}).on('changeDate', function(e){
					$(this).datepicker('hide');
				});*/


			function showAccountINfor(){
					var Years = $('#Years').val();
					var teacherId = $('#teacherId').val();
					var forteacher  = "ddd";
			if(teacherId !=""){
							$.ajax({
										url : "showAccounAndDueInfo.php",
										data : {Years:Years,teacherId:teacherId,forteacher:forteacher},
										type : "POST",
										success:function(data){
												
												$('#showDailyreport').html(data);
										}
									});
									}else {
										alert("Please Fill Up Important Fields..!!");
									}
					
					
			}
			
			function showstrffAccountinfo(){
					var sYears = $('#sYears').val();
					var struffID = $('#struffID').val();
					var forstruffID  = "ddd";
					
					if(struffID !='' ){
					 	
						
							$.ajax({
										url : "showAccounAndDueInfo.php",
										data : {sYears:sYears,struffID:struffID,forstruffID:forstruffID},
										type : "POST",
										success:function(data){
										//alert(data);
												$('#showMonthlyreport').html(data);
										}
									});
										
					}else{
							alert('Please Select The Date !!');
					}
			}
			
			function shoDueAmmount(){
					var stdYears = $('#stdYears').val();
					var Student = $('#Student').val();
					var forSTudent  = "ddd";
					
					if(Student !=""){
						$.ajax({
										url : "showAccounAndDueInfo.php",
										data : {stdYears:stdYears,forSTudent:forSTudent,Student:Student},
										type : "POST",
										success:function(data){
												
													//alert(data);
												$('#showEarlyCost').html(data);
										}
									});
					
					}else{
							alert('Please Enter The Year !!');
					}
			}
			 
   
	</script>
	
	</head>
	 <style type="text/css">
<!--
.style1 {color: #CCCCCC}
-->
    </style>
	<style>
	 
	.ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  float: left;
  display: none;
  min-width: 310px;
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
  <body>
  <form name="" action="#" method="post"  enctype="multipart/form-data" class="form-horizontal dataFrom">
  	<div class="has-feedback col-xs-12 col-sm-8 col-lg-10 col-md-10  col-md-offset-1 table-bordered" style="margin-top:10px;">

<ul class="nav nav-tabs" style="margin-top:20px; ">
  <li class="active"><a data-toggle="tab" href="#home">Teacher's</a></li>
  <li><a data-toggle="tab" href="#menu1">Struff's</a></li>
  <li><a data-toggle="tab" href="#menu2">Student's</a></li>
</ul>

<div class="tab-content table-bordered" style="margin-bottom:20px;">
  <div id="home" class="tab-pane fade in active" style="margin-bottom:10px;">
    			<table style="width:100%;">
						<tr>
								<td><span class="text-success" style="font-size:15px; padding-left:10px;"><strong>Teacher ID: </strong></span><br/>	
								<div class="col-md-12"> <input type="text" autocomplete="off" name="teacherId"  onKeyUp="return showIdby()"  id="teacherId" placeholder='Teacher ID' style="width:100%;  height:30px;"/>
								<div id="idlist" class="ui-autocomplete"  style="text-align:left"></div></div>
								</td>
								<td><span class="text-success" style="font-size:15px; padding-left:10px;"><strong>Enter Year: </strong></span><br/>	
								<input type="text" name="Years" id="Years" onKeyUp="return showAccountINfor()" style="width:  300px; height:30px; margin-left:10px;"  /></td>
								
						</tr>
				</table>		
		
					<!--<span class="text-success" style="font-size:15px; padding-left:10px;"><strong>Select Date : </strong></span><br/>
						<input type="text" name="date" id="date" style="width: 500px; height:30px; margin-left:10px;" onSelect="return ShowReportDaily()" onClick="return ShowReportDaily()" />&nbsp;&nbsp;-->
			
			
			<div id="showDailyreport" style="margin-top:20px;"></div>
  	
  </div>
  <div id="menu1" class="tab-pane fade" style="margin-bottom:20px;">
  
  		
		<table style="width:100%;">
						<tr style="text-align:left">
								<td><span class="text-success" style="font-size:15px; padding-left:10px;"><strong>Struff's ID: </strong></span><br/>	
								<div class="col-md-12"> <input type="text" autocomplete="off" name="struffID"  onKeyUp="return showIdby()"  id="struffID" placeholder='Struff ID' style="width:100%;  height:30px;"/>
								<div id="stflist" class="ui-autocomplete"  style="text-align:left"></div></div>
								</td>
								<td><span class="text-success" style="font-size:15px; padding-left:10px;"><strong>Enter Year: </strong></span><br/>	
								<input type="text" name="sYears" id="sYears" onKeyUp="return showstrffAccountinfo()" style="width:  300px; height:30px; margin-left:10px;"  /></td>
								
						</tr>
				</table>		
								
								<div id="showMonthlyreport" style="margin-top:20px;"></div>
  
  
  </div>
  <div id="menu2" class="tab-pane fade">
			   <table style="width:100%;">
						<tr>
								<td><span class="text-success" style="font-size:15px; padding-left:10px;"><strong>Student's ID: </strong></span><br/>	
								<div class="col-md-12"> <input type="text" autocomplete="off" name="Student"  onKeyUp="return showIdby()"  id="Student" placeholder='Student ID' style="width:100%;  height:30px;"/>
								<div id="stdlist" class="ui-autocomplete"  style="text-align:left"></div></div>
								</td>
								<td><span class="text-success" style="font-size:15px; padding-left:10px;"><strong>Enter Year: </strong></span><br/>	
								<input type="text" name="stdYears" id="stdYears" onKeyUp="return shoDueAmmount()" style="width:  300px; height:30px; margin-left:10px;"  /></td>
								
						</tr>
				</table>	
										<div id="showEarlyCost" style="margin-top:20px;"></div>
  </div>
  		
</div>
    <script src="../js/bootstrap.min.js"></script>
	
	</form>
  </body>
</html>