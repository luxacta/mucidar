<?php

namespace App\Core;

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

class Router
{
  protected $routes = [];
  protected $middleware = [];

  /**
   * Add a new route to the router.
   */
  public function addRoute($method, $path, $controller, $action)
  {
    $this->routes[] = [
      'method' => $method,
      'path' => $path,
      'controller' => $controller,
      'action' => $action,
      'middleware' => $this->middleware,
    ];

    // Reset middleware after adding the route
    $this->middleware = [];
    return $this; // For method chaining
  }

  /**
   * Apply middleware based on authentication type.
   */
  public function auth($type)
  {
    $middlewareClass = ($type === 'guest') ? GuestMiddleware::class : AuthMiddleware::class;
    $this->middleware[] = new $middlewareClass();
    return $this;
  }

  /**
   * Run the router and match routes.
   */
  public function run()
  {
    $url = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $method = $_SERVER['REQUEST_METHOD'];

    foreach ($this->routes as $route) {
      $pattern = $this->buildRegex($route['path']);

      // Match the current URL and method
      if ($route['method'] === $method && preg_match($pattern, $url, $params)) {
        // Run any assigned middleware
        foreach ($route['middleware'] as $middleware) {
          $middleware->handle();
        }

        // Resolve the controller and action dynamically
        $controllerClass = "App\\Controllers\\" . $route['controller'];
        $action = $route['action'];

        if (class_exists($controllerClass) && method_exists($controllerClass, $action)) {
          $controller = new $controllerClass();
          // Call the action with parameters
          $controller->$action(...array_slice($params, 1));
        } else {
          // Handle 404 if the controller or action is not found
          $this->abort(404);
        }
        return;
      }
    }

    // If no matching route is found, abort with a 404
    $this->abort(404);
  }

  /**
   * Build a regex pattern from the route string.
   */
  protected function buildRegex($route)
  {
    // Handle optional numeric parameters (e.g., :num?)
    $pattern = preg_replace('/:\w+\(num\)\?/', '(?:\d+)?', $route);

    // Handle required numeric parameters (e.g., :num)
    $pattern = preg_replace('/:\w+\(num\)/', '\d+', $pattern);

    // Handle required named parameters (e.g., :username)
    $pattern = preg_replace('/:\w+/', '([^/]+)', $pattern);

    // Handle optional named parameters (e.g., :username?)
    $pattern = preg_replace('/:\w+\?/', '(?:([^/]+))?', $pattern);

    // Return the regex pattern with optional trailing slash support
    return "#^" . rtrim($pattern, '/') . "/?$#";
  }

  /**
   * Abort the current request with a given status code.
   */
  protected function abort($statusCode = 404)
  {
    http_response_code($statusCode);
    require "../app/Views/errors/{$statusCode}.php";
    exit; // Stop further execution
  }
}