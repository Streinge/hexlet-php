<?php

namespace Hexlet\Php;

interface ObjInterface
{
    public function __get($key);
    public function __set($key, $value);
}
