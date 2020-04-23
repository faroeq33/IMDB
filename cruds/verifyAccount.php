<?php
require_once '../init.php';

use IMDB\Models\Account as Account;
use IMDB\Dump as Dump;
use IMDB\Session as Session;

if ( isset($_POST['account']) )
{
    $formField = $_POST['account'];//fetching all the fields instead of foreaching each value

    $account = new Account(
        $formField['username'],
        $formField['password']
    );

    $UserVerified = $account->verifyUser(
        $formField['username'],
        $formField['password']
    );

    if ( $UserVerified )
    {
        Session::setUsername( $account->getUsername() );
        Session::logOn();

        $successMessage = 'is ingelogd!';

        echo $twig->render('account.html.twig', [
            'succesMessage' => $successMessage
            ]);
    }
    else
    {
        $errorMessage = [
            'errorMessage' => 'Wachtwoord klopt niet!'
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