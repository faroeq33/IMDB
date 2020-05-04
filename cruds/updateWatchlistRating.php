<?php
require_once "../init.php";

use IMDB\Models\Watchlist as Watchlist;
use IMDB\Dump as Dump;
use IMDB\Session as Session;

if (  isset( $_POST['rating'] ) )
{
    $withThisRating = $_POST['rating'];
    $fromThisMovie = $_POST['movie'];
    $fromThisUsername = Session::getUsername();

    $watchlist = new Watchlist( $fromThisUsername );



        // ga naar watchlist.php/ model om de methode te schrijven voor wijzigen van rating
    //methode uitvoeren voor het wijzigen van de rating
    $watchlist->updateWatchlistRating($fromThisMovie, $withThisRating);

    Dump::varDump($watchlist, true);

//    $data = [
//        'watchlist' => $watchlist->getWatchedMovies(),
//        'pageTitle' => 'Bekeken films'
//    ];

//    echo $twig->render('watchlist.html.twig', $data);
}
else
{
    $data = [
        'errorMessage' => 'Geen rating doorgegeven!',
        'pageTitle' => 'Er ging iets mis...'
    ];

    echo $twig->render('watchlist.html.twig', $data);
}
