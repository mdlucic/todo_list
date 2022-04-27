<!-- 
If user is not registered don't display todos  
Display todo form 
Show todo from db from logged in user with delete button for that todo
-->
<?php require("includes/user_error.php")?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Todo List</title>
	<link rel="stylesheet" href="includes/style.css">
	<style>
		a {
			text-decoration: none;
		}
	</style>
</head>
<body>
		<h2 style="text-align: center; margin-bottom:40px">Todo List</h2>
	<header>
			<div class="search" style="display: flex; justify-content: center;">
				<form action="../../src/model/todo_validation.php" method="POST">
				<input type="text" name="todo" size="40" placeholder="Todo:">
				<input type="submit" value="Submit">
				</form>
			</div>
	</header>

<?php
require("../../config/database.php");
$sql = "SELECT * FROM todo.messages WHERE users_username = :users_username";
$stmt = new DBConn;

$db = $stmt->connect()->prepare($sql);
$db->bindParam(':users_username', $_SESSION['username']);
$db->execute();
$row = $db->fetchAll(PDO::FETCH_ASSOC);

foreach($row as $msg)
{
?>
	<div class="todo">
	<ul>
		<li><?php echo $msg['msg'] ?></li>
	</ul>
	<div class="delete">
	<form action="../../src/model/delete_todo.php" method="POST">
	<button type="submit" value=<?php echo $msg['id']?> name="delete">X</button>
	</form>
	</div>
	</div>
<?php 
}
?>

</body>
</html>
