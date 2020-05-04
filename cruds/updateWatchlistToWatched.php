<?php
require_once "../init.php";

use IMDB\Models\Watchlist as Watchlist;
use IMDB\Dump as Dump;
use IMDB\Session as Session;

if (  isset( $_SESSION['username'] ) )
{
    $fromThisUsername = Session::getUsername();
    $fromThisMovie =  $_GET['movie']; // TODO: nog invullen vanaf de form

    $watchlist = new Watchlist( $fromThisUsername );

    $watchlist->updateMovieToWatched( $fromThisMovie );// wijzig deze methode

    $moviesToBeWatched = $watchlist->getMoviesToBeWatched();

    $data = [
        'watchlist' => $moviesToBeWatched,
        'pageTitle' => 'Mijn films',
        'succesMessage' => 'Film is toegevoegd aan : Mijn Bekeken Films'
    ];

    echo $twig->render('watchlist.html.twig' , $data);
}
else
{
    $data = [
        'errorMessage' => 'Je bent nog niet ingelogd!',
        'pageTitle' => 'Er ging iets mis'
    ];

    echo $twig->render('watchlist.html.twig', $data);//twig template aanmaken
}
