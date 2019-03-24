<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
	<form method="post" action="#" enctype="multipart/form-data">
		<table class="table table-bordered table-responsive">
			<tr>
				<td class="title" colspan="2">Add Photo</td>
			</tr>
			<tr>
				<td>Title</td>
				<td>
					<input type="text" name="title" class="form-control" placeholder="Title" id="title" />
				</td>
			</tr>
			<tr>
				<td>Image</td>
				<td>
					<label for="file" class="btn btn-primary" style="width: 160px;"><i class="fa fa-folder"></i>&nbsp;&nbsp;&nbsp;&nbsp;Choose file</label>

					<input type="file" onchange="preview_image(this)" name="file" id="file" style="display: none;" />

					<img id="preview" style="margin-left: 20px; cursor: pointer;" data-toggle="modal" data-target="#imagem" onclick="selectimage()">
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<button type="button" class="btn btn-success" id="upload">
						<i class="fa fa-plus"> &nbsp;Upload</i>
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
	$("#upload").click(function() {
		var formData = new FormData();
		formData.append('file', jQuery('#file')[0].files[0]);
		formData.append('title', jQuery("#title").val());
		$.ajax({
			url: 'ajax/addPhoto.php',
			type: 'POST',
			data: formData,
			contentType: false,
		  	processData: false,
			success: function(result){
				jQuery("#title").val(null);
				alert(result);
			}
		});
	});
</script>