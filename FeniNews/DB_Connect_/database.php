<?php
	class connection extends PDO{
		protected $tb;
		private $condition;
		
		public function __construct()
		{
			$dsn = 'mysql:dbname=feninews;host=localhost';
			$user = 'root';
			$pass = '';
			parent::__construct($dsn,$user,$pass);
		}

		public function tableName($table){
		 	$this->tb = $table;
		}
		/*select By fields*/
		public  function selectAdd($condition){
		 	$sql = "SELECT advertisement.*,advertisementposition.position FROM advertisement inner join advertisementposition ON advertisement.position=advertisementposition.position WHERE advertisement.position=:fields";
		 	$stmt = $this->prepare($sql);
		 	$stmt->bindParam(':fields',$condition);
		 	$stmt->execute();
		 	$fetch = $stmt->fetchAll();
		 	return $fetch[0];
		}
		public  function selectByFields($table,$field,$condition){
		 	$sql = "SELECT * FROM $table WHERE $field=:fields";
		 	$stmt = $this->prepare($sql);
		 	$stmt->bindParam(':fields',$condition);
		 	$stmt->execute();
		 	$fetch = $stmt->fetchAll();
		 	return $fetch[0];
		}
		/*selectin all from database*/

		public  function selectAll(){
		 	$sql = "SELECT * FROM $this->tb ORDER BY id DESC";
		 	$stmt = $this->prepare($sql);
		 	$stmt->execute();
		 	return $stmt->fetchAll();
		}
		public function selectAllLimit(){
			$sql = "SELECT * FROM $this->tb ORDER BY id DESC LIMIT 24";
		 	$stmt = $this->prepare($sql);
		 	$stmt->execute();
		 	return $stmt->fetchAll();
		}
		public function selectLimit($table,$limit){
			$sql = "SELECT * FROM $table ORDER BY id DESC LIMIT $limit";
		 	$stmt = $this->prepare($sql);
		 	$stmt->execute();
		 	return $stmt->fetchAll();
		}
		public function selectFirst(){
			$sql = "SELECT * FROM $this->tb ORDER BY id ASC LIMIT 1";
		 	$stmt = $this->prepare($sql);
		 	$stmt->execute();
		 	return $stmt->fetchAll();
		}
		public function selectLast(){
			$sql = "SELECT * FROM $this->tb ORDER BY id DESC LIMIT 1";
		 	$stmt = $this->prepare($sql);
		 	$stmt->execute();
		 	return $stmt->fetchAll();
		}
		public  function selectSub($table){
		 	$sql = "SELECT * FROM $table ORDER BY id ASC";
		 	$stmt = $this->prepare($sql);
		 	$stmt->execute();
		 	return $stmt->fetchAll();
		}
		/*select query builder*/
		public function select($query){
		 	$stmt = $this->prepare($query);
		 	$stmt->execute();
		 	return $stmt->fetchAll();
		}
		//inserting with query//
		public function insertQ($query){
		 	return $this->exec($query);
		}

		/*select by id*/
		public function selectById($id){
		 	$sql = "SELECT * FROM $this->tb WHERE id=:id";
		 	$stmt = $this->prepare($sql);
		 	$stmt->bindParam(':id',$id);
		 	$stmt->execute();
		 	return $stmt->fetchAll();
		}
		/*condition*/
		public function selectNext($id){
			$sql = "SELECT * FROM $this->tb WHERE id<:id  ORDER BY id DESC LIMIT 1";
		 	$stmt = $this->prepare($sql);
		 	$stmt->bindParam(':id',$id);
		 	$stmt->execute();
		 	return $stmt->fetchAll();
		}
		public function selectPrev($id){
			$sql = "SELECT * FROM $this->tb WHERE id>:id  ORDER BY id ASC LIMIT 1";
		 	$stmt = $this->prepare($sql);
		 	$stmt->bindParam(':id',$id);
		 	$stmt->execute();
		 	return $stmt->fetchAll();
		}
		/*select fields by id*/
		public function selectFieldById($fields,$id){
		 	$sql = "SELECT $fields FROM $this->tb WHERE id=:id";
		 	$stmt = $this->prepare($sql);
		 	$stmt->bindParam(':id',$id);
		 	$stmt->execute();
		 	return $stmt->fetchAll();
		}
		function with($con){
			$this->condition = $con;
			return $this;
		}
		
		/*counter */
		public function counTRow($tableName,$fields=false){
			if ($fields) {
				$query = "SELECT COUNT($fields) FROM $tableName";
			} else {
				$query = "SELECT COUNT(id) FROM $tableName";
			}
			$stmt = $this->prepare($query);
			$stmt->execute();
			$value = $stmt->fetchAll();
			return $value[0][0];
		}
		/*end of counter*/
		/*inserting into database*/

		public function insert($data){
		 	$a = 0;
		 	$key = array_keys($data);
		 	$keys = implode(',',array_keys($data));
		 	$placeholder = ":" .implode(', :',array_keys($data));
		 	$sql = "INSERT INTO $this->tb($keys) VALUES($placeholder)";
		 	$stmt = $this->prepare($sql);
		 	// foreach ($data as $key => $value) {
		 	// 	$stmt->bindParam(":".$key,$value);
		 	// }
		 	$count = count($data);
		 	while ($a < $count) {
		 		$stmt->bindParam(":".$key[$a],$data[$key[$a]]);
		 		$a++;
		 	}
		 	return $stmt->execute();
		}


		/*updating data base */
		public function update($dt){
			$x = 0;
			$keyss = array_keys($dt);
		 	$updateKeys = NULL;
		 	$counter = count($dt);
		 	foreach ($dt as $key => $value) {
		 		$updateKeys .= "$key=:$key,";
		 	}
		 	$updateKeys = rtrim($updateKeys,",");
		 	$updateKeys;
		 	$sql = "UPDATE $this->tb SET $updateKeys WHERE id=$this->condition";
		 	$stmtt = $this->prepare($sql);
		 	while ($x < $counter) {
		 		$stmtt->bindParam(":".$keyss[$x],$dt[$keyss[$x]]);
		 		$x++;
		 	}
		 	return $stmtt->execute();
		 	
		}
		public function destroy(){
			$sql = "DELETE FROM $this->tb WHERE id='$this->condition'";
			return $this->exec($sql);
		}

		public function deleteQ($sql){
			return $this->exec($sql);
		}

	}
?>