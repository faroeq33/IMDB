<?php
session_start();
require_once '../init.php';

echo $twig->render('registrationform.html.twig');