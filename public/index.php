<?php

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Core\Router;
use App\Core\ErrorHandler;

// Load the .env file
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$router = new Router();

try {
  // Load routes
  require '../config/routes.php';

  // Run the router
  $router->run();
} catch (\Throwable $e) {
  ErrorHandler::handle($e);
}