<div class="col-md-12">
	<form method="post" name="" enctype="multipart/form-data" id="form">
		<table class="table table-bordered table-striped">
			<tr>
				<td class="title" colspan="2">
					Change image
				</td>
			</tr>
			<tr>
				<td align="center"  class="tdD" width="50%">
					<?php
						if ($_GET["ext"]!="none") {
						?>
							<img  height="300" width="300" src="../<?php echo $_GET["refpath"] ?>/<?php echo $_GET["id"] ?>.<?php echo $_GET["ext"] ?>"/>
						<?php
						}else{
						?>
							<span class="label label-info">No image</span>
						<?php
						}
					?>
				</td>
				<td>
					<img id="preview"  height="300" width="300">
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2">
					<input type="file" name="file" onchange="preview_image(this)" style="display: none;" id="file" >
					<label class="btn btn-primary btn-sm" style="width: 160px;" for="file">Choose image</label>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<span id="status"></span>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<button class="btn btn-info" type="button" id="change" style="width: 120px;">
						<i class="fa fa-plus"></i> Change
					</button>
				</td>
			</tr>
		</table>
	</form>
</div>
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
				$("#preview").css('height','300px');
				$("#preview").addClass("img-responsive img-thumbnail");
            }
		}
	</script>

		<script type="text/javascript">
            $("#change").click(function() { 
            	if ($("#file").val()) {
            		var formData = new FormData();
	                $("#status").html("<img src='img/loading.gif' >");
	                formData.append('file', $('#file')[0].files[0]);
	                formData.append('imageId', '<?php echo htmlentities(htmlspecialchars($_GET["id"])) ?>');
	                formData.append('ref', '<?php echo htmlentities(htmlspecialchars($_GET["ref"])) ?>');
	                formData.append('refpath', '<?php echo htmlentities(htmlspecialchars($_GET["refpath"])) ?>');
	                $.ajax({
	                   url : 'ajax/uplodImage.php',
	                   type : 'POST',
	                   data : formData,
	                   processData: false, 
	                   contentType: false, 
	                   success : function(data) {
	                       $("#status").html(data);
	                   }
	                });
            	}else{
            		$("#status").html("<span class='text-danger'>Please select an image</span>");
            	}
            });
        </script>