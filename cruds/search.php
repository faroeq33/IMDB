<?php
require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ .'loader.php';

use IMDB\Movie as Movie;
use IMDB\Helper as Helper;

if ( isset( $_POST['title'] ) )
{

    $formfieldTitle = $_POST['title'];
    $cleanTitle = Helper::replaceChars($formfieldTitle);

    $movie = new Movie($cleanTitle);
    $movie -> setMovieInfo();
    $movieInfo = $movie -> getMovieInfo();

    echo $twig -> render('search-result.html.twig', $movieInfo);

}
else
{
    $errorMessage = [
        'errorMessage' => 'Er is iets misgegaan'
    ];

    echo $twig->render('search-result.html.twig', $errorMessage);
}
