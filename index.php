<?php
session_start();
require_once 'init.php';

echo $twig->render('core.html.twig');