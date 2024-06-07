<?php

namespace Core;

class App {

    protected static $controller;

    public static function setContainer($container) {
        static::$controller = $container;
    }

    public static function container() {
        return static::$controller;
    }

    public static function bind($key, $resolver) {
        static::container()->bind($key, $resolver);
    }

    public static function resolve($key) {
        return static::container()->resolve($key);
    }
}