<?php
session_start();
//$db=mysqli_connect("localhost","root","","project");
require 'connect.php';
 
?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Lab-mgmt-menu</title>
    </head>

    <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <header>
          <nav class="cyan lighten-1">
            <div class="nav-wrapper">
              <a href="#" class="brand-logo center">LAB MANAGMENT</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </div>
          </nav>
      </header>
      <main>
      <?php
        if(isset($_SESSION['message']))
      {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
      }
      ?>
      <style>
      h4 { 
          display: block;
          text-align: center;
          }
      </style>
      <h4>Welcome <?php echo $_SESSION['username']; ?></h4>
      <div class="container">
        <div class="row">
        <div class="col s12 m6">
          <div class="card cyan darken-2">
            <div class="card-content white-text">
              <span class="card-title">Pie Chart Representation</span>
              <p>Click on the below link in this card to view the pie chart represenation of the status of the lab managment system.</p>
            </div>
            <div class="card-action">
              <a href="piechart.php">Click here!</a>
            </div>
          </div>
        </div>
        <div class="col s12 m6">
          <div class="card cyan darken-2">
            <div class="card-content white-text">
              <span class="card-title">Bar Chart Representation</span>
              <p>Click on the below link in this card to view the bar chart represenation of each System-Sensor status in the lab.</p>
            </div>
            <div class="card-action">
              <a href="chart.php">Click Here!</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m6">
          <div class="card cyan darken-2">
            <div class="card-content white-text">
              <span class="card-title">Attendence System</span>
              <p>Click on the below link to view the attendence of the lab for a given period of time.</p>
            </div>
            <div class="card-action">
              <a href="calendarchart.php">Click Here!</a>
            </div>
          </div>
        </div>
        <div class="col s12 m6">
          <div class="card cyan darken-2">
            <div class="card-content white-text">
              <span class="card-title">Current Status</span>
              <p>Click on this link to view the current status of each system in the lab.</p>
            </div>
            <div class="card-action">
              <a href="statesrep.php">Click Here!</a>
            </div>
          </div>
        </div>
      </div>
      </div>
      </main>
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





























































































