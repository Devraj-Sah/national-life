<?php
$value = $_GET['value'];
//if(strlen($value) == strlen(utf8_decode($value))) // condition for unicode text
{
	$value = str_replace("!", "-", $value);
	$value = str_replace("@", "-", $value);
	$value = str_replace("#", "-", $value);
	$value = str_replace("$", "-", $value);
	$value = str_replace("%", "-", $value);
	$value = str_replace("^", "-", $value);
	$value = str_replace("&", "-", $value);
	$value = str_replace("*", "-", $value);
	$value = str_replace("(", "-", $value);
	$value = str_replace(")", "-", $value);
	$value = str_replace("_", "-", $value);
	$value = str_replace("{", "-", $value);
	$value = str_replace("}", "-", $value);
	$value = str_replace("[", "-", $value);
	$value = str_replace("]", "-", $value);
	$value = str_replace(":", "-", $value);
	$value = str_replace(";", "-", $value);
	$value = str_replace("\"", "", $value);
	$value = str_replace("'", "", $value);
	$value = str_replace("<", "-", $value);
	$value = str_replace(",", "-", $value);
	$value = str_replace(">", "-", $value);
	$value = str_replace(".", "-", $value);
	$value = str_replace("?", "-", $value);
	$value = str_replace("/", "", $value);
	$value = str_replace("\\", "", $value);
	$value = str_replace("|", "-", $value);
	$value = str_replace("-", " ", $value);
	$value = str_replace("   ", " ", $value);
	$value = str_replace("  ", " ", $value);
	
	
	
	$value = trim($value);
	$value = str_replace(" ", "-", $value);
	$value = trim($value, "-");
	$value = strtolower($value);
	echo $value;
}
//else
//	echo date("Y-m-d-h-i-s");
?>