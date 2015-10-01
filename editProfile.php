<?php
//include config
require_once('includes/config.php');
if( !$user->is_logged_in() ){ header('Location: index.php'); }


$userQuery = "SELECT * FROM users where username = '". $_SESSION['username'] . "'";
$result = $db->query($userQuery);
$row = $result->fetch();


?>


<!DOCTYPE html>
<html>
<head>
    <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>profile</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- Custom CSS -->

</head>
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
                            <a href="login.php">
                                <?php
                                        echo "Hello, " . $_SESSION['username'];
                                ?>
                            </a>
                        </li>

                        <li>
                            <?php
                                        echo "<a href='logout.php'> Log out </a>" ;
                                ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header> <br><br>

    <?php
        if(isset($_POST['submit']))
        {

        }
    ?>

    <div class="container">
        <h1>Edit Profile</h1>
        <hr>

        <div class="row well">


            <div class="col-md-9 personal-info">
                <div class="alert alert-info alert-dismissable">
                    <a class="panel-close close" data-dismiss="alert">×</a>
                    <i class="fa fa-coffee"></i>This is an
                    <strong>.alert</strong>. Use this to show important
                    messages to the user.
                </div>

                <h3>Personal info</h3>

                <form class="form-horizontal" method="post">
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label"><div class="text-left">Username:</div></label>

                        <div class="col-md-9">
                            
                            <h5><?php echo  $row['username'] ?></h5>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-md-3 control-label"><div class="text-left">email:</div></label>

                        <div class="col-md-8">
                            <input class="form-control" type="text" value=<?php echo "'" . $row['email'] . "'"?>
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><div class="text-left">Password:</div></label>

                        <div class="col-md-8">
                            <input class="form-control" type="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><div class="text-left">Confirm password:</div></label>

                        <div class="col-md-8">
                            <input class="form-control" type="password" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>

                        <div class="col-md-8">
                            <input class="btn btn-primary" type="button" value=
                            "Save Changes"> <span></span><input class=
                            "btn btn-default" type="reset" value="Cancel" name="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <script src=
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>