<?php
session_start();
   require 'db.php';
?> 
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="materialize/css/materialize.min.css">
      	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
      	<style type="text/css">
        .box_image{
          height: 50px;
        }
        .a{
          padding-top: 50px;
        }
      	</style>
	</head>
<body>
      <div class="row a">
          <div class="col s6 offset-s3">
            <div class="card-panel gray">
              <div class="row" >
                <div> 
                  <b>NAME=></b><br>
                  <b>NAME=></b><br>
                  <b>NAME=></b><br>
                  <b>NAME=></b><br>
                  <b>NAME=></b><br>
                  <b>NAME=></b><br>
                </div> 
              </div>
            </div>
          </div>
      </div>
        
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
      <script>
</script>
</body>
</html>
 <!--/*echo '<tbody class="responsive-table stripped">
            <tr>
            <td>'.$row['name'].'</td>
            <td>'.$row['user_id'].'</td>
            <td>'.$row['code'].'</td>
            <td>'.$row['category'].'</td>
            <td>'.$row['baseprize'].'</td>
            <td>'.$row['description'].'</td>
          </tr>
        </tbody>
      </table>';
                echo'<img class="responsive-img circle" src=images/'.$row['image'].'>';*/