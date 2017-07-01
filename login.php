<?php
session_start();
require 'connect.php';
//$db=mysqli_connect("localhost","root","","project");
if(isset($_POST['login_btn']))
{
    $username=mysqli_real_escape_string($connect,$_POST['username']);
    $password=mysqli_real_escape_string($connect,$_POST['password']);
    $password=md5($password);
    $sql="SELECT * FROM user_details WHERE username='$username' AND password='$password'";
    $result= mysqli_query($connect,$sql) or die("Error: " . mysqli_error($connect));
    $data = mysqli_fetch_array($result, MYSQLI_NUM);
    if($data[0]!=0)
    {
      if($data[6]=="Inactive")
      {
        $_SESSION['message']="You haven't activated your account!";
      }
      else
      {
        $_SESSION['message']="You are now Loggged In";
        $_SESSION['username']=$username;
        header("location:home.php");
      }
    }
   else
   {
        $_SESSION['message']="Username and Password combiation incorrect";
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
   <title>Lab-mgmt-login</title>
</head>
<body>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <header>
          <nav class="cyan lighten-1">
            <div class="nav-wrapper">
              <a href="#" class="brand-logo center">LAB MANAGMENT</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="register.php">Register</a></li>
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
      <script type="text/javascript">
      function validation()
      {
          var username=document.myform.username.value;
          var password=document.myform.password.value;
          if(username==null || username=="",password==null || password=="")
          {
             alert("Please fill all field");
             return false;
          }
      }
      </script>
      <form class="col s12 m6 offset-m3" name="myform" method="post" action="login.php" onsubmit="return validation()">
        <div class="row">
        <div class="input-field col s12 m6 offset-m3">
          <input id="username" type="text" class="validate" name="username">
          <label for="username">Username</label>
        </div>
        </div>
        <div class="row">
        <div class="input-field col s6 offset-m3">
          <input id="password" type="password" class="password" name="password">
          <label for="password">Password</label>
        </div>
        </div>
        <button class="btn waves-effect waves-light cyan darken-1" type="submit" name="login_btn">Submit
      <i class="material-icons right">send</i>
      </button>
      </form>
      </div>
      </div>
      </main>
      <br>
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