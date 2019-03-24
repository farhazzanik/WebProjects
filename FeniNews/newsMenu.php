<?php
    if (@$mainMenuu!="") {
        $table = "news_main_menu";
        $menuID = $mainMenuu;
        $fields = "main_menu_id";
    } else if($subMenuu!=""){
        $table = "news_sub_menu";
        $menuID = $subMenuu;
        $fields = "sub_menu_id";
    }
    
?>
<?php
    $asss = "SELECT COUNT(news_info.id)
        FROM news_info INNER JOIN $table ON 
        news_info.id=$table.news_id
        WHERE $table.$fields='$menuID'";
    if($fetchCount = $db->select($asss)){
        $rows = $fetchCount[0][0];
    }
    $per_page = 12;
    $last = ceil($rows/$per_page);
    if($last<1){
        $last='1';
    }
    $pagenum = 1;
    if(isset($pn)){
        $pagenum = preg_replace('#[^0-9]#', '', $pn);
    }
    if($pagenum < 1) { 
        $pagenum = 1; 
    } else if($pagenum > $last) { 
        $pagenum = $last; 
    }
    $limit = 'LIMIT ' .($pagenum - 1) * $per_page .',' .$per_page;
    $query = "SELECT news_info.*,$table.$fields FROM news_info INNER JOIN $table ON news_info.id=$table.news_id WHERE $table.$fields='$menuID' ORDER BY news_info.id DESC $limit";
        if($fetchAll = $db->select($query)){
            $paginationCtrls = '';
        if($last != 1){
            if ($pagenum > 1) {
                $previous = $pagenum - 1;
                $paginationCtrls .= '<a class="btn" href="'.$section.'/'.$pagingmenu.'/'.$previous.'" style="background:#E95546; color:#fff;" >&laquo;</a>';
                // Render clickable number links that should appear on the left of the target page number
                for($i = $pagenum-4; $i < $pagenum; $i++){
                    if($i > 0){
                        $paginationCtrls .= '<a class="btn" href="'.$section.'/'.$pagingmenu.'/'.$i.'" style="background:#E95546; color:#fff;">'.$i.'</a>';
                    }
                }
            }
            // Render the target page number, but without it being a link
            $paginationCtrls .= '<span class="active btn" style="">'.$pagenum.'</span> &nbsp; ';
            // Render clickable number links that should appear on the right of the target page number
            for($i = $pagenum+1; $i <= $last; $i++){
                $paginationCtrls .= '<a class="btn" href="'.$section.'/'.$pagingmenu.'/'.$i.'" style=" color:#fff;background:#E95546;">'.$i.'</a>';
                if($i >= $pagenum+4){
                    break;
                }
            }
            // This does the same as above, only checking if we are on the last page, and then generating the "Next"
            if ($pagenum != $last) {
                $next = $pagenum + 1;
                $paginationCtrls .= '<a class="btn" href="'.$section.'/'.$pagingmenu.'/'.$next.'" style="background:#E95546; color:#fff;">&raquo;</a> ';
            }
        }

    }
?>
<?php
    foreach ($fetchAll as  $newslist) {
        $shortText = substr($newslist["fb_share_text"], 0, 250);
        $ShortDetais = substr($shortText, 0, strrpos($shortText, ' '));
?>
<div class="span4">
    <div class="news_box widget widget-lifestyle"  style="height:350px;">
      <!-- widget-title-2 -->
      <div class="item clearfix">
        <a href="#">
            <?php
              if (file_exists("newsImage/".$newslist["id"].".".$newslist["ext"])) {
              ?>
                <img src="newsImage/<?php echo $newslist["id"]; ?>.<?php echo $newslist["ext"]; ?>"  alt=" <?php echo $fetchTadition["title"];?>"  style="width:100%; height:180px;">
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
            <div style="min-height:50px;">
                <h4><a href="article/<?php echo $newslist["id"] ?>"><?php echo $newslist["title"] ?></a></h4>
            </div>
            <p class="color_black"><?php echo $ShortDetais; ?> ... <a href="#" class="more">বিস্তারিত</a> </p>
          </div>
        </div>
      </div>
    </div>
</div>
<?php
    }
?>

<div class="span12" align="center"><br>
    <div class="btn-group">
        <?php echo $paginationCtrls; ?>
    </div>
</div>