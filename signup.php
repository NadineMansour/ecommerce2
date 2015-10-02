<?php
//include config
require_once('includes/config.php');

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link rel="stylesheet" href="style/normalize.css">
  <link rel="stylesheet" href="style/main.css">

  <title>SB Admin 2 - Sign up form</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>


	<?php

	//process signup form if submitted
	if(isset($_POST['submit'])){

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$confirm = trim($_POST['confirmP']);
		$email = trim($_POST['email']);
		$card = trim($_POST['cardnumber']);
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);
		
		if($user->registerNewUser($username,$email,$password,$confirm,$card,$firstName,$lastName)){ 

			//logged in return to index page
			header('Location: index.php');
			exit;
		

		} else {
			$message = '<p class="error">Sign up error</p>';
		}

	}
	//end if submit
	?>

    <header>
        <nav class="navbar navbar-default navbar-fixed-top" style="background: #000;">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" data-target=
                    "#navbar" data-toggle="collapse" type="button"><span class=
                    "sr-only">Toggle navigation</span> <span class=
                    "icon-bar"></span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button> <a class=
                    "navbar-brand" href="index.php">Doola</a>
                </div>

                <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                                <?php
                                   if($user->is_logged_in())
                                   {
                                        echo "<a href='profile.php'>Hello, " . $_SESSION['username'] . "</a>";
                                   }
                                   else
                                   {
                                        echo"<a href='login.php'>Sign in</a>";
                                   }
                                ?>
                        </li>

                        <li>
                            <?php
                                   if($user->is_logged_in())
                                   {
                                        echo "<a href='logout.php'> Log out </a>" ;
                                   }
                                   else
                                   {
                                        echo "<a href='signup.php'> Register </a>";
                                   }
                                ?>
                        </li>
                        <li>
                            <a href="store.php"> store </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

	<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign up for free</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                                <div class='form-group'>
                                    <input class='form-control' placeholder='First Name' name='firstName' type='firstName' autofocus>
                                </div>
                                <div class='form-group'>
                                    <input class='form-control' placeholder='Last Name' name='lastName' type='lastName' autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirm password" name="confirmP" type="password" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email" name="email" type="email" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Card Number" name="cardnumber" type="text" autofocus>
                                </div>
                                
                                <?php 
									foreach ($user->getErrors() as $error)
										echo "<h6 class='error'>".$error."</h6>";
                                ?>        
                                </br>                    
                                <input class="btn btn-lg btn-success btn-block" type="submit" name="submit" value="Sign Up"  /> 
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>
</html>
