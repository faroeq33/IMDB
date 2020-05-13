<?php
require_once "../init.php";

use IMDB\Models\Movie as Movie;
use IMDB\Dump as Dump;

if ( isset( $_GET['title'] ) )
{
    $formfieldTitle = $_GET['title'];

    $movie = new Movie($formfieldTitle);

    $data = [
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
        'Website'       => $movie->Website,
        'Response'      => $movie->Response,
        'errorMessage' => 'Er is iets misgegaan'
    ];

    echo $twig->render('searchresult.html.twig', $data);
}
else
{
    $data = [
        'errorMessage' => 'Er is iets misgegaan, Geen film gevonden',
        'pageTitle' => 'Zoek film'
    ];

    echo $twig->render('searchresult.html.twig', $data);
}
