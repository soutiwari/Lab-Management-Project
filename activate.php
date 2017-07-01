<?php
	session_start();
	$db=mysqli_connect("localhost","root","","labarduino");
require 'connect.php';
	if(!empty($_GET["id"])) {
	$query = "UPDATE user_details set status = 'active' WHERE id='" . $_GET["id"]. "'";
	$result = mysqli_query($connect,$query);
		if (!$result) {
			die('Invalid query: ' . mysqli_error($connect));
		}
		if(!empty($result)) {
			$message = "Your account is activated.";
		} else {
			$message = "Problem in account activation.";
		}
	}
?>
<html>
<head>
<title>PHP User Registration Form</title>
</head>
<body>
<?php if(isset($message)) { ?>
<div class="message"><?php echo $message; ?></div>
<?php } ?>
<a href="login.php">Login!!!</a>
</body></html>