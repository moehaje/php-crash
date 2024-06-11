<?php

namespace Core;

class Validator {
    public static function string($value, $min = 1, $max = INF): bool
    {
        $value = trim($value);

        // strlen() is for string length
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function greaterThan(int $value, int $greaterThan): bool
    {
        return $value > $greaterThan;
    }
}