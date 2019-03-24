<style type="text/css">
	.imgLoad{
		margin-left: 45%;
	}
</style>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" id="result">
	<?php
		$countData = $db->counTRow("newspaper");
		$perPage = 15;
		$last = ceil($countData/$perPage);
		if($last < 1){
			$last = 1;
		}
	?>
</div>
<div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="pagination" align="center">
		
	</div>
	<input type="hidden" name="pn" id="pn"/>
	<input type="hidden" name="perPage" id="perPage" value="<?php echo $perPage; ?>" />
	<input type="hidden" name="last" id="last" value="<?php echo $last; ?>" />
</div>
<!--Description edit modal-->
<div class="modal fade" id="decriptionModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <b>Edit: </b>
        </div>
        <div class="modal-body">
        	<input type="hidden" name="descriptioneditID" id="descriptioneditID">
          	<textarea class="form-control" placeholder="Description" id="redactor"><span id="smsms"></span></textarea>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
          		<button class="btn btn-info" type="button" id="save">
	            	<i class="fa fa-plus"> Save</i>
	          	</button>
	            <button type="button" class="btn btn-danger" data-dismiss="modal">
	            	<span class="fa fa-times"> </span> Cancle
	            </button>
          </div>
        </div>
      </div>
      
    </div>
  </div>
 <!--end of description edit modal-->

 <!--Edit modal-->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <b>Edit: </b>
        </div>
        <div class="modal-body">
        	<input type="hidden" name="titleEditiD" id="titleEditiD">
        	<table class="table table-bordered">
        		<tr>
        			<td>Title</td>
        			<td>
        				<input type="text" name="Edit" id="titleEdit" class="form-control" />
        			</td>
        		</tr>
        		<tr>
        			<td>Reporte's name</td>
        			<td>
        				<input type="text" name="reporterName" id="reporterName" class="form-control" />
        			</td>
        		</tr>
        	</table>
        </div>
        <div class="modal-footer">
          <div class="btn-group">
          		<button class="btn btn-info" type="button" id="savetitle">
	            	<i class="fa fa-plus"> Save</i>
	          	</button>
	            <button type="button" class="btn btn-danger" data-dismiss="modal">
	            	<span class="fa fa-times"> </span> Cancle
	            </button>
          </div>
        </div>
      </div>
      
    </div>
  </div>
 <!--end of Edit modal-->

 <!--Delete modal-->
<div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <b>Are you realy want to delete ?</b>
        </div>
        <div class="modal-body">
        	<input type="hidden" name="deleteID" id="deleteID" />
        	<input type="hidden" name="ext" id="ext" />
        </div>
        <div class="modal-footer">
          <div class="btn-group">
          		<button class="btn btn-danger" type="button" id="deleteAll">
	            	<i class="fa fa-times"> Delete</i>
	          	</button>
	            <button type="button" class="btn btn-info" data-dismiss="modal">
	            	<span class="fa fa-plus"> </span> Cancle
	            </button>
          </div>
        </div>
      </div>
      
    </div>
  </div>
 <!--end of Delete modal-->

<script type="text/javascript">
	$(document).ready(function() {
		getAllNewsPaper(1);
	});
</script>
<script type="text/javascript">
	var perPage = $("#perPage").val();
	var last = $("#last").val();
	function getAllNewsPaper(pn=false){
		if (pn) {
			pn = pn;
		}else{
			pn = 1;
		}
		$("#pn").val(pn);
		$("#result").html('<img src="./img/loading.gif" class="imgLoad">');
		$.ajax({
			url: 'ajax/getAllNewspaper.php',
			type: 'POST',
			data: {perPage: perPage, last:last,pn: pn},
			success: function(result){
				$("#result").html(result);
			}
		});
		// Change the pagination controls
		var paginationCtrls = "";
	    if(last != 1){
			if (pn > 1) {
				paginationCtrls += '<button class="btn btn-primary" onclick="getAllNewsPaper('+(pn-1)+')">&lt;</button>';
	    	}
			paginationCtrls += ' &nbsp; &nbsp; <b>Page '+pn+' of '+last+'</b> &nbsp; &nbsp; ';
	    	if (pn != last) {
	        	paginationCtrls += '<button class="btn btn-primary" onclick="getAllNewsPaper('+(pn+1)+')">&gt;</button>';
	    	}
	    }
	    jQuery("#pagination").html(paginationCtrls);
	}
</script>
<script type="text/javascript">
	function selectDescription(id){
		$("#descriptioneditID").val(id);
		$.ajax({
			url: 'ajax/getAllNewspaper.php',
			type: 'POST',
			data: {descriptionID: id},
			success: function(result){
				$("#smsms").html(result);
			}
		});
		
	}
</script>
<script type="text/javascript">
	$("#save").click(function(event) {
		var descriptioneditID =  $("#descriptioneditID").val();
		var descriptionE = $("#smsms").html();
		if (descriptionE) {
			descriptionE = descriptionE;
		}else{
			descriptionE = $("#redactor").val();
		}
		$.ajax({
			url: 'ajax/addNewsPaper.php',
			type: 'POST',
			data: {descriptioneditID:descriptioneditID, descriptionE: descriptionE},
			success: function(result){
				alert(result);
				location.reload();
			}
		});
	});
</script>
<script type="text/javascript">
	function getTitleReport(id,title,reporter) {
		$("#titleEditiD").val(id);
		$("#titleEdit").val(title);	
		$("#reporterName").val(reporter);	
	}
</script>
<script type="text/javascript">
	$("#savetitle").click(function(event) {
		var titleEditiD = $("#titleEditiD").val();
		var titleEdit = $("#titleEdit").val();	
		var reporterName = $("#reporterName").val();
		$.ajax({
			url: 'ajax/addNewsPaper.php',
			type: 'POST',
			data: {titleEditiD: titleEditiD,titleEdit: titleEdit, reporterName: reporterName},
			success: function(result){
				$("#editModal").modal("hide");
				$.gritter.add({
					title: 'Result!',
					text: result,
					sticky: false,
					time: '2000'
				});
				var pn = $("#pn").val();
				getAllNewsPaper(pn);
			}
		});
		
	});
</script>
<script type="text/javascript">
	function selectDeleteId(id,ext) {
		$("#deleteID").val(id);
		$("#ext").val(ext);
	}
</script>
<script type="text/javascript">
	$("#deleteAll").click(function(event) {
		var deleteID = $("#deleteID").val();
		var ext = $("#ext").val();
		$.ajax({
			url: 'ajax/addNewsPaper.php',
			type: 'POST',
			data: {deleteID: deleteID,ext: ext},
			success: function(result){
				$("#deleteModal").modal("hide");
				$.gritter.add({
					title: 'Result!',
					text: result,
					sticky: false,
					time: '2000'
				});
				var pn = $("#pn").val();
				getAllNewsPaper(pn);
			}
		});
	});
</script>