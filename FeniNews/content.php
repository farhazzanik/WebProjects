<?php
  date_default_timezone_set('Asia/Dhaka');
  
  $db->tableName("news_info");
  $fetchPost = $db->selectById($postid);
?>
<style type="text/css">
  .description{
    font-size: 16px;
    text-align: justify;
    line-height: 28px; 
  }
  
    p{
         font-size: 16px;
         text-align:justify;
  }
  
</style>





 <div class="span12">
        <div class="advertisement"><a href="#" title="Feni News Chanel" target="_blank">
            <a href="https://www.youtube.com/channel/UCLWz1ie-FJDTXNX8TuvJ__g" title="ringid" target="_blank"> <img width="100%" src="images/servbox.gif" alt="www.feninews.com"/></a></a></div>
      </div>
      
    <?php 
    date_default_timezone_set('Asia/Dhaka');
    
    
/*$currentDate = $fetchPost[0]["date_english"];
$engDATE = array(1,2,3,4,5,6,7,8,9,0,January,February,March,April,May,June,July,August,September,October,November,December,Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday,Friday);
$bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার','
বুধবার','বৃহস্পতিবার','শুক্রবার' 
);
$convertedDATE = str_replace($engDATE, $bangDATE, $currentDate);
*/

function bn_date($str)
 {
     $en = array(1,2,3,4,5,6,7,8,9,0);
    $bn = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
    $str = str_replace($en, $bn, $str);
    $en = array( 'January', 'February', 'March', 'April', 'May', 'June', 'Jul', 'August', 'September', 'October', 'November', 'December' );
    $en_short = array( 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' );
    $bn = array( 'জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর' );
    $str = str_replace( $en, $bn, $str );
    $str = str_replace( $en_short, $bn, $str );
    $en = array('Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday');
     $en_short = array('Sat','Sun','Mon','Tue','Wed','Thu','Fri');
     $bn_short = array('শনি', 'রবি','সোম','মঙ্গল','বুধ','বৃহঃ','শুক্র');
     $bn = array('শনিবার','রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহস্পতিবার','শুক্রবার');
     $str = str_replace( $en, $bn, $str );
     $str = str_replace( $en_short, $bn_short, $str );
     $en = array( 'am', 'pm' );
    $bn = array( 'পূর্বাহ্ন', 'অপরাহ্ন' );
    $str = str_replace( $en, $bn, $str );
     return $str;
 }
				
				
?>


      <div class="row-fluid ">
        <div class="span12 shadow">
          <p>
          <b>
          <h2 class="pdl20"><?php echo $fetchPost[0]["title"]; ?></h2>
      
          </b>
          </p>
          
          
          <p class="pdl20 det">
          
          
          
		
		
		
              
          </p>
           <div class="section">
				<div class="addthis_sharing_toolbox" data-url="http://www.feninews.com<?php  print $_SERVER['REQUEST_URI']; ?>">
          <div style="float:left; width:120px; border:0px solid #000;">
            <a class="addthis_counter addthis_pill_style"></a>
          </div>
            <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
        </div>
      </div>
		
		  <div class="fb-share-button" data-href="http://www.feninews.com<?php  print $_SERVER['REQUEST_URI']; ?>" data-layout="button" 
	  data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" 
	  href="https://www.facebook.com/sharer/sharer.php?u=http://www.feninews.com<?php  print $_SERVER['REQUEST_URI']; ?>amp;src=sdkpreparse">Share</a>
	  </div>
		<span class="fb-save" data-uri="http://www.feninews.com<?php  print $_SERVER['REQUEST_URI']; ?>" data-size="large"></span>
		
          <hr/>
          <div class="pdl20 pdr30">
            <div class="span12 dt2">
              <?php
              if (file_exists("newsImage/".$fetchPost[0]["id"].".".$fetchPost[0]["ext"])) {
              ?>
                <img width="100%" src="newsImage/<?php echo $fetchPost[0]["id"]; ?>.<?php echo $fetchPost[0]["ext"]; ?>" class="img-responsive" style="max-height:500px;">
              <?php
              } else {
                ?>
                  <img src="images/News.jpg" class="img-responsive">
                <?php
              }
              
            ?>
            </div>
            <p>
                
                <?php echo $fetchPost[0]["description"]; ?>
            
            </p>
           
          
            <br><br>
            
            <span style='font-size:14px;'> 
            
            প্রকাশঃ  <?php    echo   bn_date( $fetchPost[0]["date_english"]) ?>  
            </span>
            
            <div>
			<br>
			 <a href="http://www.feniuniversity.edu.bd/" target="_blank"> <img src="http://www.feninews.com/images/feniUniversity.jpg" style="width:100%; min-height:200px; max-height:300px; ></a></div>
            
         
            <div class="clear"></div>
          </div>
          <div> </div>
          <div class="clear"></div>
          <br/>
          <div class="pdl30 det"></div>
          <div class="clear"></div>
          <!-- AddThis Button BEGIN -->
	 
        </div>
        
        
        
        
        <div class="clear">
        <div class="fb-comments" data-href="http://www.feninews.com<?php  print $_SERVER['REQUEST_URI']; ?>" data-width="100%" data-numposts="5"></div>
        </div>
		 <div class="clear"></div>
		 <div> <a href="http://sbit.com.bd/" target="_blank"> <img src="http://www.feninews.com/images/feni.jpg" style="width:100%; min-height:200px; max-height:300px" ></a>
            </div>

      </div>