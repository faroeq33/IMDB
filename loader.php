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
    return WORKING_DIR . "assets/css/" . $nameStylesheet;
});
$twig->addFunction($cssPathFunction);

// custom functions
$pageFunction = new \Twig\TwigFunction('page', function ($page) {
    return  WORKING_DIR . $page . ".php";
});

$imgFunction = new \Twig\TwigFunction('img', function ($fileName) {
    $imgDir = "assets/img/";
    return $imgDir . $fileName;
});

$twig->addFunction($pageFunction);
$twig->addFunction($imgFunction);

$twig->addGlobal('rootFolder', WORKING_DIR);
/* functions */


//globals
$twig->addGlobal('root', ROOTPATH);
$twig->addGlobal('session', $_SESSION);
