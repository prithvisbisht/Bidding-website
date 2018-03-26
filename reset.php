<?php
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if (isset($_POST['forget'])) 
    {
      $password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
      $email=$_SESSION['email'];
      echo $email;
      $sql="UPDATE users SET password='$password' WHERE email='$email'";
      if ( $mysqli->query($sql))
          {
                $_SESSION['message']='Password has been successfully changed';
                header("location: message.php");
          }
      else 
          {
                $_SESSION['message'] = 'There has been some problems accesing the database plaease try after sometime';
                header("location: error.php");
          }
    }
    else
    {
      $_SESSION['message'] = 'There has been some problems accesing the database plaease try after sometime';
      header("location: error.php");
    }
  }
?><!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="stylesheet" href="style/index.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="utf-8">
    <title>Login Page</title>
  </head>
  <body class="bgimage res">
    <!--Navigation Header-->
    <nav>
      <div class="nav-wrapper black">
        <a href="index.php" class="brand-logo logo">Bidding</a>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down" >
            <li><a href="index.php"><i class="material-icons left">home</i> Home</a></li>
            <li><a href="register.php"><i class="material-icons left">add_circle</i>Register</a></li>
          </ul>
          <ul id="nav-mobile" class="side-nav black">
            <li><a href="index.html"><i class="material-icons left">home</i> Home</a></li>
            <li><a href="register.php"><i class="material-icons left">add_circle</i>Register</a></li>
          </ul>
      </div>
    </nav>

    <!--form-->
    <div class="row">
      <div id="login" class="col s6 offset-s3">
      <form class=" blue-grey" action="reset.php" method="post" autocomplete="off">
        <fieldset>
          <div class="container">
            <input class="validate" type="password" placeholder="enter password" id="password" name="password" required autocomplete="off">
            <label class="input-field"><b>Password*</b></label><br>
            <input class="validate" type="password" placeholder="confirm your password" name="confirmpassword" id="confirmPassword" required autocomplete="off">
            <label class="input-field"><b>Confirm Password*</b></label><br>
            <button id="btnSubmit" class="btn waves-effect blue left" type="submit" name="forget">submit</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div>

  <div class="fixed-action-btn">
      <a href="#" class="btn-floating red large tooltipped"><i class="large material-icons">add </i></a>
        <ul>
          <li><a href="#" class="btn-floating large blue tooltipped" data-position="top" data-tooltip="Contact on Faceboook"><i class="fa fa-facebook-official" style="font-size:24px"></i></a></li>
          <li><a href="https://plus.google.com/u/0/110378863211673805314" class="btn-floating large red tooltipped" data-position="top" data-tooltip="Contact on google plus"><i class="fa fa-google-plus" style="font-size:24px"></i></a></li>
          <li><a href="http://www.github.com/prithvisbisht" class="btn-floating large black tooltipped" data-position="top" data-tooltip="Contact on github"><i class="fa fa-github-square" style="font-size:24px"></i></a></li>
        </ul>
    </div>

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script type="text/javascript">
    $(function () {
        $("#btnSubmit").click(function () {
            var password = $("#password").val();
            var confirmPassword = $("#confirmPassword").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        });
    });
  </script>

</body>
</html>