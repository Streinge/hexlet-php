<?php

namespace Hexlet\Php;

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

use Hexlet\Php\EnumerableInterface;

class Enumerable implements EnumerableInterface
{
    private $newElement;

    private function __construct($newElement)
    {
        $this->newElement = $newElement;
    }

    public static function wrap($newElement)
    {
        return new Enumerable($newElement);
    }

    public function where($key, $value)
    {
        $new =  array_values(array_filter($this->newElement, function ($item) use ($key, $value) {
            return $item[$key] === $value;
        }));
        return new Enumerable($new);
    }

    public function all()
    {
        return $this->newElement;
    }
}


$coll = Enumerable::wrap([]);
var_dump([] === $coll->all());
//var_dump($coll);
$elements = [
    ['key' => 'value'],
    ['key' => '']
];
$coll = Enumerable::wrap($elements);
//var_dump($coll);
$result = $coll->where('key', 'value');
$expected = [
    ['key' => 'value']
];

var_dump(($expected === $result->all())); //true
var_dump($elements === $coll->all()); //true

$elements2 = [
    ['key' => 'value', 'year' => 1932],
    ['key' => '', 'year' => 1100],
    ['key' => 'value', 'year' => 32]
];
$coll2 = Enumerable::wrap($elements2);
$result2 = $coll2->where('key', 'value');
var_dump($result2->all());
$expected2 = [
    ['key' => 'value', 'year' => 1932],
    ['key' => 'value', 'year' => 32]
];
var_dump($expected2 == $result2->all());
