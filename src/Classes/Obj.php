<?php

namespace Hexlet\Php;

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}
use Hexlet\PHP\ObjInterface;
use ArrayAccess;

class Obj implements ObjInterface, ArrayAccess
{
    public $container = [];

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    public function __set($name, $value)
    {
        $this->container[$name] = $value;
        return $this->container;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->container)) {
            if (is_array($this->container[$name])) {
                // Создаем новый объект, клонируя текущий и заменяя контейнер
                $newObj = clone $this;
                $newObj->container = &$this->container[$name];
                return $newObj;
            } else {
                return $this->container[$name];
            }
        }
        return null;
    }
}
$items = [
    'key' => 'value',
    'key2' => [
        'key3' => 'value3'
    ]
];
$obj = new Obj($items);
echo "Должно быть TRUE\n";
var_dump('value' == $obj->key);
echo "Должно быть TRUE\n";
var_dump('value3' == $obj->key2->key3);
echo "Должно быть TRUE\n";
var_dump('value' == $obj['key']);
echo "Должно быть TRUE\n";
var_dump('value3' == $obj['key2']['key3']);
echo "Должно быть TRUE\n";
var_dump(null == $obj->key2->key1);
echo "Должно быть TRUE\n";
var_dump(null == $obj['kei']);

$obj->key = 'another value';
echo "Должно быть TRUE\n";
var_dump('another value' === $obj->key);
echo "Должно быть TRUE\n";
var_dump('another value' === $obj['key']);

$obj->key2->key3 = 'lolo';
echo "Должно быть TRUE\n";
var_dump('lolo' === $obj->key2->key3);
echo "Должно быть TRUE\n";
var_dump('lolo' === $obj['key2']['key3']);
