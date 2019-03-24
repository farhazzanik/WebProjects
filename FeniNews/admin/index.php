<?php
  ob_start();
  session_start();
  error_reporting();
  if (isset($_POST["signOut"])) {
    session_destroy();
    print "<script>location='../adminloginpanel'</script>";
  }
  $adminid = @$_SESSION['adminid'];
  if (@$_SESSION['approved']==1) {
  include '../DB_Connect_/DB.php';
  $db = new DB;
  $fetch_admin_info = $db->select("SELECT * FROM admin_info WHERE id='$adminid'");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/pace/pace.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/textEdit/redactor/redactor.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="plugins/gritter/jquery.gritter.css">
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="plugins/gritter/jquery.gritter.min.js"></script>
  <script src="plugins/textEdit/redactor/redactor.min.js"></script>
	<style>
		.title{
			background:#00c0ef;
			color:white;
			font-size:18px;
			text-align:center;
		}
		.whit{
			 background:#f6f6f6;
		}
    .imgWrapsm{
      width: 100%;
      height:144px;
      cursor: pointer;
      position: relative;
      display: block;
      overflow: hidden;
    }
    .imgDescriptionsmall {
      position: absolute;
      bottom: -9px;
      left: 0;
      background: #000;
      right: 0;
      color: #fff;
      visibility: visible;
      opacity: 0.7;
      transition: all 0.2s;
      width: 100%;
      line-height: 25px;
      font-size: 15px;
      padding: 10px;
    }
    .mm{
      margin-bottom:15px;
    }
	</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="./" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../images/<?php echo $fetch_admin_info[0]["id"] ?>.<?php echo $fetch_admin_info[0]["ext"] ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $fetch_admin_info[0]["name"]; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../images/<?php echo $fetch_admin_info[0]["id"] ?>.<?php echo $fetch_admin_info[0]["ext"] ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $fetch_admin_info[0]["name"]; ?> - Admin
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                <form method="post">
                   <button class="btn btn-default btn-flat" type="submit" name="signOut">Sign out</button>
                </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
    <?php
      if($fetch_admin_info[0]["id"]==306){
    ?>
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <ul class="sidebar-menu">
		<li class="header">Developer Option</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Developer option</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="index.php?a=mainLink"><i class="fa fa-circle-o"></i> Main link</a></li>
            <li><a href="index.php?a=subLink"><i class="fa fa-circle-o"></i> Sub link</a></li>
          </ul>
        </li>
      </div>
      <?php
        }
      ?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <?php
          if ($adminid!=306) {
            $mainMenuResult = $db->select("SELECT main_link_priority.*,main_link_info.* FROM main_link_priority INNER JOIN main_link_info ON main_link_priority.main_link_id=main_link_info.id WHERE main_link_priority.admin_id='$adminid'");
          foreach ($mainMenuResult as $data) {
            if($data["route_name"]=="#"){
              $route = "#";
            }else{
              $route = $data["route_name"];
            }
        ?>
        <li class="treeview">
          <a href="<?php echo $route; ?>">
            <i class="fa fa-folder"></i>
            <span><?php echo $data["link_name"]; ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php
              $query = "SELECT sub_link_priority.*,sub_link_info.* FROM sub_link_priority INNER JOIN sub_link_info ON sub_link_priority.sub_link_id=sub_link_info.id WHERE sub_link_priority.admin_id='$adminid' AND sub_link_priority.main_link_id='".$data["id"]."'";
              $subMenuResult = $db->select($query);
              foreach ($subMenuResult as $submenu) {
                
            ?>
            <li><a href="index.php?page=<?php echo $submenu["route_name"] ?>"><i class="fa fa-circle-o"></i> <?php echo $submenu["sublink_name"]; ?></a></li>
            <?php
              }
            ?>
          </ul>
        </li>
        <?php
          }
        }else if($adminid==306){
          $mainMenuResult = $db->selectSub("main_link_info");
          foreach ($mainMenuResult as $data) {
            if($data["route_name"]=="#"){
              $route = "#";
            }else{
              $route = $data["route_name"];
            }
          ?>
        <li class="treeview">
          <a href="<?php echo $route; ?>">
            <i class="fa fa-folder"></i>
            <span><?php echo $data["link_name"]; ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php
              $query = "SELECT * FROM sub_link_info WHERE main_link='".$data["id"]."'";
              $subMenuResult = $db->select($query);
              foreach ($subMenuResult as $submenu) {
                
            ?>
            <li><a href="index.php?page=<?php echo $submenu["route_name"] ?>"><i class="fa fa-circle-o"></i> <?php echo $submenu["sublink_name"]; ?></a></li>
            <?php
              }
            ?>
          </ul>
        </li>
        <?php 
          }
        }
        ?>
          
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row whit">
	  	<?php
			if(isset($_GET["a"])){
        if ($adminid==306) {
          if($_GET["a"]=="mainLink"){
            include("add_main_link.php");
          }else if($_GET["a"]=="subLink"){
            include("add_sub_link.php");
          }
        }
        if ($_GET["a"]=="changeImage") {
          include 'pages/changeImage.php';
        }else if($_GET["a"]=="newsMenuArea"){
          include 'pages/changenewsMenuArea.php';
        }
			}else if(isset($_GET["page"])){
        $resultPage = $db->select("SELECT * FROM sub_link_info WHERE route_name='".$_GET["page"]."'");
        include "pages/".$resultPage[0]["page_name"];
      }else{
				include "gellery.php";
			}
		?>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Developed by <a href="http://sbit.com.bd/" target="_blank">SBIT</a>.</strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.6 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- Morris.js charts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

  <script src="plugins/iCheck/icheck.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
  <!-- jvectormap -->
  <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/pace/pace.min.js"></script>
  <script src="plugins/knob/jquery.knob.js"></script>
  <!-- daterangepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <script src="plugins/select2/select2.full.min.js"></script>
  <script type="text/javascript">
    $(".select2").select2();
    $('#datepicker').datepicker({
        autoclose: true
      });
    $("#dataa").DataTable();
    
    $("#dataaa").DataTable();
    $(document).ajaxStart(function() { Pace.restart(); }); 
    $('#redactor').redactor();
  </script>
<!-- jQuery 2.2.3 -->
</body>
</html>
<?php
}else{
  print "<script>location='../'</script>";
}
  ob_end_flush();
?>