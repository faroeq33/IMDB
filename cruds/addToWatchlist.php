<?php
require_once "../init.php";

use IMDB\Models\Movie as Movie;
use IMDB\Models\Watchlist as Watchlist;
use IMDB\Session as Session;
use IMDB\Dump as Dump;
use IMDB\MovieHelper as MovieHelper;

if ( !is_null( $_GET['imdbID']) && isset( $_SESSION['username'] ) )
{
    $imdbID = $_GET['imdbID'];
    $fromThisUsername = $_SESSION['username'];

    $movie = new Movie( $imdbID );

    $movie->addMovieToDatabase();

    if ( ! MovieHelper::MovieExists( $imdbID, $fromThisUsername ) )
    {
        $watchlist = new Watchlist( $fromThisUsername );
        $watchlist->addToWatchlist( $imdbID );

        $data = [
            'pageTitle' => 'Filmtoevoegen',
            'succesMessage' => ' is toegevoegd aan Mijn Films!',
            'movieTitle' => $movie->Title,
        ];

        echo $twig->render( 'watchlist.html.twig', $data );
    }
    else
    {
        $data = [
            'pageTitle' => 'Filmtoevoegen',
            'errorMessage' => ' is al toegevoegd!',
            'movieTitle' => $movie->Title
        ];

        echo $twig->render('watchlist.html.twig', $data);
    }
}
else
{
    $data = [
        'pageTitle' => 'Filmtoevoegen',
        'errorMessage' => 'Geen film en/of username gevonden! Je moet een account hebben om een film toe te voegen.'
    ];

    // boven
    echo $twig->render('watchlist.html.twig', $data);//twig template aanmaken
}
