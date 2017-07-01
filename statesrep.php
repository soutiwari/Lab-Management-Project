<?php
session_start();
//$db=mysqli_connect("localhost","root","","test");
require 'connect.php';
$sql="SELECT system_id,date(datetime) as date,time(datetime) as time,state FROM `system_state` order by datetime desc limit 2";
$result = mysqli_query($connect,$sql);
?>

<!DOCTYPE html>
<html>
<head>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="stylesheet" type="text/css" href="css/style.css"/>
      <link rel="stylesheet" type="text/css" href="css/materialize-style.css">
	<title>Lab-mgmt-states-rep</title>
</head>
<body>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <header>
          <nav class="cyan lighten-1">
            <div class="nav-wrapper">
              <a href="#" class="brand-logo center">LAB MANAGMENT</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="logout.php">Logout</a></li>
              </ul>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="home.php">Menu</a></li>
              </ul>
            </div>
          </nav>
      </header>
      <main>
     <div class="container">
	<div id="content">
		
	<div id="Info">
		<br><br><br>
		<h4>The Information of each PC after recent updation-</h4>
		<br><br>
	</div>
		<style type="text/css">
			table {
   					 border-collapse: collapse;
				}

				table, th, td {
    				border: 1px solid black;
    				text-align: center;
    				vertical-align: bottom;
				}
				tr:hover {background-color: #f5f5f5}
		</style>
		<table id="stateTable">
			<tr>
			<th> System Id </th>
			<th> Last Updated On </th> 
			<th> State </th>
			<th> Action </th>
			</tr>
			<?php

				while ($row = mysqli_fetch_array($result)) 
				{
					echo "<tr id='".$row['system_id']."'>";
					echo "<td>".$row['system_id']."</td>";
					echo "<td>".$row['date']." ".$row['time']."</td>";
					echo "<td>".$row['state']."</td>";
					if($row['state'] == 3)
					{
						echo "<td><button class='turnOffBtn waves-effect waves-light cyan darken-1' id='".$row['system_id']."'>"."Turn off</button> </td>";
					}
					else
					{
						echo "<td>Nothing</td>";
					}


					echo "</tr>";
				}

			?>

		</table>

	</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>
	<script type="text/javascript">
		
	$(document).ready(function(){

		$(".turnOffBtn").click(function(e){

			ip = "172.16.68.153";

			var sensor_id = $(this).prop('id');
			
			$.ajax({
				'url': 'turnOff.php',
				'dataType': 'json',
				'method': 'POST',
				'data': {'ip': ip} 
			})
			.done(function(data){

				if(data.status == true)
				{
					alert("Turned Off");
				}
			})
			.fail(function(){

				alert("Sorry Man, I am really Sorry!");
			});

		});


	});
	</script>
</main>
<br>
<br>
<br>
<br>
<br>
<footer class="page-footer cyan lighten-1">
          <div class="container">
            <div class="row">
              <div class="col 16 s12 m6">
                <h6 class="white-text">Team Members-</h6>
                <a class="grey-text text-lighten-4" href="https://www.linkedin.com/in/abhishek-sarda-2015358b/">Abhishek Sarda</a><br>
                <a class="grey-text text-lighten-4" href="https://www.linkedin.com/in/soumyatiwari2995/">Soumya Tiwari</a><br>
                <a class="grey-text text-lighten-4" href="https://www.linkedin.com/in/neyhal-menghani-102560117/">Neyhal Menghani</a><br>
                <a class="grey-text text-lighten-4" href="https://www.linkedin.com/in/nikita-agrawal-b11bb6b1/">Nikita Agrawal</a><br>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2017 CSE 2013-17 NITRR.
            </div>
          </div>
        </footer>
</body>
</html>