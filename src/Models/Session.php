<?php


namespace IMDB\Models;


class Session
{
    /**
     * @bool
     */
    public $signedIn;

    /**
     * @var
     */
    public $username;

    public function Start()
    {
        return session_start();
    }

    public function Destroy()
    {
        return session_destroy();
    }

    public function signIn() {
        $this->signedIn = 1;
    }

    public function IsLoggedOff(){
        $this->signedIn = 0;
    }
}