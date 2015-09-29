<?php
//include config
require_once('includes/config.php');
?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Welcome Page</title>
</head>
<body>
  <h3>Welcome Page !!</h3>
  <?php
  		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			echo "Sign in ";
		}
		else{
			echo "Nadine mesh fahma 7aga";
		}
  ?>
</body>
</html>