<!DOCTYPE html>
<html>
<head>
	<title>Profile file</title>
</head>
<body>
	<h1>Profile has been created login to access the account</h1>
	<?php 
		
		 if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];
              
              // Don't annoy the user with more messages upon page refresh
              unset( $_SESSION['message'] );
          }
          
	?>
	<a href="login.php"><button name="login"/>Log in</button></a>
</body>
</html>