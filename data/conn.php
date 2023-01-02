<?php
class Dbconn{
	var $host;
	var $uname;
	var $psw;
	var $dbname;
	var $links;
	var $db;
	
	function __construct(){
		$this->host = "localhost";
		$this->uname = "lifenati_dbuser1"; 		
		$this->psw = 'l$B^Mtb+v&iW';					
		$this->dbname = "lifenati_db2";

		$this->links = mysqli_connect($this->host,$this->uname,$this->psw) or die("Sorry, couldnot connect to mysqli Server now");
		$this->db = mysqli_select_db($this->links,$this->dbname) or die("Sorry, couldnot find database");	
		
		mysqli_query($this->links,'SET CHARACTER SET utf8');
		mysqli_query($this->links,"SET SESSION collation_connection ='utf8_general_ci'") or die (mysqli_error($this->links)); 		
	}
	
	function exec($sqlMain){
		//echo $sqlMain;
		//$result = mysqli_query($sqlMain,$this->links) or die("You have some problem with your data");
		$result = mysqli_query($this->links,$sqlMain) or die(mysqli_error($this->links));
		//$result = mysqli_query($sqlMain,$this->links);
		return $result;
	}
	
	function exec2($sqlMain){
		//echo $sqlMain;
		$result = @mysqli_query($sqlMain,$this->links);
		return $result;
	}
	
	function numRows($result)
	{
		return mysqli_num_rows($result);			
	}
	
	function affRows()
	{
		return mysqli_affected_rows($this->links);			
	}
	
	function insertId()
	{
		return mysqli_insert_id($this->links);
	}
	
	function fetchArray($result)
	{
		return mysqli_fetch_array($result);
	}	
	
	function fetchObject($result)
	{
		return mysqli_fetch_object($result);
	}	
	
	function fetchAssoc($result)
	{
		return mysqli_fetch_assoc($result);
	}
	
	function commit()
	{
		return ($this -> exec("Commit"));
	}
	
	function begin()
	{
		return ($this -> exec("Begin"));
	}
	
	function rollback()
	{
		return ($this -> exec("Rollback"));
	}
	
	function Dbclose()
	{
		mysqli_close($this->links);
	}			
}	//Dbconn ends

$conn = new Dbconn();
?>
