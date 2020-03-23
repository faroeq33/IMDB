<?php
namespace IMDB;

class JsonConversion
{
	private $input;
	private $url;
	private $json;
	private $data;

	public function __construct($url, $input) {
		$this->url = $url;
		$this->input = $input;
	}

	public function convertToPHParray( ){
        $jsonFileContents = file_get_contents( $this->url . $this->input );
        $phpFileContents = json_decode($jsonFileContents, true);// json to php array conversion

        $this->json = $jsonFileContents;
        $this->data = $phpFileContents;
		}

	public function getData(){
        return $this->data;
    }
}