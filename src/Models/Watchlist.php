<?php


namespace IMDB\Models;

use IMDB\Database as Database;
use PDOException;


class Watchlist
{
    public  $watchlistMovies;

    /**
     * @param $username
     * @param $imdbId
     */
    public function addToWatchlist($username, $imdbId ){
        try {
            $database = new Database();

            $sql = "INSERT INTO watchlist (account_username, movie_imdb_id) VALUES ( :username, :imdb_id);";
            $database->query($sql);
            $database->bind(":username", $username);
            $database->bind(":imdb_id", $imdbId);
            $database->resultSet();
        } catch (PDOException $e) {

            echo "error";
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    /**
     * @param $fromUsername
     * @return array
     */
    public function setMovies( $fromUsername ){
        try {
            $database = new Database();

            // TODO: query testen in phpMyAdmin
            $sql = "SELECT movie_imdb_id, is_watched, rating FROM watchlist WHERE account_username = :username";
            $database->query($sql);
            $database->bind(":username", $fromUsername);
            $this->watchlistMovies = $database->resultSetAll();
        } catch (PDOException $e) {

            echo "error";
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}