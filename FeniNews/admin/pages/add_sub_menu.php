<div class="col-md-12">
	<table class="table table-bordered table-hover whit">
		<tr>
			<td colspan="2" class="title">Sub Menu</td>
		</tr>
		<tr>
			<td>Main menu</td>
			<td>
				<select  name="main_link" class="form-control select2" style="width: 100%;" id="mainMenuId">
                  	<?php
						$result = $db->selectSub("menu_info");
						foreach ($result as $value) {
					?>
					<option value="<?php echo $value["id"] ?>"><?php echo $value["menu_name"] ?></option>
					<?php
						}
					?>
                </select>
			</td>
		</tr>
		<tr>
			<td>Submenu Name</td>
			<td>
                 <input type="text" name="submenuName" class="form-control" placeholder="Submenu Name" id="submenuName">
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<button class="btn btn-info btn-md" type="button" id="saveSubmenu"><i class="fa fa-plus"></i> Save</button>
			</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
	$("#saveSubmenu").click(function(event) {
		var mainMenuId = $("#mainMenuId").val();
		var submenuName = $("#submenuName").val();
		$.ajax({
			url: 'ajax/submenu.php',
			type: 'POST',
			data: {mainMenuId: mainMenuId,submenuName:submenuName},
			success: function(data){
				$.gritter.add({
					title: 'Result!',
					text: data,
					sticky: false,
					time: '2000'
				});
				$("#submenuName").val(null);
			}
		});
		
	});
</script>