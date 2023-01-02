<?php
class Users
{
 
 function userAccessSave($id,$access){
  global $conn;

  $sql = "DELETE FROM user_access WHERE userId=".$id."";
  $conn -> exec($sql);
  foreach ($access as $acc) {
    $sql = "INSERT INTO user_access(userId,hasAccessId) VALUES(".$id.",".$acc.")";
    $conn -> exec($sql);
  }
  
 }

 function selectUserAccess($id){
   global $conn;

   $sql ="SELECT * FROM user_access WHERE userId =".$id."";
   // echo $sql;
   // die();
   $resultAccess = $conn -> exec($sql);
   return $resultAccess;
 }

 function validate($uname,$pswd)
 {
 	global $conn;
  
	
  $sql = "SELECT * FROM users u WHERE md5(u.username) = '". md5(cleanQuery($uname)). "' AND u.password = '". md5(cleanQuery($pswd)) ."' AND u.status = 'A'";
//  echo $sql;
//  die();
  $result = $conn -> exec($sql);
  $numRows = $conn -> numRows($result);
  if($numRows)
  {
   $row = $conn -> fetchArray($result);
   $_SESSION['sessUserId'] = $row['id'];
   $_SESSION['sessFullname'] = $row['fullname'];
   $_SESSION['sessUsername'] = $row['username'];
   $_SESSION['sessUserGroupId'] = $row['userGroupId'];
   $_SESSION['sessLastLogin'] = $row['lastLogin'];

   
   return true;
  }
  else
  {
   return false;
  }
 }

 function updateLastLogin($id)
 {
 	global $conn;
	
	$date = date('Y-m-d H:i:s');
	
  $sql = "UPDATE users SET lastLogin = '$date' WHERE id = '$id'";
  $result = $conn -> exec($sql);
 }

 function updateLoginTimes($id)
 {
 	global $conn;
	
  $sql = "UPDATE users SET loginTimes = (loginTimes + 1) WHERE id = '$id'";
  $result = $conn -> exec($sql);
 }

 function validatePassword($id,$pswd)
 {
 	global $conn;
  $sql = "SELECT COUNT(*) cnt FROM users WHERE id = '$id' AND password = '".md5($pswd)."'";
   
  $result = $conn -> exec($sql);
  $row = $conn -> fetchArray($result);
  if($row['cnt'] > 0)
   return true;
  else
   return false;
 }

 function updatePassword($id,$pswd)
 {
 	global $conn;
	
  $sql = "UPDATE users SET password = '".md5($pswd)."' WHERE id = '$id'";
  //echo $sql;
  $result = $conn -> exec($sql);
  $affRows = $conn -> affRows();
  if($affRows)
   return true;
  else
   return false;
 }

 function createNewUser($fullname,$uname,$pswd,$status){
    global $conn;
    $fullname = cleanQuery($fullname);
    $uname = cleanQuery($uname);
    $pswd = md5(cleanQuery($pswd));
    $status = cleanQuery($status);
    $sql ="INSERT INTO users (fullname,username,password,status,userGroupId) VALUES('$fullname','$uname','$pswd','$status',2)";
    $result = $conn->exec($sql);
    $affRows = $conn -> affRows();
    if($affRows)
     return true;
    else
     return false;
 }

 function updateUser($id,$fullname,$uname,$pswd,$status){
    global $conn;
    $id = cleanQuery($id);
    $fullname = cleanQuery($fullname);
    $uname = cleanQuery($uname);
    $pswd = md5(cleanQuery($pswd));
    $status = cleanQuery($status);
    $sql ="UPDATE users SET fullname='$fullname', username='$uname', password='$pswd', status='$status' WHERE id=$id";
    $result = $conn->exec($sql);
    $affRows = $conn -> affRows();
    if($affRows)
     return true;
    else
     return false;
 }
 
 function deleteUser($id){
    global $conn;
    $id = cleanQuery($id);
    $sql = "DELETE FROM users WHERE id=$id";
    $result = $conn->exec($sql);
    $affRows = $conn -> affRows();
    if($affRows)
     return true;
    else
     return false;
 }

 function listUsers(){
  global $conn;
  
  $sql = "SELECT * FROM users u WHERE u.userGroupId = 2";

  $result = $conn -> exec($sql);
  $numRows = $conn -> numRows($result);
  if($numRows)
  {
    $rows = array();
    while($row = $conn -> fetchAssoc($result)){
      array_push($rows, $row);
    }
   return $rows;
  }
  else
  {
   return false;
  }
 }

 function getUserById($id){
   global $conn;

   $sql = "SELECT * FROM users WHERE id = $id";
   $result = $conn -> exec($sql);
   $numRows = $conn -> numRows($result);
   if($numRows)
   {
    $row = $conn -> fetchAssoc($result);
    return $row;
   }
  else
  {
   return false;
  }

}
 
 function getLastLoginDate(){
     global $conn;
     $sql = "select lastLogin from users where username = 'admin'";
     $result = $conn->exec($sql);
     $row = $conn->fetchArray($result);
     return $row['lastLogin'];
 }
}

$users = new Users();
?>