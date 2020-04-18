<?php
require_once "../init.php";

use IMDB\Models\Movie as Movie;

if ( isset( $_GET['title'] ) )
{
    $formfieldTitle = $_GET['title'];

    $movie = new Movie($formfieldTitle);
    $movie->setMovieInfo();
    $movieInfo = $movie->getMovieInfo();

    echo  $twig->render('searchresult.html.twig', $movieInfo);
}
else
{
    $errorMessage = [
        'errorMessage' => 'Er is iets misgegaan'
    ];

    echo $twig->render('searchresult.html.twig', $errorMessage);
}
