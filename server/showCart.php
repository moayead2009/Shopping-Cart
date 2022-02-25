<?php
session_start();
include "connect.php";
$access = isset($_SESSION["userid"]);
if ($access) {
	//show the cart
	$SQL = $dbh->prepare("SELECT c.userid, c.itemid, c.cart, u.name, i.itemname, i.itemimage, i.price
							FROM cart c 
							JOIN users u 
							ON c.userid = u.userid 
							JOIN items i 
							ON c.itemid = i.itemid 
							WHERE c.userid = ?");
	$ShowName = true;
	$SQL->execute([$_SESSION['userid']]);
	
include_once 'header.php';
?>	


<div class="cartitems">
	<div class="carttitle">MY CART</div>
	<div class="mainCart">
		<div class="leftCart">
		<?php 
		$totalPrice = 0;
		while ($row = $SQL->fetch()) { 
			$totalPrice += ($row['price'] * $row['cart']);
		?>
			<div class="cartBox">
				<div class="cartImage"><img src="..<?php echo $row['itemimage']; ?>"></div>
				<div class="cartcartDetails">
					<div class="cartName"><?php echo $row['itemname']; ?></div>
					<div class="cartSaller">Seller : Admin</div>
					<div class="cartPrice">$<?php echo ($row['price'] * $row['cart']); ?></div>
				</div>
				<div class="cartAction">
					<div class="cartQTY">
						<input type="number" value="<?php echo $row['cart']; ?>" data-itemValueId="<?php echo $row['itemid']; ?>" class="cartQTYInput">
					</div>
					<div class="cartQTYupdate">
						<input type="button" value="update" class="cartQTYupdateInput">
					</div>
					<div class="cartRemove">
						<input type="button" value="delete" data-CartItemid="<?php echo $row['itemid']; ?>" class="cartRemoveInput">
					</div>
				</div>
			</div>
		<?php } ?>
		</div>
		<div class="rightCart">
			<span class="rightTitle">PRICE DETAILS</span>
			<div class="priceDetails">
				<div class="priceLeft">
					<div class="priceQTYTitle"></div>
					<div class="priceQTYValueTitle">Delivery Charges</div>
					<div class="totalAmount">Amount Payable</div>
				</div>
				<div class="priceRight">
					<div class="priceQTYT">$<?php echo $totalPrice; ?></div>
					<div class="priceQTYValue">FREE</div>
					<div class="totalAmountValue">$<?php echo $totalPrice; ?></div>
				</div>
			</div>
			<div class="checkOut">
				<input type="button" value="Check Out">
			</div>
		</div>
	</div>

<?php

	

}else{
	echo "<h1>Not Logged in. Access denied.</h1>";
}

?>

</div>
</body>
</html>	


