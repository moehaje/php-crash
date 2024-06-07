<?php

namespace Core;

use Core\Middleware\Auth;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;

class Router {
    protected $routes = [];

    public function add($method, $uri, $controller) {

        // compact() method will also be practical but too advanced! :)
        // compact will create the same associative array with the parameters of the function
        // so $this->routes[] = compact('method', 'uri', 'controller')

        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller) {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller) {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller) {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller) {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller) {
        return $this->add('PUT', $uri, $controller);
    }

    public function only($key) {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route($uri, $method) {
        foreach ($this->routes as $route) {
            if ($route['uri'] == $uri && $route['method'] == strtoupper($method)) {
                // apply the middleware
                // 1st way
//              if ($route['middleware'] === 'guest') {
//                  (new Guest)->handle();
//               }
//               if ($route['middleware'] === 'auth') {
//                   (new Auth)->handle();
//               }
                // 2nd better way
//              if ($route['middleware']) {
//                  $middleware = Middleware::MAP[$route['middleware']];
//                  (new $middleware)->handle();
//              }
                // 3rd better and cleaner way
                Middleware::resolve($route['middleware']);

                return require base_path($route['controller']);
            }
        }

        $this->abort();
    }

    protected function abort($code = 404){
        http_response_code($code);
        require base_path("views/{$code}.php");
        die();
    }
}