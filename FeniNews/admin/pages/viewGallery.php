<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 whit" id="result" align="center">
	
</div>
<div class="modal fade" id="editModal" role="dialog">
	<form method="post" action="#" enctype="multipart/form-data">
	    <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						&times;
					</button>
					<b>Edit: <span id="tii"></span></b>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-hover">
						<tr>
							<td>
								<input type="text" name="title" class="form-control" placeholder="Title" id="title" />
								<input type="hidden" name="editid" id="editid" >
							</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" id="save">
						<i class="fa fa-plus">
							Save
						</i>
					</button>
					<button type="button" data-dismiss="modal" class="btn btn-danger">
						<i class="fa fa-times"> Cancle</i>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="modal fade" id="deleteModal" role="dialog">
	<form method="post" action="#" enctype="multipart/form-data">
	    <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						&times;
					</button>
					<b>DELETE: Are you realy want to delete?<span id="tii"></span></b>
				</div>
				<div class="modal-body">
					<input type="hidden" name="deleteid" id="deleteid" >
					<input type="hidden" name="ext" id="ext" >
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" id="delete">
						<i class="fa fa-times">
							Delete
						</i>
					</button>
					<button type="button" data-dismiss="modal" class="btn btn-danger">
						<i class="fa fa-times"> Cancle</i>
					</button>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="modal fade" id="linkModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				Link: 
			</div>
			<div class="modal-body">
				<input type="text" name="link" id="link" placeholder="Image Link" class="form-control">
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-danger">
					<i class="fa fa-times"> Cancle</i>
				</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		selectAllPhoto();
	});
	function selectAllPhoto() {
		$("#result").html("<img src='../images/loading.gif' class='img-responsive msa' alt='Loading'>");
		var a = "1000";
		$.ajax({
			url: 'ajax/addPhoto.php',
			type: 'POST',
			data: {a: a},
			success: function(result){
				$("#result").html(result);
			}
		});
		
	}
</script>
<script type="text/javascript">
	function selectEdit(id,title) {
		$("#editid").val(id);
		$("#title").val(title);
	}
</script>
<script type="text/javascript">
	$("#save").click(function(event) {
		var editid = $("#editid").val();
		var edittitle = $("#title").val();
		$.ajax({
			url: 'ajax/addPhoto.php',
			type: 'POST',
			data: {editid: editid, edittitle: edittitle},
			success: function(result){
				selectAllPhoto();
				$("#editModal").modal("hide");
				$.gritter.add({
					title: 'Result!',
					text: result,
					sticky: false,
					time: '2000'
				});
			}
		});
	});
</script>
<script type="text/javascript">
	function selectDelete(id,ext) {
		$("#deleteid").val(id);
		$("#ext").val(ext);
	}
</script>
<script type="text/javascript">
	$("#delete").click(function(event) {
		var deleteid = $("#deleteid").val();
		var ext = $("#ext").val();
		$.ajax({
			url: 'ajax/addPhoto.php',
			type: 'POST',
			data: {deleteid: deleteid, ext: ext},
			success: function(result){
				selectAllPhoto();
				$("#deleteModal").modal("hide");
				$.gritter.add({
					title: 'Result!',
					text: result,
					sticky: false,
					time: '2000'
				});
			}
		});
	});
</script>
<script type="text/javascript">
	function getLink(id,ext){
		// var host = $(location).attr('hostname');
		// if(host=="localhost"){
		// 	var link = "./Gallery/"+id+"."+ext;
		// }
		var link = "../Gallery/"+id+"."+ext;
		$("#link").val(link);
	}
</script>