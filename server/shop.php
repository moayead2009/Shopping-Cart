<?php
session_start();
include "connect.php";

$access = isset($_SESSION["userid"]);
if ($access) {
	//item page
	$SQL = $dbh->prepare("SELECT * from items, users where userid = ?");
	$SQL->execute([$_SESSION["userid"]]);
include_once 'header.php';
?>

<div class="items">
<?php

	while ($row = $SQL->fetch()) {
		echo "<div class='itemBox'>";
        echo "<div class='itemImage'><img src='../" . $row["itemimage"] . "'></div>";
        echo "<div class='itemName'>" . $row["itemname"] . "</div>";
        echo "<div class='itemDec'>" . $row["itemdec"] . "</div>";
        echo "<div class='itemPrice'>$" . $row["price"] . "</div>";
        echo "<input type='button' value='Add' data-itemid=" .  $row["itemid"]  .">";
		$ShowName=false;
		echo "</div>";
    }	
	

}else{
	echo "<h1>Not Logged in. Access denied.</h1>";
}

?>

</div>
</body>
</html>
