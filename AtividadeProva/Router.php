<?php

class Router {
    private $routes = [];

    public function addRoute($method, $path, $callback) {
        $this->routes[] = [
            "method" => $method,
            "path" => $path,
            "callback" => $callback
        ];
    }

    public function handleRequest() {
        $requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestedMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['path'] === $requestedPath && $route['method'] === $requestedMethod) {
                call_user_func($route['callback']);
                return;
            }
        }

        // Default 404 response
        http_response_code(404);
        echo "Route not found";
    }
}

foreach ($this->routes as $route) {
    $pattern = preg_replace('/\{[^\}]+\}/', '([^/]+)', $route['path']);
    if (preg_match('#^' . $pattern . '$#', $requestedPath, $matches) && $route['method'] === $requestedMethod) {
        array_shift($matches);
        call_user_func_array($route['callback'], $matches);
        return;
    }
}