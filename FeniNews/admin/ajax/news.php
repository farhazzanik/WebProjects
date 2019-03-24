<?php
	include '../../DB_Connect_/DB.php';
  	$db = new DB;
  	$db->tableName("news_info");
  	if (isset($_POST["moreID"])) {
  		$fetchNews = $db->select("SELECT * FROM news_info WHERE id='".$_POST["moreID"]."'");
  		$button = '<div class="btn-group"><button type="button" class="btn btn-primary btn-sm" onclick="lessData('.$fetchNews[0]["id"].')">Less</button>'.'<button type="button" class="btn btn-info btn-sm" onclick="descriptionSelect('.$fetchNews[0]["id"].')"  data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i> Edit</button></div>';
  		echo $fetchNews[0]["description"].$button;
  	}
  	if (isset($_POST["lessID"])) {
  		$fetchNews = $db->select("SELECT * FROM news_info WHERE id='".$_POST["lessID"]."'");
  		$button = '<br/><button type="button" class="btn btn-primary btn-sm" onclick="moreData('.$fetchNews[0]["id"].')">More</button>';
  		$s = substr($fetchNews[0]["description"], 0, 520);
		echo $d = substr($s, 0, strrpos($s, ' ')).$button;
  	}
  	if (isset($_POST["descId"])) {
  		$fetchNews = $db->select("SELECT * FROM news_info WHERE id='".$_POST["descId"]."'");
  		echo $fetchNews[0]["description"];
  	}
  	if (isset($_POST["editId"])) {
  		$editId = DB::s($_POST["editId"]);
  		$DescriptionAll = DB::s($_POST["DescriptionAll"]);
  		$db->with($editId);
  		$dt = array('description' => $DescriptionAll);
  		if ($db->update($dt)) {
			echo "Updated";
		}else{
			echo "Failed";
		}
  	}
  	if (isset($_POST["fb_sharID"])) {
  		$fb_sharID = $db->with(DB::s($_POST["fb_sharID"]));
  		$fb_share_t = DB::s($_POST["fb_share_t"]);
  		if (!empty($fb_share_t)) {
  			$dt = array(
  					'fb_share_text' => $fb_share_t
  				);
  			if ($db->update($dt)) {
				echo "Updated";
			}else{
				echo "Failed";
			}
  		}
  	}
    if (isset($_POST["titleEditID"])) {
      $titleEditID = $db->with(DB::s($_POST["titleEditID"]));
      $titleEdittext = DB::s($_POST["titleEdittext"]);
      if (!empty($titleEdittext)) {
        $dt = array(
            'title' => $titleEdittext
          );
        if ($db->update($dt)) {
        echo "Updated";
      }else{
        echo "Failed";
      }
      }
    }
    if (isset($_POST["reporterEditttext"])) {
      $reporterEditid = $db->with(DB::s($_POST["reporterEditid"]));
      $reporterEditttext = DB::s($_POST["reporterEditttext"]);
      if (!empty($reporterEditttext)) {
        $dt = array(
            'reporters_name' => $reporterEditttext
          );
        if ($db->update($dt)) {
        echo "Updated";
      }else{
        echo "Failed";
      }
      }
    }
?>
<?php
    if (isset($_POST["menuAreaID"])) {
      $menuAreaID =  DB::s($_POST["menuAreaID"]);
      //division select
      $queryDivision = "SELECT news_division.*,divisions_info.divisions_name FROM news_division INNER JOIN divisions_info ON news_division.division_id=divisions_info.id WHERE news_division.news_id='".$menuAreaID."'";
      $fetchDivision = $db->select($queryDivision);
      //end of devision select//

      //group by division//
      $queryDivisionG = "SELECT news_district.*,divisions_info.divisions_name FROM news_district INNER JOIN divisions_info ON news_district.news_division_id=divisions_info.id WHERE news_district.news_id='".$menuAreaID."' GROUP BY news_district.news_division_id";
      $fetchForGroupBYDivision = $db->select($queryDivisionG);
      //end of group by division//

      // query for main menu select //
      $queryMainMenu = "SELECT news_main_menu.*,menu_info.menu_name FROM news_main_menu INNER JOIN menu_info ON news_main_menu.main_menu_id=menu_info.id WHERE news_main_menu.news_id='".$menuAreaID."'";
      $fetchMainMenu = $db->select($queryMainMenu);
      //end of main menu select//
      ?>
        <p class="" style="font-size: 16px; font-weight: bold;">Division: </p>
            <div style="margin-left: 20px;" id="mainLi">
              <?php
                $x = 0;
                foreach ($fetchDivision as $DivisionA) {
                  $x++;
                  ?>
                  <p><span class="label label-info"><?php echo $x; ?></span>  &nbsp;<?php echo $DivisionA["divisions_name"] ?></p>
                  <?php
                }
              ?>
            </div>
          <p class="" style="font-size: 16px; font-weight: bold;">District: </p>
            <div style="margin-left: 20px;" id="subLi">
              <?php
                $a = 0;
                foreach ($fetchForGroupBYDivision as $gml) {
                  //sublink
                  $QueryForDistrict = "SELECT news_district.*,district_info.district,divisions_info.divisions_name FROM news_district INNER JOIN district_info ON news_district.news_district_id=district_info.id INNER JOIN divisions_info ON news_district.news_division_id=divisions_info.id WHERE news_district.news_id='".$gml["news_id"]."' AND news_district.news_division_id='".$gml["news_division_id"]."'";
                  $fetchDistrict = $db->select($QueryForDistrict);
                  $a++;
                  ?>
                  <p><span class="label label-info"><?php echo $a; ?></span>  &nbsp;<?php echo $gml["divisions_name"] ?>: <?php 
                  $sl = 0;
                  foreach ($fetchDistrict as $sbL) {
                    $sl++;
                  ?>
                    <span class="label label-danger"><?php echo $sl; ?></span>&nbsp;<?php echo $sbL["district"]; ?>&nbsp;&nbsp;
                  <?php } ?>
                  </p>
                  <?php
                }
              ?>
            </div>
          <p class="" style="font-size: 16px; font-weight: bold;">Main Menu: </p>
            <div style="margin-left: 20px;" id="mainMm">
              <?php
                $aa = 0;
                foreach ($fetchMainMenu as $mainmA) {
                  $aa++;
                  ?>
                  <p><span class="label label-info"><?php echo $aa; ?></span>  &nbsp;<?php echo $mainmA["menu_name"] ?></p>
                  <?php
                }
              ?>
            </div>
          <p class="" style="font-size: 16px; font-weight: bold;">Sub Menu: </p>
            <div style="margin-left: 20px;" id="SubMm">
              <?php
                $aaa = 0;
                foreach ($fetchMainMenu as $aaaa) {
                  //sub menu
              $queryForSubM = "SELECT news_sub_menu.*,submenu_info.sub_menu_name FROM news_sub_menu INNER JOIN submenu_info ON news_sub_menu.sub_menu_id=submenu_info.id WHERE news_sub_menu.main_menu_id='".$aaaa["main_menu_id"]."' AND news_sub_menu.news_id='".$menuAreaID."'";
              $fetchSubM = $db->select($queryForSubM);
                  $aaa++;
                  ?>
                  <p style="line-height: 30px;"><span class="label label-info"><?php echo $aaa; ?></span>  &nbsp;<?php echo $aaaa["menu_name"]; ?>:&nbsp;&nbsp;  
                  <?php
                  $sll = 0;
                  foreach ($fetchSubM as $sbm) {
                    $sll++;
                  ?>
                    <span class="label label-danger"><?php echo $sll; ?></span>&nbsp;<?php echo $sbm["sub_menu_name"]; ?>&nbsp;&nbsp;
                  <?php } ?>
                  </p>
                  <?php
                }
              ?>
            </div>
      <?php
    }
?>
<?php
  if (isset($_POST["deleteID"])) {
    $deleteID = DB::s($_POST["deleteID"]);
    $newsFetch = $db->selectById($deleteID);
    $db->with($deleteID);
    if ($db->destroy()) {
      $districtDeletequery = "DELETE FROM news_district WHERE news_id='".$deleteID."'";
      $db->deleteQ($districtDeletequery);

      $divisionDeletequery = "DELETE FROM news_division WHERE news_id='".$deleteID."'";
      $db->deleteQ($divisionDeletequery);
      
      $mainmenuDeletequery = "DELETE FROM news_main_menu WHERE news_id='".$deleteID."'";
      $db->deleteQ($mainmenuDeletequery);
      $submenuDeletequery = "DELETE FROM news_sub_menu WHERE news_id='".$deleteID."'";
      $db->deleteQ($submenuDeletequery);
      @DB::fileDelete("../../newsImage/".$deleteID.".".$newsFetch[0]["ext"]);
      echo "News deleted";
    }else{
      echo "Failed";
    }
  }
?>