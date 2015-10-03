<?php
//include config
require_once('includes/config.php');

$username = $_SESSION['user'];
$sql = "SELECT * FROM history WHERE username='$username' ORDER BY date DESC";
$result = $db->query($sql);


//sidebar
$female = "SELECT DISTINCT type FROM items WHERE gender='f'";
$resultf = $db->query($female);

$male = "SELECT DISTINCT type FROM items WHERE gender='m'";
$resultm = $db->query($male);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Social Buttons CSS -->
    <link href="bower_components/bootstrap-social/bootstrap-social.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

 <nav class="navbar navbar-default navbar-fixed-top" style="background: #000; margin-bottom: 10px;">
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
                            <a href="login.php">
                                <?php
                                   if($user->is_logged_in())
                                   {
                                        echo $_SESSION['username'];
                                   }
                                   else
                                   {
                                        echo"Sign in";
                                   }
                                ?>
                            </a>
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
                    </ul>
                </div>
            </div>
    </nav>

<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="store.php?gender=f">WOMEN</a>
            </li>
            <?php
            while($rowf = $resultf->fetch()) {
                echo '<ul><a href=store.php?type=' . $rowf['type'] . '>'.$rowf['type'].'</a></ul>';
             }
            ?>

            <li class="sidebar-brand">
                <a href="store.php?gender=m">MEN</a>
            </li>
            <?php
                while($rowm = $resultm->fetch()) {
                    echo '<ul><a href=store.php?type=' . $rowm['type'] . '>'.$rowm['type'].'</a></ul>';
                }
            ?>
        </ul>
    </div>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <?php
                    $count = 0;
                    while($row = $result->fetch()) {
                        $itemID = $row['itemId'];

                        $sqlitem = "SELECT * FROM items WHERE itemID='$itemID'";
                        $item = $db->query($sqlitem)->fetch();
                        $item_name = $item['name'];
                        $url = $item['url'];
                        $quantity =  $row['quantity'];
                        $total_price = $quantity * $item['price'];
                        $date = $row['date'];
                            ?>
                            <div class="col-sm-4 col-lg-4 col-md-4">
                                <div class="thumbnail">
                                    <?php
                                        echo "<img alt='' src='" . $url . "'style='border-radius: 25px; border: 2px;'><br>";
                                    ?>
                                    <div class="caption">                                       
                                        <?php
                                        echo "<h5 class='pull-right'>".$total_price."$</h5>";
                                        echo "<h5>".$item_name."</h5>";                                 
                                        echo "<h5> Quantity: ".$quantity."</h5>";
                                        echo "<h6> Date: ".$date."</h6>";
                                        ?>                                      
                                    </div>
                                </div>
                            </div>
                            <?php   
                        $count++;                   
                    }
                    if ($count == 0) {
                            ?>
                            <div class="col-sm-4 col-lg-4 col-md-4">
                                <h1>You have no purchases.</h1>
                            </div>
                            <?php   
                    }
                    ?> 
                </div>

            </div>

        </div>

    </div>
</div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>