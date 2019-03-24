<body onLoad="getMenu()">
	<div class="table table-bordered table-hover" id="resultmain" align="center" >
		<img src="./img/loading.gif" style="margin-top: 150px;">
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
          <span><b>Menu Name:</b>  </span><br><input type="text" name="menuna" id="m" class="form-control"><br>
          <input type="hidden" name="" id="mid">
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-info" onClick="saveMenu()">
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
        	<input type="hidden" name="did" id="did">
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-info" onClick="deleteMenu()">
        		<span class="fa fa-times"> Delete</span>
        	</button>
          	<button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>

<script type="text/javascript">
	function getMenu() {
		$.ajax({
			url: 'ajax/mainMenu.php',
			type: 'POST',
			data: {a: "akash"},
			success:function(data){
				$("#resultmain").html(data);
			}
		});
		
	}
	function selectMenuData(id,v) {
		$("#ti").text(v);
		$("#m").val(v);
		$("#mid").val(id);
	}
	function saveMenu() {
		var m = $("#m").val();
		var mid = $("#mid").val();
		$.ajax({
			url: 'ajax/mainMenu.php',
			type: 'POST',
			data: {m: m,mid: mid},
			success:function(data){
				getMenu();
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
	function selectMenudelte(id,va) {
		$("#did").val(id);
		$("#tid").text(va);
	}
	function deleteMenu() {
		var didd = $("#did").val();
		$.ajax({
			url: 'ajax/mainMenu.php',
			type: 'POST',
			data: {didd: didd},
			success:function(data){
				getMenu();
				$("#Modal").modal("hide");
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