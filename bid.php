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
    <title>Bidding Corporation</title>
  </head>
  <body>
    <!--Navigation Header-->
    <nav>
      <div class="nav-wrapper black">
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
    $id=$_GET['x'];
    $sql = "SELECT * FROM item where id='$id'";
    $result = mysqli_query($mysqli,$sql);
    $row=mysqli_fetch_assoc($result);
    $_SESSION['user']=$row;
    $sql="SELECT * from bid where item_id='$id'";
    $result2 = mysqli_query($mysqli,$sql);
    $col=mysqli_fetch_assoc($result2);
	 echo '<div class="row">';
	 echo' <div class="col m6 col offset-m3 col s6 col offset-s3 card-panel">
                <a href="bid.php"><h5>'.$row['name'].'</h5></a>
                <img class="boximage polaroid container" src="images/'.$row['image'].'" alt="">
                <br>
                <p>
                <b>ID</b>=>'.$row['id'].'<br>
   		   	    <b>CODE</b>=>'.$row['code'].'<br>
                <b>USER_id</b>=>'.$row['user_id'].'<br>
                <b>CATEGORY</b>=>'.$row['category'].'<br>
                <b>DESCRIPTION</b>=>'.$row['description'].'<br>
                <b>BASEPRIZE</b>=>'.$row['baseprize'].'<br>
                <b>CURRENT PRICE</b>=>'.$col['current_bid'].'<br>
                </p>
              </div>';
     if ($_SESSION['id']==$row['user_id'] or $row['sold']==1) 
     {
     	echo '<div class="col m6 col offset-m3 col s6 col offset-s3">
				<button class="btn tooltipped waves-effect light-blue" data-position="top" data-tooltip="this item is either sold or uploaded by you">
					Place your bid
				</button>
			</div>';
     }
     else
     {
     	echo '<div class="col m6 col offset-m3 col s6 col offset-s3">
				<form method="post" action="bid_success.php"><button class="btn waves-effect light-blue" type="submit" name="bid">
					Place your bid
				</button></form>
			</div>';	
		}

?>		
	
	
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
          Materialize.toast('HEllO USER!', 4000);
     </script>
</body>
</html>
