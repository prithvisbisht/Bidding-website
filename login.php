<?php
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
?>
<!DOCTYPE html>
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
  <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
          //user logging in
          if (isset($_POST['login']))
           {
             $email = $mysqli->escape_string($_POST['email']);
             $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
             if ( $result->num_rows == 0 )
             { // User doesn't exist
               $_SESSION['message'] = "User with that email doesn't exist!";
                header("location: error.php");
             }
             else
             { // User exists
              $user = $result->fetch_assoc();
              if ( password_verify($_POST['password'], $user['password']) )
              {
                $_SESSION['email'] = $user['email'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                // This is how we'll know the user is logged in
                $_SESSION['logged_in'] = true;
                header("location: home.php");
              }
              else
              {
                  $_SESSION['message'] = "You have entered wrong password, try again!";
                  header("location: error.php");              }
            }
          }
      }
  ?>
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
          <ul id="nav-mobile" class="side-nav light-blue darken-4">
            <li><a href="index.html"><i class="material-icons left">home</i> Home</a></li>
            <li><a href="register.php"><i class="material-icons left">add_circle</i>Register</a></li>
          </ul>
      </div>
    </nav>


    <div class="row">
      <div id="login" class="col s6 offset-s3">
      <form class=" blue-grey" action="login.php" method="post" autocomplete="off">
        <fieldset>
          <div class="imgcontainer center-align">
            <img src="img/user.png" alt="Avatar" class="responsive-img circle" style="height:200px">
          </div>
          <div class="container">
            <input class="validate" type="email" placeholder="Enter email" name="email" required autocomplete="off">
            <label class="input-field"><b>E-mail*</b></label>
            <input type="password" placeholder="Enter Password" name="password" required autocomplete="off">
            <label><b>Password*</b></label><br><br>
            <button class="btn waves-effect blue left" type="submit" name="login">Login</button>
            <div align="right">
            <a href="forget_password.php" class=""><u>Forget password?</u></a>
          </div>
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
     <script>
       $(".button-collapse").sideNav();
       </script>
  </body>
</html>
