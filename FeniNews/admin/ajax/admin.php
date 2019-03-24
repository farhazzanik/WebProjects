<?php
	include '../../DB_Connect_/DB.php';
  	$db = new DB;
	if (isset($_POST["id"])) {
		$id = $_POST["id"];
		// main link
		$query = "SELECT main_link_priority.*,main_link_info.link_name FROM main_link_priority INNER JOIN main_link_info ON main_link_priority.main_link_id=main_link_info.id WHERE main_link_priority.admin_id='$id'";
		$fetchMain = $db->select($query);
		//sublink group BY 
		$queryForGroupBYMl = "SELECT sub_link_priority.*,main_link_info.link_name FROM sub_link_priority INNER JOIN main_link_info ON sub_link_priority.main_link_id=main_link_info.id WHERE sub_link_priority.admin_id='$id' GROUP BY sub_link_priority.main_link_id ";
		$fetchForGroupBYMl = $db->select($queryForGroupBYMl);
		//main menu
		$queryForMainM ="SELECT menu_priority.*,menu_info.menu_name FROM menu_priority INNER JOIN menu_info ON menu_priority.main_menu_id=menu_info.id WHERE menu_priority.admin_id='$id'";
		$fetchMainM = $db->select($queryForMainM);

		// sub menu group by
		$queryAAA = "SELECT submenu_priority.*,menu_info.menu_name FROM submenu_priority INNER JOIN menu_info ON submenu_priority.main_menu_id=menu_info.id WHERE submenu_priority.admin_id='$id' GROUP BY submenu_priority.main_menu_id";

		$fetchAAA = $db->select($queryAAA);
?>
			<p class="" style="font-size: 16px; font-weight: bold;">Main Link: </p>
        		<div style="margin-left: 20px;" id="mainLi">
        			<?php
        				$x = 0;
        				foreach ($fetchMain as $mainL) {
        					$x++;
        					?>
        					<p><span class="label label-info"><?php echo $x; ?></span>  &nbsp;<?php echo $mainL["link_name"] ?></p>
        					<?php
        				}
        			?>
        		</div>
        	<p class="" style="font-size: 16px; font-weight: bold;">Sub Link: </p>
        		<div style="margin-left: 20px;" id="subLi">
        			<?php
        				$a = 0;
        				foreach ($fetchForGroupBYMl as $gml) {
        					//sublink
							$queryForSubL = "SELECT sub_link_priority.*,sub_link_info.sublink_name,main_link_info.link_name FROM sub_link_priority INNER JOIN sub_link_info ON sub_link_priority.sub_link_id=sub_link_info.id INNER JOIN main_link_info ON sub_link_priority.main_link_id=main_link_info.id WHERE sub_link_priority.admin_id='$id' AND sub_link_priority.main_link_id='".$gml["main_link_id"]."'";
							$fetchSubl = $db->select($queryForSubL);
        					$a++;
        					?>
        					<p><span class="label label-info"><?php echo $a; ?></span>  &nbsp;<?php echo $gml["link_name"] ?>: <?php 
        					$sl = 0;
        					foreach ($fetchSubl as $sbL) {
        						$sl++;
        					?>
        						<span class="label label-danger"><?php echo $sl; ?></span>&nbsp;<?php echo $sbL["sublink_name"]; ?>&nbsp;&nbsp;
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
        				foreach ($fetchMainM as $mainmA) {
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
        				foreach ($fetchAAA as $aaaa) {
        					//sub menu
							$queryForSubM = "SELECT submenu_priority.*,submenu_info.sub_menu_name,menu_info.menu_name FROM submenu_priority INNER JOIN submenu_info ON submenu_priority.submenu_id=submenu_info.id INNER JOIN menu_info ON submenu_priority.main_menu_id=menu_info.id WHERE submenu_priority.admin_id='$id' AND submenu_priority.main_menu_id='".$aaaa["main_menu_id"]."'";
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
?><?php
	if (isset($_POST["did"])) {
		$did = DB::s($_POST["did"]);
        $extensionnn = $_POST["extensionnn"];
		$db->tableName("admin_info");
		$db->with("$did");
		if ($db->destroy()) {
			$ml = "DELETE FROM main_link_priority WHERE admin_id='$did'";
			$db->deleteQ($ml);
			$sl = "DELETE FROM sub_link_priority WHERE admin_id='$did'";
			$db->deleteQ($sl);
			$mm = "DELETE FROM menu_priority WHERE admin_id='$did'";
			$db->deleteQ($mm);
			$sm = "DELETE FROM submenu_priority WHERE admin_id='$did'";
			$db->deleteQ($sm);
            $db->fileDelete("../../images/".$did.".".$extensionnn);
			echo "Successful";
		}
	}
?>