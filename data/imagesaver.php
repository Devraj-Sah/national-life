<?php
function imagesaver($upfile,$destinationFile,$max_height, $max_width)
{
	$size = getimagesize($upfile); 
	$width = $size[0];
	$height = $size[1];
	$type = $size['mime'];
	
	$x_ratio = $max_width / $width;
	$y_ratio = $max_height / $height;
	
	if( ($width <= $max_width) && ($height <= $max_height) )
	{
		$tn_width = $width;
		$tn_height = $height;
	}
	elseif (($x_ratio * $height) < $max_height)
	{
		$tn_height = ceil($x_ratio * $height);
		$tn_width = $max_width;
	}
	else
	{
		$tn_width = ceil($y_ratio * $width);
		$tn_height = $max_height;
	}
		
	ini_set('memory_limit', '32M');
	
	if($type == "image/jpg" || $type == "image/jpeg" || $type == "image/pjpeg")
		$src = imagecreatefromjpeg($upfile);
	elseif($type == "image/gif")
		$src = imagecreatefromgif($upfile);
	elseif($type == "image/png" || $type == "image/x-png")
		$src = imagecreatefrompng($upfile);
		
	$dst = imagecreatetruecolor($tn_width, $tn_height);
	
	imagecopyresampled($dst, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
	
	$fp = fopen($destinationFile, "w");
	fclose($fp);
	
	if($type == "image/jpg" || $type == "image/jpeg" || $type == "image/pjpeg")
		imagejpeg ($dst, $destinationFile, 100);
	elseif($type == "image/gif")
		imagegif ($dst, $destinationFile);
	elseif($type == "image/png" || $type == "image/x-png")
		imagepng ($dst, $destinationFile, 100);
	//Imagepng($dst);
	imagedestroy($src);
	imagedestroy($dst);
}
?>