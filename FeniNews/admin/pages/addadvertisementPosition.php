<div class="col-lg-12 col-md-12 wht">
	<form method="post" id="form">
		<table class="table table-bordered table-striped">
			<tr>
				<td class="title" colspan="2" align="center">Advertisement positions</td>
			</tr>
			<tr>
				<td>Position</td>
				<td>
					<input type="text" name="position" id="position" class="form-control" placeholder="Position..." />
				</td>
			</tr>
			<tr>
				<td>Size</td>
				<td>
					<input type="text" name="size" id="size" class="form-control" placeholder="Size..." />
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<button type="submit" class="btn btn-info" id="save">
						<i class="fa fa-plus"> Save</i>
					</button>
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="getAllPosition()">
						<i class="fa fa-history"> View</i>
					</button>
				</td>
			</tr>
		</table>
	</form>
</div>
 <!--view modal-->
  <div class="modal fade" id="viewModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>All position :</b></h4>
        </div>
        <div class="modal-body" id="rrr">
          
        </div>
        <div class="modal-footer">
        </div>
      </div>
      
    </div>
  </div>
  <!--view modal-->

  <!--Edit modal-->
  <div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Edit :</b></h4>
        </div>
        <div class="modal-body" id="rr">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" onclick="editPostion()">
            <span class="fa fa-edit"> Save</span>
          </button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--edit modal-->
<!--delte modal-->
  <div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Are you realy want to delete ?</b></h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="deleteID" id="deleteID">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" onclick="deletePostion()">
            <span class="fa fa-times"> Save</span>
          </button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-plus"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--delete modal-->
<script type="text/javascript">
	$("#form").submit(function(event) {
		var position = $("#position").val();
		var sizee = $("#size").val();
		$.ajax({
			url: 'ajax/addposition.php',
			type: 'POST',
			data: {position: position, sizee: sizee},
			success: function(result){
				$("#position").val(null);
				$("#size").val(null);
				alert(result);
			}
		});
		
		event.preventDefault();
	});
</script>
<script type="text/javascript">
	function getAllPosition() {
		$.ajax({
			url: 'ajax/addposition.php',
			type: 'POST',
			data: {a: 10},
			success: function(data){
				$("#rrr").html(data);
			}
		});
		
	}
</script>
<script type="text/javascript">
	function selectEdit(id) {
		$("#viewModal").modal("hide");
		$("#editModal").modal("show");
		$.ajax({
			url: 'ajax/addposition.php',
			type: 'POST',
			data: {selectId: id},
			success: function(result){
				$("#rr").html(result);
			}
		});
		
	}
</script>
<script type="text/javascript">
	function editPostion(){
		var editId = $("#editID").val();
		var editpositions = $("#positionsss").val();
		var editsize = $("#sizzze").val();
		$.ajax({
			url: 'ajax/addposition.php',
			type: 'POST',
			data: {editId: editId, editpositions: editpositions, editsize: editsize},
			success: function(result){
				alert(result);
				if (result == "Edited successfully") {
					getAllPosition();
					$("#editModal").modal("hide");
					$("#viewModal").modal("show");
				}
			}
		});
		
	}
</script>
<script type="text/javascript">
	function selectDelete(deleteID) {
		$("#viewModal").modal("hide");
		$("#deleteModal").modal("show");
		$("#deleteID").val(deleteID);
	}
</script>
<script type="text/javascript">
	function deletePostion() {
		var deleteID = $("#deleteID").val();
		$.ajax({
			url: 'ajax/addposition.php',
			type: 'POST',
			data: {deleteID: deleteID},
			success: function(result){
				alert(result);
				if (result == "Deleted successfully") {
					getAllPosition();
					$("#deleteModal").modal("hide");
					$("#viewModal").modal("show");
				}
			}
		});
		
	}
</script>