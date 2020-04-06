<?php


namespace IMDB;


class Password
{
    private static $password;

    public static function hash( $password )
    {
        $hashedInput = password_hash($password, PASSWORD_DEFAULT);
        self::$password = $hashedInput;
        return self::$password;
    }

}