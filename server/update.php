<?php
session_start();
include "connect.php";
//get the details from the user
$itemid    = filter_input(INPUT_POST, "itemid", FILTER_VALIDATE_INT);
$cart    = filter_input(INPUT_POST, "cart", FILTER_VALIDATE_INT);

if(($itemid && $cart) !== null && ($itemid && $cart) !== false){
	//update the details
	$SQL = $dbh->prepare("UPDATE cart SET cart = ? WHERE itemid = ?");
	if ($SQL->execute([$cart, $itemid])) {
		echo json_encode(12);
	}else {
		echo json_encode(13);
	}
}

