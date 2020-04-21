<?php
require_once "../init.php";

use IMDB\Models\Movie as Movie;
use IMDB\Models\Watchlist as Watchlist;
use IMDB\Dump as Dump;
use IMDB\Session as Session;

if (  !is_null( Session::getUsername() ) )
{
    $fromThisUsername = $_SESSION['username'];

    $watchlist = new Watchlist();


    $watchlist->setMovies( $fromThisUsername );
    $movieIDs = $watchlist->watchlistMovies;// TODO: bekijk of getWatchlistMovies wel werkt


    // foreach movieIds as movieid

//    Dump::varDump($movieIDs, true);
//    global $movies;
//
//    foreach ( )
//    // film gegeven ophalen met een foreach want elke film moet gevult worden met properties
//    echo $twig->render('watchlist.html.twig');
}
else
{
    $errorMessage = [
        'errorMessage' => 'Geen films in je lijst!'
    ];

    echo $twig->render('watchlist.html.twig', $errorMessage);//twig template aanmaken
}
