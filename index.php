<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

use CRUD\Controller\Controller;

include ("loader.php");

$controller = new Controller();

$uri = str_replace('/CRUD/' , "/", explode("?",$_SERVER['REQUEST_URI'])[0]);

$controller->switcher($uri, $_REQUEST);
