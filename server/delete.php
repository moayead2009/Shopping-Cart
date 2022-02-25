<?php
session_start();

include "connect.php";

$itemid = filter_input(INPUT_POST, "itemid", FILTER_VALIDATE_INT);

if($itemid !== null && $itemid !== false){
	//delete items
	$SQL = $dbh->prepare("DELETE FROM cart WHERE itemid = ?");
	if ($SQL->execute([$itemid])) {
		echo json_encode(10);
	}else {
		echo json_encode(11);
	}
}

