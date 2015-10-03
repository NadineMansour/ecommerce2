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

    <title>Confirm purchase</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
        if(isset($_POST['confirm']))
        {
            //--------------------------- inserting values in history table -------------------
            $current_user = $_SESSION['username']; //username

            $userID_sql = "SELECT userID FROM users WHERE username = '$current_user'";//user ID
            $ID_result = $db->query($userID_sql);
            $row_id = $ID_result->fetch();
            $current_userID = $row_id['userID'];


            $count = 0;
            while($count < sizeof($_SESSION['cart']['name']))
            {
                
                    $current_itemID = $_SESSION['cart']['itemID'][$count];
                    $current_amount = $_SESSION['cart']['amount'][$count];

                    $insert_sql = "INSERT INTO history (userid , username , itemid , quantity ) 
                    VALUES ('$current_userID' , '$current_user' , '$current_itemID' , '$current_amount')";
                    $result = $db->query($insert_sql);

                //update  stock in items table..........................................................
                    $stock_query = "SELECT stock FROM items WHERE itemID = '$current_itemID'";  
                    $stock_result = $db->query($stock_query);
                    $fetch = $stock_result->fetch();
                    $new_stock = $fetch['stock'] - $current_amount;

                    $stock_update_query = "UPDATE items  SET stock = $new_stock WHERE itemID = $current_itemID";
                    $exe = $db->query($stock_update_query);
                

                $count++;
            }
            unset($_SESSION['cart']);
            $_SESSION['purchase'] = true;
            header('location: index.php');
            
        }
    ?>

    <nav class="navbar navbar-default navbar-fixed-top" style="background: #000;">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" data-target=
                    "#navbar" data-toggle="collapse" type="button"><span class=
                    "sr-only">Toggle navigation</span> <span class=
                    "icon-bar"></span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button> <a class=
                    "navbar-brand" href=""><img src='https://upload.wikimedia.org/wikipedia/commons/3/33/Vanamo_Logo.png' style='width: 30px; height: 30px;'></a>
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
        </nav><br><br><br><br>



    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>

                            <th>Quantity</th>

                            <th class="text-center">Price</th>

                            <th class="text-center">Total</th>

                            <th>&nbsp;</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                                                        $total = 0 ;
                                                        $count = 0 ;
                                                        while($count < sizeof($_SESSION['cart']['name']))
                                                        {
                                                            $requied_amount = $_SESSION['cart']['amount'][$count];
                                                            $current_id = $_SESSION['cart']['itemID'][$count];
                                                            $query = "SELECT * FROM items WHERE itemID = $current_id";
                                                            $result = $db->query($query);
                                                            $res = $result->fetch();
                                                            if($res['stock'] >=  $_SESSION['cart']['amount'][$count] )
                                                            {
                                                                $stockAvail = "In Stock.";
                                                                $price = $res['price'];
                                                            }
                                                            else
                                                            {
                                                                $stockAvail = "Out of Stock";
                                                                $price = 0;
                                                            }
                                                            echo    "<tr>
                                                                        <td class='col-sm-8 col-md-6'>
                                                                            <div class='media'>
                                                                                <a class='thumbnail pull-left' href=''>
                                                                                <img class='media-object' src='" . $res['url'] . "'
                                                            
                                                            style='width: 72px; height: 72px;'></a>

                                                            <div class='media-body'>
                                                                <h4 class='media-heading'><a href=
                                                                ''>&nbsp&nbsp&nbsp" . $_SESSION['cart']['name'][$count] ."</a></h4>
                                                                <span>&nbsp&nbsp&nbspStatus:</span>
                                                                <span class='text-success'><strong>" . $stockAvail."</strong></span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td class='col-sm-1 col-md-1' style=
                                                    'text-align: center'><input class='form-control'
                                                    id='exampleInputEmail1' type='email' value=
                                                    '". $_SESSION['cart']['amount'][$count] ."''></td>

                                                    <td class='col-sm-1 col-md-1 text-center'>
                                                    <strong>$" . $price. ".00</strong></td>

                                                    <td class='col-sm-1 col-md-1 text-center'>
                                                    <strong>$" . $price * $_SESSION['cart']['amount'][$count] .".00</strong></td>
                                                </tr>";         
                                                            $total = ($price * $_SESSION['cart']['amount'][$count]) + $total;
                                                            $count++;
                                                        }

                                                        echo "<tr>
                                                    <td>&nbsp;</td>

                                                    <td>&nbsp;</td>

                                                    <td>&nbsp;</td>

                                                    <td>
                                                        <h3>Total</h3>
                                                    </td>

                                                    <td class='text-right'>
                                                        <h3><strong>$" . $total . ".00</strong></h3>
                                                    </td>
                                                </tr>";

                                                ?>
                    </tbody>
                </table><?php
                if (isset($_SESSION['cart']))
                {
                    echo"
                    <form role='form' method='post'>
                        <input class='btn btn-lg btn-success btn-block' type='submit' name='confirm' value='confirm'  /> 
                    </form>
                    ";
                }
                ?>
            </div>
        </div>
    </div><script src=
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> <script src="js/bootstrap.min.js"></script> <script src="js/Animation.js"></script>

</body>
</html>