<?php

namespace IMDB;

use PDO;
use PDOException;

/**
 * Class Database
 * @package IMDB
 */
class Database
{

    private $dbhost = DB_HOST;
    private $dbuser = DB_USER;
    private $dbpass = DB_PASS;
    private $dbname = DB_NAME;

    /**
     * @var PDO
     */
    private $dbh; //PDO connectie (handler)

    private $error;

    private const BR = "</br>";

  public $stmt;  //query

    /**
     * Database constructor.
     */
    public function __construct()
    {
        //DSN (DB source name(connection string))
        $dsn = 'mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname; //voor gebruik verschillende databases

        try {
            $this->dbh = new PDO($dsn, $this->dbuser, $this->dbpass);

        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo 'Er is een error ontstaan bij het verbinden: ' . $this->error;
        }

    }

    /**
     * @param $query
     */
    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    /**
     * @param $param
     * @param $value
     * @param null $type
     */
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

    /**
     * @return mixed
     */
    private function executeQuery(){
        return $this->stmt->execute();
    }

    /**
     * @return mixed
     */
    public function resultSet(){
        $this->executeQuery();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);//
    }

}
