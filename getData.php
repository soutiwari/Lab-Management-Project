<?php 

require "connect.php";

if($_SERVER["REQUEST_METHOD"] == "POST") //if request is a post request, in this case post request from //arduino
{
	//echo "okay";
	$sensor1 = $_POST['sumA'];
	$sensor2 = $_POST['sumB'];
	
	$pcIp1 = "169.254.152.19";
	$pcIp2 = "169.254.90.101";
	
	exec("ping -n 3 $pcIp1", $outcome1, $pingResult1);
	
	exec("ping -n 3 $pcIp2", $outcome2, $pingResult2);


	$pos1 = strpos($outcome1[2],"unreachable");
	
	if($pos1 === false)
	{
		// Do Nothing.
	}
	else
	{
		$pingResult1 = 1;
	}

	$pos2 = strpos($outcome2[2],"unreachable");
	
	if($pos2 === false)
	{
		// Do Nothing.
	}
	else
	{
		$pingResult2= 1;
	}

	
	if($sensor1 >= 30 && $pingResult1 == 0)
		$sql1 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(1,1)";
	else if($sensor1 >= 30 && $pingResult1 == 1)
		$sql1 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(1,2)";
	else if($sensor1 < 30 && $pingResult1 == 0)
		$sql1 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(1,3)";
	else if($sensor1 < 30 && $pingResult1 == 1)
		$sql1 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(1,4)";
	
	// State Updation of System 2.
	
	if($sensor2 >= 30 && $pingResult2 == 0)
		$sql2 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(2,1)";
	else if($sensor2>= 30 && $pingResult2 == 1)
		$sql2 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(2,2)";
	else if($sensor2 < 30 && $pingResult2 == 0)
		$sql2 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(2,3)";
	else if($sensor2 < 30 && $pingResult2 == 1)
		$sql2 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(2,4)";
	
	// State Updation of System 1.
	
	/*if($sensor1 >= 30)
		$sql1 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(1,1)";
	else if($sensor1 >= 20 && $sensor1 < 30)
		$sql1 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(1,2)";
	else if($sensor1 >= 10 && $sensor1 < 20)
		$sql1 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(1,3)";
	else if($sensor1 < 10)
		$sql1 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(1,4)";
	
	// State Updation of System 2.
	
	if($sensor2 >= 30)
		$sql2 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(2,1)";
	else if($sensor2>= 20 && $sensor2 < 30)
		$sql2 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(2,2)";
	else if($sensor2 >= 10 && $sensor2 < 20)
		$sql2 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(2,3)";
	else if($sensor2 < 10)
		$sql2 = "INSERT INTO system_state "."(system_id,state) "."VALUES "."(2,4)";
		*/
	
	//$sql = "INSERT INTO system_state "."(humidity,temperature) "."VALUES ".
		//	"($sensor1,$sensor2)";
	
	$result1 = mysqli_query($connect,$sql1);
	$result2 = mysqli_query($connect,$sql2);
	//echo ($sql);
	
	if(!$result1)
	{
		echo "Could not insert state of System 1";
		mysql_close($connect);
	}
	
	if(!$result2)
	{
		echo "Could not insert state of System 2";
		mysql_close($connect);
	}
}
else
{
	echo "I am sorry bro!";
}
?>