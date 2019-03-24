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
                  <th width="25%">Division Name</th>
                  <th width="25%">District Name</th>
                  <th width="25%">Thana</th>
                  <th width="25%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $queryGroupByDivision = "SELECT thanas_info.*,divisions_info.divisions_name FROM thanas_info INNER JOIN divisions_info ON thanas_info.division_id=divisions_info.id GROUP BY thanas_info.division_id";
                  $FetchGroupByDivision = $db->select($queryGroupByDivision);
                  foreach ($FetchGroupByDivision as $division) {
                ?>
                  <tr>
                    <td style="display: none;"></td>
                    <td colspan="4" align="center" class="bg-info"><?php echo $division["divisions_name"]; ?></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                  </tr>
                  <tr>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td colspan="4" style="padding: 0px; padding-bottom:5px; ">
                      <table class="table table-bordered table-striped" style="margin-bottom: -5px;">
                      <?php
                        $queryGroupByDistrict = "SELECT thanas_info.*,district_info.district FROM thanas_info INNER JOIN district_info ON thanas_info.district_id=district_info.id WHERE thanas_info.division_id='".$division["division_id"]."' GROUP BY thanas_info.district_id";
                        $FetchGroupByDistrict = $db->select($queryGroupByDistrict);
                        foreach ($FetchGroupByDistrict as $District) {
                      ?>
                        <tr>
                          <td style="display: none;"></td>
                          <td style="display: none;"></td>
                          <td colspan="4" align="center" class="bg-success"><?php echo $District["district"]; ?></td>
                          <td style="display: none;"></td>
                        </tr>
                        <tr>
                          <td style="display: none;"></td>
                          <td style="display: none;"></td>
                          <td colspan="4" align="center" style="padding: 0px; padding-bottom:5px; ">
                            <table class="table table-bordered table-striped" style="margin-bottom: -5px;">
                            <?php
                                $queryForAlldata = "SELECT thanas_info.*,divisions_info.divisions_name,district_info.district FROM thanas_info INNER JOIN divisions_info ON thanas_info.division_id=divisions_info.id INNER JOIN district_info ON thanas_info.district_id=district_info.id WHERE thanas_info.division_id='".$division["division_id"]."' AND thanas_info.district_id='".$District["district_id"]."'";
                              $FetchForAlldata = $db->select($queryForAlldata);
                              foreach ($FetchForAlldata as $Alldata) {
                            ?>
                              <tr>
                                <td width="25%"><?php echo $Alldata["divisions_name"]; ?></td>
                                <td width="25%"><?php echo $Alldata["district"]; ?></td>
                                <td width="25%"><?php echo $Alldata["thana_name"]; ?></td>
                                <td width="25%">
                                  <div class="btn-group">
                                    <button class="btn btn-info btn-sm" type="button"  data-toggle="modal" data-target="#myModal" onclick="SELECTEditThana('<?php echo $Alldata["id"]; ?>')">
                                      <i class="fa fa-edit"></i> Edit
                                    </button>


                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#Modal" onclick="selectDeleteThanas('<?php echo $Alldata["id"]; ?>','<?php echo $Alldata["thana_name"]; ?>')">
                                      <i class="fa fa-times"></i> Delete
                                    </button>
                                  </div>
                                </td>
                              </tr>
                              <?php
                                }
                              ?>
                            </table>
                          </td>
                          <td style="display: none;"></td>
                        </tr>
                        <?php
                          }
                        ?>
                      </table>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th width="25%">Division Name</th>
                  <th width="25%">District Name</th>
                  <th width="25%">Thana</th>
                  <th width="25%">Action</th>
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
          <table class="table table-bordered table-hover">
            <tr>
              <td>Division name</td>
              <td id="divsionA">
                
              </td>
            </tr>
            <tr>
              <td>District name</td>
              <td id="districtA">
              </td>
            </tr>
            <tr>
              <td>Thana Name</td>
              <td>
                <input type="text" name="thana_name" id="thana_name" class="form-control">
                <input type="hidden" name="" id="eid">
              </td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" onclick="saveThana()">
            <span class="fa fa-plus"> Save</span>
          </button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>
<!--End of edit Modal-->

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
          <button type="button" class="btn btn-info" onclick="deleteThana()">
            <span class="fa fa-times"> Delete</span>
          </button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>

  <script type="text/javascript">
    function SELECTEditThana(id) {
      $("#eid").val(id);
      $.ajax({
        url: 'ajax/thanas.php',
        type: 'POST',
        data: {EID: id},
        success:function(data){
          var a = data.split("`");
          $("#divsionA").html(a[2]);
          $("#districtA").html(a[1]);
          $("#thana_name").val(a[0]);
        }
      });
      
    }
  </script>

  <script type="text/javascript">
  function selectDistrictChange() {
    var division_id = $("#division_id").val();
    $.ajax({
      url: 'ajax/thanas.php',
      type: 'POST',
      data: {division_id: division_id},
      success: function(data){
        $("#districts_id").html(data);
      }
    });
    
  }
</script>
<script type="text/javascript">
  function saveThana() {
    var iddd = $("#eid").val();
    var diViSion =  $("#division_id").val();
    var DisTRict =  $("#districts_id").val();
    var ThaNas = $("#thana_name").val();
    $.ajax({
      url: 'ajax/thanas.php',
      type: 'POST',
      data: {iddd: iddd,diViSion: diViSion,DisTRict: DisTRict,ThaNas: ThaNas},
      success: function(data){
        alert(data);
        location.reload();
      }
    });
    
  }
</script>
<script type="text/javascript">
  function selectDeleteThanas(id,name) {
    $("#tid").text(name);
    $("#diddd").val(id);
  }
</script>
<script type="text/javascript">
  function deleteThana() {
    var diddd = $("#diddd").val(); 
    $.ajax({
      url: 'ajax/thanas.php',
      type: 'POST',
      data: {diddd: diddd},
      success: function(data){
        alert(data);
        location.reload();
      }
    });
  }
</script>