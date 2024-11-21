<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

use App\Controllers\ExpensesController;
use App\Controllers\TripController;
use App\Router\Router;
require './vendor/autoload.php';

header("Content-type: application/json; charset=UTF-8");

$router = new Router();


$tripController = new TripController();
$expenseController = new ExpensesController();


$router->add('GET', '/trips', [$tripController, 'list']);
$router->add('GET', '/trips/{id}', [$tripController, 'getById']);
$router->add('POST', '/trips', [$tripController, 'create']);
$router->add('DELETE', '/trips/{id}', [$tripController, 'delete']);
$router->add('PUT', '/trips/{id}', [$tripController, 'update']);

$router->add('GET', '/expenses', [$expenseController, 'list']);
$router->add('GET', '/expenses/{id}', [$expenseController, 'getById']);
$router->add('POST', '/expenses', [$expenseController, 'create']);
$router->add('DELETE', '/expenses/{id}', [$expenseController, 'delete']);
$router->add('PUT', '/expenses/{id}', [$expenseController, 'update']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);
$requestedPath = "/" . $pathItems[1] . ($pathItems[2] ? "/" . $pathItems[2] : "");

$router->dispatch($requestedPath);