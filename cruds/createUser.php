<?php
require_once '../init.php';

use IMDB\Models\User as User;
Use IMDB\Password as Password;
use IMDB\Dump as Dump;

if ( isset($_POST['user']) )
{
    $formField = $_POST['user'];

    $user = new User(
        $formField['username'],
        $formField['password']
    );

    $user->register();

    $data = $user->findUser( $user->getUsername() );

    $successMessage = 'is succesvol aangemeld!';

    echo $twig->render('user.html.twig', [
        'data' => $data,
        'successMessage' => $successMessage
    ]);
}
else
{
    $errorMessage = [
        'errorMessage' => 'Vul alle velden in!'
    ];

    echo $twig->render('user.html.twig', $errorMessage);
}