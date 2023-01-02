<?php

function cleanQuery($string)
{
   global $conn;
    // if(get_magic_quotes_gpc())  // prevents duplicate backslashes
    // {
    // $string = stripslashes($string);
    // }
    if (phpversion() >= '4.3.0')
        {
          $string = mysqli_real_escape_string($conn->links,$string);
        }
    else
        {
            $string = mysqli_escape_string($conn->links,$string);
        }   
  return $string;
}

function clean_array(&$arr)
{
  global $conn;
  foreach ($arr as $k => $v)
  {
    if (is_array($v))
      clean_array($arr[$k]);
    else
    {
      if (get_magic_quotes_gpc())
        $v = stripslashes($v);
      $v = trim($v);
      $arr[$k] = mysqli_real_escape_string($conn->links,$v);
    }
  }
}

// clean_array($_POST);
// clean_array($_GET);
// clean_array($_REQUEST);
?>