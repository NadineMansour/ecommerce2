<?php
//include config
require_once('includes/config.php');
if( !$user->is_logged_in() ){ header('Location: index.php'); }

//the cart session 
if (isset($_GET['itm']) && isset($_GET['quan'])) {
    $item = $_GET['itm']; 
    $quantity = $_GET['quan'];
    $sql = "SELECT * FROM items WHERE itemID=$item";
    $result = $db->query($sql);
    $i = $result->fetch();
    Cart::addToCart($i['name'],$i['price'],$i['itemID'],$i['type'],$quantity,$i['url']);
} 

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

    <title>Shopping cart</title>

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
                    <span class="icon-bar"></span></button> <a class="navbar-brand" href="index.php"><img src='https://upload.wikimedia.org/wikipedia/commons/3/33/Vanamo_Logo.png' style='width: 30px; height: 30px;'></a>
                </div>

                 <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="login.php"> 
                                <?php
                                   if($user->is_logged_in())
                                   {
                                        echo "Hello, ".$_SESSION['username'];
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
                        <li>
                            
                        </li>
                        <li>
                            <?php
                                    if($user->is_logged_in())
                                    {
                                        echo "<a href='cart.php'> cart </a>";
                                    }
                                    else
                                    {
                                        echo "<a href='login.php'> cart </a>";
                                    }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>

         <!-- Sidebar -->

        

    <?php  
    if (isset($_GET['item']) && isset($_GET['oper'])) {
        $item = $_GET['item']; 
        $oper = $_GET['oper'];
        if ($oper == "p") {
           if ($item>=0) {
                $itemID = $_SESSION['cart']['itemID'][$item];
                $sql = "SELECT * FROM items WHERE itemID=$itemID";
                $stock = $db->query($sql);
                $x = $stock->fetch();
                $quantity= $x['stock'];
                if ($quantity >=  $_SESSION['cart']['amount'][$item]+1) {
                    $_SESSION['cart']['amount'][$item]++;
                }         
           }
        }
        elseif ($oper == "m") {
            if ($item >= 0 ) {
                if ($_SESSION['cart']['amount'][$item] > 0) {
                    $_SESSION['cart']['amount'][$item]--;
                }  
            }
        }
    }   
    ?>
    <?php
        if(isset($_POST['confirm'])){
            header('Location: confirmation.php');
        }
    ?>
 <div id="wrapper">
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
                    if (isset($_SESSION['cart'])) {                    
                        $count=0;
                        while ($count< sizeof($_SESSION['cart']['name'])) {
                            if ($_SESSION['cart']['amount'][$count]) {
                                ?> 
                                <div class="col-sm-4 col-lg-4 col-md-4">
                                    <div class="thumbnail">
                                        <?php
                                            echo "<img alt='' src='" . $_SESSION['cart']['url'][$count] . "'style='border-radius: 25px; border: 2px;'><br>";
                                        ?>
                                        <div class="caption">
                                            <?php
                                            echo "<h5 class='pull-right'>".$_SESSION['cart']['price'][$count]."$</h5>";
                                            echo "<h5>".$_SESSION['cart']['name'][$count]."</h5>";
                                            echo "type - ".$_SESSION['cart']['type'][$count];
                                            echo "<h5 class='pull-right'> #".$_SESSION['cart']['amount'][$count]."</h5>";
                                            $plus = "p".$count;
                                            $minus = "m".$count;
                                            echo "</br>";
                                            echo "</br>";
                                            echo "<a class='btn btn-danger btn-circle btn-m fa fa-plus'  href=cart.php?oper=p&item=",urlencode($count),"></a>";
                                            echo "<a class='btn btn-danger btn-circle btn-m fa fa-minus' href=cart.php?oper=m&item=",urlencode($count),"></a>";
                                            ?>                                      
                                        </div>
                                    </div>
                                </div>
                                <?php                                  
                            }
                            $count++;						
						}  
                                            echo "<form role='form' method='post'>
                        <input class='btn btn-lg btn-success btn-block' type='submit' name='confirm' value='confirm'  /> 
                    </form>";

                            $count++;                       
                        }  
                    else{
                        echo "<h1> Your cart is empty.";
                    }
                    ?> 
                </div>

            </div>

        </div>

    </div>
</div>
</div>
    <!-- /.container -->
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>


</body>

</html>

