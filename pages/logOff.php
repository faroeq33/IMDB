<?php
require_once '../init.php';

use IMDB\Session as Session;



echo $twig->render('core.html.twig');

Session::logOff();