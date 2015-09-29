<?php
//include config
require_once('includes/config.php');

$female = "SELECT DISTINCT type FROM items WHERE gender='f'";
$resultf = $db->query($female);

$male = "SELECT DISTINCT type FROM items WHERE gender='m'";
$resultm = $db->query($male);

if(isset($_GET['type']))
{
    $shop = "SELECT * FROM items WHERE type = '".$_GET['type'] ."'";
}
else
{
    if(isset($_GET['gender']))
    {
        if($_GET['gender'] =='m' )
        {
            $shop = "SELECT * FROM items WHERE gender='m'";
        }
        else
        {
            $shop = "SELECT * FROM items WHERE gender='f'";
        }

    }
    else
    {
        $shop = "SELECT * FROM items";
    }
    
}


mysql_connect('localhost','root','');
mysql_select_db('phpTrail');

$allItems = mysql_query($shop) or die(mysql_error());
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- Custom CSS -->
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>side

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
        <br><br>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                  <li class="sidebar-brand">
                    <a href="store.php?gender=f">
                        WOMEN
                    </a>
                  </li>
                    <?php
                                            
                                            // output data of each row
                                            while($rowf = $resultf->fetch()) {
                                                echo '<ul><a href=store.php?type=' . $rowf['type'] . '>'.$rowf['type'].'</a></ul>';
                                            }
                                            ?>

                    <li class="sidebar-brand">
                        <a href="store.php?gender=m">
                            MEN
                        </a>
                    </li>
                      <?php
                                                
                                                // output data of each row
                                                while($rowm = $resultm->fetch()) {
                                                    echo '<ul><a href=store.php?type=' . $rowm['type'] . '>'.$rowm['type'].'</a></ul>';
                                                }
                                                ?>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <?php
                                $counter = 3;
                                while($item = mysql_fetch_assoc($allItems))
                                {
                                    if($counter % 3 == 0)
                                    {
                                        echo "<div class='col-md-3'>";
                                    }
                                    else
                                    {
                                        echo "<div class='col-md-3 col-md-offset-1'>";
                                    }
                                    echo "<div class='thumbnail' style=''>";
                                    echo "<img alt='' src='" . $item['url']. "'style='border-radius: 25px; border: 2px;'><br>";
                                    echo "<div class='caption' style='border-top: 1px solid #ccc;'><h6>This is a product</h6>";
                                    echo "<h5 class='text-right'>$" . $item['price']. ".00 <br> Quantity: ". $item['stock'] ."</h5>";
                                  
                                    echo "<p class='text-right'><a class='btn btn-primary' href='#''>Add to Cart</a></p></div></div></div>";
                                    $counter = $counter + 1;
                               }
                    ?>                
            </div>
        </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
<script src=
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
