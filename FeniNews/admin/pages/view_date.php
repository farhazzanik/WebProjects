          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bangla Date</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dataa" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>English Date</th>
                  <th>Bangla Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $db->tableName("date_info");
                  $resultdate = $db->selectAll();
                  foreach ($resultdate as $dates) {
                ?>
                  <tr id="<?php echo $dates["id"]; ?>">
                    <td id="s<?php echo $dates["id"]; ?>"><?php echo $dates["edate"]; ?></td>
                    <td id="d<?php echo $dates["id"]; ?>"><?php echo $dates["bdate"]; ?></td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-info btn-sm" type="button"  data-toggle="modal" data-target="#myModal" onclick="selectDate('<?php echo $dates["id"]; ?>','<?php echo $dates["edate"]; ?>','<?php echo $dates["bdate"]; ?>')"><i class="fa fa-edit"></i> Edit</button>



                        <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#Modal" onclick="selectDelete('<?php echo $dates["id"]; ?>','<?php echo $dates["bdate"]; ?>')"><i class="fa fa-times"></i> Delete</button>
                      </div>
                    </td>
                  </tr>
                <?php
                  }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>English Date</th>
                  <th>Bangla Date</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



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
          <p><b>English Date:</b></p>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" placeholder="mm/dd/yyyy">
              </div>
          <br>
          <p><b>Bangla Date:</b></p>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="bdate" id="bdate" class="form-control" placeholder="Bangla Date">
              </div>
          <br>
          <input type="hidden" name="" id="sid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" onclick="saveDate()">
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
          <button type="button" class="btn btn-info" onclick="deleteDate()">
            <span class="fa fa-times"> Delete</span>
          </button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--delete modal-->

  <script type="text/javascript">
    function selectDate(id,edate,bdate) {
      $("#sid").val(id);
      $("#datepicker").val(edate);
      $("#bdate").val(bdate);
    }
  </script>

  <script type="text/javascript">
    function saveDate() {
      var eid = $("#sid").val();
      var EDt = $("#datepicker").val();
      var BDt = $("#bdate").val();
      $.ajax({
        url: 'ajax/date.php',
        type: 'POST',
        data: {eid: eid,EDt: EDt,BDt: BDt},
        success: function(data){
          $("#myModal").modal("hide");
          $("#s"+eid).text(EDt);
          $("#d"+eid).text(BDt);
          $.gritter.add({
            title: 'Result!',
            text: data,
            sticky: false,
            time: '2000'
          });
        }
      });
      
    }
    function selectDelete(id,bdate) {
      $("#ti").text(bdate);
      $("#did").val(id);
    }
    function deleteDate() {
      var diid = $("#did").val();
      $.ajax({
        url: 'ajax/date.php',
        type: 'POST',
        data: {diid: diid},
        success: function(data){
          $("#Modal").modal("hide");
          $("#"+diid).hide('slow', function() {
            $.gritter.add({
              title: 'Result!',
              text: data,
              sticky: false,
              time: '2000'
            });
          });
        }
      });
      
    }
  </script>