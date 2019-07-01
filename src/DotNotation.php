<?php

namespace App;

class DotNotation
{
    /**
     * Get a value from an associative array, through dot notation syntax
     * 
     * e.g. get(['hello' => ['world' => true]], 'hello.world') // true
     */
    public static function get(array $array, string $key, $default = null)
    {
        foreach (explode('.', $key) as $segment) {
            if (array_key_exists($segment, $array)) {
                $array = $array[$segment];
            } else {
                return $default;
            }
        }

        // we have the final value
        return $array;
    }
}