<?php
class Feedbacks
{
	function save($name, $address, $phone, $email, $country, $comment)
	{
		global $conn;
		
		$name = cleanQuery($name);
		$address = cleanQuery($address);
		$phone = cleanQuery($phone);
		$email = cleanQuery($email);
		$country = cleanQuery($country);
		$comment = cleanQuery($comment);
		
		$date = date('Y-m-d H:i:s');
		
				
		$sql = "INSERT INTO feedbacks
						SET
							`name` = '$name',
							address = '$address',
							phone = '$phone',
							email = '$email',
							country = '$country',
							comment = '$comment',
							onDate = '$date'";
		$result = $conn->exec($sql);
		
		return $conn->insertId();
	}	
	
	function delete($id)
	{  
		global $conn;
		
		$id = cleanQuery($id);
		
		$sql = "DELETE FROM feedbacks WHERE id = '$id'";
		$conn->exec($sql);
		
		return $conn -> affRows();
	}
	
	function getById($id)
	{
		global $conn;
		
		$id = cleanQuery($id);
		
		$sql = "SElECT * FROM feedbacks WHERE id = '$id'";
		$result = $conn->exec($sql);
		return $conn -> fetchArray($result);
	}
}

$feedbacks = new Feedbacks();
?>