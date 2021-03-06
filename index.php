<?php
//include config
require_once('includes/config.php');

$female = "SELECT DISTINCT type FROM items WHERE gender='f'";
$resultf = $db->query($female);

$male = "SELECT DISTINCT type FROM items WHERE gender='m'";
$resultm = $db->query($male);
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
    <link href="css/confirm.css" rel="stylesheet">
    <script src=
    "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> <script src="js/bootstrap.min.js"></script> <script src="js/Animation.js"></script>
    <script>
function myFunctionModal()
{
    $('div.modal').removeClass('display');
}
</script>
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
        </nav>

        <div class="jumbotron jumbotronBanner">
            <div class="container">
                <h1 class="text-center"></h1>
            </div>
        </div>
    </header>

    
<?php
        if(isset($_SESSION['purchase']))
        {
            echo "<div class='modal fade bs-example-modal-lg in display' id='myModal' tabindex='-1' aria-hidden='false' >
                <div class='modal-dialog modal-lg'>
                    <div class='modal-content'>
                              <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close' onclick='myFunctionModal()'><span aria-hidden='true'>&times;</span></button></div>
                        <div class='modal-body'>
                            <h2>Your Order has been confirmed</h2>
                        </div>
                    </div>
                </div>
            </div>";
        }
?>
    


<section>
        <div class="jumbotron men">
            <div class="container">
                <h1 class="text-center">Men</h1><br><br>
            </div>

            <?php
                $counter = 0;
                while($rowm = $resultm->fetch()) {
                    if($counter % 3 == 0 )
                    {
                        echo"<div class='container'>
                            <div class='row'>";
                    }
                    echo "<div class='col-lg-4 col-md-4 col-sm-6'>
                                <h2 class='text-center'>";
                    echo '<a href=store.php>'.$rowm['type'].'</a></h2></div>';
                    if($counter%3==0 and $counter > 0)
                    {
                        echo "</div></div><br><br><br><br>";
                    }
                    $counter++;

                }
            ?>
           
        </div>
    </section>

    <section>
        <div class="jumbotron women">
            <div class="container">
                <h1 class="text-center">Women</h1><br><br>
            </div>

             <?php
                $counterf = 0;
                while($rowf = $resultf->fetch()) {
                    if($counterf % 3 ==0 )
                    {
                        echo"<div class='container'>
                            <div class='row'>";
                    }
                    echo "<div class='col-lg-4 col-md-4 col-sm-6'>
                                <h2 class='text-center'>";
                    echo '<a href=index.php>'.$rowf['type'].'</a></h2></div>';
                    if($counterf%3==0 and $counter > 0)
                    {
                        echo "</div></div><br>";
                    }
                    $counterf++;

                }
            ?>
          
        </div>
    </section>




     

</body>
</html>