<?php
require_once('includes/config.php');
$female = "SELECT itemId FROM items WHERE gender='f'";
$resultf = $db->query($female);

while($rowf = $resultf->fetch()) {

    $id = $rowf['itemId'];
    $sqlItem = "SELECT * FROM items WHERE itemId=$id";
	$item = $db->query($sqlItem);
	$i = $item->fetch();
	Cart::addToCart($i['name'],$i['price'],$i['itemID'],$i['type'],3);
}
?>