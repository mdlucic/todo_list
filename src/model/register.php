<?php
	//When registration fails in registration_verification.php, registration input boxes
	// are included but with no css, so this page redirects to original register.php file.
	header("Location: ../../public/view/register.php");
	exit();
?>
