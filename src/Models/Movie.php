<?php
namespace IMDB\Models;

use IMDB\JsonConversion as JsonConversion;
use IMDB\MovieHelper as MovieHelper;

class Movie
{
    private $imdbId;
    private $title;
    private $movieInfo;


    public function __construct( $titleOrImdbId )
    {
        if ( MovieHelper::isImdbId( $titleOrImdbId ) ) {
            $this->imdbId = $titleOrImdbId;
        }
        else {
            $cleanTitle = MovieHelper::replaceSpaces($titleOrImdbId);
            $this->title = $cleanTitle;
        }
    }

    /**
     * @param mixed $imdbId
     */
    public function setImdbId($imdbId): void
    {
        $this -> imdbId = $imdbId;
    }

    public function setMovieInfo()
    {
        $jsonConversion = new JsonConversion("http://www.omdbapi.com/?apikey=186be766&t=" , $this->title);
        $jsonConversion->convertToPHParray();
        $data = $jsonConversion->getData();

        $this->movieInfo = $data;
    }

    public function getMovieInfo()
    {
        return $this->movieInfo;

    }
}