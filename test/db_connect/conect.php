<?php
class database {

    public $servername="localhost";
	public $username="root";
	public $pass="";
	public $db_name="testriga";
	
	/*public $servername="localhost";
	public $username="root";
	public $pass="";
	public $db_name="joypursorojoni";*/

	public $link;
	public $eror;
	public $sms;
	public $la;
	
	//database connection 
	public function __construct()
	{
		$this->db_connect();
	}


	private function db_connect()
	{
		$this->link= new mysqli($this->servername,$this->username,$this->pass,$this->db_name) or die ("database connect failed".$this->link->error."(".$this->link->errno.")");
		if(!$this->link)
		{
			echo $this->eror="connection failed";
		}
	}
	// end database connection 

	//sql injection
	public function escape($value)
	{
		$ouput=mysqli_real_escape_string($this->link,$value);
		return $ouput;
	}

	//last id
	public function lastid()
	{
		$lastid = mysqli_insert_id($this->link);
		return $lastid;
	}
	 
	

	//check insert query
	public function insert_query($query)
	{
	
		$insert_query=$this->link->query($query);
		if($insert_query)
		{
			 $this->sms="<span class='text-center text-success glyphicon glyphicon-ok'><strong>&nbsp;Data Insert Successfully</strong></span>";
			 $la=mysqli_insert_id($this->link);
			 return $la;
		}
		else
		{
			 $this->sms="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Data Insert Unuccessfully</strong></span>";
		}
	}
	//chect select query
	public function  select_query($query)
	{
		$select_query=$this->link->query($query);
		if($select_query->num_rows>0)
		{
			return $select_query; 
		}
		else
		{
			return false;
		}
		
	}
	
	//chect update and replace query
	public function update_query($query)
	{
		$update=$this->link->query($query);
		if($update)
		{
			$this->sms="<span class='text-center text-success glyphicon glyphicon-ok'><strong>&nbsp;Data Update Successfully</strong></span>";
		}
		else
		{
			$this->sms="<span class='text-center text-danger glyphicon glyphicon-remove'><strong>&nbsp;Data Update Unuccessfully</strong></span>";
		}
	}
	//check delete query

	public function delete_query($query)
	{
		$delete=$this->link->query($query);
		if($delete)
		{
			$this->sms="<span class='text-center text-success glyphicon glyphicon-ok'><strong>&nbsp;Data Delete Successfully</strong></span>";
			//header('location:index.php');
		}
		else
		{
			$this->sms="<span class='text-center  text-danger glyphicon glyphicon-remove'><strong>&nbsp;Data Delete Unsuccessfully</strong></span>";
		}
	}
	
	public function getClientExtension($file){
			$exploded = explode(".", $file);
			$endofArray = end($exploded);
			return $ext = strtolower($endofArray);
		}


	public function _destruct()
	{
		$this->link->close();
	}

}

?>