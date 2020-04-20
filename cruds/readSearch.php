<?php
require_once "../init.php";

use IMDB\Models\Movie as Movie;
use IMDB\Dump as Dump;

if ( isset( $_GET['title'] ) )
{
    $formfieldTitle = $_GET['title'];

    $movie = new Movie($formfieldTitle);
    $movie->setMovieProperties();

    $movieInfo = [
        'Title'         => $movie->Title,
        'Year'          => $movie->Year,
        'Rated'         => $movie->Rated,
        'Released'      => $movie->Released,
        'Runtime'       => $movie->Runtime,
        'Genre'         => $movie->Genre,
        'Director'      => $movie->Director,
        'Writer'        => $movie->Writer,
        'Actors'        => $movie->Actors,
        'Plot'          => $movie->Plot,
        'Language'      => $movie->Language,
        'Country'       => $movie->Country,
        'Awards'        => $movie->Awards,
        'Poster'        => $movie->Poster,
        'Ratings'       => $movie->Ratings,
        'Metascore'     => $movie->Metascore,
        'imdbRating'    => $movie->imdbRating,
        'imdbVotes'     => $movie->imdbVotes,
        'imdbID'        => $movie->imdbID,
        'Type'          => $movie->Type,
        'DVD'           => $movie->DVD,
        'BoxOffice'     => $movie->BoxOffice,
        'Production'    => $movie->Production,
        'Website'       => $movie->Website
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
