<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 whit">
	<form method="post" action="#" enctype="multipart/form-data">
		<table class="table table-bordered table-responsive">
			<tr class="title">
				<td colspan="2" align="center">Daily Newspaper</td>
			</tr>
			<tr>
				<td>
					Title
				</td>
				<td>
					<input type="text" name="title" id="title" class="form-control" placeholder="Title" />
				</td>
			</tr>
			<tr>
				<td>
					Description
				</td>
				<td>
					<textarea class="form-control" placeholder="Description" id="redactor" style="resize: none;" rows="3" name="description"></textarea>
				</td>
			</tr>
			<tr>
				<td>Reporter's Name</td>
				<td>
					<input type="text" name="reporterName" class="form-control" placeholder="Reporter's Name" id="reporterName" >
				</td>
			</tr>
			<tr>
				<td>
					Image
				</td>
				<td>
					<input type="file" name="file" id="file" style="display: none;" onchange="preview_image(this)" >
					<label for="file" class="btn btn-success" style="width: 200px
					;">
						<i class="fa fa-folder"> &nbsp;&nbsp;Choose image</i>
					</label>
					<img id="preview" style="margin-left: 20px; cursor: pointer;" data-toggle="modal" data-target="#imagem" onclick="selectimage()">
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<button type="button" class="btn btn-primary" id="save" style="width: 120px">
						<i class="fa fa-plus"> Save</i>
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
	$("#save").click(function() {
		$.gritter.add({
			title: 'Result!',
			text: "Proccesing....",
			sticky: false,
			time: '2000'
		});
		var formData = new FormData();
		formData.append('file', jQuery('#file')[0].files[0]);
		formData.append('title', jQuery("#title").val());
		formData.append('description', jQuery("#redactor").val());
		formData.append('reporterName', jQuery("#reporterName").val());
		$.ajax({
			url: 'ajax/addNewsPaper.php',
			type: 'POST',
			data: formData,
			contentType: false,
		  	processData: false,
			success: function(result){
				jQuery("#title").val(null);
				jQuery('#redactor').redactor('set', null);
				jQuery("#reporterName").val(null);
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