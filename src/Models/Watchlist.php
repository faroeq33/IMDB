<?php


namespace IMDB\Models;

use IMDB\Database as Database;
use PDOException;


class Watchlist
{
    private  $username;
    private  $watchlistItems;

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
    public function addToWatchlist($imdbId ){
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
     * @return void
     */
    private function setWatchlistItems(){
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

    /**
     * @return mixed
     */
    public function getWatchlistItems()
    {
        $this->setWatchlistItems();
        return $this -> watchlistItems;
    }
}