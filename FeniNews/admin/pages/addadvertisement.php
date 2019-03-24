<div class="col-md-12 wht">
	<form method="post" action="#" enctype="multipart/form-data">
		<table class="table table-bordered">
			<tr>
				<td colspan="2" align="center" class="title">
					Add advertisement
				</td>
			</tr>
			<tr>
				<td>Title</td>
				<td><input type="text" name="title" placeholder="title" id="title" class="form-control" /></td>
			</tr>
			<tr>
				<td>Link</td>
				<td><input type="text" name="link" placeholder="Link" id="link" class="form-control" /></td>
			</tr>
			<tr>
				<td>Description</td>
				<td>
					<textarea class="form-control" name="description" id="description" style="resize: none;" rows="3" placeholder="Description"></textarea>
				</td>
			</tr>
			<tr>
				<td>Position</td>
				<td>
					<select name="position" class="form-control" id="position" onchange="selectSize()">
						<option>Select position</option>
						<?php 
							$db->tableName("advertisementposition");
							$fetchAll = $db->selectAll();
							foreach ($fetchAll as $fetch) {
								echo "<option>".$fetch["position"]."</option>";
							}
						 ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Size</td>
				<td>
					<select name="sizee" class="form-control" id="sizee">
						<option>Select Size</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Image</td>
				<td>
					<div class="form-inline"><input type="file" name="file" id="file" onchange="preview_image(this)" style="display: none;" >
						<label for="file" class="btn btn-success" style="width: 250px;">Choose image</label><img id="preview" style="margin-left: 20px; cursor: pointer;" data-toggle="modal" data-target="#imagem" onclick="selectimage()">
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<button type="button" class="btn btn-info" id="save">
						<i class="fa fa-plus"> Save</i>
					</button>
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="getAllAdd()">
						<i class="fa fa-link"></i> View
					</button>
				</td>
			</tr>
		</table>
	</form>
</div>
<!--Image modal-->
  <div class="modal fade" id="imagem" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Image preview =></b></h4>
        </div>
        <div class="modal-body"  align="center">
         	<img src="" id="prpr" class="img-responsive">
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-info" data-dismiss="modal">
        		<span class="fa fa-times"> </span> Close
        	</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--Image modal-->
  <!--View modal-->
  <div class="modal fade" id="viewModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Addvertisement</b></h4>
        </div>
        <div class="modal-body"  align="center" id="rest">
         	
        </div>
        <div class="modal-footer">
        </div>
      </div>
      
    </div>
  </div>
  <!--View modal-->
  <!--Delete modal-->
  <div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Are you realy want to delete?</b></h4>
        </div>
        <div class="modal-body"  align="center">
         	<input type="hidden" name="deleteID" id="deleteID">
         	<input type="hidden" name="deleteExt" id="deleteExt">
        </div>
        <div class="modal-footer">
        	<div class="btn-group">
        		<button type="button" class="btn btn-danger" onclick="deleteAdd()">
        			<i class="fa fa-times"> Delete</i>
        		</button>
        		<button type="button" class="btn btn-info" onclick="getBack()" data-dismiss="modal">
        			<i class="fa fa-plus"> Cancle</i>
        		</button>
        	</div>
        </div>
      </div>
      
    </div>
  </div>
  <!--Delete modal-->
  <script>
		function preview_image(e) {
			var file = e.files[0];
			var imagefile = file.type;		
			var type = ["image/jpeg","image/png","image/jpg","image/gif"];
			if(imagefile==type[0] || imagefile==type[1] || imagefile==type[2] ||imagefile==type[3]){
				var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(e.files[0]);
			}else{
				alert("Please select a vild image");
			}
            function imageIsLoaded(e) {
                $("#file").css('border-color','GREEN');
                $("#preview").attr('src',e.target.result);
				$("#preview").css('height','70px');
				$("#preview").addClass("img-responsive img-thumbnail");
            }
		}
	</script>  
	<script type="text/javascript">
		function selectimage() {
			var attra = $("#preview").attr('src');
			$("#prpr").attr('src', attra);
		}
	</script>
	<script type="text/javascript">
		function selectSize() {
			var position = $("#position").val();
			$.ajax({
				url: 'ajax/addadvertisement.php',
				type: 'POST',
				data: {positionn: position},
				success: function(result){
					$("#sizee").html(result);
				}
			});
			
		}
	</script>
	<script type="text/javascript">
	$("#save").click(function() {
		var title = jQuery("#title").val();
		var formData = new FormData();
		if (title) {
			formData.append('file', jQuery('#file')[0].files[0]);
			formData.append('title', jQuery("#title").val());
			formData.append('link', jQuery("#link").val());
			formData.append('description', jQuery("#description").val());
			formData.append('position', jQuery("#position").val());
			formData.append('sizee', jQuery("#sizee").val());
			$.ajax({
				url: 'ajax/addadvertisement.php',
				type: 'POST',
				data: formData,
				contentType: false,
			  	processData: false,
				success: function(result){
					alert(result);
					jQuery("#title").val(null);
					jQuery("#link").val(null);
					jQuery("#description").val(null);
					jQuery("#position").val(null);
					jQuery("#sizee").val(null);
				}
			});
		}else{
			alert("Please fill out all fields");
		}
	});
</script>
<script type="text/javascript">
	function getAllAdd(){
		var rrr = 10000;
		$.ajax({
			url: 'ajax/getAdd.php',
			type: 'POST',
			data: {rrr: rrr},
			success: function(result){
				$("#rest").html(result);
			}
		});
		
	}
</script>
<script type="text/javascript">
	function selectDelete(id,ext){
		$("#viewModal").modal("hide");
		$("#deleteModal").modal("show");
		$("#deleteID").val(id);
		$("#deleteExt").val(ext);
	}
</script>
<script type="text/javascript">
	function deleteAdd(){
		var deleteID = $("#deleteID").val();
		var deleteExt = $("#deleteExt").val();
		$.ajax({
			url: 'ajax/getAdd.php',
			type: 'POST',
			data: {deleteID: deleteID, deleteExt: deleteExt},
			success: function(result){
				alert(result);
				$("#viewModal").modal("show");
				$("#deleteModal").modal("hide");
				getAllAdd();
			}
		});
	}
</script>
<script type="text/javascript">
	function getBack(){
		$("#viewModal").modal("show");
		$("#deleteModal").modal("hide");
	}
</script>