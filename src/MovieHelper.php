<?php
namespace IMDB;
use IMDB\Database as Database;

class MovieHelper
{
    public static function urlConfig( $value ){
        $apiUrl = "http://www.omdbapi.com/?apikey=186be766";

        if ( $value[0] == "t" && $value[1] == "t" ) {
            $apiUrl = $apiUrl . "&i=";
            return $apiUrl;
        } else {
            $apiUrl = $apiUrl . "&t=";
            return $apiUrl;
        }
    }

    /**
     * @param $input
     * @return string|string[]
     */
    public static function replaceSpaces( $input )
    {
        return str_replace([' '],'_', $input);
    }

    public static function isImdbId( $input )
    {
        if ( preg_match("/^tt/", $input ) )
        {
            return true;
        }
    }

    /**
     * @param $withImdbId
     * @param $fromUsername
     * @return bool
     */

    public static function MovieExists(  $withImdbId, $fromUsername )
    {

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
    }
}