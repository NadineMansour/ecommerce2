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

    <title>Profile</title>

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
    </header> <br><br>

    <?php
        if(isset($_POST['submit']))
        {
            if(isset($_POST['password']) and isset($_POST['email']) and isset($_POST['passwordConfirm']))
            {
                if($_POST['passwordConfirm'] == $_POST['password'])
                {

                    if(!$user->editUserInfo( $_SESSION['username'], $_POST['email'], $_POST['password'],$_POST['passwordConfirm'], $_POST['cardnumber'], $_POST['firstName'], $_POST['lastName'], $_POST['avatar'])){
                        $message = "User information updated successfully";
                        $alert = "<div class='alert alert-info alert-dismissable'>
                    <a class='panel-close close' data-dismiss='alert'>×</a>
                    <i class='fa fa-coffee'></i>" .  $message .
                "</div>";
                    }
                    else
                    {
                        $message = "Please try again";
                    $alert = "<div class='alert alert-info alert-dismissable' style='background: #FFCCCC'>
                    <a class='panel-close close' data-dismiss='alert'>×</a>
                    <i class='fa fa-coffee'></i>" .  $message .
                "</div>";
                    }   
                }
                else
                {
                    $message = "Passwords donot match. Please try again.";
                                        $alert = "<div class='alert alert-info alert-dismissable' style='background: #FFCCCC'>
                    <a class='panel-close close' data-dismiss='alert'>×</a>
                    <i class='fa fa-coffee'></i>" .  $message .
                "</div>";
                }
                    
                $alertPanel = $alert;
            }
            $userQuery = "SELECT * FROM users where username = '". $_SESSION['username'] . "'";
            $result = $db->query($userQuery);
            $row = $result->fetch();


        }
    ?>

    <div class="container" >
        <h1>Edit Profile</h1>
        <hr>

        <div class="row well">
            <form class="form-horizontal" method="post">

            <div class='col-md-2'>
            <div class='row'>               
                    <div class="text-center">
                        <img src=<?php echo $row['avatar'];?> class="avatar img-circle" alt="avatar" style="width:12em; height:12em; margin-bottom:15px;">
                        <input class="form-control" name="avatar"  type="text" value=<?php echo "'" . $row['avatar'] . "'"?>>
                    </div>
                </div>
            </div>
            <div class='col-md-1'>
            </div>


            <div class="col-md-9 personal-info" style='border-left-style: solid; border-width: 3px;'>
                <?php
                if(isset($_POST['submit']))
                {
                    echo $alertPanel;
                }
                ?>

                <h3>Personal info</h3>

                
                    
                    <div class="form-group">
                        <label class="col-md-3 control-label"><div class="text-left">Username:</div></label>

                        <div class="col-md-9">
                            
                            <h5><?php echo  $row['username'] ?></h5>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label"><div class="text-left">First Name:</div></label>

                        <div class="col-md-8">
                            <input class="form-control" name="firstName" type="text" value=<?php echo "'" . $row['firstName'] . "'"?>
                            >
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-3 control-label"><div class="text-left">Last Name:</div></label>

                        <div class="col-md-8">
                            <input class="form-control" name="lastName" type="text" value=<?php echo "'" . $row['lastName'] . "'"?>
                            >
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-md-3 control-label"><div class="text-left">email:</div></label>

                        <div class="col-md-8">
                            <input class="form-control" name="email" type="text" value=<?php echo "'" . $row['email'] . "'"?>
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><div class="text-left">Password:</div></label>

                        <div class="col-md-8">
                            <input class="form-control" name="password" type="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><div class="text-left">Confirm password:</div></label>

                        <div class="col-md-8">
                            <input class="form-control" name="passwordConfirm" type="password" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><div class="text-left">Credit Card:</div></label>

                        <div class="col-md-8">
                            <input class="form-control" name="cardnumber" type="text" value=<?php echo "'" . $row['cardnumber'] . "'"?>
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>

                        <div class="col-md-8">
                            <input class="btn btn-primary" type="submit" value=
                            "Save Changes" name="submit"> <span></span><input class=
                            "btn btn-default" type="reset" value="Cancel" >
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