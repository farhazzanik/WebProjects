<div class="col-md-12">
	<table class="table table-bordered table-hover whit">
		<tr>
			<td class="title" colspan="2">Add division</td>
		</tr>
		<tr>
			<td>Division Name</td>
			<td>
				<input type="text" name="division" class="form-control" placeholder="Division Name" id="division" />
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<button class="btn btn-info" style="width: 80px;" type="button" name="add" id="add">
					<i class="fa fa-plus"></i> Save
				</button>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
	$("#add").click(function(event) {
		var division = $("#division").val();
		$.ajax({
			url: 'ajax/divisions.php',
			type: 'POST',
			data: {division: division},
			success: function(data){
				$.gritter.add({
					title: 'Result!',
					text: data,
					sticky: false,
					time: '2000'
				});
				$("#division").val(null);
			}
		});
	});
</script>