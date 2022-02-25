<?php
session_start();
include "connect.php";
$access = isset($_SESSION["userid"]);
if ($access) {
	$itemid = filter_input(INPUT_POST, "itemid", FILTER_VALIDATE_INT);
	if($itemid !== null && $itemid !== false){
		$SQL = $dbh->prepare("SELECT * FROM cart where userid = ? and itemid = ?");
		$SQL->execute([$_SESSION['userid'], $itemid]);
		if ($SQL->rowCount() > 0){
			echo json_encode(7);
		} else {
			$SQLI = $dbh->prepare("INSERT INTO cart VALUES (?,?,?)");
			if ($SQLI->execute([$_SESSION["userid"], $itemid, 1])) {
				if ($SQLI->rowCount() > 0) {
					echo json_encode(8);
				}
			}
		}
	}

}

