<!--Registration page -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Todo</title>
	<link rel="stylesheet" href="includes/style.css">
	<style>
		a {
			text-decoration: none;
		}
	</style>
</head>
<body>
	<div class="title">
		<h2>Register Here:</h2>
	</div>
	<div class="register">
	<form action="../../src/model/register_validation.php" method="POST">
		<input type="text" name="first_name" placeholder="First Name" size="25" required>
		<br>
		<br>
		<input type="text" name="last_name" placeholder="Last Name" size="25" required>
		<br>
		<br>
		<input type="text" name="username" placeholder="Username" size="25" required>
		<br>
		<br>
		<input type="text" name="email" placeholder="Email" size="25" required>
		<br>
		<br>
		<input type="password" name="password" placeholder="Password" size="25" required>
		<br>
		<br>
		<input type="password" name="password1" placeholder="Confirm Password" size="25" required />
		<input type="submit" value="Submit" name="submit" style="margin-left: 80px;">
	</form>
	<p style="text-align: center; margin-top: 50px;"><a href="login.php">Go back</a></p>
	</div>
</body>
</html>
