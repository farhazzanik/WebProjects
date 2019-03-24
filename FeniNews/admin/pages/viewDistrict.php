		<style type="text/css">
			td{
				font-size: 15.5px;
			}
		</style>
		    <div class="box">
            <div class="box-header">
              <h3 class="box-title">District </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dataaa" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Division Name</th>
                  <th>District Name</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               		<?php 
               			$fetchDivisions = $db->select("SELECT district_info.*,divisions_info.divisions_name FROM district_info INNER JOIN divisions_info ON district_info.division_id=divisions_info.id GROUP BY district_info.division_id");
               			foreach ($fetchDivisions as $divisions) {
               		?>
               			<tr class="bg-info">
               				<td style="display: none;"></td>
               				<td colspan="3" align="center" class="bg-info"><?php echo $divisions["divisions_name"]; ?></td>
               				<td style="display: none;"></td>
               			</tr>
               			<tr>
               				<td style="display: none;"></td>
               				<td colspan="3">
               					<table class="table table-bordered table-striped" style="margin-bottom: -5px;">
               						<?php
			               				$query = "SELECT district_info.*,divisions_info.divisions_name FROM district_info INNER JOIN divisions_info ON district_info.division_id=divisions_info.id WHERE district_info.division_id='".$divisions["division_id"]."'";
			               				$fetchDistrict = $db->select($query);
			               				foreach ($fetchDistrict as $district) {
			               			?>
			               			<tr>
			               				<td width="40%"><?php echo $district["divisions_name"]; ?></td>
			               				<td width="36.6%"><?php echo $district["district"]; ?></td>
			               				<td>
			               					<div class="btn-group">
			               						<button type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#myModal" onclick="selectEdit('<?php echo $district["id"]; ?>','<?php echo $district["district"]; ?>')">
			               							<i class="fa fa-edit"></i> Edit
			               						</button>
			               						<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal" onclick="SlectDelect('<?php echo $district["id"]; ?>','<?php echo $district["district"]; ?>')">
			               							<i class="fa fa-times"></i> Delete
			               						</button>
			               					</div>
			               				</td>
			               			</tr>
			               			<?php } ?>
               					</table>
               				</td>
               				<td style="display: none;"></td>
               			</tr>
               		<?php
               			}
               		?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Division Name</th>
                  <th>District Name</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->






<!--edit Modal-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Edit: <span id="ti"></span></b></h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-striped">
          	<tr>
          		<td>Division name</td>
          		<td id="divsionA">
          			
          		</td>
          	</tr>
          	<tr>
          		<td>District name</td>
          		<td>
          			<input type="text" name="nothing" class="form-control" placeholder="District name" id="districtName">
          			<input type="hidden" name="ss" id="eid">
          		</td>
          	</tr>
          </table>
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-info" onclick="saveDis()">
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
        	<button type="button" class="btn btn-info" onclick="deleteDis()">
        		<span class="fa fa-times"> Delete</span>
        	</button>
          	<button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>


  <script type="text/javascript">
	function selectEdit(id,name) {
		$("#eid").val(id);
		$.ajax({
			url: 'ajax/districts.php',
			type: 'POST',
			data: {idd: id},
			success:function(data){
				var a = data.split("`");
				$("#districtName").val(a[1]);
				$("#divsionA").html(a[0]);
			}
		});
		
	}
</script>
<script type="text/javascript">
	function saveDis() {
		var eiid = $("#eid").val();
		var disTrict = $("#districtName").val();
		var diviSion = $("#division_id").val();
		$.ajax({
			url: 'ajax/districts.php',
			type: 'POST',
			data: {eiid: eiid, diviSion: diviSion, disTrict: disTrict},
			success:function(data){
				$("#myModal").modal("hide");
				alert(data);
				location.reload();
			}
		});
		
	}
</script>
<script type="text/javascript">
function SlectDelect(id,name) {
	$("#diddd").val(id);
	$("#tid").text(name);
}
</script>
<script type="text/javascript">
	function deleteDis() {
		var diddd = $("#diddd").val();
		$.ajax({
			url: 'ajax/districts.php',
			type: 'POST',
			data: {diddd: diddd},
			success: function(data){
				$("#Modal").modal("hide");
				alert(data);
				location.reload();
			}
		});
		
	}
</script>