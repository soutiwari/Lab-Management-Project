<?php

	$dbserver = "localhost";
	$dbschema = "labarduino";
	$dbuser = "root";
	$dbpass = "";
	
	$connect = mysqli_connect($dbserver,$dbuser,$dbpass,$dbschema);
	
	if(!$connect)
	{
		echo "Not Connected".mysqli_error($connect);
	}
?>