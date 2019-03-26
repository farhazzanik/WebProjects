<?php
  require_once("db_connect/config.php");
   require_once("db_connect/conect.php");
	
	$db = new database();

	
		 $sql = "SELECT * FROM `adminarea` ORDER BY id ASC";
		$result_data = $db->select_query($sql);	

		if($result_data != "")	{
			while($fetch_Data = $result_data->fetch_object()){

					echo "<tr align='center'>
		                <td id='county".$fetch_Data->id."'>".$fetch_Data->county."</td>
		                <td id='country".$fetch_Data->id."'>".$fetch_Data->country."</td>
		                <td id='town".$fetch_Data->id."'>".$fetch_Data->town."</td>
		                <td id='postcode".$fetch_Data->id."'>".$fetch_Data->postcode."</td>
		                <td id='Description".$fetch_Data->id."'>".substr($fetch_Data->Description, 0,100)."</td>
		                <td id='Address".$fetch_Data->id."'>".$fetch_Data->Address."</td>
		                <td id='image".$fetch_Data->id."'>
		                <img src='image/".$fetch_Data->id.".png' height='80' width='80'></td>
		                <td id='bedrooms".$fetch_Data->id."'>".$fetch_Data->bedrooms."</td>
		                   <td id='bathrooms".$fetch_Data->id."'>".$fetch_Data->bathrooms."</td>
		                <td id='Price".$fetch_Data->id."'>$".$fetch_Data->Price."</td>
		                <td id='Type".$fetch_Data->id."'>".$fetch_Data->Type."</td>
		                 <td id='act".$fetch_Data->id."'> <input type='button' onclick='editData($fetch_Data->id,\"$fetch_Data->county\",\"$fetch_Data->country\",\"$fetch_Data->town\",\"$fetch_Data->postcode\",\"$fetch_Data->Description\",\"$fetch_Data->Address\",\"$fetch_Data->bedrooms\",\"$fetch_Data->bathrooms\",\"$fetch_Data->Price\",\"$fetch_Data->Type\")' value='Edit' class='btn btn-primary btn-sm' style='border-radius: 0px;'> <input type='button' onclick='deleteData($fetch_Data->id)' value='Delete' class='btn btn-warning btn-sm' style='border-radius: 0px;'></td>	
            			</tr>";
				}
		}
	
?>