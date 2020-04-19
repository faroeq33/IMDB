<?php
require_once '../init.php';

use IMDB\Models\Account as Account;
Use IMDB\Password as Password;
use IMDB\Dump as Dump;

if ( isset($_POST['account']) )
{
    $formField = $_POST['account'];// Get all formfields, instead of foreaching each value

    $account = new Account(
        $formField['accountname'],
        $formField['password']
    );

    $account->register();

    $fetchedUsername = $account->findUser( $account->getUsername() );

    $successMessage = 'is succesvol aangemeld!';

    echo $twig->render('account.html.twig', [
        'userName' => $fetchedUsername['username'],
        'successMessage' => $successMessage
    ]);
}
else
{
    $errorMessage = [
        'errorMessage' => 'Vul alle velden in!'
    ];

    echo $twig->render('account.html.twig', $errorMessage);
}