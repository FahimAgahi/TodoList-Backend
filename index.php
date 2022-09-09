<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

use CRUD\Controller\Controller;

include("loader.php");

$controller = new Controller();

$uri = str_replace('/CRUD/', "/", explode("?", $_SERVER['REQUEST_URI'])[0]);

$controller->switcher($uri, $_REQUEST);
