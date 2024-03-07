<?php

namespace Hexlet\Php;

interface EnumerableInterface
{
    public static function wrap($elements);
    public function where($key, $value);
    public function all();
}
