<html lang="en">
<head>
  <title>Final</title>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="../css/css.css" rel="stylesheet">
  <script src="js/js.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="header">
	<div class="firstNav">
		<div class="leftNav"><span class="title"><a href="../index.php">HEJAZI STORE</a></span></div>
		<div class="rightNav"><div class="cartCount"><a href="showCart.php">CART : <span class="cartValue">0</span></a></div></div>
	</div>
	<div class="secondtNav">
		<div class="leftNav"><?php echo "Welcome " . $_SESSION["name"]; ?></div>
		<div class="rightNav"><a href="logout.php">Log out</a></div>
	</div>
	<div class="addstatus"></div>
</div>