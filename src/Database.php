<?php
namespace IMDB;

class Database{

	//eigenschappen
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;

	public $dbh; //PDO connectie (handler)
	public $error;


	public $stmt;  //query

	//constuctor
	public function __construct(){

		//DSN (DB source name(connection string))
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname; //voor gebruik verschillende databases

		try {
			$this->dbh = new PDO($dsn, $this->user, $this->pass);
		}
		catch (PDOException $e) {
			$this->error = $e->getMessage();
			echo 'Er is een error ontstaan bij het verbinden: ' . $this->error;
		}
	}

	//methoden

	public function bind($param, $value, $type = null){
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
				break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
				break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
				break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}



	public function query($query){
		$this->stmt = $this->dbh->prepare($query);
	}

	private function executeQuery(){
		return $this->stmt->execute();
	}

	public function resultset(){
		$this->executeQuery();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}
?>