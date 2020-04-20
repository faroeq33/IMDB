<?php
require_once "../init.php";

use IMDB\Models\Movie as Movie;
use IMDB\Models\Watchlist as Watchlist;
use IMDB\Dump as Dump;

if ( isset( $_GET['imdbID'] ) )
{
    $formfieldTitle = $_GET['imdbID'];

    $movie = new Movie($formfieldTitle);

    $movie->setMovieProperties();


    //TODO: maak een methode dat accountid ophaalt uit de database testen
    //TODO: maak een methode aan dat je accountid kunt weergeven
    //vang user id op om mee te geven in de add to watch list

    Dump::varDump($_SESSION, true);
    $movie->addMovie();
    $movie->addToWatchlist( $_SESSION['username']);

    //maak een showWatchList();

    echo  $twig->render('watchlist.html.twig');
}
else
{
    $errorMessage = [
        'errorMessage' => 'Er is iets misgegaan'
    ];

    // boven 
    echo $twig->render('watchlist.html.twig', $errorMessage);//twig template aanmaken
}
