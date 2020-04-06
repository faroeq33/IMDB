<?php
namespace IMDB;

use IMDB\Database as Database;
use IMDB\Password as Password;

class User {
    private $username;
    private $password;

    public function __construct($username,$password) {
        $this->username = $username;
        $this->password = $password;
        $this->register();
    }

    private function register() {
        $sql = new Database();
        $username = $this->username;
        $password = Password::hash($this->password);

        $sql->query("INSERT INTO `User` (username, password) VALUES ( :user, :password");
        $sql->bind(":password", $username);
        $sql->bind(":user:", $password);
        $sql->resultset();
    }
}
