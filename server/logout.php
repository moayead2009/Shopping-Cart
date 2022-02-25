<?php 
session_start();
$access = isset($_SESSION["userid"]);
if ($access) {
    session_unset();
    session_destroy();
	header("Location: ../index.php");
}

?>
