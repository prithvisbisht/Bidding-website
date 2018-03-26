<?php
  require 'db.php';
  session_start();
  if ($_SESSION['logged_in']==false) 
   {
    $_SESSION['message']="you must login before using this page ";
    header("location:error.php");
   }
  else if (isset($_POST['upload'])) {
    $target= "images/".basename($_FILES['image']['name']);
    $image=$_FILES['image']['name'];
    $description=$_POST['item_description'];
    $name=$_POST['item_name'];
    $category=$_POST['category'];
    $baseprize=$_POST['baseprize'];
    $increment=$_POST['bid_increment'];
    $start=$_POST['bid_start'];
    $end=$_POST['bid_end'];

    $result=$mysqli->query("SELECT * FROM item");
    $num=$result->num_rows + 1;
    $code='GEU'.$num;
    $first_name=$_SESSION['first_name'];
    $email=$_SESSION['email'];
    $result = $mysqli->query("SELECT * from users where first_name='$first_name' and email='$email'");
    $user=$result->fetch_assoc();
    $user_id=$user['id'];

    $sql="INSERT INTO item(user_id,name,code,image,description,category,baseprize,increment,start,finish) values ('$user_id','$name','$code','$image','$description','$category','$baseprize','$increment','$start','$end')";
    if(mysqli_query($mysqli,$sql))
    {
      move_uploaded_file($_FILES['image']['tmp_name'],$target);
      header("location: home.php");
    }
    else{
     $_SESSION['message'] = 'error in query try again';
            header("location: error.php"); 
    }
    $result = $mysqli->query("SELECT id from item where code='$code'") or die($mysqli->error());
    $row=mysqli_fetch_assoc($result);
    $id=$row['id'];
    $sql="INSERT into bid (item_name,item_id,baseprize,current_bid) values ('$name','$id','$baseprize','$baseprize')";
    mysqli_query($mysqli,$sql);
     
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
    <title>Bidding Corporation</title>
  </head>
  <body>
    <!--Navigation Header-->
    <nav>
      <div class="nav-wrapper black">
        <a href="home.php" class="brand-logo logo">Logo</a>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="home.php"><i class="material-icons left">home</i> Home</a></li>
            <li><a href="myaccount.php"><i class="material-icons left">account_circle</i>My Account</a></li>
            <li><a href="upload.php"><i class="material-icons left">add_circle</i>Add item</a></li>
          </ul>
          <ul id="nav-mobile" class="side-nav light-blue darken-4">
            <li><a href="#"><i class="material-icons left">home</i> Home</a></li>
            <li><a href="myaccount.php"><i class="material-icons left">account_circle</i>My account</a></li>
            <li><a href="upload.php"><i class="material-icons left">add_circle</i>Add Item</a></li>
          </ul>
      </div>
    </nav>

     <!--Form-->
    <div id="upload" class="container">
      <form class="card-panel deep-orange accent-1" action="upload.php" method="post" enctype="multipart/form-data" autocomplete="off">
        <h2 align=center>Add your item</h2>
        <div>
          <div class="row">
            <div class="col s6">
              <input type="text" placeholder="Name of the item" name="item_name" required autocomplete="off">
              <label><b>Item name</b></label><br>
            </div>
            <div class="col s6">
              <select name="category">
                <option value="" disabled selected>category</option>
                <option value="Electronics">Electronics</option>
                <option value="Lifestyle">Lifestyle</option>
                <option value="Sports">Sports</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col s6">
              <input type="number" placeholder="Base prize for the item" name="baseprize" required autocomplete="off">
              <label><b>Base prize</b></label>
            </div>
            <div class="col s6">
              <input type="number" placeholder="Minimum bid increment" name="bid_increment" required autocomplete="off">
              <label><b>BId Increment</b></label>
            </div>
          </div>
          <div class="row">
            <div class="col s6">
              <input type="date" name="bid_start">
              <label><b>Bid Start Time</b></label>
            </div>
            <div class="col s6">
              <input type="date" name="bid_end">
              <label><b>Bid End Time</b></label>
            </div>
          </div>
          <textarea class="materialize-textarea" placeholder="Description of the item goes in here" name="item_description"></textarea>
          <label for="textarea1"><b>Description</b></label>
          <div class="file-field input-field">
            <div class="btn">
              <span>Image</span>
              <input type="file" name="image">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
          </div>
          <button class="btn waves-effect blue large" type="submit" name="upload">Add item</button>
        </div><br>
      </form>
    </div>




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
       $(".button-collapse").sideNav();
      $(document).ready(function() {
              $('select').material_select();
              });
      $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: false // Close upon selecting a date,
  });
     </script>
  </body>
</html>
