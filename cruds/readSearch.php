<?php
require_once "../init.php";

use IMDB\Models\Movie as Movie;
use IMDB\Dump as Dump;

if ( isset( $_GET['title'] ) )
{
    $formfieldTitle = $_GET['title'];

    $movie = new Movie($formfieldTitle);// TODO: Refactor to setMovieProperties
    $movie->setMovieProperties();

    $movieInfo = [
        'Title'   => $movie->Title,
        'Poster'  => $movie->Poster,
        'Plot'    => $movie->Plot,
        'Year'    => $movie->Year,
        'Rated'   => $movie->Rated,
        'Ratings' => $movie->Ratings,
    ];

    echo $twig->render('searchresult.html.twig', $movieInfo);
}
else
{
    $errorMessage = [
        'errorMessage' => 'Er is iets misgegaan'
    ];

    echo $twig->render('searchresult.html.twig', $errorMessage);
}
