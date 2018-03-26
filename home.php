<?php
	 session_start();
   require 'db.php';
	 if ($_SESSION['logged_in']==false) 
   {
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
    <title>Bidding Corporation</title>
  </head>
  <body>
    <!--Navigation Header-->
    <nav>
      <div class="nav-wrapper black">
        <a href="home.php" class="brand-logo logo">Logo</a>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="logout.php"><i class="material-icons left">home</i> Logout</a></li>
            <li><a href="myaccount.php"><i class="material-icons left">account_circle</i>My Account</a></li>
            <li><a href="upload.php"><i class="material-icons left">add_circle</i>Add item</a></li>
          </ul>
          <ul id="nav-mobile" class="side-nav light-blue darken-4">
            <li><a href="logout.php"><i class="material-icons left">home</i> logout</a></li>
            <li><a href="myaccount.php"><i class="material-icons left">account_circle</i>My account</a></li>
            <li><a href="upload.php"><i class="material-icons left">add_circle</i>Add Item</a></li>
          </ul>
      </div>
    </nav>
    <!--Floating buttons-->
    <div class="fixed-action-btn">
      <a href="#" class="btn-floating red large tooltipped"><i class="large material-icons">add </i></a>
        <ul>
          <li><a href="#" class="btn-floating large blue tooltipped" data-position="top" data-tooltip="Contact on Faceboook"><i class="fa fa-facebook-official" style="font-size:24px"></i></a></li>
          <li><a href="https://plus.google.com/u/0/110378863211673805314" class="btn-floating large red tooltipped" data-position="top" data-tooltip="Contact on google plus"><i class="fa fa-google-plus" style="font-size:24px"></i></a></li>
          <li><a href="http://www.github.com/prithvisbisht" class="btn-floating large black tooltipped" data-position="top" data-tooltip="Contact on github"><i class="fa fa-github-square" style="font-size:24px"></i></a></li>
        </ul>
    </div>


        <?php 
        $sql = "SELECT * FROM item";
        $result = mysqli_query($mysqli,$sql);
          if(mysqli_num_rows($result) > 0) 
          {
            echo '<div class="row">' ;
            while($row=mysqli_fetch_assoc($result)) 
              {
                echo' <div class="col m4 col offset-m1 col s6 col offset-s3 card-panel">
                        <a href="bid.php?x='.$row['id'].'"><h5 class="center">'.$row['name'].'</h5></a>
                        <img class="materialboxed boximage polaroid container" src="images/'.$row['image'].'" alt="">
                        <br>
                        <p>
                          <b>ID</b>=>'.$row['id'].'<br>
                          <b>CODE</b>=>'.$row['code'].'<br>
                          <b>USER_id</b>=>'.$row['user_id'].'<br>
                          <b>CATEGORY</b>=>'.$row['category'].'<br>
                          <b>DESCRIPTION</b>=>'.$row['description'].'<br>
                          <b>BASEPRIZE</b>=>'.$row['baseprize'].'<br>
                        </p>
                    </div>';
              }
              echo '</div>';
          }
 ?>




    <!--Import jQuery before materialize.js-->
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
     <script>
       $(".button-collapse").sideNav();
     </script>
  </body>
</html>