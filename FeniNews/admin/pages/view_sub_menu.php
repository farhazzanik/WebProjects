<body onload="getSubMenu()">
	<div class="table table-bordered table-hover" id="resultmain" align="center" >
		<img src="./img/loading.gif" style="margin-top: 150px;">
	</div>
</body>
<!--edit modal-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Edit: <span id="ti"></span></b></h4>
        </div>
        <div class="modal-body">
          <p><b>Main menu name:</b></p>
          	<select  name="main_link" class="form-control select2" style="width: 100%;" id="mainMenuId">
                <?php
					$result = $db->selectSub("menu_info");
					foreach ($result as $value) {
				?>
				<option value="<?php echo $value["id"] ?>"><?php echo $value["menu_name"] ?></option>
				<?php
					}
				?>
            </select>
          <br>
          <p><b>Sub menu name:</b></p><input type="text" name="menuna" id="snn" class="form-control"><br>
          <input type="hidden" name="" id="sid">
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-info" onclick="saveSMenu()">
        		<span class="fa fa-plus"> Save</span>
        	</button>
          	<button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--end of edit modal-->
  

  <!--Delete modal-->
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
        	<button type="button" class="btn btn-info" onclick="deletesubMenu()">
        		<span class="fa fa-times"> Delete</span>
        	</button>
          	<button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--delete modal-->
<script type="text/javascript">
	function getSubMenu() {
		$.ajax({
			url: 'ajax/submenu.php',
			type: 'POST',
			data: {a: "akash"},
			success:function(data){
				$("#resultmain").html(data);
			}
		});
		
	}
	function selectSubMenuData(id,mid,mname,sname) {
		$("#ti").text(sname);
		$("#snn").val(sname);
		$("#sid").val(id);
	}
	function saveSMenu() {
		var mainMenuId = $("#mainMenuId").val();
		var snn = $("#snn").val();
		var sid = $("#sid").val();
		$.ajax({
			url: 'ajax/submenu.php',
			type: 'POST',
			data: {mid: mainMenuId,snn:snn,sid:sid},
			success:function(data){
				getSubMenu();
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


	function selectSMenudelte(id,name) {
		$("#tid").text(name);
		$("#did").val(id);
	}

	function deletesubMenu() {
		var deleteId = $("#did").val();
		$.ajax({
			url: 'ajax/submenu.php',
			type: 'POST',
			data: {deleteId:deleteId},
			success: function(data){
				getSubMenu();
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