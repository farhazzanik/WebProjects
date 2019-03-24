<?php
	$db->tableName("news_info");
	$fetchAll = $db->selectAllLimit();
	foreach ($fetchAll as $SportsR) {
	//echo  $SportsR["id"].$SportsR["ext"];
?>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mm whit">
	<div class="imgWrapsm">
	  <?php
	    if (file_exists("../newsImage/".$SportsR["id"].".".$SportsR["ext"])) {
	    ?>
	      <img src="../newsImage/<?php echo $SportsR["id"]; ?>.<?php echo $SportsR["ext"]; ?>" class="img-responsive">
	    <?php
	    } else {
	      ?>
	        <img src="../images/News.jpg" class="img-responsive">
	      <?php
	    }
	    
	  ?>
	  	<p  class="imgDescriptionsmall">
	      <?php echo $SportsR["title"]; ?>
	    </p>
	</div>
</div>
<?php
	}
?>