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
          <li><a href="https://plus.google.com/u/0/110378863211673805314" class="btn-floating large red tooltipped" data-position="top" data-tooltip="Contact on google plus"><i class="fa fa-google-plus" style="font-size:24px"></i></a></li>
          <li><a href="http://www.github.com/prithvisbisht" class="btn-floating large black tooltipped" data-position="top" data-tooltip="Contact on github"><i class="fa fa-github-square" style="font-size:24px"></i></a></li>
        </ul>
    </div>

     
      <div class="row" style="padding: 50px">
        <div class="col s8 col offset-s2">
          <ul class="collapsible popout" data-collapsible="accordion">
          <li class="blue lighten-3">
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
        <li class="blue lighten-3">
          <div class="collapsible-header"><i class="material-icons">place</i>Item added</div>
          <div class="collapsible-body"><?php 
          $id=$row['id'];
          $sql = "SELECT * from item where user_id='$id'";
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
          else{
            echo "no item added";
          }
           ?></div>
        </li>
        <!--<li>
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
        </li>-->
        <li class="blue lighten-3">
          <div class="collapsible-header"><i class="material-icons">whatshot</i>Item Purchased</div>
          <div class="collapsible-body"><?php 
            $sql="SELECT * from item where sold=0";
          $result = mysqli_query($mysqli,$sql);
          while($row=mysqli_fetch_assoc($result))
          {
            $date=date("Y-m-d");
            $start=$row['start'];
            $finish=$row['finish'];
            $id=$_SESSION['id'];
            $name=$row['name'];
            $item_id=$row['id'];
            if($finish<$date)
            {
              $sql="SELECT * from bid where item_name='$name'";
              $result2= mysqli_query($mysqli,$sql);
              if($result2->num_rows > 0)
              {
                 while($data=mysqli_fetch_assoc($result2))
                 {
                  
                  $bid= $data['current_bid'];
                  $user_id=$data['user_id'];
                  $sql="INSERT into sold (item_id,user_id,final_price)values('$item_id','$user_id','$bid')";
                  if(mysqli_query($mysqli,$sql))
                  {
                    $query="UPDATE item set sold=1 where id='$item_id' ";
                    mysqli_query($mysqli,$query); 
                  }
                 }
              }

            }
          }
          $sql="SELECT * from sold,item where sold.user_id='$id' and sold.item_id=item.id";
              if($result = mysqli_query($mysqli,$sql))
              {
                if($result->num_rows > 0)
                {
                  echo '<div class="row">';
                 while($row=mysqli_fetch_assoc($result))
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
                          <b>prize bought</b>=>'.$row['final_price'].'<br>
                        </p>
                    </div>';
                 } 
                }
              }
           ?></div>
        </li>
        <li class="blue lighten-3">
          <div class="collapsible-header"><i class="material-icons">whatshot</i>Item Sold</div>
          <div class="collapsible-body"><?php 
            $sql="SELECT * from item where user_id='$id' and sold=1";
            if($result = mysqli_query($mysqli,$sql))
            {
              if($result->num_rows > 0)
              {
                 echo '<div class="row">';
                 while($row=mysqli_fetch_assoc($result))
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
              else
              {
                echo "no items sold";
              }
            }

           ?></div>
        </li>
      </ul>
    </div>
  </div>
      <!--Import jQuery before materialize.js-->
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
     <script>
       $(".button-collapse").sideNav();
     </script>

  </body>
</html>