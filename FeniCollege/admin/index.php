<?php
	error_reporting(1);
	@session_start();
	
	if(isset($_POST["logOUt"]))
	{
		unset($_SESSION["logstatus"]);
	}
	
	if($_SESSION["logstatus"] === "Active")
	{
		require_once("../db_connect/config.php");
		require_once("../db_connect/conect.php");
		$db = new database();
		
		
	
	
	
		$projectinfo="SELECT  * FROM `project_info`";
		$result=$db->select_query($projectinfo);
		if($result>0){
			$fetch_result=$result->fetch_array();
		}
	?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>এডমিন পেনেল || <?php if(isset($fetch_result)){ echo $fetch_result["title"];} else {echo "";}?></title>
	<link rel="shortcut icon" href="all_image/<?php echo "shortcurt_iconSDMS2015"?>.png" />
<link rel="stylesheet" href="../css/loading/loading.css" />
    <script type="text/javascript" src="../js/loading/pace.min.js"></script>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
  <form name="" action="" method="post">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>&nbsp;Panel</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../other_img/<?php echo $_SESSION["id"];?>.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION["name"];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../other_img/<?php echo $_SESSION["id"];?>.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $_SESSION["name"];?> - <?php if($_SESSION["id"]=="306"){ echo "Software Company";}else {echo "Member of &nbsp;	".$fetch_result["title"];} ?>
                      <small> <?php if($_SESSION["id"]=="306"){ ?>since Jan. 2011<?php } ?></small>
                    </p>
                  </li>
                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                     <input type="submit" name="logOUt" class="btn btn-default btn-flat"  value="Sign Out"/>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
         
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
		  <?php 
		  	if($_SESSION["id"]=="306"){
		  ?>
           <li class="header">Developer LINK</li>
          <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Developer LINK</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="Main_Link_Add.php" target="adminbody"><i class="fa fa-circle-o"></i> Add Main Link</a></li>
                <li><a href="Sub_Link_Add.php" target="adminbody" ><i class="fa fa-circle-o"></i> Add Sub Link</a></li>
				      <li><a href="Add_classSection.php" target="adminbody"><i class="fa fa-circle-o"></i>Add Class Section </a></li>
                <li><a href="Add_class.php" target="adminbody"><i class="fa fa-circle-o"></i>Add class</a></li>
                <li><a href="project.php" target="adminbody"><i class="fa fa-circle-o"></i>Project Info</a></li>

              </ul>
            </li>


           	
			<?php
					if($_SESSION["id"]=="306"){
						
						$select_main_link="SELECT * FROM `main_link_info` ORDER BY `SLNO` ASC";
					}
					else {
						
						$select_main_link="SELECT `main_link_piority`.*,`main_link_info`.`Main_Link_Name`,`Page_Name`,`type` FROM `main_link_info` 
INNER JOIN `main_link_piority` ON `main_link_piority`.`Main_Link_id`=`main_link_info`.`Main_Link_Id`
WHERE `main_link_piority`.`adminId`='".$_SESSION["id"]."'   ORDER BY `main_link_info`.`SLNO` ASC ";
					}
			
					$chek_main_link=$db->select_query($select_main_link);
					if($chek_main_link){
					while($fetch_main_link=$chek_main_link->fetch_array()){
					if($fetch_main_link["Page_Name"] == '#')
					{
					
					
		
					
			?>
		
			<li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i>
                <span> <?php  echo $fetch_main_link["Main_Link_Name"];?></span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                 <?php  
						if($_SESSION["id"]=="306"){
							
							$select_sub_link="SELECT * FROM  `sub_link_info` WHERE `Main_Link`='".$fetch_main_link[1]."' ORDER BY `Sl_No` ASC";
						}else{
							
							$select_sub_link="SELECT `sublinkpeority`.*,`sub_link_info`.`Sub_Link_Name`,`Sub_Page_Name` FROM `sublinkpeority`
INNER JOIN `sub_link_info` ON `sub_link_info`.`Sub_Link_Id`=`sublinkpeority`.`sublinkId` WHERE 
`sublinkpeority`.`AdminId`='".$_SESSION["id"]."' AND `sub_link_info`.`Main_Link`='$fetch_main_link[1]' GROUP BY `sub_link_info`.`Sub_Link_Id` ORDER BY `sub_link_info`.`Sl_No` ASC";
						}
				 		
						$chek_Sub_link=$db->select_query($select_sub_link);
						if($chek_Sub_link)
						{
						while($fetch_sub_link=$chek_Sub_link->fetch_array()){
				 ?>
				 
				 <li><a href="<?php echo $fetch_sub_link["Sub_Page_Name"];?>" target="adminbody"><i class="fa fa-circle-o text-red"></i> <span><?php echo $fetch_sub_link["Sub_Link_Name"];?></span></a></li>
                 <?php  } }?>
                
              </ul>
            </li>
			   
			
					<?php } else {?>
					<li><a href="<?php echo $fetch_main_link[3];?>" target="adminbody"><i class="fa fa-book"></i> <span><?php echo $fetch_main_link[2];?></span></a></li>
				<?php } } }  }?>
					
					  
			

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
            <li><a href="../"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><input type="submit" name="logOUt" value="Log Out" class="link"/></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          
          <!-- Main row -->
          <div class="row">
            <div class="col-lg-12" style="height: 2300px;">
                    <!-- IFRAME -->
                    <iframe <?php 
						if($_SESSION["id"]=="306"){
					?>src="Add_classSection.php"<?php } else {
				 	$iframsrccode="SELECT `sublinkpeority`.`sublinkId`,`MainLinkID`,`sub_link_info`.`Sub_Link_Name`,`Sub_Page_Name`
FROM `sublinkpeority` INNER JOIN `sub_link_info` ON `sub_link_info`.`Sub_Link_Id`=`sublinkpeority`.`sublinkId`
WHERE `sublinkpeority`.`AdminId`='".$_SESSION["id"]."' GROUP BY `sublinkpeority`.`AdminId`";
				$resultsrc=$db->select_query($iframsrccode);
							if($resultsrc>0){
								$fetch_result=$resultsrc->fetch_array();
					?> src="<?php echo $fetch_result[3];?>"; <?php } } ?>name="adminbody" height="100%" width="100%"  allowtransparency="1" frameborder="1" scrolling="yes" id="iframe" onload='javascript:resizeIframe(this);'>

                      
                     </iframe>

                     <!-- IFRAME -->
            </div>
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b></b> 
         </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://sbit.com.bd/"><?php echo $_SESSION["name"];?></a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
	</form>
	
	  </body>
</html>
<?php } else { print "<script>location='../adminloginpanel/index.php'</script>";}?>

