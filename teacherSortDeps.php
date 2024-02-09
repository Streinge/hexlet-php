<?php

namespace Hexlet\Php;

// BEGIN
function sortDeps(array $deps)
{
    $add = function ($acc, $node) use (&$add, $deps) {
        var_dump($acc);
        var_dump($node);
        $subDeps = $deps[$node] ?? [];

        $subAcc = array_reduce($subDeps, $add, []);

        $result = array_merge($acc, $subAcc);
        var_dump($result);
        $result[$node] = true;
        return $result;
    };
    // анонимная функция запускается без передачи параметров
    $set = array_reduce(array_keys($deps), $add, []);
    return array_keys($set);
}
// END

$deps1 = [
    'mongo' => [],
    'tzinfo' => ['thread_safe'],
    'uglifier' => ['execjs'],
    'execjs' => ['thread_safe', 'json'],
    'redis' => [],
];

$deps2 = [
    'wrong' => ['predicated', 'sexp_processor'],
    'xpath' => ['nokogiri'],
    'predicated' => ['htmlentities'],
    'sexp_processor' => [],
    'nokogiri' => ['wrong'],
    'virtus' => [],
];

$deps3 = [
    'wrong' => ['predicated', 'sexp_processor'],
    'xpath' => ['nokogiri'],
    'predicated' => ['htmlentities'],
    'sexp_processor' => [],
    'nokogiri' => ['wrong', 'libxml2'],
    'libxml2' => ['libxslt'],
    'virtus' => [],
];

$expected1 = ['mongo', 'thread_safe', 'tzinfo', 'json', 'execjs', 'uglifier', 'redis'];
$expected2 = ['htmlentities', 'predicated', 'sexp_processor', 'wrong', 'nokogiri', 'xpath', 'virtus'];
$expected3 = [
    'htmlentities',
    'predicated',
    'sexp_processor',
    'wrong',
    'libxslt',
    'libxml2',
    'nokogiri',
    'xpath',
    'virtus'
];

var_dump($expected1 === sortDeps($deps1));
//var_dump($expected2 === sortDeps($deps2));
//print_r(sortDeps($deps1));
//var_dump($expected3 === sortDeps($deps3));