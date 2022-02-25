<?php
session_start();
include "connect.php";

$email    = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "pass");

if($email !== null){
	if($password !== null){
		//check page, to check on the user inputs
		$SQL = $dbh->prepare("SELECT * FROM users WHERE email = ?");
		if ($SQL->execute([$email])) {
			if ($SQL->rowCount() > 0) {
				$row = $SQL->fetch();
				$hashdb = $row["password"];
				$hasspassword = password_verify($password, $hashdb);
				if(strtoupper($email) === strtoupper($row['email']) && $hasspassword){
					$_SESSION["userid"] = $row['userid'];
					$_SESSION["name"] = $row['name'];
					echo json_encode(1);
				}else if(strtoupper($email) === strtoupper($row['email']) && strlen($password) > 0 && !$hasspassword){
					echo json_encode(2);
				}else{
					echo json_encode(3);
				}
			}else{
				echo json_encode(4);
			}
			
		}
	}else {
		$SQL = $dbh->prepare("SELECT * FROM users WHERE email = ?");
		if ($SQL->execute([$email])) {
			if ($SQL->rowCount() > 0) {
				echo json_encode(0);
			}else{
				echo json_encode(-1);
			}
		}
	}

}else{
	echo "There is an issue with your parameters ..";
}
