<?php
/**
 * Database configuration
 */
class Database
{
    // varible/property for database config
	private $host     = "localhost";
	private $db_name  = "php_simple_api";
	private $username = "root";
	private $password = "";
	public $conn;

	// get connection
	public function getConnection()
	{
		$this->conn = null;
		try {
			$this->conn = new PDO("mysql:host=". $this->host . "; dbname=". $this->db_name, $this->username, $this->password);
			$this->conn->exec("set names utf8");
		} catch (PDOException $exception) {
			echo "Connection error". $exception->getMessage();
		}
		return $this->conn;
	}
}

?>