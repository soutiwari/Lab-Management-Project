<?php  
 session_start();
// $connect = mysqli_connect("localhost", "root", "", "test"); 
require 'connect.php';
 if(isset($_POST['form_btn'])) 
 { 
    $startdate=mysqli_real_escape_string($connect,$_POST['startdate']);
    $starttime=mysqli_real_escape_string($connect,$_POST['starttime']);
    $enddate=mysqli_real_escape_string($connect,$_POST['enddate']);
    $endtime=mysqli_real_escape_string($connect,$_POST['endtime']);
    $startdatetime=$startdate.' '.$starttime;
    $enddatetime=$enddate.' '.$endtime;
    $type='BarChart';
    $query1="INSERT INTO `query_log`(`current_timedate`, `start_date`, `start_time`, `end_date`, `end_time`, `type`) VALUES (NOW(),'$startdate','$starttime','$enddate','$endtime','$type');";
    $res = mysqli_query($connect,$query1);
    if(!$res)
    {
      die('Invalid query: ' . mysqli_error($connect));
    }
    else
    {
      $query = "select system_id as sys_id,(select count(id) from system_state where state=1 and system_id=sys_id) as state1,(select count(id) from system_state where state=2 and system_id=sys_id) as state2,(select count(id) from system_state where state=3 and system_id=sys_id) as state3,(select count(id) from system_state where state=4 and system_id=sys_id) as state4 from system_state where system_state.datetime between '$startdatetime' AND '$enddatetime' group by system_id";  
      $result = mysqli_query($connect, $query);
    }
}
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>
            <title>Lab-mgmt-bar-chart</title>
            <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
              google.charts.load('current', {'packages':['bar']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
              var data = google.visualization.arrayToDataTable([
              ['Sys_id', 'State1', 'State2', 'State3','State4'],
              <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["sys_id"]."', ".$row["state1"].",".$row["state2"].",".$row["state3"].",".$row["state4"]."],";  
                          }  
                ?> 
              ]);

              var options = {
              chart: {
              title: 'Sensor and PC state performance',
              subtitle: 'System and states',
              vAxis: {title:'System(sensor-PC) ID'},
              hAxis: {title: 'Number of time system are in a given state'},
              }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
            }
          </script> 
      </head>  
      <body>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <header>
          <nav class="cyan lighten-1">
            <div class="nav-wrapper">
              <a href="#" class="brand-logo center">LAB MANAGEMENT</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="home.php">Menu</a></li>
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </div>
          </nav>
      </header>
      <main>
      <h6>Enter Start and End date-time</h6>
        <div class="row">
        <form class="col s12 m3" name="dateform" method="post" action="chart.php">
        <div class="row">
        <div class="input-field col s6">
          <input id="startdate" type="date" class="validate" name="startdate" >
        </div>
        <div class="input-field col s6">
          <input id="starttime" type="time" class="validate" name="starttime">
          <label for="starttime"></label>
        </div>
        </div>
        <div class="row">
        <div class="input-field col s6">
          <input id="enddate" type="date" class="validate" name="enddate" >
        </div>
        <div class="input-field col s6">
          <input id="endtime" type="time" class="validate" name="endtime">
          <label for="endtime"></label>
        </div>
        </div>
        <button class="btn waves-effect waves-light cyan darken-1" type="submit" name="form_btn">Submit
      <i class="material-icons right">send</i>
      </button>
          </form>
          <div class="col s12 m6 offset-m3">
                <div id="columnchart_material" style="width: 500px; height: 300px;"></div>
                </div>
                </div>  
          </div>
          <div class="row">
          <div class="col s12 m6">
           <div class="card-panel cyan darken-2">
            <span class="white-text"><p>On submitting the start and end date and time,status of each system(PC-Sensor) is displayed in form of bar chart where for a system different satus count is represented as bar.<br>
                                      STATE 1-(SENSOR-ON,PC-ON)-BLUE<br>
                                      STATE 2-(SENSOR-ON,PC-OFF)-RED<br>
                                      STATE 3-(SENSOR-OFF,PC-ON)-YELLOW<br>
                                      STATE 4-(SENSOR-OFF,PC-OFF)GREEN.<br>
            The data is updated after every half an hour and thus the Y-axis represent the count of state for the given time.</p>
          </span>
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