<?php
require_once "../init.php";

use IMDB\Models\Movie as Movie;
use IMDB\Models\Watchlist as Watchlist;
use IMDB\Dump as Dump;
use IMDB\Session as Session;

if (  isset( $_SESSION['username'] ) )
{
    $fromThisUsername = Session::getUsername();

    $rawWatchlist = new Watchlist( $fromThisUsername );

    $rawWatchlistMovies = $rawWatchlist->getWatchlistItems();

    $watchlist = [];// Rename this something that makes sense

    //maak een methode genaamd populate movies

    foreach($rawWatchlistMovies as $watchlistMovie ) {
        $newmovie = new Movie($watchlistMovie['movie_imdb_id']);

        $movie = [];//This represents a single movie thats about to be populated

        $movie['movie_imdb_id']    = $watchlistMovie['movie_imdb_id'];
        $movie['is_watched']       = $watchlistMovie['is_watched'];
        $movie['rating']           = $watchlistMovie['rating'];
        $movie['Title']         = $newmovie->Title;
        $movie['Year']          = $newmovie->Year;
        $movie['Rated']         = $newmovie->Rated;
        $movie['Released']      = $newmovie->Released;
        $movie['Runtime']       = $newmovie->Runtime;
        $movie['Genre']         = $newmovie->Genre;
        $movie['Director']      = $newmovie->Director;
        $movie['Writer']        = $newmovie->Writer;
        $movie['Actors']        = $newmovie->Actors;
        $movie['Plot']          = $newmovie->Plot;
        $movie['Language']      = $newmovie->Language;
        $movie['Country']       = $newmovie->Country;
        $movie['Awards']        = $newmovie->Awards;
        $movie['Poster']        = $newmovie->Poster;
        $movie['Ratings']       = $newmovie->Ratings;
        $movie['Metascore']     = $newmovie->Metascore;
        $movie['imdbRating']    = $newmovie->imdbRating;
        $movie['imdbVotes']     = $newmovie->imdbVotes;
        $movie['imdbID']        = $newmovie->imdbID;
        $movie['Type']          = $newmovie->Type;
        $movie['DVD']           = $newmovie->DVD;
        $movie['BoxOffice']     = $newmovie->BoxOffice;
        $movie['Production']    = $newmovie->Production;
        $movie['Website']       = $newmovie->Website;

        $watchlist[] = $movie;
    }

    echo $twig->render('watchlist.html.twig', [
        'watchlist' => $watchlist
    ]);
}
else
{
    $errorMessage = [
        'errorMessage' => 'Je bent nog niet ingelogd!'
    ];

    echo $twig->render('watchlist.html.twig', $errorMessage);//twig template aanmaken
}
