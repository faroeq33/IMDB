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
    public $Response;

    private $value;
    private $error;

    /**
     * Movie constructor.
     * @param $value
     */
    public function __construct( $value )
    {
        $cleansedValue = MovieHelper::replaceSpaces($value);
        $this->value = $cleansedValue;
        $this->setMovieProperties();
    }


    /**
     * @return mixed
     */
    private function setMovieProperties()
    {
        $jsonUrl = MovieHelper::urlConfig($this->value);

        $jsonConversion = new JsonConversion($jsonUrl, $this->value);
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

    public function addMovieToDatabase(){
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


}
