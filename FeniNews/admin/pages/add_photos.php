<div class="col-md-12">
	<table class="table table-bordered table-striped">
		<tr>
			<td colspan="2" class="title">Photo Gallery</td>
		</tr>
		<tr>
			<td>Title</td>
			<td>
				<input type="text" name="title" class="form-control" placeholder="Title" id="title" />
			</td>
		</tr>
		<tr>
			<td>Description</td>
			<td>
				<textarea id="redactor"></textarea>
			</td>
		</tr>
		<tr>
			<td>Select image</td>
			<td>
				<div class="form-inline"><input type="file" name="file" id="file" onchange="preview_image(this)" style="display: none;" >
					<label for="file" class="btn btn-success" style="width: 250px;">Choose image</label><img id="preview" style="margin-left: 20px; cursor: pointer;" data-toggle="modal" data-target="#imagem" onclick="selectimage()">
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<button class="btn btn-info" type="button" id="save" style="width: 160px;">
					<i class="fa fa-plus"> Save</i>
				</button>
			</td>
		</tr>
	</table>
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