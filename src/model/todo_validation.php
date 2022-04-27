<?php

//insert user data into db
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	session_start();
	require("../classes/Todo.php");

	$msg = $_POST['todo'];
	$username = $_SESSION['username'];

	$todo = new Todo;
	$todo->setMsg($msg);
	$todo->setUsersUsername($username);
	
	if(isset($msg) && $msg != "") 
	{
		if($todo->insertTodo())
		{
			header("Location: ../../public/view/homepage.php");
			exit();
		}
		else 
		{
			echo "Not good";
		}
	}
	else 
	{
		header("Location: ../../public/view/homepage.php");
		exit();
	}

}

?>
