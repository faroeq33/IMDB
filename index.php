<?php
require_once 'init.php';

$pagetitle = 'Project OOPMovie';

echo $twig->render('home.html.twig', [
    'pageTitle' => $pagetitle
]);