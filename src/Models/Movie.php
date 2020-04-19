<?php
namespace IMDB\Models;

use IMDB\Dump;
use IMDB\JsonConversion as JsonConversion;
use IMDB\MovieHelper as MovieHelper;
use IMDB\Models\Movie as Mov;

/**
 * Class Movie
 * @package IMDB\Models
 */
class Movie
{
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

    /**
     * Movie constructor.
     * @param $titleOrImdbId
     */
    public function __construct($titleOrImdbId )
    {
        if ( MovieHelper::isImdbId( $titleOrImdbId ) ) {
            $this->imdbID = $titleOrImdbId;
        }
        else {
            $cleanTitle = MovieHelper::replaceSpaces($titleOrImdbId);
            $this->Title = $cleanTitle;
        }
    }


    /**
     * @return mixed
     */
    public function setMovieProperties()
    {
        $jsonConversion = new JsonConversion("http://www.omdbapi.com/?apikey=186be766&t=" , $this->Title);
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
}
