<?php
// database class

use Dotenv\Dotenv;
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
class DBConn
{
	/**
	 *
	 *@user = mysql username
	 *@password = mysql password
	 *@dbc = mysql:host=<your hostname>;dbname=<your db name>;charset=UTF8;
	 *
	 */

	private $user;
	private $password;
	private $dbc;


	public function setEnvs()
	{
		$this->user = $_ENV['DB_USER'];
		$this->password = $_ENV['DB_PASS'];
		$this->dbc = $_ENV['DBC'];
	}

	public function connect()
	{
		$conn = new PDO($_ENV['DBC'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
  		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $conn;
	}
	
}
?>
