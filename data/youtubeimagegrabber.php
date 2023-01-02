<?php

function getYouTubeImage($url, $size)
{
  if ($url == "")
  {
    return;
  }
  $size = ($size == "") ? "big" : $size;

  $results = explode("/watch?v=", $url);

  $vid = ( $results == "" ) ? $url : $results[1];
  if ($size == "big")
  {
    return "http://img.youtube.com/vi/" . $vid . "/2.jpg";
  }
  else
  {
    return "http://img.youtube.com/vi/" . $vid . "/0.jpg";
  }
}

function formatYoutubeLink($link)
{
  $strPOs = strpos($link, "src=");
  $newString =  substr($link, $strPOs);
  $strExplode = explode(" ",$newString);
  $onlySrc = $strExplode[0];
  $exploded = explode('"', $onlySrc);
  $link = stripslashes($exploded[0]);

  if (strpos($link, "/embed/") > 0)
    $url = str_replace("/embed/", "/v/", $link);
  elseif (strpos($link, "/watch?v=") > 0)
    $url = str_replace("/watch?v=", "/v/", $link);
  elseif (strpos($link, "youtu.be/") > 0)
    $url = str_replace("youtu.be", "youtube.com/v/", $link);
  elseif (strpos($link, "/v/") > 0)
    $url = $link;

  return $url;
}

/*
  <!--
  <script type="text/javascript">
  function getScreen( url, size )
  {
  if(url === null){ return ""; }
  size = (size === null) ? "big" : size;
  var vid;
  var results;
  results = url.match("[\\?&]v=([^&#]*)");
  vid = ( results === null ) ? url : results[1];
  if(size == "small"){ return "http://img.youtube.com/vi/"+vid+"/2.jpg";  }
  else {    return "http://img.youtube.com/vi/"+vid+"/0.jpg";  }
  }

  imgUrl_big   = getScreen("uVLQhRiEXZs");
  imgUrl_small = getScreen("uVLQhRiEXZs", 'small');
  document.getElementById('utimg').src = imgUrl_small;
  </script>
  -->
 */
?>