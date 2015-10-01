<?php
//include config
require_once('includes/config.php');
 
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <title>Cool Desgins</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/doola.css" rel="stylesheet">
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
                    "navbar-brand" href="">Doola</a>
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

        <div class="jumbotron jumbotronBanner">
            <div class="container">
                <h1 class="text-center">Yollo !!</h1>
            </div>
        </div>
    </header>

<section>
        <div class="jumbotron men">
            <div class="container">
                <h1 class="text-center">Men</h1><br><br>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <h2 class="text-center">
                            <a href="store.php">Department 1</a>
                        </h2>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <h2 class="text-center">
                            <a href="store.php">Department 2</a>
                        </h2>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <h2 class="text-center">
                            <a href="store.php">Department 3</a>
                        </h2>
                    </div>
                </div>
            </div><br>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <h2 class="text-center">
                            <a href="store.php">Department 4</a>
                        </h2>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <h2 class="text-center">
                            <a href="store.php">Deparment 5</a>
                        </h2>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <h2 class="text-center">
                            <a href="store.php">Department 6</a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="jumbotron women">
            <div class="container">
                <h1 class="text-center">Women</h1><br><br>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <h2 class="text-center">
                            <a href="store.php">Department 1</a>
                        </h2>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <h2 class="text-center">
                            <a href="store.php">Department 2</a>
                        </h2>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <h2 class="text-center">
                            <a href="store.php">Department 3</a>
                        </h2>
                    </div>
                </div>
            </div><br>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <h2 class="text-center">
                            <a href="store.php">Department 4</a>
                        </h2>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <h2 class="text-center">
                            <a href="store.php">Deparment 5</a>
                        </h2>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <h2 class="text-center">
                            <a href="store.php">Department 6</a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

 <section>
   <div class="jumbotron foot container">
        <div class="row">
            <div class="col-md-12">
                <p class="text-center footer-text">About us.</p>
            </div>
        </div>

   </div>
</section>

<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright © Yasta</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Contact us</a>
                        </li>
                        <li><a href="#">Privacy Policy</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

  

<script src=
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> <script src="js/bootstrap.min.js"></script> <script src="js/Animation.js"></script>
</body>
</html>