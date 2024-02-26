<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function Php\Immutable\Fs\Trees\trees\isFile;
use function Php\Immutable\Fs\Trees\trees\isDirectory;
use function Php\Immutable\Fs\Trees\trees\getChildren;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\getMeta;

function reduce($funcFirst, $tree, $acc)
{
    $acc = $funcFirst($acc, $tree);
    $children = $tree['children'] ?? [];

    $result = array_reduce($children, fn($acc, $node) => reduce($funcFirst, $node, $acc), $acc);
    return $result;
}

$tree = mkdir('/', [
    mkdir('eTc', [
        mkdir('NgiNx'),
        mkdir('CONSUL', [
            mkfile('config.json'),
        ]),
    ]),
    mkfile('hOsts'),
]);

$actual = reduce(fn($acc) => $acc + 1, $tree, 0);
//print_r($actual);
var_dump(6 === $actual);
$actual2 = reduce(fn($acc, $node) => isFile($node) ? $acc + 1 : $acc, $tree, 0);
var_dump(2 === $actual2);
$actual3 = reduce(fn($acc, $node) => isDirectory($node) ? $acc + 1 : $acc, $tree, 0);
var_dump(4 === $actual3);
