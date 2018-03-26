<?php
   session_start();
   require 'db.php';
   if ($_SESSION['logged_in']==false) {
    echo "string";
    $_SESSION['message']="you must login before using this page ";
    header("location:error.php");
   }
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link rel="stylesheet" href="materialize/css/materialize.min.css">
      <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="stylesheet" href="style/index.css">
    <meta charset="utf-8">
  <title>Error</title>
</head>
<body>
    <!--Navigation Header-->
    <nav>
      <div class="nav-wrapper light-blue darken-4">
        <a href="home.php" class="brand-logo logo">Logo</a>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="logout.php"><i class="material-icons left">home</i>Logout</a></li>
            <li><a href="myaccount.php"><i class="material-icons left">account_circle</i>My Account</a></li>
            <li><a href="upload.php"><i class="material-icons left">add_circle</i>Add item</a></li>
          </ul>
          <ul id="nav-mobile" class="side-nav light-blue darken-4">
            <li><a href="logout.php"><i class="material-icons left">home</i>Logout</a></li>
            <li><a href="myaccount.php"><i class="material-icons left">account_circle</i>My account</a></li>
            <li><a href="upload.php"><i class="material-icons left">add_circle</i>Add Item</a></li>
          </ul>
      </div>
    </nav>
    <?php 
  if ($_SERVER['REQUEST_METHOD']=='POST') 
  {
     if (isset($_POST['bid']))
     {
      $row=$_SESSION['user'];
      $id=$row['id'];
      $sql="SELECT max(current_bid) from bid where item_id='$id'";
      if($result=mysqli_query($mysqli,$sql))
      {
          $res=mysqli_fetch_assoc($result);
          $bid=$row['increment'] + $res['max(current_bid)'];
          $user=$_SESSION['id'];
          $sql="UPDATE bid set current_bid='$bid',user_id='$user' where item_id='$id'";
          if(mysqli_query($mysqli,$sql))
          {
            echo '<div class="row">
    <div class="col s6 col offset-s3 teal">
      <h4 class="center">Bid has been successfully placed</h4><br>
      <h5 class="center">Current price:- <b>'.$bid.'</b></h5>
      <form action="home.php" class="container center">
        <h5>Visit homepage to bid more</h5>
        <button class="btn waves-effect red" type="submit">
          Home
        </button>
      </form>
    </div>
  </div>';
          }
      }
      
     }
 }
?>
   <!--Floating buttons-->
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
