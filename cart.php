<?php
//include config
require_once('includes/config.php');

//the cart session 
if (isset($_GET['itm']) && isset($_GET['quan'])) {
    $item = $_GET['itm']; 
    $quantity = $_GET['quan'];
    $sql = "SELECT * FROM items WHERE itemID=$item";
    $result = $db->query($sql);
    $i = $result->fetch();
    Cart::addToCart($i['name'],$i['price'],$i['itemID'],$i['type'],$quantity);
} 


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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
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

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">

            </div>

            <div class="col-md-9">

                <div class="row carousel-holder">

                </div>

                <div class="row">

                	<?php
                    if (isset($_SESSION['cart'])) {
                    
                        $count=0;
						while ($count< sizeof($_SESSION['cart']['name'])) {
	                        ?>
		                    <div class="col-sm-4 col-lg-4 col-md-4">
		                        <div class="thumbnail">

		                            <img src="http://placehold.it/320x150" alt="">
		                            <div class="caption">
		                                
		                                <?php
		                                echo "<h4 class='pull-right'>".$_SESSION['cart']['price'][$count]."$</h4>";
		                                echo "<h4>".$_SESSION['cart']['name'][$count]."</h4>";
		                                echo "type - ".$_SESSION['cart']['type'][$count];
                                        echo "<h4 class='pull-right'> #".$_SESSION['cart']['amount'][$count]."</h4>";
                                        $plus = "p".$count;
                                        $minus = "m".$count;
                                        echo "</br>";
                                        echo "</br>";
                                        echo "<a class='btn btn-danger btn-circle btn-m fa fa-plus' href=cart.php?oper=p&item=",urlencode($count),"></a>";
                                        echo "<a class='btn btn-danger btn-circle btn-m fa fa-minus' href=cart.php?oper=m&item=",urlencode($count),"></a>";
		                                ?>                                      
	                            	</div>
		                        </div>
		                    </div>
	                        <?	
                            $count++;						
						}  
                    }
                    else{
                        echo "<h1> Your cart is empty.";
                    }
                    ?> 
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

