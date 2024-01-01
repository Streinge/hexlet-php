<?php

require_once 'Map.php';

use function Hexlet\Php\make;
use function Hexlet\Php\get;
use function Hexlet\Php\set;

$map = make();
$result = get($map, 'key');
var_dump($result);
// $this->assertNull($result);
$result = get($map, 'key', 'value');
var_dump($result);
// $this->assertEquals('value', $result);
set($map, 'key2', 'value2');
$result = get($map, 'key2');
var_dump($result);
// $this->assertEquals('value2', $result);
set($map, 'key2', 'another value');
$result = get($map, 'key2');
var_dump($result);
// $this->assertEquals('another value', $result);
echo "ВАРИАНТ С КОЛИИЗИЕЙ \n";
$map = make();

set($map, 'aaaaa0.462031558722291', 'vvv');
set($map, 'aaaaa0.0585754039730588', 'boom!');

$result = get($map, 'aaaaa0.462031558722291');
var_dump($result);
// $this->assertEquals('vvv', $result);
$result = get($map, 'aaaaa0.0585754039730588');
//$this->assertNull($result);
var_dump($result);
set($map, 'aaaaa0.462031558722291', 'wop');
$result = get($map, 'aaaaa0.462031558722291');
var_dump($result);
//$this->assertEquals('wop', $result);
