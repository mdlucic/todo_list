<!--
	Login page 
	CSS is in <style> tags beacuse of some bug it wont link to style.css folder
-->
<!DOCTYPE html>
<?php 
if($_GET["action"] == 'verified')
{
	echo "<p>You can login now</p>";
}
?>
<!-- Main page -->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Todo List</title>
	<link rel="stylesheet" href="includes/style.css">
	<style>
		.head {
			display: grid;
			justify-content: center;
		}
		.login {
			display: grid;
			justify-content: center;
			grid-template-columns: repeat(1, 190px);
			margin-right: 40px;
		}
		a {
			text-decoration: none;
		}
	</style>
</head>

<body>
<div class="head">
<h1>Todo List</h1>
</div>
<div class="login">
		<form action="../../src/model/login_verification.php" method="POST">
			<input type="text" name="username" placeholder="Username or Email">
			<br>
			<br>
			<input type="password" name="password" placeholder="Password">
			<br>
			<br>
			<input type="submit" value="Log in" style="margin-left: 65px;">
			<br>
			<br>
		</form>
	<p style="text-align:center; margin-right: 7px;"><a href="register.php">Click to register</a></p>
	</div>
</body>

</html>
