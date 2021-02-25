<?php
/* loader settings */
define('ROOTPATH', '/portfolio/projects/oopmovie/');
$loader = new \Twig\Loader\FilesystemLoader('../views');

$twig = new \Twig\Environment($loader, [
    'debug' => true
]);

$twig->addExtension(new \Twig\Extension\DebugExtension());
/* loader settings  */



/* functions*/
$cssPathFunction = new \Twig\TwigFunction('css', function ($nameStylesheet) {
    return "http://localhost/IMDB/assets/css/" . $nameStylesheet;
});
$twig->addFunction($cssPathFunction);

$imgPathFunction = new \Twig\TwigFunction('img', function ($nameStylesheet) {
    return "http://localhost/IMDB/assets/css/" . $nameStylesheet;
});
$twig->addFunction($imgPathFunction);
/* functions */


//globals
$twig->addGlobal('root', ROOTPATH);
$twig->addGlobal('session', $_SESSION);
