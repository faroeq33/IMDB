<?php
require __DIR__.'/vendor/autoload.php';
require_once 'loader.php';

use IMDB\JsonConversion as JsonConversion;

$formfieldTitle = $_POST['title'];

$movie = new JsonConversion($formfieldTitle);
$movie->replaceChars();

$movie->setUrl("http://www.omdbapi.com/?apikey=186be766&t=");

$json = $movie->getInfo();

$movieInfoInPHP = $movie->conversion($json);

echo $twig->render('search-result.html.twig', $movieInfoInPHP);
