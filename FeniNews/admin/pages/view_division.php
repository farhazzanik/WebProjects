<body onload="selectDivision()">
	<div class="col-md-12" id="res">
		<img src="./img/loading.gif" style="margin-top: 150px; margin-left: 200px;">
	</div>
</body>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Edit: <span id="ti"></span></b></h4>
        </div>
        <div class="modal-body">
          <span><b>Division Name:</b>  </span><br><input type="text" name="menuna" id="divc" class="form-control"><br>
          <input type="hidden" name="" id="divid">
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-info" onclick="saveDiv()">
        		<span class="fa fa-plus"> Save</span>
        	</button>
          	<button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>
<!--delete -->
  <div class="modal fade" id="Modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Delete: <span id="tid"></span>?</b></h4>
        </div>
        <div class="modal-body">
        	<input type="hidden" name="did" id="diddd">
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-info" onclick="deleteDivision()">
        		<span class="fa fa-times"> Delete</span>
        	</button>
          	<button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>

<script type="text/javascript">
	function selectDivision() {
		var a = "a";
		$.ajax({
			url: 'ajax/divisions.php',
			type: 'POST',
			data: {a: a},
			success: function(data){
				$("#res").html(data);
			}
		});
		
	}
</script>

<script type="text/javascript">
	function selectData(id) {
		$.ajax({
			url: 'ajax/divisions.php',
			type: 'POST',
			data: {bb: id},
			success:function(data){
				$("#divc").val(data);
				$("#divid").val(id);
			}
		});
		
	}
</script>
<script type="text/javascript">
	function saveDiv() {
		var divc = $("#divc").val();
		var divid = $("#divid").val();
		$.ajax({
			url: 'ajax/divisions.php',
			type: 'POST',
			data: {divc: divc,divid: divid},
			success:function(data){
				selectDivision();
				$("#myModal").modal("hide");
				$.gritter.add({
					title: 'Result!',
					text: data,
					sticky: false,
					time: '2000'
				});
			}
		});
		
	}
</script>
<script type="text/javascript">
	function selectDeletedat(id,name) {
		$("#diddd").val(id);
		$("#tid").text(name);
	}
</script>
<script type="text/javascript">
	function deleteDivision() {
		var diddd = $("#diddd").val();
		$.ajax({
			url: 'ajax/divisions.php',
			type: 'POST',
			data: {diddd: diddd},
			success:function(data){
				selectDivision();
				$("#myModal").modal("hide");
				$.gritter.add({
					title: 'Result!',
					text: data,
					sticky: false,
					time: '2000'
				});
			}
		});
		
	}
</script>