<?php


namespace IMDB;


class Session
{
    /**
     * @param $username
     */
    public static function setUsername( $username ) {
        $_SESSION['username'] = $username;
    }

    /**
     * @return mixed
     */
    public static function getUsername() {
        return $_SESSION['username'];
    }

    /**
     * @return bool
     */
    public static function start()
    {
        return session_start();
    }

    public static function logOn() {
        $_SESSION['loggedIn'] = 1;

        session_write_close();
    }

    public static function getLoginStatus() {
        return $_SESSION['loggedIn'];

        session_write_close();
    }

    public static function logOff() {
        session_unset();

        session_write_close();
    }

    public static function destroy() {
        session_destroy();

session_write_close();
    }
}