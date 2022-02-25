<?php
session_start();
include "connect.php";
$access = isset($_SESSION["userid"]);
if ($access) {
	$SQLSUM = $dbh->prepare("SELECT SUM(cart) AS count FROM cart WHERE userid = ?");
	if ($SQLSUM->execute([$_SESSION["userid"]])) {
		$row = $SQLSUM->fetch();
		$_SESSION["cart"] = $row['count'];
		echo json_encode((int)$_SESSION["cart"]);
	}
}
?>
