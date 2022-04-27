<div style="display: grid; justify-content:end;">
	<?php
	#only logged in users can see contents of the application
	session_start();
	if (!isset($_SESSION['username']) || $_SESSION['username'] == "") {
		echo "<p>You are not authorized to view this page. Login insted</p>";
		include("../view/login.php");
		die();
	}
	//TODO
	//Insert here
	else {
		echo "<p>{$_SESSION['username']}<br><a href=../../src/model/logout.php>Logout</a></p>";
		include("time.php");
	}

//TODO
//$user = new DBConn;
//$user->connect->prepare...
//else if ($row['flag'] == 0) {
//		echo User with this username is already logged in
//		die;
//}
	?>
</div>
