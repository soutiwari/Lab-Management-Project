<?php  
 session_start();
// $connect = mysqli_connect("localhost", "root", "", "test"); 
require 'connect.php';
 if(isset($_POST['form_btn'])) 
 { 
    $starttime=mysqli_real_escape_string($connect,$_POST['starttime']);
    $endtime=mysqli_real_escape_string($connect,$_POST['endtime']);
    $type='CalendarChart';
    $query1="INSERT INTO `query_log`(`current_timedate`, `start_date`, `start_time`, `end_date`, `end_time`, `type`) VALUES (NOW(),NOW(),'$starttime',NOW(),'$endtime','$type');";
    $res = mysqli_query($connect,$query1);
    if(!$res)
    {
      die('Invalid query: ' . mysqli_error($connect));
    }
    else
    {
      $query = "SELECT system_id,date(datetime) as date,count(state) as count from system_state where (state=1 or state=2) and time(datetime) between '$starttime' AND '$endtime' group by date(datetime),system_id ;";  
      $result = mysqli_query($connect, $query);
    }
}
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>
            <title>Lab-mgmt-calendar</title>
            <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
            <script type="text/javascript">  
            google.charts.load("current", {packages:["calendar"]});
            google.charts.setOnLoadCallback(drawChart);  
            function drawChart() {
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn({ type: 'date', id: 'Date' });
            dataTable.addColumn({ type: 'number', id: 'count' });
            dataTable.addRows([
             <?php 
                $prevDate ="0000-00-00";
                $count=1;
                if($result)
                {
                 while($row = mysqli_fetch_array($result))  
                {  
                    $date = $row["date"];
                    $date = split('-', $date);
                    //$date[2] = 2;
                    $date[1]--;
                    //print_r($date);
                    //if(strcmp($prevDate, $date) == 0)
                      /*  {
                          //echo "hello";
                          $count++;
                          
                        }
                    else
                      $count=1;

                    $prevDate = $date; */
                      //echo $count." ".$prevDate." ".$date[2];
                    echo "[new Date(".$date[0].",".$date[1].",".$date[2]."), ".$row['count']."],";  
                }
                } 
            ?>
        ]);
        var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));

       var options = {
         title: "Lab Attendance",
         height: 350,
       };

       chart.draw(dataTable, options);
      }
           </script>  
      </head>  
      <body>
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <header>
          <nav class="cyan lighten-1">
            <div class="nav-wrapper">
              <a href="#" class="brand-logo center">LAB MANAGMENT</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="home.php">Menu</a></li>
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </div>
          </nav>
      </header>
      <main>
      <h6>Enter Start and End time</h6>
        <div class="row">
        <form class="col s12 m3" name="dateform" method="post" action="calendarchart.php">
        <div class="row">
        <div class="input-field col s6">
          <input id="starttime" type="time" class="validate" name="starttime">
          <label for="starttime"></label>
        </div>
        <div class="input-field col s6">
          <input id="endtime" type="time" class="validate" name="endtime">
          <label for="endtime"></label>
        </div>
        </div>
        <button class="btn waves-effect waves-light  cyan darken-2" type="submit" name="form_btn">Submit
      <i class="material-icons right">send</i>
      </button>
          </form>
          <div class="col s12 m3 offset-m3">
           <div class="card-panel  cyan darken-2">
            <span class="white-text">In this on submitting start and end time,attendence is shown for that period of time.Hover over the calendar to view the attendence of the lab.
          </span>
          </div>
          </div>
          </div>
          <br><br>
          <div class="container">
          <div class="row">
            <div class="col s12 m6">
                 <div id="calendar_basic" style="width: 1000px; height: 350px;"></div>
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











  