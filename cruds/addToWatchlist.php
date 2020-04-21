<?php
require_once "../init.php";

use IMDB\Models\Movie as Movie;
use IMDB\Models\Watchlist as Watchlist;
use IMDB\Session as Session;
use IMDB\Dump as Dump;
use IMDB\MovieHelper as MovieHelper;

if ( isset( $_GET['imdbID']) && isset( $_SESSION['username'] ) )
{
    $formfieldTitle = $_GET['imdbID'];
    $fromThisUsername = $_SESSION['username'];

    $movie = new Movie($formfieldTitle);

    $movie->addMovieToDatabase();


    if ( ! MovieHelper::MovieExists( Session::getUsername(), $_GET['imdbID'] ) ) {
        $watchlist = new Watchlist();
        $watchlist->addToWatchlist($fromThisUsername, $_GET['imdbID']);

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
        'errorMessage' => 'Geen film gevonden en/of username!'
    ];

    // boven
    echo $twig->render('watchlist.html.twig', $errorMessage);//twig template aanmaken
}
