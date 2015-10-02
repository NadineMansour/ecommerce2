<?php
//include config
require_once('includes/config.php');
if(isset($_SESSION['cart']))
{
	echo "Are you sure you want to purchase : ";
	$count = 0 ;
	while($count < sizeof($_SESSION['cart']['name']))
	{
		if($_SESSION['cart']['amount'][$count] > 0)
		{	
			$requied_amount = $_SESSION['cart']['amount'][$count];
			$current_id = $_SESSION['cart']['itemID'][$count];

			$sql = "SELECT stock FROM items WHERE itemID = $current_id";
			$result = $db->query($sql);

			while($raw = $result->fetch())
			{
				if ($raw['stock'] >= $requied_amount)
				{
					echo "-".$_SESSION['cart']['name'][$count]."<br>";
				}
				else
				{
					echo "select amount less than that in the stock ".$raw['stock'];
				}
			}
		}
		$count++;

	}
}
else
{
	echo "choose itesm first";
}
?>


<html lang="en">

<head>
</head>

<body>

<?php
	if(isset($_POST['confirm']))
	{
		
		$current_user = $_SESSION['username']; //username

		$userID_sql = "SELECT userID FROM users WHERE username = '$current_user'";//user ID
		$ID_result = $db->query($userID_sql);
		$raw = $ID_result->fetch();
		$current_userID = $raw['userID'];


		$count = 0;
		while($count < sizeof($_SESSION['cart']['name']))
		{
			if($_SESSION['cart']['amount'][$count] > 0)
			{	
				$current_itemID = $_SESSION['cart']['itemID'][$count];
				$current_amount = $_SESSION['cart']['amount'][$count];

				$insert_sql = "INSERT INTO history (userid , username , itemid , quantity ) 
				VALUES ('$current_userID' , '$current_user' , '$current_itemID' , '$current_amount')";
				 $result = $db->query($insert_sql);
			}

			$count++;
		}


		$_SESSION['cart'] = array('name' => array(),'price' => array(),'itemID' => array(),'type' => array(),'amount' => array(),'url' => array());
		header('location: index.php');
		exit;
	}
?>
<?php
if (isset($_SESSION['cart']))
{
	?>
	<form role="form" method="post">
		<input class="btn btn-lg btn-success btn-block" type="submit" name="confirm" value="confirm"  /> 
	</form>
	<?php
}
?>
</body>

</html>