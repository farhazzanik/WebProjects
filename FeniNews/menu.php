
<style>
    #mobile-header .grid_4 a.sidrmenu {
    display: inline-block;
    padding: 6px 10px;
    text-align: center;
    background: #F6022A;
    color: #fff;
}



.sidr {
    display: none;
    position: absolute;
    position: fixed;
    top: 0;
    height: 100%;
    z-index: 999999;
    width: 260px;
    overflow-x: none;
    overflow-y: auto;
    font-family: "lucida grande",tahoma,verdana,arial,sans-serif;
    font-size: 15px;
    background: #006699;
    
}
    </style>
</style>
<div id="extraControls" class="hidden">
    <div id="sidr">
        <ul>
  	<li><a href="./">প্রচ্ছদ</a></li>
 		<?php
          $fetchMainMenu = $db->selectSub("menu_info");
          foreach ($fetchMainMenu as $mainMenu){
        ?>
            <li><a href="main-section/<?php echo $mainMenu["id"]; ?>/" ><?php echo $mainMenu["menu_name"] ?></a>
			
        
		
                <ul>
				 <?php
				 if($mainMenu["id"]!='11011')
				 {
              $fetchSubMenu = $db->select("SELECT * FROM submenu_info WHERE main_menu_id='".$mainMenu["id"]."'");
              foreach ($fetchSubMenu as $subMenu) {
                $expl = explode(" ", $subMenu["sub_menu_name"]);
                $impl = implode("-", $expl);
            ?>
                                                <li><a href="sub-section/<?php echo $mainMenu["id"]; ?>/<?php echo $subMenu["id"]; ?>/"><?php echo $subMenu["sub_menu_name"]; ?></a></li>

                                   <?php
                }
				}
              ?>              

                        </ul>
						</li>  
						
				 <?php
            }
          ?>       
						
					


      </ul>
    </div>
</div>



<div class="container-fluid">

    <div class="row-fluid">
        <div class="span12">
            
            <div class="logo">
               
			   
                    <span style="float:left; clear:right;">
                     <a href="./"><img src="images/coverPic.jpg" class="mobile-hide" alt="FeniNews" /></a>
					 </span>
					 
					 
              <span style="float:right;background:#ccc;">
                    <a href="http://www.feniuniversity.edu.bd/" target="_blank">  <img src="images/feniuniversitytop.jpg"  class="mobile-hide"  style="width:770px;"  /></a>
					
						
						</span>
                        

     </div>
        </div>
    </div>



    <div class="mobile-hide">
        <ul class="mainmenu">
			<li><a href="./">প্রচ্ছদ</a></li>
 		<?php
          $fetchMainMenu = $db->selectSub("menu_info");
          foreach ($fetchMainMenu as $mainMenu){
        ?>
            <li><a href="main-section/<?php echo $mainMenu["id"]; ?>/" ><?php echo $mainMenu["menu_name"] ?></a>
			
        
		
                <ul>
				 <?php
				 
				 if($mainMenu["id"]!='11011')
				 {
              $fetchSubMenu = $db->select("SELECT * FROM submenu_info WHERE main_menu_id='".$mainMenu["id"]."'");
              foreach ($fetchSubMenu as $subMenu) {
                $expl = explode(" ", $subMenu["sub_menu_name"]);
                $impl = implode("-", $expl);
            ?>
                                                <li><a href="sub-section/<?php echo $mainMenu["id"]; ?>/<?php echo $subMenu["id"]; ?>/"><?php echo $subMenu["sub_menu_name"]; ?></a></li>

                                   <?php
                }
				}
              ?>              

                        </ul>
						</li>  
						
				 <?php
            }
          ?>       
					
      </ul>
    </div>
</div>
