<?php

namespace Core\Middleware;

class Middleware {
    public const MAP = [
        'guest' => GUEST::class,
        'auth' => AUTH::class,
    ];

    public static function resolve($key) {

        if (!$key) {
            return;
        }

        $middleware = static::MAP[$key] ?? false;

        // if providing a wrong middleware key!
        if (!$middleware) {
            throw new \Exception("No middleware key for '{$key}' was found");
        }

        (new $middleware)->handle();
    }
}