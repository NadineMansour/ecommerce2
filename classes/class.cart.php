<?php
require_once('includes/config.php');

class Cart{


function addToCartHelp($name,$price,$itemID,$type,$amount,$url)
{

		if (in_array($itemID, $_SESSION['cart']['itemID'])) {
	    	$count =0;
	    	while ($count < sizeof($_SESSION['cart']['itemID'])) {
	    		if ($_SESSION['cart']['itemID'][$count] == $itemID) {
	    			$_SESSION['cart']['amount'][$count] += $amount;
	    			break;
	    		}
	    		$count++;
	    	}
		}
		else{
			array_push($_SESSION['cart']['name'],$name);
			array_push($_SESSION['cart']['price'],$price);
			array_push($_SESSION['cart']['itemID'],$itemID);
			array_push($_SESSION['cart']['type'],$type);
			array_push($_SESSION['cart']['amount'],$amount);
			array_push($_SESSION['cart']['url'],$url);		
		}
}


public function addToCart($name,$price,$itemID,$type,$amount,$url)
{
	if(isset($_SESSION['cart'])){
		Cart::addToCartHelp($name,$price,$itemID,$type,$amount,$url);
	}
	else
	{
		$_SESSION['cart'] = array('name' => array(),'price' => array(),'itemID' => array(),'type' => array(),'amount' => array(),'url' => array());
		Cart::addToCartHelp($name,$price,$itemID,$type,$amount,$url);
	}
}

public function get_amount($itemID){
	if(isset($_SESSION['cart'])){
		if (in_array($itemID, $_SESSION['cart']['itemID'])) {
	    	$count =0;
	    	while ($count < sizeof($_SESSION['cart']['itemID'])) {
	    		if ($_SESSION['cart']['itemID'][$count] == $itemID) {
	    			return $_SESSION['cart']['amount'][$count];
	    		}
	    		$count++;
	    	}
	    	return0;
		}
		else{
			return 0;
		}
	}
	else{
		return 0;
	}
}

public function get_amount($itemID){
	if(isset($_SESSION['cart'])){
		if (in_array($itemID, $_SESSION['cart']['itemID'])) {
	    	$count =0;
	    	while ($count < sizeof($_SESSION['cart']['itemID'])) {
	    		if ($_SESSION['cart']['itemID'][$count] == $itemID) {
	    			return $_SESSION['cart']['amount'][$count];
	    		}
	    		$count++;
	    	}
	    	return 0;
		}
		else{
			return 0;
		}
	}
	else{
		return 0;
 	}
 }







}
?>
