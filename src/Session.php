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
        session_start();
    }

    public static function logOn() {
        $_SESSION['loggedIn'] = 1;
    }

    public static function close() {
        session_write_close();
    }

    public static function getLoginStatus() {
        return $_SESSION['loggedIn'];
    }

    public static function logOff() {
        session_unset();
    }

    public static function destroy() {
        session_destroy();
    }
}