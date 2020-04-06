<?php
require_once "../init.php";

use IMDB\Movie as Movie;

if ( isset( $_GET['title'] ) )
{
    $formfieldTitle = $_GET['title'];

    $movie = new Movie($formfieldTitle);
    $movie->setMovieInfo();
    $movieInfo = $movie->getMovieInfo();

    echo  $twig->render('search-result.html.twig', $movieInfo);
}
else
{
    $errorMessage = [
        'errorMessage' => 'Er is iets misgegaan'
    ];

    echo $twig->render('search-result.html.twig', $errorMessage);
}
