<?php

use App\Router;
use App\Db;
use App\Session;
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';

Session::start();

define('ROOT', dirname(__FILE__));

$route = new Router();
$route->run();

Db::connect();
?>