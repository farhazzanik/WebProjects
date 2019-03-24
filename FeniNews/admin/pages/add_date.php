<?php
 date_default_timezone_set('Asia/Dhaka');
?>
<div class="col-md-12">
	<table class="table table-hover table-bordered whit">
		<tr>
			<td class="title" colspan="2">Update Date in Bangla</td>
		</tr>
		<tr>
			<td>English Date</td>
			<td>
				<div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" placeholder="mm/dd/yyyy" value="<?php echo date("m/d/Y") ?>">
                </div>
			</td>
		</tr>
		<tr>
			<td>Bangla Date</td>
			<td>
				<div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
				<input type="text" name="bdate" id="bdate" class="form-control" placeholder="Bangla Date">
				</div>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<button class="btn btn-info btn-md" type="button" id="savedate"><i class="fa fa-plus"></i> Save</button>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
	$("#savedate").click(function(event) {
		var edate = $("#datepicker").val();
		var bdate = $("#bdate").val();
		$.ajax({
			url: 'ajax/date.php',
			type: 'POST',
			data: {edate: edate,bdate: bdate},
			success:function(data){
				$.gritter.add({
					title: 'Result!',
					text: data,
					sticky: false,
					time: '2000'
				});
				$("#bdate").val(null);
			}
		});
		
	});
</script>