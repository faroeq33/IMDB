<?php
require_once '../init.php';

use IMDB\User as User;

if ( isset($_POST['user']) )
{
    $formField = $_POST['user'];

    $user = new User(
        $formField['username'],
        $formField['password']
    );
}
else
{
    $errorMessage = [
        'errorMessage' => 'Er is iets misgegaan'
    ];

    echo $twig->render('search-result.html.twig', $errorMessage);
}


