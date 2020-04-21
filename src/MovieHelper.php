<?php
namespace IMDB;
use IMDB\Database as Database;

class MovieHelper
{
    public static function replaceSpaces( $input )
    {
        $replaceChars = [' '];
        return str_replace($replaceChars,'_', $input);
    }

    public static function isImdbId( $input )
    {
        if ( preg_match("/^tt/", $input ) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @param $withImdbId
     * @param $fromUsername
     * @return bool
     */

    public static function MovieExists(  $withImdbId, $fromUsername ){

        try {
            $database = new Database();

            $sql = "SELECT * FROM watchlist WHERE account_username LIKE :username AND movie_imdb_id LIKE :imdb_id";
            $database->query($sql);
            $database->bind(":username", $fromUsername);
            $database->bind(":imdb_id", $withImdbId);
            $fetchedMovieAndUser = $database->resultSet();

            if ( !empty( $fetchedMovieAndUser ) ) {
                return true;
            }

            if ( empty( $fetchedMovieAndUser ) ) {
                return false;
            }
        } catch (PDOException $e) {

            echo "error";
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}