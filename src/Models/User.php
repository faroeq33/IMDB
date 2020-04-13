<?php
namespace IMDB\Models;


use IMDB\Database as Database;
use IMDB\Password as Password;
use IMDB\Dump as Dump;
use PDOException;

class User
{
    private $username;
    private $password;

    private $error;

    public function __construct($username, $password)
    {
        $hashedPassword = Password ::hash($password);
        $this->username = $username;
        $this->password = $hashedPassword;
    }

    public function register()
    {
        try {
            $database = new Database();

            $sql = "INSERT INTO `User` ( username, password ) VALUES ( :username, :password )";
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

    public function findUser( $username )
    {
        try
        {
            $database = new Database();
            $sql = "SELECT username FROM `User` WHERE (username = :username)";
            $database->query($sql);
            $database->bind(":username", $username);
            $usernameArray = $database->resultSet();

            return $usernameArray;
        }
        catch (PDOException $exception)
        {
            echo "oh nee!";
            return $exception;
        }
    }

    public function getUsername()
    {
        return $this->username;
    }
}
