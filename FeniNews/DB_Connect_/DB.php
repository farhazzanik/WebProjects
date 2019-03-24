<?php 
	include("database.php");
	
	class DB extends connection{
		
		public function s($input){
			return trim($input);
		}
		public function autogenerat($table,$fildname,$prefix,$id_length) {
			$query="SELECT MAX($fildname) FROM $table";
			$result = $this->select($query);
			$max_id = $result[0][0];
			
			//print $max_id."<br/>";
			$prefix_length=strlen($prefix);
			//print $prefix_length."<br/>";
			$only_id=substr($max_id,$prefix_length);
			//print $only_id;
			$new=(int)($only_id);
			//print $new;
			$new++;
			//print $new;
			$number_of_zero=$id_length-$prefix_length-strlen($new);
			$zero=str_repeat("0", $number_of_zero);
			//print $zero;
			$made_id=$prefix.$zero.$new;
			//print $made_id;
			return $made_id;
	
		}
		public function encryptt($user_pass) {
			$format = "$2y$10$";
			$salt_length = "22";
			$salt = $this->sal_generate($salt_length);
			$format_salt = $format.$salt;
			$hash = crypt($user_pass,$format_salt);
			return $hash;
		}
		public function sal_generate($length) {
			$uniqID = md5(uniqid(mt_rand(), true));
			$base64_string = base64_encode($uniqID);
			$verify_base64 = str_replace("+",".", $base64_string);
			$salt = substr($verify_base64,0,$length);
			return $salt;
		}
		public function fileDelete($location){
			if(file_exists($location)){
				return unlink($location);
			}
		}
		public function es($input){
			return trim(htmlspecialchars(htmlentities($input)));
		}
		public function getClientExtension($file){
			$exploded = explode(".", $file);
			$endofArray = end($exploded);
			return $ext = strtolower($endofArray);
		}
		
		
		public function storeAs($file, $folder, $name){
			$destination = "../".$folder."/".$name;
			if (is_dir('../'.$folder)) {
				return move_uploaded_file($file, $destination);
			}else{
				if(mkdir('../'.$folder)){
					return move_uploaded_file($file, $destination);
				}
			}
		}
		public function encoDe($value){
			return explode("/",
			 htmlspecialchars(
			 	htmlentities(
			 		trim(
			 			rtrim($value, "/ ")
			 			)
			 		)
			 	)
			 );
		}

	}
?>