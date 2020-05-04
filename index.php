<?php
require_once 'init.php';

$pagetitle = 'Project OOPMovie';

echo $twig->render('core.html.twig', [
    'pageTitle' => $pagetitle
]);