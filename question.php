<?php
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if (isset($_POST['submit'])) 
    {
      $ans=$mysqli->escape_string($_POST['answer']);
      if ($_SESSION['ans']==$ans) 
      {
        header("location: reset.php");
      }
      else
      {
        $_SESSION['message'] = "User with that email doesn't exist!";
        header("location: error.php");
      }
    }
  }
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

    <!--form-->
    <div class="row">
      <div id="login" class="col s6 offset-s3">
      <form class=" blue-grey" action="question.php" method="post" autocomplete="off">
        <fieldset>
          <div class="container">
            <?php  
              echo "<h5>".$_SESSION['ques']."</h5>";
            ?>
            <input class="validate" type="text" placeholder="Enter answer" name="answer" required autocomplete="off">
            <button class="btn waves-effect blue left" type="submit" name="submit">submit</button>
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
    <!--Import jQuery before materialize.js-->
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
     <script>
          $(document).ready(function() {
              $('select').material_select();
              });
     </script>
  </body>
</html>