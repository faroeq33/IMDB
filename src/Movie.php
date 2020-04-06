<?php
namespace IMDB;

use IMDB\JsonConversion as JsonConversion;
use IMDB\MovieHelper as MovieHelper;

class Movie
{
    private $title;
    private $movieInfo;

    public function __construct($title)
    {
        $cleanTitle = MovieHelper::replaceSpaces($title);
        $this->title = $cleanTitle;
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