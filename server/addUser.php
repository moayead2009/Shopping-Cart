<?php
include "connect.php";

$userName  = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
$userEmail = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$userPass  = filter_input(INPUT_POST, "pass");
$userPhone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);

if(($userName && $userEmail && $userPass && $userPhone) !== null &&
   ($userName && $userEmail && $userPass && $userPhone) !== false){
	   $hash = password_hash($userPass, PASSWORD_BCRYPT);
	   //insert registrtion 
	$SQL = $dbh->prepare("INSERT INTO users (name,email,password,phone) VALUES(?,?,?,?)");
	$insert = [$userName, $userEmail, $hash, $userPhone];
	if ($SQL->execute($insert)) {
		if ($SQL->rowCount() > 0) {
			echo json_encode(5);
		}else{
			echo json_encode(6);
		}
	}
}else{
	echo "There is an issue with your parameters ..";
}




























// $SQL = $dbh->prepare("SELECT itemname, itemdec, price, itemqty from items");
// $SQL->execute();
//// $itemlist = [];
// while ($row = $SQL->fetch()) {
	// echo $row["itemname"] . "-" . $row["itemdec"] . "-" . $row["price"] . "-" . $row["itemqty"] . "<br>";
// }
