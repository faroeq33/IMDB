<?php
require_once "../init.php";

use IMDB\Models\Movie as Movie;

if ( isset( $_GET['imdbId'] ) )
{
    $formfieldTitle = $_GET['imdbId'];

    $movie = new Movie($formfieldTitle);

    //update movie op algezien zetten
    $movie->setMovieInfo();
    $movieInfo = $movie->getMovieInfo();

    //nieuwe twig maken met wensenlijst
    echo  $twig->render('watchlist.html.twig', $movieInfo);
}
else
{
    $errorMessage = [
        'errorMessage' => 'Er is iets misgegaan'
    ];

    // boven 
    echo $twig->render('watchlist.html.twig', $errorMessage);//twig template aanmaken
}
