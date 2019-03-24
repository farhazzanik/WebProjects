<div class="col-md-12">
	<table class="table table-borderd table-hover whit">
		<tr>
			<td class="title" colspan="2">District</td>
		</tr>
		<tr>
			<td width="30%">Select Division</td>
			<td>
				<select  name="division_id" class="form-control select2" style="width: 100%;" id="division_id">
                  	<?php
						$result = $db->selectSub("divisions_info");
						foreach ($result as $value) {
					?>
					<option value="<?php echo $value["id"] ?>"><?php echo $value["divisions_name"] ?></option>
					<?php
						}
					?>
                </select>
			</td>
		</tr>
		<tr>
			<td>District Name</td>
			<td>
				<input type="text" name="district" class="form-control" placeholder="District Name" id="districtName">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<button class="btn btn-info" type="button" id="save" style="width: 80px;">
					<i class="fa fa-plus"></i> Save
				</button>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
	$("#save").click(function(event) {
		var division_id = $("#division_id").val();
		var districtName = $("#districtName").val();
		$.ajax({
			url: 'ajax/districts.php',
			type: 'POST',
			data: {division_id: division_id,districtName: districtName},
			success:function(data){
				$.gritter.add({
					title: 'Result!',
					text: data,
					sticky: false,
					time: '2000'
				});
				$("#districtName").val(null);
			}
		});
	});
</script>