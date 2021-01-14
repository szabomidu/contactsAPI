<?php
require "src/Router/Router.php";

use src\Router\Router;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($uri[1] !== 'contacts') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$contactId = null;
if (isset($uri[2])) {
    $contactId = (int) $uri[2];
}
$router = new Router();
echo json_encode($router->processRequest($requestMethod, $contactId));