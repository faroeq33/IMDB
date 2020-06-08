<?php
require_once "../init.php";

use IMDB\Models\Watchlist as Watchlist;
use IMDB\Dump as Dump;
use IMDB\Session as Session;

if (  isset( $_SESSION['username'] ) )
{
    $fromThisUsername = Session::getUsername();

    $watchlist = new Watchlist( $fromThisUsername );
    $watchlist->setMoviesWatched();
    $watchlist->setWatchlistMovies();

    $data = [
        'watchlist' => $watchlist->getWatchlistMovies(),
        'pageTitle' => 'Bekeken films'
    ];

    echo $twig->render('watchlist.html.twig', $data);
}
else
{
    $data = [
        'errorMessage' => 'Je bent nog niet ingelogd!',
        'pageTitle' => 'Er ging iets mis'
    ];

    echo $twig->render('loginform.html.twig', $data);
}
