<?php
class UserAuth
{
	private $id;
	private $first_name;
	private $last_name;
	private $username;
	private $email;
	private $password;
	private $status;
	private $registration_date;
	private $verification_code;
	public $connection;
	public $error;


	public function __construct()
	{
		require_once("../../config/database.php");
		$database = new DBConn;
		$this->connection = $database->connect();
	}

	//Setter methods with preg_match for restriction of user input 
	public function setId(int $id)
	{
		$this->id = $id;
	}

	public function setFirstName(string $first_name)
	{	
		if(!preg_match("/^[a-zA-Z\pL]+$/u", $first_name))
		{
			$this->error[] = "First name must contain only letters";
		}
		else 
		{
			$this->first_name = $first_name;
		}
	}

	public function setLastName(string $last_name)
	{
		if(!preg_match("/^[a-zA-Z\pL]+$/u", $last_name))
		{
			$this->error[] = "Last name must contain only latters";
		}
		else 
		{
			$this->last_name = $last_name;
		}
	}	

	public function setUsername(string $username)
	{
		if(!preg_match("/^[a-zA-Z0-9_\pL]+$/u", $username))
		{
			$this->error[] = "Username allows letters, numbers and underscore only";
		}
		else 
		{
			$this->username = $username;
		}
	}

	public function setEmail(string $email)
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$this->error[] = "Email format apears to be wrong.";
		}
		else 
		{
			$this->email = $email;
		}
	}

	public function setPassword(string $password)
	{
		if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/", $password))
		{

			$this->error[] = "Password must include at least one uppercase, one lowercase letter and a digit.";
		}
		else 
		{
			$this->password = password_hash($password, PASSWORD_BCRYPT);
		}
	}

	public function setStatus(string $status)
	{
		$this->status = $status;
	}

	public function setRegistrationDate(string $registration_date)
	{
		$this->registration_date = $registration_date;
	}

	public function setVerificationCode(string $verification_code)
	{
		$this->verification_code = $verification_code;
	}

	//Getters
	public function getId() : int
	{
		return $this->id;
	}
	public function getFirstName() : string
	{
		return $this->first_name;
	}
	public function getLastName() : string
	{
		return $this->last_name;
	}
	public function getUsername() : string 
	{
		return $this->username;
	}
	public function getEmail() : string
	{
		return $this->email;
	}
	public function getPassword() : string
	{
		return $this->password;
	}
	public function getStatus() : string
	{
		return $this->status;
	}
	public function getRegistrationDate() : string
	{
		return $this->registration_date;
	}
	public function getVerificationCode() : string
	{
		return $this->verification_code;
	}

	 
	public static function verifyInput($input) : string
	{
		$input = trim($input);
		$input = stripcslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}	
	
	//Return user data from db where username matches logged in username
	public function getUserData() 
	{
		$sql = "SELECT * FROM todo.users WHERE username = :username";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':username', $this->username);

		if($stmt->execute())
		{
			$data = $stmt->fetch(PDO::FETCH_ASSOC);
			return $data;
		}
		else 
		{
			echo "Nothing found in SQL query";
			return 0;
		}
		
	}

	//If there are no errors from user input return true
	public function isValidInput() : bool
	{
		if(empty($this->error))
		{
			return true;
		}
		else 
		{
			return false;
		}
	}

	//Show errors made for registration and display to user
	public function showRegistrationErrors() : void
	{
		foreach($this->error as $msg)
		{
			echo "<p>$msg</p>";
		}
	}

	//Save user data into db if there were no errors with registration and preg_matches
	public function saveData() : bool
	{
		if($this->isValidInput() == true)
		{
			$sql = "INSERT INTO todo.users (first_name, last_name, username, email, password, status, registration_date, verification_code) VALUES (:first_name, :last_name, :username, :email, :password, :status, :registration_date, :verification_code)";
		
			$stmt = $this->connection->prepare($sql);
			$stmt->bindParam(":first_name", $this->verifyInput($this->first_name));
			$stmt->bindParam(":last_name", $this->verifyInput($this->last_name));
			$stmt->bindParam(":username", $this->verifyInput($this->username));
			$stmt->bindParam(":email", $this->verifyInput($this->email));
			$stmt->bindParam(":password", $this->password);
			$stmt->bindParam(":status", $this->status);
			$stmt->bindParam(":registration_date", $this->registration_date);
			$stmt->bindParam(":verification_code", $this->verification_code);

			if($stmt->execute())
			{
				return true;
			}
		}

		$this->connection = null;
		return false;
	}

	//check if token sent via email is the same as users in db
	public function isValidEmailToken() : bool
	{
		$sql = "SELECT * FROM todo.users WHERE verification_code = :verification_code";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':verification_code', $this->verification_code);
		$stmt->execute();

		if($stmt->rowCount() > 0)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}

	//users token is valid, now enable users account 
	public function enableAccount() : bool
	{
		$sql = "UPDATE todo.users SET status = :status WHERE verification_code = :verification_code";
		$stmt = $this->connection->prepare($sql);
		$stmt->bindParam(':status', $this->status);
		$stmt->bindParam(':verification_code', $this->verification_code);

		if($stmt->execute())
		{
			return true;
		}
		else 
		{
			return false;
		}
	}

}
