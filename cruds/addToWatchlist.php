<?php
require_once "../init.php";

use IMDB\Models\Movie as Movie;
use IMDB\Models\Watchlist as Watchlist;
use IMDB\Session as Session;
use IMDB\Dump as Dump;
use IMDB\MovieHelper as MovieHelper;

if ( !is_null( $_GET['imdbID']) && !is_null( $_SESSION['username'] ) )
{
    $imdbID = $_GET['imdbID'];
    $fromThisUsername = $_SESSION['username'];

    $movie = new Movie( $imdbID );

    $movie->addMovieToDatabase();


    if ( ! MovieHelper::MovieExists( $imdbID, $fromThisUsername ) )
    {
        $watchlist = new Watchlist( $fromThisUsername );
        $watchlist->addToWatchlist( $imdbID );

        $succesMessage =  ' is toegevoegd aan Mijn Films!';

        echo $twig->render('watchlist.html.twig', [
            'succesMessage' => $succesMessage,
            'movieTitle' => $movie->Title,
        ]);
    }
    else
    {
        $errorMessage =  ' is al toegevoegd!';

        echo $twig->render('watchlist.html.twig', [
            'errorMessage' => $errorMessage,
            'movieTitle' => $movie->Title,
        ]);
    }
}
else
{
    $errorMessage = [
        'errorMessage' => 'Geen film en/of username gevonden!'
    ];

    // boven
    echo $twig->render('watchlist.html.twig', $errorMessage);//twig template aanmaken
}
