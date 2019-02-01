<?php
use Helpers\Router;

$router = new Router();
$router->match($_SERVER['QUERY_STRING'], $_SERVER['REQUEST_METHOD']);
$router->execute();