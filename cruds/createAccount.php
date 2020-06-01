<?php
require_once '../init.php';

use IMDB\Models\Account as Account;
use IMDB\Dump as Dump;
use IMDB\Session;

if ( isset($_POST['account']) )
{
    $formField = $_POST['account'];// Get all formfields, instead of foreaching each value

    $account = new Account(
        $formField['username'],
        $formField['password']
    );
    $account->register();

    $fetchedUsername = $account->findUser( $account->getUsername() );

    $data = [
        'pageTitle' => 'create account',
        'buttonMessage' => 'Inloggen',
        'message' => 'Je account is aangemaakt!',
        'buttonLink' => 'cruds/showLoginForm.php'
    ];

    echo $twig->render('account.html.twig', $data);
}
else
{
    $data = [
        'errorMessage' => 'Vul alle velden in!',
        'pageTitle' => 'Er ging iets mis'
    ];

    echo $twig->render('error.html.twig', $data);
}