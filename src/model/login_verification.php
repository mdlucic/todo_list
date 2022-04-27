<?php
session_start();

/**
 *If user submited the data check for username, email and password and see if they match, if they do set session for that user and redirect him to homepage if not input is wrong and don't match
 *
 */

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	require("../../config/database.php");
	require("../classes/User_Auth.php");

	$username = UserAuth::verifyInput($_POST['username']);
	$password = UserAuth::verifyInput($_POST['password']);
	$status = 'Enabled';

	$conn = new DBConn;
	$sql = "SELECT * FROM todo.users WHERE username = :username OR email = :email";
	$stmt = $conn->connect()->prepare($sql);
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':email', $username);
	$stmt->execute();

	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($row['status'] == 'Enabled')
	{
		if(password_verify($password, $row['password']))
		{
			$_SESSION['username'] = $row['username'];
			header("Location: ../../public/view/homepage.php");
			exit();
		}
		else
		{
			echo "<p>Wrong password</p>";
		}


	}
	else 
	{
		echo "<p>Click on the verification link we sent you via email</p>";
		include("../../public/view/login.php");

	}

	$conn = null;
}
?>
