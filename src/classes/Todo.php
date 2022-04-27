<?php
class Todo 
{

	/**
	 *
	 *@id = to_do id
	 *@msg = to_do messages
	 *@users_username = username associated with @msg from different table
	 *@connection = for connecting to the db
	 *
	 */

	private $id;
	private $msg;
	private $users_username;
	private $connection;

	public function __construct()
	{
		require("../../config/database.php");
		$database = new DBConn;
		$this->connection = $database->connect();
	}

	//Setter methods for @id, @msg, $users_username 
	public function setId(int $id)
	{
		$this->id = $id;
	}
	public function setMsg($msg)
	{
		$this->msg = $msg;
	}
	public function setUsersUsername($users_username)
	{
		$this->users_username = $users_username;
	}


	//Getters
	public function getId() : int
	{
		return $this->id;
	}
	public function getMsg() : string
	{
		return $this->msg;
	}
	public function getUsersUsername() : string
	{
		return $this->users_username;
	}

	//Insert user data into to_do table
	public function insertTodo() : bool
	{
		$sql = "INSERT INTO todo.messages (msg, users_username) VALUES (:msg, :users_username)";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':msg', $this->msg);
		$stmt->bindParam(':users_username', $this->users_username);

		if($stmt->execute())
		{
		return true;
		}
		return false;
	}

}
