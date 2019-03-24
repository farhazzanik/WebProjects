<div class="col-md-12">
	<table class="table table-bordered table-hover whit">
		<tr>
			<td class="title" colspan="2">Add thana</td>
		</tr>
		<tr>
			<td>Select Division</td>
			<td>
				<select  name="division_id" class="form-control select2" style="width: 100%;" id="division_id" onchange="selectDistrictChange()">
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
			<td>Select Districts</td>
			<td>
				<select  name="districts_id" class="form-control select2" style="width: 100%;" id="districts_id">
                  	
                </select>
			</td>
		</tr>
		<tr>
			<td>Thana Name</td>
			<td>
				<input type="text" name="thana" id="thana" class="form-control" placeholder="Thana Name">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<button class="btn btn-info" type="button" id="save" style="width: 120px;">
					<i class="fa fa-plus"></i> Save
				</button>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
	function selectDistrictChange() {
		var division_id = $("#division_id").val();
		$.ajax({
			url: 'ajax/thanas.php',
			type: 'POST',
			data: {division_id: division_id},
			success: function(data){
				$("#districts_id").html(data);
			}
		});
		
	}
	jQuery(document).ready(function($) {
		selectDistrictChange();
	});
</script>
<script type="text/javascript">
	$("#save").click(function(event) {
		var division = $("#division_id").val(); 
		var districts_id = $("#districts_id").val();
		var thanas = $("#thana").val();
		$.ajax({
			url: 'ajax/thanas.php',
			type: 'POST',
			data: {thanas: thanas,districts_id:districts_id,division:division},
			success: function(data){
				$.gritter.add({
					title: 'Result!',
					text: data,
					sticky: false,
					time: '2000'
				});
				$("#thana").val(null);
			}
		});
		
	});
</script>