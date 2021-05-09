<?php
require_once '../init.php';

use IMDB\Session as Session;

Session::logOff();

$data = [
	'pageTitle' => 'uitloggen',
	'successMessage' => 'Je bent nu uitgelogd...',
];

echo $twig->render('logoff.html.twig', $data);
