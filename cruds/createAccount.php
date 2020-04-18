<?php
require_once '../init.php';

use IMDB\Models\User as User;
Use IMDB\Password as Password;
use IMDB\Dump as Dump;

if ( isset($_POST['user']) )
{
    $formField = $_POST['user'];// Get all formfields, instead of foreaching each value

    $user = new User(
        $formField['username'],
        $formField['password']
    );

    $user->register();

    $fetchedUsername = $user->findUser( $user->getUsername() );

    $successMessage = 'is succesvol aangemeld!';

    echo $twig->render('user.html.twig', [
        'userName' => $fetchedUsername['username'],
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