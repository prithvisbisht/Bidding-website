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
    <title>Bidding Corporation</title>
  </head>
  <body class="red lighten-5">
    <!--Navigation Header-->
    <nav>
      <div class="nav-wrapper  black">
        <a href="index.php" class="brand-logo logo">Bidding</a>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href=""><i class="material-icons left">home</i> Home</a></li>
            <li><a href="login.php"><i class="material-icons left">account_circle</i>Log In</a></li>
          </ul>
          <ul id="nav-mobile" class="side-nav light-blue darken-4">
            <li><a href="index.php"><i class="material-icons left">home</i> Home</a></li>
            <li><a href="login.php"><i class="material-icons left">account_circle</i>Log In</a></li>
          </ul>
      </div>
    </nav>
    <!--Form-->
    <div class="row">
      <div id="register1" class="col s6 offset-s3">
      <form class="blue-grey" action="register.php" method="post" autocomplete="off">
      <fieldset>
        <div class="container">
          <input  class="validate" type="text" placeholder="Enter First Name" name="first_name" required autocomplete="off">
          <label><b>First Name*</b></label>
          <input class="validate" type="text" placeholder="Enter Last Name" name="last_name" required autocomplete="off">
          <label><b>Last Name*</b></label>
          <select name="staff">
            <option value="" disabled selected>Classification</option>
            <option value="Teachers">Teachers</option>
            <option value="Students">Students</option>
            <option value="Other">Other</option>
          </select>
          <input class="validate" type="email" placeholder="Enter email" name="email" required autocomplete="off">
          <label><b>E-mail*</b></label>
          <input class="validate" type="password" placeholder="Enter Password" name="password" required autocomplete="off">
          <label><b>Password*</b></label>
          <select name="question">
              <option value="" disabled selected>Select a security question</option>
              <option value="What is your pet name?">What is your pet name?</option>
              <option value="Where were you born?">Where were you born?</option>
              <option value="What is your father's middle name?">What is your father's middle name?</option>
          </select>
          <input class="validate" type="text" placeholder="Answer For security Ques" name="answer" required autocomplete="off">
          <label><b>Answer*</b></label>
          <br><br>
          <button class="btn waves-effect blue left" type="submit" name="register">Register</button>
        </div>
      </fieldset>
    </form>
    </div>
  </div>

  <div class="footer">© 2017 Copyright Text</div>

    <!--Import jQuery before materialize.js-->
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
     <script>
          $(document).ready(function() {
              $('select').material_select();
              });
          $(".button-collapse").sideNav();
     </script>

     <div class="fixed-action-btn">
      <a href="#" class="btn-floating red large tooltipped"><i class="large material-icons">add </i></a>
        <ul>
          <li><a href="#" class="btn-floating large blue tooltipped" data-position="top" data-tooltip="Contact on Faceboook"><i class="fa fa-facebook-official" style="font-size:24px"></i></a></li>
          <li><a href="https://plus.google.com/u/0/110378863211673805314" class="btn-floating large red tooltipped" data-position="top" data-tooltip="Contact on google plus"><i class="fa fa-google-plus" style="font-size:24px"></i></a></li>
          <li><a href="http://www.github.com/prithvisbisht" class="btn-floating large black tooltipped" data-position="top" data-tooltip="Contact on github"><i class="fa fa-github-square" style="font-size:24px"></i></a></li>
        </ul>
    </div>
  </body>
</html>
<?php
  if ($_SERVER['REQUEST_METHOD']=='POST') 
   {
     if (isset($_POST['register'])) 
     {
        // Escape all $_POST variables to protect against SQL injections
        $first_name = $mysqli->escape_string($_POST['first_name']);
        $last_name = $mysqli->escape_string($_POST['last_name']);
        $email = $mysqli->escape_string($_POST['email']);
        $staff = $mysqli->escape_string($_POST['staff']);
        $question = $mysqli->escape_string($_POST['question']);
        $answer = $mysqli->escape_string($_POST['answer']);
        $password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
        // Check if user with that email already exists
        $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
        $row=mysqli_fetch_assoc($result);
        // We know user email exists if the rows returned are more than 0
        if ( $result->num_rows > 0 ) 
        {
            $_SESSION['message']="email already used";
            header("location: error.php");
        }
        else 
        {   // Email doesn't already exist in a database, proceed...
            // active is 0 by DEFAULT (no need to include it here)
            $sql = "INSERT INTO users (first_name, last_name, email,staff, password,security_ques,security_ans) "
            . "VALUES ('$first_name','$last_name','$email','$staff','$password','$question','$answer')";
            // Add user to the database
            if ($mysqli->query($sql))
            {
                $_SESSION['message']='Account has been created now login to access your account';
                header("location: message.php");
            }
            else 
            {
                $_SESSION['message'] = 'Registration failed!';
                header("location: error.php");
            }

        }
     }
   }
?>