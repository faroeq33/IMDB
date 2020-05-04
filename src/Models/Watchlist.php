<?php


namespace IMDB\Models;

use IMDB\Database as Database;
use IMDB\Models\Movie as Movie;
use IMDB\Dump as Dump;
use PDOException;

class Watchlist
{
    private $username;
    public  $watchlistItems;

    /**
     * Watchlist constructor.
     * @param $fromUsername
     */
    public function __construct( $fromUsername )
    {
        $this->username = $fromUsername;
    }

    /**
     * @param $imdbId
     */
    public function addToWatchlist($imdbId )
    {
        try {
            $database = new Database();

            $sql = "INSERT INTO watchlist (account_username, movie_imdb_id) VALUES ( :username, :imdb_id);";
            $database->query($sql);
            $database->bind(":username", $this->username);
            $database->bind(":imdb_id", $imdbId);
            $database->resultSet();

        } catch (PDOException $e) {

            echo "error";
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    /**
     * @param $imdbId
     */
    public function updateMovieToWatched( $imdbId )
    {
        try {
            $database = new Database();

            $sql = "UPDATE watchlist SET is_watched = 1 WHERE movie_imdb_id = :imdbId AND account_username = :username;";
            $database->query($sql);
            $database->bind(":imdbId", $imdbId);
            $database->bind(":username", $this->username);
            $database->resultSet();

        } catch (PDOException $e) {

            echo "error";
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    /**
     * @param $fromThisImdbId
     * @param $withThisRating
     */
    public function updateWatchlistRating( $fromThisImdbId, $withThisRating )
    {
        try {
            $database = new Database();

            $sql = "UPDATE watchlist SET rating =:rating WHERE (account_username = :username) AND (movie_imdb_id = :imdbid)";
            $database->query($sql);
            $database->bind(":rating", $withThisRating);
            $database->bind(":username", $this->username);
            $database->bind(":imdbId", $fromThisImdbId);
            $database->resultSet();

        } catch (PDOException $e) {

            echo "error";
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    private function setAllWatchListMovies()
    {
        try {
            $database = new Database();

            // TODO: query testen in phpMyAdmin
            $sql = "SELECT movie_imdb_id, is_watched, rating FROM watchlist WHERE account_username = :username";
            $database->query($sql);
            $database->bind(":username", $this->username);
            $this->watchlistItems = $database->resultSetAll();
        } catch (PDOException $e) {

            echo "error";
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    private function setMoviesWatched()
    {
        try {
            $database = new Database();

            // TODO: query testen in phpMyAdmin
            $sql = 'SELECT movie_imdb_id, is_watched, rating FROM watchlist WHERE account_username = :username AND is_watched = "1"';
            $database->query($sql);
            $database->bind(":username", $this->username);
            $this->watchlistItems = $database->resultSetAll();
        } catch (PDOException $e) {

            echo "error";
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    private function setMoviesToBeWatched(){
        try {
            $database = new Database();

            // TODO: query testen in phpMyAdmin
            $sql = "SELECT movie_imdb_id, is_watched, rating FROM watchlist WHERE account_username = :username AND is_watched = 0";
            $database->query($sql);
            $database->bind(":username", $this->username);
            $this->watchlistItems = $database->resultSetAll();
        } catch (PDOException $e) {

            echo "error";
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    private function setWatchlistMovies()
    {
        $rawWatchlistItems = $this->watchlistItems;

        $watchlist = [];

        foreach( $rawWatchlistItems as $watchlistMovie ) {
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

            $watchlist[] = $movie; //Stores the movie array in the watchlist array
        }
        $this->watchlistItems = $watchlist;
    }

    /**
     * @return mixed
     */

    public function getAllWatchlistMovies()
    {
        $this->setAllWatchListMovies();
        $this->setWatchlistMovies();

        return $this->watchlistItems;
    }


    public function getWatchedMovies()
    {
        $this->setMoviesWatched();
        $this->setWatchlistMovies();

        return $this->watchlistItems;
    }

    public function getMoviesToBeWatched()
    {
        $this->setMoviesToBeWatched();
        $this->setWatchlistMovies();

        return $this->watchlistItems;
    }


}