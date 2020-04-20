<?php
namespace IMDB\Models;

use IMDB\Dump;
use IMDB\JsonConversion as JsonConversion;
use IMDB\MovieHelper as MovieHelper;
use IMDB\Database as Database;
use PDOException;

/**
 * Class Movie
 * @package IMDB\Models
 */
class Movie
{
    //The properties have to be named the same as the Json keys
    public $Title;
    public $Year;
    public $Rated;
    public $Released;
    public $Runtime;
    public $Genre;
    public $Director;
    public $Writer;
    public $Actors;
    public $Plot;
    public $Language;
    public $Country;
    public $Awards;
    public $Poster;
    public $Ratings;
    public $Metascore;
    public $imdbRating;
    public $imdbVotes;
    public $imdbID;
    public $Type;
    public $DVD;
    public $BoxOffice;
    public $Production;
    public $Website;

    private $isWatched;
    private $searchParam;
    private $error;

    /**
     * Movie constructor.
     * @param $titleOrImdbId
     */
    public function __construct( $titleOrImdbId )
    {
        if ( MovieHelper::isImdbId( $titleOrImdbId ) )
        {
            $this->imdbID = $titleOrImdbId;
        }
        else
        {
            $cleanTitle     = MovieHelper::replaceSpaces( $titleOrImdbId );
            $this->Title    = $cleanTitle;
        }
    }


    /**
     * @return mixed
     */
    public function setMovieProperties()
    {
        $jsonUrl = "http://www.omdbapi.com/?apikey=186be766";

        if (!is_null($this->Title) ){
            $this->searchParam = "&t=" . $this->Title;
        }

        if (!is_null($this->imdbID) ){
            $this->searchParam = "&i=" . $this->imdbID;
        }

        $jsonConversion = new JsonConversion($jsonUrl, $this->searchParam);
        $jsonConversion->convertToPHParray();
        $moviedata = $jsonConversion->getData();

        $classVarNames =  array_keys(
            get_class_vars(
                get_class( $this )
            )
        );

        $AmountOfClassVarNames = count($classVarNames);

        foreach ($moviedata as $movieproperty => $value)
        {
            for ($i=0; $i < $AmountOfClassVarNames ; $i++)
            {
                if ($movieproperty == $classVarNames[$i])
                {
                    $this->{$classVarNames[$i]} = $value;
                }
            }
        }
    }

    /**
     * @return mixed
     */
    public function getImdbID()
    {
        return $this -> imdbID;
    }


    public function addMovie(){
        try {
            $database = new Database();

            $sql = "INSERT INTO movie ( imdb_id ) VALUES ( :imdb_id )";
            $database->query($sql);
            $database->bind(":imdb_id", $this->imdbID);
            $database->resultSet();
        } catch (PDOException $e) {

            echo "error";
            echo 'Connection failed: ' . $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * @param $username
     */
    public function addToWatchlist( $username ){
        try {
            $database = new Database();

            $sql = "INSERT INTO watchlist (account_username, movie_imdb_id) VALUES ( :username, :imdb_id);";
            $database->query($sql);
            $database->bind(":username", $username);
            $database->bind(":imdb_id", $this->imdbID);
            $database->resultSet();
        } catch (PDOException $e) {

            echo "error";
            echo 'Connection failed: ' . $e->getMessage();
            echo $this->error;
        }
    }


    public function showMovies(){
        try {
            $database = new Database();

            $sql = "SELECT imdb_id FROM watchlist";
            $database->query($sql);
            $database->bind(":imdb_id", $this->imdbID);
            $database->resultSet();
        } catch (PDOException $e) {

            echo "error";
            echo 'Connection failed: ' . $e->getMessage();
            echo $this->error;
        }
    }

    /* TODO: isWatched testen
    public function isWatched(){
        try {
            $database = new Database();

            $sql = "UPDATE film SET ( is_watched = :$isWatched  )  ( :imdb_id )";
            $database->query($sql);
            $database->bind(":imdb_id", $this->imdbID);
            $database->resultSet();
        } catch (PDOException $e) {

            echo "error";
            echo 'Connection failed: ' . $e->getMessage();
            echo $this->error;
        }
    }
    */
}
