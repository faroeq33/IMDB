<?php
namespace IMDB;

class JsonConversion
{
    private $input;
    private $url;
    private $json;
    private $data;

    /**
     * JsonConversion constructor.
     * @param $url
     * @param $input
     */
    public function __construct($url, $input) {
        $this->url = $url;
        $this->input = $input;
    }

    public function convertToPHParray( ) {
        $jsonFileContents = file_get_contents( $this->url . $this->input );

        $this->json = $jsonFileContents;
        $this->data = json_decode($jsonFileContents, true);//phpFileContents
    }

    public function getData() {
        return $this->data;
    }
}