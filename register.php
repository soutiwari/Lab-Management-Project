<?php
session_start();
require 'connect.php';
//$db=mysqli_connect("localhost","root","","project");
if(isset($_POST['register_btn']))
{
    $firstname= mysqli_real_escape_string($connect,$_POST['firstname']);
    $lastname= mysqli_real_escape_string($connect,$_POST['lastname']);
    $username= mysqli_real_escape_string($connect,$_POST['username']);
    $email= mysqli_real_escape_string($connect,$_POST['email']);
    $password= mysqli_real_escape_string($connect,$_POST['password']);
    $password2= mysqli_real_escape_string($connect,$_POST['password2']);
    $password=md5($password);  
    $check="SELECT * FROM user_details WHERE username = '$username' or email='$email'";
    $rs = mysqli_query($connect,$check);
    $data = mysqli_fetch_array($rs, MYSQLI_NUM);
    if($data[0] ==0) {
      $sql="INSERT INTO user_details(firstname,lastname,username,email,password,status) VALUES('$firstname','$lastname','$username','$email','$password','Inactive')";
      $result = mysqli_query($connect,$sql);
      if (!$result) {
      die('Invalid query: ' . mysqli_error($connect));
      } 
      else {
        $current_id=mysqli_insert_id($connect);
        if(!empty($current_id)) {
        $actual_link = "http://localhost/arduinoproject"."/activate.php?id=" . $current_id;
        $toEmail = $_POST['email'];
        // echo $toEmail;
        $subject = "User Registration Activation Email";
        $content = "Click this link to activate your account.'>" . $actual_link . "</a>";
        $headers="from:soumyatiwari95@gmail.com";
        if(mail($toEmail, $subject, $content, $headers)) {
          $_SESSION['message']= "You have registered and the activation mail is sent to your email. Click the activation link to activate you account.";
        }
      } else {
        $_SESSION['message'] = "Problem in registration. Try Again!"; 
      }
    }
    }
    else {
      $_SESSION['message'] = "UserName or Email is already in use."; 
    }
}
?>
<!DOCTYPE html>
<html>
<script src="js/field-validation.js"></script>
<head>
  <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
       <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="stylesheet" type="text/css" href="css/style.css"/>
  <title>Lab-mgmt-register</title>
</head>
<body>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <header>
          <nav class="cyan lighten-1">
            <div class="nav-wrapper">
              <a href="#" class="brand-logo center">LAB MANAGMENT</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="login.php">Login</a></li>
              </ul>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="index.php">Home</a></li>
              </ul>
            </div>
          </nav>
      </header>
      <?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
    ?>
      <main>
      <div class="container">
      <div class="row">
      <form class="col s12" name="myform" method="post" action="register.php" onsubmit="return validateForm()">
      <div class="row">
        <div class="input-field col s6">
          <input id="firstname" type="text" class="validate" name="firstname" >
          <label for="firstname">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="lastname" type="text" class="validate" name="lastname">
          <label for="lastname">Last Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="username" type="text" class="validate" name="username">
          <label for="username">Username</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate" name="email">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="password" type="password" class="password" name="password">
          <label for="password">Password</label>
        </div>
        <div class="input-field col s6">
          <input id="password2" type="password" class="validate" name="password2">
          <label for="password2">Password Again!</label>
        </div>
      </div>
      <button class="btn waves-effect waves-light cyan darken-1" type="submit" name="register_btn">Submit
      <i class="material-icons right">send</i>
      </button>
    </form>
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






























































