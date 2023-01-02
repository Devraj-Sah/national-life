<?php

function cleanQuery($string)
{
  /*
    if(get_magic_quotes_gpc())  // prevents duplicate backslashes
    {
    $string = stripslashes($string);
    }
    if (phpversion() >= '4.3.0')
    {
    $string = mysql_real_escape_string($string);
    }
    else
    {
    $string = mysql_escape_string($string);
    }
   */
  return $string;
}

function clean_array(&$arr)
{
  foreach ($arr as $k => $v)
  {
    if (is_array($v))
      clean_array($arr[$k]);
    else
    {
      if (get_magic_quotes_gpc())
        $v = stripslashes($v);
      $v = trim($v);
      $arr[$k] = mysql_real_escape_string($v);
    }
  }
}

// clean_array($_POST);
// clean_array($_GET);
// clean_array($_REQUEST);
?>