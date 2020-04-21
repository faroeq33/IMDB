<?php
require_once '../init.php';

use IMDB\Session as Session;

Session::logOff();

echo $twig->render('logoff.html.twig');