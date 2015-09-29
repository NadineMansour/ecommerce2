<?php
//include config
require_once('includes/config.php');

$username = $_SESSION['user'];
$sql = "SELECT * FROM history WHERE username='$username' ORDER BY date DESC";
$result = $db->query($sql);
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
                	$count = 0;
					while($row = $result->fetch()) {
						$itemID = $row['itemId'];

						$sqlitem = "SELECT * FROM items WHERE itemID='$itemID'";
						$item = $db->query($sqlitem)->fetch();
						$item_name = $item['name'];
						$url = $item['url'];
						$quantity =  $row['quantity'];
						$total_price = $quantity * $item['price'];
						$date = $row['date']
	                        ?>
		                    <div class="col-sm-4 col-lg-4 col-md-4">
		                        <div class="thumbnail">

		                            <img src="http://placehold.it/320x150" alt="">
		                            <div class="caption">
		                                
		                                <?php
		                                echo "<h4 class='pull-right'>".$total_price."$</h4>";
		                                echo "<h4>".$item_name."</h4>";
		                                
                                        echo "<h4> Quantity: ".$quantity."</h4>";
                                        echo "<h4> Date: ".$date."</h4>";
		                                ?>                                      
	                            	</div>
		                        </div>
		                    </div>
	                        <?	
	                    $count++;					
                    }
                    if ($count == 0) {
	                        ?>
		                    <div class="col-sm-4 col-lg-4 col-md-4">
		                    	<h1>You have no purchases.</h1>
		                    </div>
	                        <?	
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