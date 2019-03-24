<style type="text/css">
  .col-md-12{
    font-size: 16px;
    font-weight: normal;
  }
</style>
<div class="col-md-12">
  <table class="table table-bordered table-striped">
    <thead>
      <tr class="title">
        <th>Title</th>
        <th>FB share text</th>
        <th>Description</th>
        <th>Reporter's</th>
        <th>Image</th>
        <th>All menu/Area</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $paginationCtrls = "";
      $asss = "SELECT COUNT(id) FROM news_info";
      $resultt=$db->select($asss);
      $rows = $resultt[0][0];
      $per_page = 7;
      $last = ceil($rows/$per_page);
      if($last<1){
        $last='1';
      }
      $pagenum = 1;
      if(isset($_GET['pn'])){
        $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
      }
      if($pagenum < 1) { 
        $pagenum = 1; 
      } else if($pagenum > $last) { 
        $pagenum = $last; 
      }
      $limit = 'LIMIT ' .($pagenum - 1) * $per_page .',' .$per_page;
      $query = "SELECT * FROM news_info ORDER BY id DESC $limit";
      if($fetch_news = $db->select($query)){
      $paginationCtrls = '';
      if($last != 1){
        if ($pagenum > 1) {
          $previous = $pagenum - 1;
          $paginationCtrls .= '<a href="index.php?page=viewNews&pn='.$previous.'" class="previous">&laquo;</a> &nbsp; &nbsp; ';
          // Render clickable number links that should appear on the left of the target page number
          for($i = $pagenum-4; $i < $pagenum; $i++){
            if($i > 0){
              $paginationCtrls .= '<a href="index.php?page=viewNews&pn='.$i.'" class="pagination">'.$i.'</a> &nbsp; ';
            }
          }
        }
        // Render the target page number, but without it being a link
        $paginationCtrls .= ''.$pagenum.' &nbsp; ';
        // Render clickable number links that should appear on the right of the target page number
        for($i = $pagenum+1; $i <= $last; $i++){
          $paginationCtrls .= '<a href="index.php?page=viewNews&pn='.$i.'" class="pagination">'.$i.'</a> &nbsp; ';
          if($i >= $pagenum+4){
            break;
          }
        }
        // This does the same as above, only checking if we are on the last page, and then generating the "Next"
        if ($pagenum != $last) {
          $next = $pagenum + 1;
          $paginationCtrls .= '<a href="index.php?page=viewNews&pn='.$next.'" class="next">&raquo;</a> ';
        }
      }
  ?>
    <?php
      foreach ($fetch_news as $news) {
         $s = substr($news["description"], 0, 520);
         $d = substr($s, 0, strrpos($s, ' '));
    ?>
      <tr>
        <td>
          <?php echo $news["title"]; ?>
          <br/><button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#titleEdit" onclick="slecttitleGet('<?php echo $news["title"]; ?>','<?php echo $news["id"] ?>')">
            <i class="fa fa-edit"></i> Edit
          </button>
        </td>
        <td id="fb_share<?php echo $news["id"] ?>">
          <?php echo $news["fb_share_text"]; ?>
          <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#fb_share_textEdit" onclick="slectfb_share_textGet('<?php echo $news["fb_share_text"]; ?>','<?php echo $news["id"] ?>')">
            <i class="fa fa-edit"></i> Edit
          </button>
        </td>
        <td id="des<?php echo $news["id"] ?>">
          <?php echo $d; ?>
          <br/><button class="btn btn-sm btn-primary" type="button" onclick="moreData('<?php echo $news["id"] ?>')">More</button>
        </td>
        <td>
          <?php echo $news["reporters_name"]; ?>
          <br/><button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#reporterEdit" onclick="slecreporterGet('<?php echo $news["reporters_name"]; ?>','<?php echo $news["id"] ?>')">
            <i class="fa fa-edit"></i> Edit
          </button>
        </td>
        <td align="center">
        <?php
          if (file_exists("../newsImage/".$news["id"].".".$news["ext"])) {
          ?>
            <img height="80" width="120" src="../newsImage/<?php echo $news["id"] ?>.<?php echo $news["ext"] ?>" />
            <a href="index.php?a=changeImage&id=<?php echo $news["id"] ?>&ext=<?php echo $news["ext"] ?>&ref=news_info&refpath=newsImage" class="btn btn-info btn-sm" style="width: 120px;">
              <i class="fa fa-edit"></i> Change
            </a>
          <?php
          }else{
            echo "No image";
            ?>
              <a href="index.php?a=changeImage&id=<?php echo $news["id"] ?>&ext=none&ref=news_info&refpath=newsImage" class="btn btn-info btn-sm" style="width: 120px;"> 
                <i class="fa fa-edit"></i> Change
              </a>
            <?php
          }
          ?>
        </td>
        <td>
          <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#menuAreaModal" onclick="slecctAllMenuArea('<?php echo $news["id"] ?>')">
            <i class="fa  fa-get-pocket"> </i> Menu/Area
          </button>
        </td>
        <td>
        <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#deleteModal" onclick="selectDeleteNews('<?php echo $news["id"] ?>')">
            <i class="fa  fa-times"> </i> Delete
          </button>
        </td>
      </tr>
    <?php
        }
      }else{

    ?>  
      <tr>
        <td colspan="8" align="center">No data found</td>
      </tr>
    <?php
      }
    ?>
    </tbody>
  </table>
</div>
  <div class="col-md-12" align="center">
    <ul class="pager">
      <li><?php echo $paginationCtrls; ?></li>
    </ul>
  </div>
<!--Delete modal-->
<div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Are you realy want to delete ?<span id="ti"></span></b></h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="deleteID" id="deleteID">
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" onclick="deleteNews()">
            <i class="fa fa-times"> Delete</i>
          </button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>
 <!--end of Delete modal-->

<!--Menu/Area modal-->
<div class="modal fade" id="menuAreaModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Menu/Area<span id="ti"></span></b></h4>
        </div>
        <div class="modal-body" id="menuArea">
          
        </div>
        <div class="modal-footer">
          <a href="" class="btn btn-info" id="hreAA">
            <i class="fa fa-edit"> Edit</i>
          </a>
            <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>
 <!--end of Menu/Area edit modal-->

<!--reporter edit modal-->
<div class="modal fade" id="reporterEdit" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Edit: <span id="ti"></span></b></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="aaa" id="reporterEditttext" name="reporterEditttext" class="form-control" />
          <input type="hidden" name="id" id="reporterEditid" />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" onclick="savereporterEditid()">
            <span class="fa fa-plus"> Save</span>
          </button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>
 <!--end of reporter edit modal-->

<!--title edit modal-->
<div class="modal fade" id="titleEdit" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Edit: <span id="ti"></span></b></h4>
        </div>
        <div class="modal-body">
          <input type="text" name="aaa" id="titleEdittext" name="titleEdittext" class="form-control" />
          <input type="hidden" name="id" id="titleEditID" />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" onclick="savetitleEdittext()">
            <span class="fa fa-plus"> Save</span>
          </button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>
 <!--end of title edit modal-->

<!--fb_share_textGet edit modal-->
<div class="modal fade" id="fb_share_textEdit" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Edit: <span id="ti"></span></b></h4>
        </div>
        <div class="modal-body">
          <textarea class="form-control" id="fb_share_textGet" style="resize: none;" rows="5"></textarea>
          <input type="hidden" name="id" id="fb_sharID" />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" onclick="savefb_share_textGet()">
            <span class="fa fa-plus"> Save</span>
          </button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>
 <!--end of fb_share_textGet edit modal-->

 <!--description edit modal-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Edit: <span id="ti"></span></b></h4>
        </div>
        <div class="modal-body">
          <textarea class="form-control" id="redactor"><span id="dddd"></span></textarea>
          <input type="hidden" name="ssssssss" id="editId" />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" onclick="saveDescription()">
            <span class="fa fa-plus"> Save</span>
          </button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times"> </span> Cancle</button>
        </div>
      </div>
      
    </div>
  </div>
 <!--end of description edit modal-->

<script type="text/javascript">
  function moreData(id) {
    $.ajax({
      url: 'ajax/news.php',
      type: 'POST',
      data: {moreID: id},
      success:function(data){
        $("#des"+id).html(data);
      }
    });
    
  }
  function lessData(id) {
    $.ajax({
      url: 'ajax/news.php',
      type: 'POST',
      data: {lessID: id},
      success:function(data){
        $("#des"+id).html(data);
      }
    });
  }
  function descriptionSelect(id) {
    $.ajax({
      url: 'ajax/news.php',
      type: 'POST',
      data: {descId: id},
      success:function(data){
        $("#editId").val(id);
        $("#dddd").html(data);
      }
    });
  }
  function saveDescription() {
    var editId = $("#editId").val();
    var DescriptionAll = $("#dddd").html();
    $.ajax({
      url: 'ajax/news.php',
      type: 'POST',
      data: {editId: editId, DescriptionAll: DescriptionAll},
      success:function(data){
        alert(data);
        location.reload();
      }
    });
  }

  function slectfb_share_textGet(value,id) {
    $("#fb_share_textGet").val(value);
    $("#fb_sharID").val(id);
  }
  function savefb_share_textGet() {
    var fb_sharID = $("#fb_sharID").val();
    var fb_share_t = $("#fb_share_textGet").val();
    $.ajax({
      url: 'ajax/news.php',
      type: 'POST',
      data: {fb_sharID: fb_sharID, fb_share_t: fb_share_t},
      success: function(data){
        if (data == "Updated") {
          $("#fb_share_textEdit").modal("hide");
          alert(data);
          location.reload();
        }else{
          alert(data);
        }
      }
    });
    
  }
</script>
<script type="text/javascript">
  function slecttitleGet(value,id) {
    $("#titleEdittext").val(value);
    $("#titleEditID").val(id);
  }
</script>
<script type="text/javascript">
  function savetitleEdittext() {
    var titleEdittext = $("#titleEdittext").val();
    var titleEditID = $("#titleEditID").val();
    $.ajax({
      url: 'ajax/news.php',
      type: 'POST',
      data: {titleEdittext: titleEdittext, titleEditID: titleEditID},
      success: function(data){
        if (data == "Updated") {
          alert(data);
          location.reload();
        }else{
          alert(data);
        }
      }
    });
  }
</script>
<script type="text/javascript">
  function slecreporterGet(value,id) {
    $("#reporterEditttext").val(value);
    $("#reporterEditid").val(id);
  }
</script>
<script type="text/javascript">
  function savereporterEditid() {
    var reporterEditttext = $("#reporterEditttext").val();
    var reporterEditid = $("#reporterEditid").val();
    $.ajax({
      url: 'ajax/news.php',
      type: 'POST',
      data: {reporterEditttext: reporterEditttext, reporterEditid: reporterEditid},
      success: function(data){
        if (data == "Updated") {
          alert(data);
          location.reload();
        }else{
          alert(data);
        }
      }
    });
  }
</script>
<script type="text/javascript">
  function slecctAllMenuArea(id) {
    $.ajax({
      url: 'ajax/news.php',
      type: 'POST',
      data: {menuAreaID: id},
      success: function(data){
        $('#hreAA').attr('href','index.php?a=newsMenuArea&newsid='+id);
        $("#menuArea").html(data);
      }
    });
  }
</script>
<script type="text/javascript">
  function selectDeleteNews(id) {
    $("#deleteID").val(id);
  }
</script>
<script type="text/javascript">
  function deleteNews() {
    var deleteID = $("#deleteID").val();
    $.ajax({
      url: 'ajax/news.php',
      type: 'POST',
      data: {deleteID: deleteID},
      success: function(data){
        if (data=="News deleted") {
          alert(data);
          location.reload();
        }else{
          alert(data);
        }
      }
    });
  }
</script>
