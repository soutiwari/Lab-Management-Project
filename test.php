<?php

require 'connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") //if request is a post request, in this case post request from //arduino
{
	//echo "okay";
	$hum = $_POST['hum'];
	echo($hum);
	$temp = $_POST['temp'];
	echo($temp);
	
	
}
else
{
	echo "Not Okay";
}

?>