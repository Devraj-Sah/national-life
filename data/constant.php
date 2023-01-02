<?php
class constants{
	function getAll()
	{
		global $conn;
		$sql = "SELECT * FROM constants";
		$result = $conn->exec($sql);
		/*while($r = $conn -> fetchArray($result))
		{print_r($r);} */
		return $result;
	
	}
	
	function getId($id)
	{
		global $conn;
		$sql = "SELECT * FROM constants WHERE id = '$id'";
		$result = $conn -> exec($sql);
		$row = $conn -> fetchArray($result);
		return $row['constantId'];
	}
	function add($constantName, $constantId, $desc)
	{
		global $conn;
		$sql = "INSERT INTO constants 
						SET
							constantname = '$constantName',
							constantId = '$constantId',
							description = '$desc'
							";
		$conn -> exec($sql);
		return $conn->insertId();
	}
	
	function update($constantName, $constantId, $desc, $id)
	{
		global $conn;
		$sql = "UPDATE constants
						SET
							constantname = '$constantName',
							constantId = '$constantId',
							description = '$desc' WHERE id = '$id'
							";
		if($conn -> exec($sql))
		return true;
		else
		return false;
	}
	
	function getById($id)
	{
		global $conn;
		$id = cleanQuery($id);
		$sql = "SELECT * FROM constants WHERE id = '$id'";
		$result = $conn -> exec($sql);
		$row = $conn -> fetchArray($result);
		return $row;
	}
	
	function getTitle($id)
	{
		global $conn;
		$sql = "SELECT 	constantName FROM constants WHERE id = '$id'";
		$result = $conn -> exec($sql);
		$row = $conn -> fetchArray($result);
		return $row['constantName'];
	}
	function delById($id)
	{
		global $conn;
		$id = cleanQuery($id);
		$sql = "DELETE FROM constants WHERE id = '$id'";
		if($conn -> exec($sql))
		return true;
		else
		return false;
	}
}
$constant = new constants();
?>