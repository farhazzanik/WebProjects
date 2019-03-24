<?php
  require 'DB_Connect_/DB.php';
  $db = new DB;
  $url = DB::encoDe($_GET["url"]);
  $section = $url[0];
  if($section=="main-section"){
    $mainMenu = $url[1];
    $querySection = "SELECT menu_name FROM menu_info WHERE id='$mainMenu'";
  }else if($section=="sub-section"){
    $subMenu = $url[2];
    $querySection = "SELECT sub_menu_name FROM submenu_info WHERE id='$subMenu'";
  }else if($section=="article"){
    $subMenu = $url[1];
    $querySection = "SELECT title,id,fb_share_text,ext FROM news_info WHERE id='$subMenu'";
  }else if ($url[1]=="area") {
    $title = "Search/area";
  }else if ($url[1]=="newspaper") {
    $title = "Search/newspaper";
  }else if ($url[1]=="details") {
    $uid = $url[2];
    $querySection = "SELECT title,id,description,ext  FROM newspaper WHERE id='$uid'";
  }else{
    $title = "404 page";
  }
  if ($fetchSection = $db->select(@$querySection)) {
    $fetchSection = $db->select(@$querySection);
    $title = $fetchSection[0][0];
  }
?><!DOCTYPE html>
<html xmlns="//www.w3.org/1999/xhtml">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head prefix="og: http://ogp.me/ns#">
<link rel="icon" href="images/favicon.png" type="image/x-icon"/>

<base href="http://www.feninews.com/">
<title>FeniNews :: Online BanglaNews Portal</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Online BanglaNews Portal || FeniNews"/>


<meta property="og:url"content="http://www.feninews.com<?php  print $_SERVER['REQUEST_URI']; ?>" />

  <meta property="og:type"content="News Paper" />

  <meta property="og:title"content="<?php echo @$fetchSection[0]["title"]; ?>" />

  <?php
    if ($section=="article") {
  ?>
  <meta property="og:description" content="<?php print $fetchSection[0]["fb_share_text"]; ?> "/>
  <?php
    }
  ?>
  <?php
    if ($section=="article") {
       if (file_exists("newsImage/".$fetchSection[0]["id"].".".$fetchSection[0]["ext"])) {
  ?>
    <meta property="og:image" content="http://www.feninews.com/newsImage/<?php print $fetchSection[0]["id"]; ?>.<?php print $fetchSection[0]["ext"]; ?>" />
  <?php
      }else{
    ?>
      <meta property="og:image" content="http://www.feninews.com/images/News.jpg" />
    <?php
      }
    }
  ?> 


<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="css/carousel.css.pagespeed.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css"/>


<script type="text/javascript" language="javascript" src="js/jquery1.7.7.min.js.pagespeed.jm.rv6_84Iu4B.js"></script>
<script src="js/jquery.carouFredSel-6.1.0-packed.js%2bjquery.mousewheel.min.js.pagespeed.jc.GAmZSkn44t.js"></script>
<script>eval(mod_pagespeed_WXY7t_9KCn);</script>
<script>eval(mod_pagespeed_LpGmw2w0NJ);</script>
<script type="text/javascript" language="javascript" src="js/jquery-ui.min.js.pagespeed.jm.8oxCB8ix0b.js"></script>
<script src="js/superfish.js%2bcustom.js.pagespeed.jc.LxxFjCLFej.js"></script>
<script>eval(mod_pagespeed_rEzwz1JmLd);</script>
<script>eval(mod_pagespeed_mqKjjurRp4);</script>
<script type="text/javascript" language="javascript" src="js/plugin.js"></script>
<script src="js/jquery.slimscroll.js%2bbootstrap.js.pagespeed.jc.TeijofFKT2.js"></script>
<script>eval(mod_pagespeed_G$zebk4$l$);</script>
<script>eval(mod_pagespeed_v0V0sNbopj);</script>
<script type="text/javascript" language="javascript" src="js/prettify.js.pagespeed.jm.MRtzLxreoI.js"></script>
<script type="text/javascript" language="javascript">$(function(){prettyPrint();});</script>
<noscript>
<style>
.es-carousel ul{display:block}
</style>
</noscript>
<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
    <div class="rg-image-wrapper">
        {{if itemsCount > 1}}
        <div class="rg-image-nav">
            <a href="#" class="rg-image-nav-prev">Previous Image</a>
            <a href="#" class="rg-image-nav-next">Next Image</a>
        </div>
        {{/if}}
        <div class="rg-image"></div>
        <div class="rg-loading"></div>
        <div class="rg-caption-wrapper">
            <div class="rg-caption" style="display:none;">
                <p></p>
            </div>
        </div>
    </div>
  </script>
<style>
.mainmenu>li>a {
    background: #006699 none repeat scroll 0 0;
	}
	.mainmenu {
    background: #666666 none repeat scroll 0 0;
	}
	.mainmenu ul {
    background: #F6022A none repeat scroll 0 0;
	}
</style>
<script type="text/javascript">var base_url="index.html";</script>
<script type="text/javascript">$(function(){doTimer()})
var t;var timer_is_on=0;function timedCount(){$('.rg-image-nav-next').click()
t=setTimeout("timedCount()",10000);}function doTimer(){if(!timer_is_on){timer_is_on=1;timedCount(3500);}}function stopCount(){clearTimeout(t);timer_is_on=0;}</script>
<script type="text/javascript">$(document).ready(function(){$("div#extraControls").removeClass("hidden");});</script>
<style>
div.hidden{display:none}
</style>
<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','../www.google-analytics.com/analytics.js','ga');ga('create','UA-40783332-1','FeniNews.com');ga('send','pageview');</script>
<!-- Hotjar Tracking Code for www.FeniNews.com -->
<script>(function(h,o,t,j,a,r){h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};h._hjSettings={hjid:60081,hjsv:5};a=o.getElementsByTagName('head')[0];r=o.createElement('script');r.async=1;r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;a.appendChild(r);})(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">_atrk_opts={atrk_acct:"yo55j1a4ZP00GX",domain:"FeniNews.com",dynamic:true};(function(){var as=document.createElement('script');as.type='text/javascript';as.async=true;as.src="../d31qbv1cthcecs.cloudfront.net/atrk.js";var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as,s);})();</script>
<noscript>
<img src="../d5nxst8fruw4z.cloudfront.net/atrk8312.gif?account=yo55j1a4ZP00GX" style="display:none" height="1" width="1" alt=""/>
</noscript>
<!-- End Alexa Certify Javascript -->
</head>
<body style="background:url(images/body-bg-32.png) repeat  fixed;">
  
  <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
  
  
    
<div class="parentcontainer">
  <div id="mobile-header">
    <?php
          include 'titleImage.php';
 		?>
  </div>
  <?php
          include 'menu.php';
 		?>
  <div class="container-fluid">
    <?php
         		 include 'hedding.php';
 		?>
  </div>
  <div class="container-fluid">
    <div class="row-fluid mt_10">
      <div class="span9">
        <div class="row-fluid"> </div>
        <div class="row-fluid">
		
		<?php
          if($section == "main-section"){
            @$pn = $url[2];
            $mainMenuu = $url[1];
            $pagingmenu = $url[1];
            include 'newsMenu.php';
          }else if($section == "sub-section"){
            @$pn = $url[3];
            $pagingmenu = $url[1]."/".$url[2];
            $subMenuu = $url[2];
            include 'newsMenu.php';
          }else if($section == "article"){
            $postid = $url[1];
            include 'content.php';
          }else{
            include "404.php";
          }
        ?>
          
        </div>
        <hr/>
        <div class="row-fluid">
		
		<?php
        if($section=="article"){
            $postid = $url[1];
            $slectMenu = $db->select("SELECT * FROM news_main_menu WHERE news_id='$postid'");
            $querySS = "SELECT news_info.*,news_main_menu.main_menu_id FROM news_info
             INNER JOIN news_main_menu ON 
            news_info.id=news_main_menu.news_id 
            WHERE news_main_menu.main_menu_id='".$slectMenu[0][1]."'
             ORDER BY news_info.id DESC LIMIT 9";
             $data = $db->select($querySS);
    		foreach ($data as  $nnss){
          $s = substr($nnss["fb_share_text"], 0, 220);
          $d = substr($s, 0, strrpos($s, ' '));
    		?>
              <div class="span4">
                <div class="news_box widget widget-lifestyle">
                  <!-- widget-title-2 -->
                  <div class="item clearfix" style="height:315px;">
                    <a href="#">
                      <?php
                        if (file_exists("newsImage/".$nnss["id"].".".$nnss["ext"])) {
                        ?>
                          <img src="newsImage/<?php echo $nnss["id"]; ?>.<?php echo $nnss["ext"]; ?>"  alt=" <?php echo $fetchTadition["title"];?>"  style="width:100%; height:180px;">
                                  <?php
                        } else {
                          ?>
                          <img src="images/News.jpg" class="img-responsive" >
                                  <?php
                        } 
                      ?>
                    </a>
                    <div class="item-content">
                      <div>
                        <div style="min-height:35px;">
                          <h4><a href="article/<?php echo $nnss["id"]; ?>"><?php echo $nnss["title"]; ?></a></h4>
                        </div>
                        <p style="text-align: justify" class="color_black" ><?php echo $d; ?>... <a href="article/<?php echo $nnss["id"]; ?>" class="more">বিস্তারিত</a> </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
    		  <?php
    		  }
            }
		  ?>
     
          <div class="clear"></div>
          <hr/>
          <div class="clear"></div>
          <div class="span12">
            <!-----Facebook Like------>
           <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffeninews.comDurbar%2F&tabs=timeline&width=400&height=300&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=338704303143050" width="300" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
          </div>
        </div>
        <div class="row-fluid"> </div>
      </div>
    
	  
      <div class="span3">
        <!--**********************************  LATEST & POPULAR **********************************-->
        <div class="tabbable span12 news_box">
          <ul class="nav nav-tabs bcgray">
            <li class="active"><a href="#tabs1-pane1" data-toggle="tab">&nbsp;&nbsp;সর্বশেষ&nbsp;&nbsp;</a></li>
            <li><a href="#tabs1-pane2" data-toggle="tab">&nbsp;&nbsp;সর্বাধিক জনপ্রিয়&nbsp;&nbsp;</a></li>
          </ul>
		  
          <div class="tab-content hm12" id="testDiv">
            <div class="tab-pane active" id="tabs1-pane1">
              <ul class="nav nav-list bs-docs-sidenav">
			  
			  <?php
				
				 $selectLastHeading = "SELECT news_info.id,news_info.title,position.Last FROM `news_info` INNER JOIN `position` ON news_info.id=position.PostID WHERE position.Last='1' ORDER BY position.PostID DESC LIMIT 8";
				 
				  $lastHeading = $db->select($selectLastHeading);
				  foreach ($lastHeading as $getHeading){
        			?>
					
                <li> <a title="<?php echo $getHeading["title"] ?>" href="article/<?php echo $getHeading["id"]; ?>">
				<i class="icon-chevron-right"></i><?php echo $getHeading["title"] ?>ু</a>
                  <div style="width: 100%; font-size: 9px; color:#999; float: right; border-bottom: 1px solid #ededed;text-align: right; "> 
				  </div>
                </li>
                <div class="clear"></div>
					<?php
					}
					?>
			
              
              </ul>
            </div>
            <div class="tab-pane" id="tabs1-pane2">
              <ul class="nav nav-list bs-docs-sidenav">
			    <?php
				
				 $selectPopular = "SELECT news_info.id,news_info.title,position.Last FROM `news_info` INNER JOIN `position` ON news_info.id=position.PostID WHERE position.Popular='1' ORDER BY position.PostID DESC LIMIT 8";
				 
				  $popular = $db->select($selectPopular);
				  foreach ($popular as $getPopulattile){
        			?>
					
                <li> <a title="<?php echo $getPopulattile["title"] ?>" href="article/<?php echo $getPopulattile["id"]; ?>">
				<i class="icon-chevron-right"></i><?php echo $getPopulattile["title"] ?>ু</a></li>

					<?php
					}
					?>
					
					
               
 
              </ul>
            </div>
          </div>
        </div>
        <div class="clear"></div>
        <hr/>
        <!--********************************* World Cup  ***********************************-->
        <!-- <div class="row-fluid">

            
        </div>
        <hr/>-->
        <div class="row-fluid news_box">
          <h4 class="widget-title"><a href="main-section/11006/">শিক্ষা </a></h4>
		  
		  
		 		 <?php
				 $selectEducation = "SELECT news_info.id,news_info.title, news_info.fb_share_text, news_info.ext,news_main_menu.main_menu_id FROM `news_info` INNER JOIN `news_main_menu` ON news_info.id=news_main_menu.news_id WHERE news_main_menu.main_menu_id='11006' ORDER BY news_main_menu.news_id DESC LIMIT 5";
				
				  $education = $db->select($selectEducation);
				  foreach ($education as $getEducationtitle)
				  {
					
?>
			  
			  
               
                   
                
				
				
          <div class="item-content divider"> <a href="article/<?php echo $getEducationtitle["id"];?>" class="pull-left"> 
		  
		   <?php
          if (file_exists("newsImage/".$getEducationtitle["id"].".".$getEducationtitle["ext"])) {
          ?>
                    <img src="newsImage/<?php echo $getEducationtitle["id"]; ?>.<?php echo $getEducationtitle["ext"]; ?>" alt="<?php echo $getEducationtitle["title"]; ?>"  class="img-thumb3" >
                    <?php
          } else {
            ?>
                    <img src="images/News.jpg" class="img-responsive">
                    <?php
          } 
        ?>
		
		 </a>
            <div class="font14"> <a href="article/<?php echo $getEducationtitle["id"];?>"><?php echo $getEducationtitle["title"]; ?></a>
              <div class="clear"></div>
            </div>
          </div>
		  <?php
		  }
		  ?>
		  
		  
		
		  
		 
          <p><a class="read-more" href="main-section/11006/">শিক্ষা - এর সকল খবর&raquo;</a></p>
        </div>
        <!--********************************************************************-->
        <!--******************************** POLL  ************************************-->
       
		
		
        <div class="span12">
          <h4 class="widget-title"></h4>
          <div class="news_box pd10"> <img class="img-thumb3" src="images/ads0000007.gif" style="width:100%; height:150px;"> </div>
          <div class="news_box pd10"> <img class="img-thumb3" src="images/moon.gif" style="width:100%; height:150px;"> </div>
          
        </div>
        <div class="clear"></div>
        <hr/>
       
        <!--********************************************************************-->
        <!--****************************  EXCLUSIVE & OPINION ****************************************-->
        <div class="tabbable span12 news_box">
          <h4 class="widget-title"><a href="sub-section/11012/12038">এক্সক্লুসিভ</a></h4>
		  
	
		  
		  
		 		 <?php
				// $exclusive = "SELECT news_info.id,news_info.title, news_info.fb_share_text, news_info.ext,news_sub_menu.main_menu_id,news_sub_menu.sub_menu_id FROM `news_info` INNER JOIN `news_sub_menu` ON news_info.id=news_sub_menu.news_id WHERE news_sub_menu.main_menu_id='11012' AND news_sub_menu.sub_menu_id='12038'  ORDER BY news_sub_menu.news_id DESC LIMIT 5";
				$exclusive="select * from news_info limit 5";
				
				  $selectExclucive = $db->select($exclusive);
				  foreach ($selectExclucive as $getExcluciveTitle)
				  {
					
?>
			  
			  
               
                   
                
				
				
          <div class="item-content divider"> <a href="article/<?php echo $getExcluciveTitle["id"];?>" class="pull-left"> 
		  
		   <?php
          if (file_exists("newsImage/".$getExcluciveTitle["id"].".".$getExcluciveTitle["ext"])) {
          ?>
                    <img src="newsImage/<?php echo $getExcluciveTitle["id"]; ?>.<?php echo $getExcluciveTitle["ext"]; ?>" alt="<?php echo $getExcluciveTitle["title"]; ?>"  class="img-thumb3" >
                    <?php
          } else {
            ?>
                    <img src="images/News.jpg" class="img-responsive">
                    <?php
          } 
        ?>
		
		 </a>
            <div class="font14"> <a href="article/<?php echo $getExcluciveTitle["id"];?>"><?php echo $getExcluciveTitle["title"]; ?></a>
              <div class="clear"></div>
            </div>
          </div>
		  <?php
		  }
		  ?>
		  
		  
		
		
		  
          <p><a class="read-more" href="sub-section/11012/12038">এক্সক্লুসিভ- এর সকল খবর&raquo;</a></p>
        </div>
        <div class="clear"></div>
        <hr/>
        <!--******************************* DIFFERENT  *************************************-->
   
		
    </div>
  </div>
    <?php include("footer.php"); ?>
</div>
</body>
<!-- Mirrored from bdlive24.com/category/politics by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 May 2017 03:49:42 GMT -->
</html>