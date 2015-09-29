
<?php
	$mini1 = mysql_connect("localhost","blognadine","111111") or die(mysql_error());
	mysql_select_db("mini1", $mini1);

	$sql = "SELECT * FROM items";

	$items = mysql_query($sql , $mini1);

	//$_SESSION['cart'] = array('name' => array(),'price' => array(),'itemID' => array(),'stock' => array());
	while ($row = mysql_fetch_array($items))
	{

		echo "<br>"."<br>";

		addToCart($row['name'],$row['price'],$row['itemID'],$row['stock']);
		}

		$count = 0 ;
		foreach ($_SESSION['cart'] as $attribute => $values) {
			echo '<h1>'. $attribute . '</h1>';

			echo '<ul>';
			foreach($values as $shit)
			{
				echo '<li>' . $shit .'</li>';
			}
			echo '</ul>';
		}
?>


<?php
function addToCart($name,$price,$itemID,$stock)
{
	if(isset($_SESSION['cart']))
	{
		array_push($_SESSION['cart']['name'],$name);
		array_push($_SESSION['cart']['price'],$price);
		array_push($_SESSION['cart']['itemID'],$itemID);
		array_push($_SESSION['cart']['stock'],$stock);

	}
	else
	{
		$_SESSION['cart'] = array('name' => array(),'price' => array(),'itemID' => array(),'stock' => array());
		array_push($_SESSION['cart']['name'],$name);
		array_push($_SESSION['cart']['price'],$price);
		array_push($_SESSION['cart']['itemID'],$itemID);
		array_push($_SESSION['cart']['stock'],$stock);
	}
}

?>
