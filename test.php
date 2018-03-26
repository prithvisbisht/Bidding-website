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
      <div class="nav-wrapper light-blue darken-4">
        <a href="home.php" class="brand-logo logo">Logo</a>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="home.php"><i class="material-icons left">home</i> Home</a></li>
            <li><a href="myaccount.php"><i class="material-icons left">account_circle</i>My Account</a></li>
            <li><a href="upload.php"><i class="material-icons left">add_circle</i>Add item</a></li>
          </ul>
          <ul id="nav-mobile" class="side-nav light-blue darken-4">
            <li><a href="home.php"><i class="material-icons left">home</i> Home</a></li>
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
          <li><a href="#" class="btn-floating large red tooltipped" data-position="top" data-tooltip="Contact on google plus"><i class="fa fa-google-plus" style="font-size:24px"></i></a></li>
          <li><a href="#" class="btn-floating large black tooltipped" data-position="top" data-tooltip="Contact on github"><i class="fa fa-github-square" style="font-size:24px"></i></a></li>
        </ul>
    </div>

     
      <div class="row">
        <div class="col s8 col offset-s2">
          <ul class="collapsible popout" data-collapsible="accordion">
          <li>
          <div class="collapsible-header"><i class="material-icons">filter_drama</i>Personal Information</div>
          <div class="collapsible-body"><?php
        $email=$_SESSION['email'];
        $sql = "SELECT * FROM users where email='$email'";
        $result1 = mysqli_query($mysqli,$sql);
        if($result1->num_rows > 0)
        {
          $row=mysqli_fetch_assoc($result1);
            echo'<div class="row" >
                    <div> 
                      <b>NAME=></b>'.$row['first_name'].' '.$row['last_name'].'<br>
                      <b>EMAIL=></b>'.$email.'<br>
                      <b>STAFF=></b>'.$row['staff'].'<br>
                      <b>USER_ID=></b>'.$row['id'].'<br>
                    </div> 
                  </div>';
          
        }
 ?></div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">place</i>Item added</div>
          <div class="collapsible-body"><?php 
          $id=$row['id'];
          $sql = "SELECT * from item where user_id='$id'";
          echo $sql;
          $result2 = mysqli_query($mysqli,$sql);
          if($result2->num_rows > 0)
          {
            echo '<div class="row">' ;
            while($row=mysqli_fetch_assoc($result2)) 
              {
                echo' <div class="col m5 col offset-m1 col s5 col offset-s1 card-panel">
                        <h5>'.$row['name'].'</h5>
                        <img class="polaroid" src="images/'.$row['image'].'" alt="">
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
          }
           ?></div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">whatshot</i>Item Purchased</div>
          <div class="collapsible-body"><?php 
          $sql="SELECT start from item";
          $result = mysqli_query($mysqli,$sql);
          while($row=mysqli_fetch_assoc($result))
          {
            $start=$row['start'];
            /*$cur_time=$_SERVER['REQUEST_TIME'];
            echo $time_added.'\t'.$cur_time;*/
            $from=date_create(date('Y-m-d'));
            $to=date_create($start);
            $diff=date_diff($to,$from);
            //print_r($diff);
            echo $diff->format('%R%a days');


          }


           ?></div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">whatshot</i>Item Purchased</div>
          <div class="collapsible-body"><?php 
            $sql="SELECT start,finish from item";
          $result = mysqli_query($mysqli,$sql);
          while($row=mysqli_fetch_assoc($result))
          {
            $date=date("Y-m-d");
            $start=$row['start'];
            $finish=$row['finish'];
            $id=$_SESSION['id'];
            if($finish>=$date)
            {
              $sql="SELECT * from bid where user_id='$id'";
              $result2= mysqli_query($mysqli,$sql);
              if($result2->num_rows > 0)
              {
                 while($data=mysqli_fetch_assoc($result2))
                 {
                  echo $data['item_name'];
                 }
              }


            }
            else 
            {
             echo "bid";
            }
          }
           ?></div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">whatshot</i>Item Sold</div>
          <div class="collapsible-body">Lorem ipsum dolor sit amet</div>
        </li>
      </ul>
    </div>
  </div>
      <?php
        $email=$_SESSION['email'];
        $sql = "SELECT * FROM users,item where email='$email' and users.id=item.user_id";
        $result = mysqli_query($mysqli,$sql);
        if($result->num_rows > 0)
        {
          $row=mysqli_fetch_assoc($result);
            echo'<div class="row a">
              <div class="col s6 offset-s3">
                <div class="card-panel gray">
                  <div class="row" >
                    <div> 
                      <b>NAME=></b>'.$row['first_name'].' '.$row['last_name'].'<br>
                      <b>EMAIL=></b>'.$email.'<br>
                      <b>NO. OF ITEMS ADDED=></b>'.$result->num_rows.'<br>
                      <b>USER_ID=></b>'.$row['user_id'].'<br>
                    </div> 
                  </div>
                </div>
              </div>
            </div>';
          
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