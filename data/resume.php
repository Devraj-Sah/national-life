<?php

class Resume {

  function save($fname, $email, $comments, $filename)
  {
    global $conn;
    $date = date('Y-m-d');
    $sql = "INSERT INTO resume SET fname = '$fname',email = '$email',comments = '$comments',filename='$filename', nDate = '$date'";
    //echo $sql;
    $result = $conn->exec($sql);
    if ($result)
    {
      return $conn->insertId();
    }
    else
    {
      return false;
    }
  }

//end func

  function getAllResumes()
  {
    global $conn;
    $sql = "SELECT * FROM resume order by id Desc";
    $result = $conn->exec($sql);
    if ($result)
    {
      return $result;
    }
    else
    {
      return false;
    }
  }

//end func	

  function getById($id)
  {
    global $conn;
    $sql = "SELECT * FROM resume WHERE id ='$id' limit 1";
    $result = $conn->exec($sql);
    if ($result)
    {
      return mysql_fetch_array($result);
    }
    else
    {
      return false;
    }
  }

  function delete($id)
  {
    global $conn;
    $sql = "DELETE FROM resume WHERE id ='$id'";
    $result = $conn->exec($sql);
    if ($result)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

//end func

  function approveByID($id)
  {
    global $conn;
    $sql = "UPDATE resume SET status=1 WHERE id ='$id'";
    $result = $conn->exec($sql);
    if ($result)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

//end func

  function disApproveByID($id)
  {
    global $conn;
    $sql = "UPDATE resume SET status=0 WHERE id ='$id'";
    $result = $conn->exec($sql);
    if ($result)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

//end func
}

$resume = new Resume();
//class end 
?>