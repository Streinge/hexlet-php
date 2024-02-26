<?php

namespace Hexlet\Php;

function dfs($parents, $listDeps, &$list, &$stack)
{
    //echo "Это номер запуска = " . $count . " \n";
    //var_dump($stack);
    /*$result = [];
    foreach ($parents as $parent) {
        if (!in_array($parent, $list)) {
            if (!array_key_exists($parent, $listDeps)) {
                $result[] = $parent;

            } else {
                $stack[] = $parent;
                $count++;
                $result = [...$result, ...dfs($listDeps[$parent], $listDeps, $list, $stack, $count)];

                $parent = array_pop($stack);
                //var_dump($stack);
                $result[] = $parent;
            }
        }
    }
    return $result;*/
    $result = array_reduce($parents, function ($acc, $parent) use ($listDeps, $stack, $list) {

        if (!in_array($parent, $list)) {
            if (!array_key_exists($parent, $listDeps)) {
                $acc[] = $parent;
            } else {
                $stack[] = $parent;
                $acc = [...$acc, ...dfs($listDeps[$parent], $listDeps, $list, $stack)];
                $parent = array_pop($stack);
                $acc[] = $parent;
            }
        }
        return $acc;
    }, []);

    return $result;
}

function sortDeps($deps)
{
    /*$count = 0;
    $stack = [];
    $result = [];
    foreach ($deps as $key => $parents) {
        if (!in_array($key, $result)) {
            if (empty($parents)) {
                $result[] = $key;
            } else {
                $stack[] = $key;
                $count++;
                $result = [...$result, ...dfs($parents, $deps, $result, $stack, $count)];
                //var_dump($stack);
                $key = array_pop($stack);
                //var_dump($stack);
                $result[] = $key;
                //var_dump($result);
            }
        }
    }

    return $result; */

    $stack = [];
    $result = array_reduce(array_keys($deps), function ($acc, $key) use ($deps, $stack) {
        if (!in_array($key, $acc)) {
            if (empty($deps[$key])) {
                $acc[] = $key;
            } else {
                $stack[] = $key;
                $acc = [...$acc, ...dfs($deps[$key], $deps, $acc, $stack)];
                $key = array_pop($stack);
                $acc[] = $key;
            }
        }
        return $acc;
    }, []);
    return $result;
}

$deps1 = [
    'mongo' => [],
    'tzinfo' => ['thread_safe'],
    'uglifier' => ['execjs'],
    'execjs' => ['thread_safe', 'json'],
    'redis' => [],
  ];

  //print_r(sortDeps($deps1));
  // => ['mongo', 'thread_safe', 'tzinfo', 'json', 'execjs', 'uglifier', 'redis'];
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
var_dump($expected2 === sortDeps($deps2));
//print_r(sortDeps($deps1));
var_dump($expected3 === sortDeps($deps3));
