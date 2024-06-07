<?php

namespace Core;

class Container {

    protected $bindings = [];

    // add function -> bind()
    public  function bind($key, $resolver) {
        $this->bindings[$key] = $resolver;
    }

    // remove function -> resolve()
    public  function resolve($key) {

        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception("No matching binding found for key {$key}");
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }
}