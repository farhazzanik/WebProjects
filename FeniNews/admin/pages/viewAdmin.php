<div class="col-md-12">
	<table class="table table-bordered table-hover whit">
		<tr>
			<td class="title" colspan="5">Admin Info</td>
		</tr>
		<tr>
			<td>Name</td>
			<td>Email</td>
			<td>Phone</td>
			<td>Image</td>
			<td>Action</td>
		</tr>
		<?php
			$db->tableName("admin_info");
			$fetchAdmin = $db->selectAll();
			foreach ($fetchAdmin as $admin) {
		?>
		<tr>
			<td><?php echo $admin["name"] ?></td>
			<td><?php echo $admin["email"] ?></td>
			<td><?php echo $admin["phone"] ?></td>
			<td><img src="../images/<?php echo $admin["id"]; ?>.<?php echo $admin["ext"]; ?>" style="height: 80px; width: 75px;"></td>
			<td>
					<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="slectPriority('<?php echo $admin["id"]; ?>','<?php echo $admin["name"]; ?>')" id="priority">
						<i class="fa  fa-get-pocket"> </i>
						See Priority
					</button>
					<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal" onclick="selectDelete('<?php echo $admin["name"] ?>','<?php echo $admin["id"] ?>','<?php echo $admin["ext"]; ?>')" id="delete">
						<i class="fa  fa-times"> </i>
						Delete
					</button>
			</td>
		</tr>
		<?php
			}
		?>
	</table>
</div>

<!--edit modal-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Admin name: <span id="ti"></span></b></h4>
        </div>
        <div class="modal-body"  id="result">
        	<img src="./img/loading.gif" style="margin:0px auto; ">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--end of edit modal-->

  <!--delete modal-->
<div class="modal fade" id="Modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Delete: <span id="ii"></span></b></h4>
        </div>
        <div class="modal-body">
        	<input type="hidden" name="did" id="did">
          <input type="hidden" name="ext" id="ext">
        </div>
        <div class="modal-footer">
        	<div class="btn-group">
        		<button type="button" class="btn btn-danger btn-sm" onclick="deleteAdmin()" >
        			<span class="fa fa-times"> </span> Delete
	        	</button>
	            <button type="button" class="btn btn-info  btn-sm" data-dismiss="modal">
	            	<span class="fa fa-times"> </span> Cancle
	            </button>
        	</div>
        </div>
      </div>
      
    </div>
  </div>
  <!--end of delete modal-->

  <script type="text/javascript">
  	function slectPriority(id,name) {
  		$("#ti").text(name);
  		$.ajax({
  			url: 'ajax/admin.php',
  			type: 'POST',
  			data: {id: id},
  			success:function(data){
  				$("#result").html(data);
  			}
  		});
  		
  	}
  </script>
  <script type="text/javascript">
  	function selectDelete(name,id,ext) {
  		$("#ii").text(name);
  		$("#did").val(id);
      $("#ext").val(ext);
  	}
  </script>
  <script type="text/javascript">
  	function deleteAdmin() {
  		var did = $("#did").val();
      var extttt = $("#ext").val();
  		$.ajax({
  			url: 'ajax/admin.php',
  			type: 'POST',
  			data: {did: did,extensionnn: extttt},
  			success:function(data){
  				alert(data);
  				location.reload();
  			}
  		});
  		
  	}
  </script>