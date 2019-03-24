 <meta http-equiv="content-type" content="text/html;charset=utf-8" />
 <div class="row-fluid braking">

        <div class="span1 latest" style="text-align:left; min-width:100px;background:#F6022A;color:#fff;">
           
শিরোনাম : 
   
			</div>
			
        <div class="span7" style="margin:0px">
            <style>.slides li{display:none}</style>
            <div class="newsticker">
                <ul class="slides">
				
				<?php
				
				 $queryBangladesh = "SELECT * from news_info order by id desc limit 6";
				 
				  $title = $db->select($queryBangladesh);
				  foreach ($title as $heading){
        			?>
		
                       <li><h2><a href="article/<?php echo $heading["id"]; ?>"><?php echo $heading["title"] ?></a></h2></li>
					<?php
					}
					?>
					
                    </ul>
            </div>
        </div>
		
		
		
        <div class="span4">
            <div class="bangla_date">
			
			  <?php 
			  date_default_timezone_set('Asia/Dhaka');
			  $date=date('m/d/Y');
              $queryR = "SELECT bdate FROM date_info WHERE edate='$date'";
             if($fetchNewsMenuSports = $db->select($queryR))
			  
             echo $fetchNewsMenuSports[0]["bdate"];
			 else
			 echo date('d-m-Y');
			 
			  ?>
			
                
								
								</div>
        </div>
    </div>
 