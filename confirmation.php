<?php
//include config
require_once('includes/config.php');
if(isset($_SESSION['cart']))
{
	echo "Are you sure you want to purchase : ";
	$count = 0 ;
	while($count < sizeof($_SESSION['cart']['name']))
	{
			$requied_amount = $_SESSION['cart']['amount'][$count];
			$current_id = $_SESSION['cart']['itemID'][$count];

			$sql = "SELECT stock FROM items WHERE itemID = $current_id";
			$result = $db->query($sql);

			while($raw = $result->fetch())
			{

				if ($raw['stock'] >= $requied_amount)
				{
					echo $_SESSION['cart']['amount'][$count] ."-".$_SESSION['cart']['name'][$count]."-" . $_SESSION['cart']['amount'][$count].  "<br>";

				}
				else
				{
					echo "select amount less than that in the stock ".$raw['stock']."<br>";
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


		$_SESSION['cart'] = array('name' => array(),'price' => array(),'itemID' => array(),'type' => array(),'amount' => array(),'url' => array());
		header('location: index.php');
		
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