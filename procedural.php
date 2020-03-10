<?php
//PROCEDUREEL

if(isset($_GET['title'])) //variablen URl balk
{
	$titleGET = $_GET['title']; //url balk of via Form


	//Bad Boys wordt Bad_Boys
	//replace spaces with underscores

	$json = file_get_contents('http://www.omdbapi.com/?t='.$titleGET.'&apikey=186be766'); //API

	$data = json_decode($json,true); //conversie naar PHP array

	$movieObject = $data['Poster']; //returnt jpg

	if(empty($movieObject))
	{
		error_reporting(0);
		echo"Geen bestaande film in IMDB.com";
	}

	echo '<img src=" '.$movieObject.' " /> <br /><br/>';
	//echo"<h1>Schrijver: ".$movieObject. "</h1>";
	echo '<button>Toevoegen aan WatchList</button>';

	//print_r($movieObject);
}
else
{
	echo"Geef een title mee aan de API!";
}


?>