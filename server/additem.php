<?php
include "connect.php";
//get the details from the user
$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
$itemdec = filter_input(INPUT_POST, "itemdec", FILTER_SANITIZE_SPECIAL_CHARS);
$price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT);
$qty = filter_input(INPUT_POST, "qty", FILTER_VALIDATE_INT);
if($name !== null && 
   $itemdec !== null && 
   $price !== null && 
   $qty !== null && 
   $price !== false && 
   $qty !== false){
	   //add it to DB
		$SQL = $dbh->prepare("INSERT INTO items (itemname,itemdec,price,itemqty) VALUES(?,?,?,?)");
		$insert = [$name, $itemdec, $price, $qty];
		if($SQL->execute($insert)){
			echo "dd";
		}else{
			echo"error";
		}
}else{
	echo "There is something went wrong! ";
}









