<?php
require_once('includes/config.php');

class Cart{


public function addToCart($name,$price,$itemID,$type,$amount)
{
	if(isset($_SESSION['cart']))
	{
		array_push($_SESSION['cart']['name'],$name);
		array_push($_SESSION['cart']['price'],$price);
		array_push($_SESSION['cart']['itemID'],$itemID);
		array_push($_SESSION['cart']['type'],$type);
		array_push($_SESSION['cart']['amount'],$amount);
		//echo $type." 00";

	}
	else
	{
		$_SESSION['cart'] = array('name' => array(),'price' => array(),'itemID' => array(),'type' => array(),'amount' => array());
		array_push($_SESSION['cart']['name'],$name);
		array_push($_SESSION['cart']['price'],$price);
		array_push($_SESSION['cart']['itemID'],$itemID);
		array_push($_SESSION['cart']['type'],$type);
		array_push($_SESSION['cart']['amount'],$amount);
		//echo $type." 01";
	}
}




}
?>
