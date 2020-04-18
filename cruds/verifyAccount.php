<?php
require_once '../init.php';

use IMDB\Models\Account as User;
Use IMDB\Password as Password;
use IMDB\Dump as Dump;

if ( isset($_POST['user']) )
{
    $formField = $_POST['user'];//fetching all the fields instead of foreaching each value

    $user = new Account(
        $formField['username'],
        $formField['password']
    );

    $UserVerified = $user->verifyUser(
        $formField['username'],
        $formField['password']
    );

    if ( $UserVerified )
    {
        $_SESSION['loggedIn'] = true;
        $_SESSION['userName'] = $user->getUsername();

        $successMessage = 'is succesvol aangemeld!';

        echo $twig->render('user.html.twig', [
            'userName' => $user->getUsername(),
            'successMessage' => $successMessage
        ]);
    }
    else
    {
        $errorMessage = [
            'errorMessage' => 'Wachtwoord klopt niet'
        ];

        echo $twig->render('user.html.twig', $errorMessage);
    }







}
else
{
    $errorMessage = [
        'errorMessage' => 'Vul alle velden in!'
    ];

    echo $twig->render('user.html.twig', $errorMessage);
}