<?php
require_once '../init.php';

use IMDB\Models\Account as Account;
Use IMDB\Password as Password;
use IMDB\Dump as Dump;

if ( isset($_POST['account']) )
{
    $formField = $_POST['account'];//fetching all the fields instead of foreaching each value

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
        $_SESSION['loggedIn'] = 1;
        $_SESSION['username'] = $user->getUsername();

        $successMessage = 'is ingelogd!';

        echo $twig->render('core.html.twig');
    }
    else
    {
        $errorMessage = [
            'errorMessage' => 'Wachtwoord klopt niet'
        ];

        echo $twig->render('account.html.twig', $errorMessage);
    }

}
else
{
    $errorMessage = [
        'errorMessage' => 'Vul alle velden in!'
    ];

    echo $twig->render('account.html.twig', $errorMessage);
}