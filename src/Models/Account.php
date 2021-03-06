<?php

namespace IMDB\Models;


use IMDB\Database as Database;
use IMDB\Password as Password;
use IMDB\Dump as Dump;
use PDOException;

/**
 * Class Account
 * @package IMDB\Models
 */
class Account {
	public $accountid;
	public $username;
	private $password;

	private $error;

	/**
	 * Account constructor.
	 * @param $username
	 * @param $password
	 */
	public function __construct($username, $password) {
		$hashedPassword = Password::hash($password);

		$this->username = $username;
		$this->password = $hashedPassword;
	}

	/**
	 *
	 */
	public function register() {
		if ($this->findUser($this->username)) {
			return false;
		}

		try {
			$database = new Database();

			$sql = "INSERT INTO account ( username, `password` ) VALUES ( :username, :password )";
			$database->query($sql);
			$database->bind(":username", $this->username);
			$database->bind(":password", $this->password);
			$database->resultSet();
		} catch (PDOException $e) {

			echo "error";
			echo 'Connection failed: ' . $e->getMessage();
			echo $this->error;
		}
	}


	public function setAccountId() {
		try {
			$database = new Database();

			$sql = "SELECT id_account FROM account WHERE username = :username";
			$database->query($sql);
			$database->bind(":username", $this->username);
			$fetchedAccountId = $database->resultSet();

			$this->accountid = $fetchedAccountId;
		} catch (PDOException $e) {

			echo 'Connection failed: ' . $e->getMessage();
		}
	}

	/**
	 * @return mixed
	 */
	public function getAccountid() {
		return $this->accountid;
	}


	/**
	 * @param $username
	 * @return \Exception|PDOException
	 */
	public function findUser($username) {
		try {
			$database = new Database();
			$sql = "SELECT username FROM account WHERE (username = :username)";
			$database->query($sql);
			$database->bind(":username", $username);

			return $database->resultSet();
		} catch (PDOException $exception) {
			echo "oh nee!";
			return $exception;
		}
	}

	/**
	 * @param $username
	 * @param $password
	 * @return bool
	 */
	public function verifyUser($username, $password) {
		//fetching hashPassword from relevent username$
		$hashedPassword = $this->getHashedPassword($username)['password'];

		$result = password_verify($password, $hashedPassword);

		return $result;
	}

	/**
	 * @param $username
	 * @return \Exception|PDOException
	 */
	public function getHashedPassword($username) {
		try {
			$database = new Database();
			$sql = "SELECT password FROM account WHERE ( username = :username )";
			$database->query($sql);
			$database->bind(":username", $username);

			return $database->resultSet();
		} catch (PDOException $exception) {
			echo "Geen rijen opgevangen" . "<br>";
			return $exception;
		}
	}

	/**
	 * @return mixed
	 */
	public function getUsername() {
		return $this->username;
	}
}
