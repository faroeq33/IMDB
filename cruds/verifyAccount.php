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
    );// TODO: hier een static van maken

    if ( $UserVerified )
    {
        Session::setUsername( $account->getUsername() );
        Session::logOn();

        $data = [
            'succesMessage' => 'is ingelogd!',
            'pagetitle' => 'Inloggen'
            ];

        echo $twig->render('account.html.twig', $data);
    }
    else
    {
        $data = [
            'errorMessage' => 'Wachtwoord klopt niet!'
        ];

        echo $twig->render('account.html.twig', $data);
    }

}
else
{
    $data = [
        'errorMessage' => 'Vul alle velden in!',
        'pageTitle' => 'Verify Account'
    ];

    echo $twig->render('account.html.twig', $data);
}