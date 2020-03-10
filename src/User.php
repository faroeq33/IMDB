<?php
namespace IMDB;

class User {
  private $username;
  private $password;
  
  public function __construct($username,$password) {
    $this->username = $name;
    $this->password = $password;
  }

  public function getUsername() {
    return $this->_username;
  }
}
