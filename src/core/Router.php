<?php

namespace App\Core;

use App\Core\Auth;

class Router {
  private static $basePath;
  private static $routes = [];
  private static $protectedRoutes = [];

  // Static method to initialize the router
  public static function init() {
    self::$basePath = $_ENV['APP_NAME'] . '/';
  }

  // Static method to add a route
  public static function addRoute($path, $action, $protected = false) {
    // Ensure the action is callable (controller method or function)
    if (is_callable($action)) {
      self::$routes[$path] = $action;

      // Add to protected routes if it's a protected route
      if ($protected) {
        self::$protectedRoutes[] = $path;
      }
    } else {
      throw new \Exception("Action for route '$path' is not callable.");
    }
  }

  // Static method to resolve the current route
  public static function resolve() {
    if (empty(self::$routes)) {
      self::init();
    }

    // Get the request URI and remove the base path
    $requestUri = trim($_SERVER['REQUEST_URI'], '/');
    $path = str_replace(self::$basePath, '', $requestUri);
    $path = parse_url($path, PHP_URL_PATH);

    // Check if the path exists in the defined routes or load 404
    if (array_key_exists($path, self::$routes)) {
      $appName = $_ENV['APP_NAME'];

      // Check if the route is the login page
      if ($path == 'admin/login') {
        $auth = new Auth();
        if ($auth->isLoggedIn()) {
          // Redirect to dashboard or homepage if user is already logged in
          header("Location: /$appName/admin");
          exit;
        }
      }

      // Check if the route is protected
      if (in_array($path, self::$protectedRoutes)) {
        $auth = new Auth();
        if (!$auth->isLoggedIn()) {
          // Redirect to login page if not authenticated
          echo
          header("Location: /$appName/admin/login");
          exit;
        }
      }

      // Call the action (controller method or function)
      $callback = self::$routes[$path];

      // Check if the callback is a valid array (controller method)
      if (is_array($callback) && count($callback) == 2) {
        if (class_exists($callback[0]) && method_exists($callback[0], $callback[1])) {
          // If it's a valid controller method, call it
          call_user_func($callback);
        } else {
          http_response_code(404);
          echo "Controller or method not found!";
        }
      } else {
        // If it's not an array or not a valid method, call the function
        call_user_func($callback);
      }
    } else {
      // If route not found, show 404
      http_response_code(404);
      call_user_func(self::$routes['404']);
    }
  }
}
