<?php
//include config
require_once('includes/config.php');
if( !$user->is_logged_in() ){ header('Location: index.php'); }


$userQuery = "SELECT * FROM users where username = '". $_SESSION['username'] . "'";
$result = $db->query($userQuery);
$row = $result->fetch();



?>



<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link rel="stylesheet" href="style/normalize.css">
  <link rel="stylesheet" href="style/main.css">

  <title>Profile</title>

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

     <header>
               <nav class="navbar navbar-default navbar-fixed-top" style="background: #000;">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" data-target=
                    "#navbar" data-toggle="collapse" type="button"><span class=
                    "sr-only">Toggle navigation</span> <span class=
                    "icon-bar"></span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button> <a class=
                    "navbar-brand" href="index.php"><img src='https://upload.wikimedia.org/wikipedia/commons/3/33/Vanamo_Logo.png' style='width: 30px; height: 30px;'></a>
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


	<section>
        <br><br><br>
        <div class="container">
            <div class="row">
                <h1>Your Account</h1>
                
            </div><br>

            <div class='row'>
                <div class='col-md-3'>
                    <div class='row'>               
                    <div class="text-center">
                        <img src=<?php echo $row['avatar'];?> class="avatar img-circle" alt="avatar" style="width:12em; height:12em;">
                    </div>
                </div>
                </div>
                <div class='col-md-9'>
            <div class="row well">
                <div class="row">
                    <div class="col-md-3">
                        <p class="text-center">Username:</p>
                    </div>
                    <div class="col-md-8">
                        <p class=""><?php echo $row['username']; ?></p>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-default" aria-label="Left Align" id="edit">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p class="text-center">First Name:</p>
                    </div>
                    <div class="col-md-9">
                        <p class=""><?php echo $row['firstName']; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p class="text-center">Last Name:</p>
                    </div>
                    <div class="col-md-9">
                        <p class=""><?php echo $row['lastName']; ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <p class="text-center">email:</p>
                    </div>
                    <div class="col-md-9">
                        <p class=""><?php echo $row['email']; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p class="text-center">Credit Card:</p>
                    </div>
                    <div class="col-md-9"><?php echo $row['cardnumber']; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">

                        <div class="text-center"><a href="history.php" class="text-right"> previous orders</a></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
            <script type="text/JavaScript">
                document.getElementById("edit").onclick = function () {
                location.href = "editProfile.php";
                };

            </script>

        
          
            
          
        </div>

    </section>

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

