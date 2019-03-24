<div class="col-md-12">
	<table class="table table-bordered table-hover whit">
		<tr>
			<td colspan="2" class="title">Main Menu</td>
		</tr>
		<tr>
			<td>Menu name</td>
			<td><input type="text" name="name" id="mainMenu" class="form-control" placeholder="Menu name" ></td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<button class="btn btn-info btn-md" type="button" id="save"><i class="fa fa-plus"></i> Save</button>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		jQuery("#save").click(function(event) {
			var mainMenu = $("#mainMenu").val();
			$.ajax({
				url: 'ajax/mainMenu.php',
				type: 'POST',
				data: {mainMenu: mainMenu},
				success: function(data){
					$.gritter.add({
						title: 'Result!',
						text: data,
						sticky: false,
						time: '2000'
					});
					$("#mainMenu").val(null);
				}
			});
			
		});
	});
</script>