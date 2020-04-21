<?php

/* loader settings */
$loader = new \Twig\Loader\FilesystemLoader('views','/opt/lampp/htdocs/IMDB');

$twig = new \Twig\Environment($loader, [
    'debug' => true
]);

$twig->addExtension(new \Twig\Extension\DebugExtension());
/* loader settings  */



/* functions*/
$cssPathFunction = new \Twig\TwigFunction('css', function ( $nameStylesheet ) {
    return "http://localhost/IMDB/assets/css/" . $nameStylesheet;
});
$twig->addFunction($cssPathFunction);

$imgPathFunction = new \Twig\TwigFunction('img', function ( $nameStylesheet ) {
    return "http://localhost/IMDB/assets/css/" . $nameStylesheet;
});
$twig->addFunction($imgPathFunction);
/* functions */


//globals
CONST ROOT = "http://localhost/IMDB/";
$twig->addGlobal('root', ROOT);
$twig->addGlobal('session', $_SESSION);
