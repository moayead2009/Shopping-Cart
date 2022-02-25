<?php 
session_start();
$access = isset($_SESSION["userid"]);
if ($access) {
	header("Location: server/shop.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Final</title>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="css/css.css" rel="stylesheet">
  <script src="js/js.js">
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
  </script>
</head>
<body>
  <div class="header">
    <div class="firstNav">
      <div class="leftNav">
        <span class="title"><a href="index.php">HEJAZI STORE</a></span>
      </div>
      <div class="rightNav">
        <div class="cartCount">
          <span class="indexvalue"></span>
        </div>
      </div>
    </div>
    <div id="topmessage"></div>
  </div>
  <div id="page">
    <div class="pageform">
      <div class="logo">
        <div class="logoButtons" id="signin" name="reg">
          Already have an account?<input type="button" value="Sign In">
        </div>
        <div class="logoButtons" id="signin" name="log">
          New account? <input type="button" value="Sign up">
        </div>
      </div>
      <div class="forms">
        <form method="post">
          <label>Name:</label> 
		  <input name="name" placeholder="Enter name" type="text"> 
		  <label>Email:</label> 
		  <input name="email" placeholder="Enter email" type="email"> 
		  <label>Password:</label> 
		  <input name="pass" placeholder="Enter password" type="password"> 
		  <label>Phone:</label> 
		  <input name="phone" placeholder="Enter phone" type="tel"> 
		  <input name="mainButton" type="button" value="Register">
        </form>
        <form action="server/shop.php" method="post">
          <label>Email:</label> 
		  <input name="email" placeholder="Enter email" type="email"> 
		  <label>Password:</label> 
		  <input name="pass" placeholder="Enter password" type="password"> 
		  <input name="mainButton" type="button" value="login">
        </form>
        <div id="error"></div>
      </div>
    </div>
  </div>
</body>
</html>