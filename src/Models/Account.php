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
class Account
{
    private $username;
    private $password;

    private $error;

    /**
     * Account constructor.
     * @param $username
     * @param $password
     */
    public function __construct($username, $password)
    {
        $hashedPassword = Password ::hash($password);
        $this->username = $username;
        $this->password = $hashedPassword;
    }

    /**
     *
     */
    public function register()
    {
        try {
            $database = new Database();

            $sql = "INSERT INTO `Account` ( username, password ) VALUES ( :username, :password )";
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

    /**
     * @param $username
     * @return \Exception|PDOException
     */
    public function findUser($username )
    {
        try
        {
            $database = new Database();
            $sql = "SELECT username FROM `Account` WHERE (username = :username)";
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

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function verifyUser($username, $password ) {
        //fetching hashPassword from relevent username$
        $hashedPassword = $this->getHashedPassword( $username );

        $verifcationResult = Password::verifyHash(
            $password,
            $hashedPassword['password']
        );

        return $verifcationResult;
    }

    /**
     * @param $username
     * @return \Exception|PDOException
     */
    public function getHashedPassword($username )
    {
        try
        {
            $database = new Database();
            $sql = "SELECT password FROM `Account` WHERE ( username = :username )";
            $database->query($sql);
            $database->bind(":username", $username);
            $hashedPasssword = $database->resultSet();

            return $hashedPasssword;
        }
        catch (PDOException $exception)
        {
            echo "Geen rijen opgevangen" . "<br>";
            return $exception;
        }
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return false|string|null
     */
    public function getPassword()
    {
        return $this -> password;
    }
}
