<?php
namespace IMDB;

class JsonConversion
{
	private $input;
	private $url;
	private $info;

	public function __construct($input) {
		$this->input = $input;
	}

	public function setUrl($url){
		$this->url =  $url;
	}

	public function replaceChars(){
		$replaceChars = [' '];

		$cleanedInput = str_replace($replaceChars,'_', $this->input);
		$this->input = $cleanedInput;
	}

	public function getInfo(){
        $this->info = file_get_contents( $this->url . $this->input );

        return $this->info;
    }

	public function conversion($jsonCode){
		$this->info  = json_decode($this->info, true);// json to php array conversion

		return $this->info;
	}
}