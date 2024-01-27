<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function Php\Immutable\Fs\Trees\trees\isFile;
use function Php\Immutable\Fs\Trees\trees\getChildren;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\getMeta;
use function Php\Immutable\Fs\Trees\trees\isDirectory;
use function Php\Immutable\Fs\Trees\trees\array_flatten;

function iter(array $tree, string $subStr, string $path)
{
    $name = getName($tree);
    if (isFile($tree)) {
        return (str_contains($name, $subStr)) ? "{$path}{$name}" : '';
    }
    $children = getChildren($tree);
    $new = array_map(function ($child) use ($path, $name, $subStr) {
        $path .= ($name === '/') ? "{$name}" : "{$name}/";
        return iter($child, $subStr, $path);
    }, $children);

    return $new;
}

function findFilesByName($tree, $subStr)
{
    $new = array_flatten(iter($tree, $subStr, ''));
    $result = array_filter($new, fn($item) => $item !== '');
    return array_values($result);
}


$tree = mkdir('/', [
    mkdir('etc', [
        mkdir('apache'),
        mkdir('nginx', [
            mkfile('nginx.conf', ['size' => 800]),
        ]),
        mkdir('consul', [
            mkfile('config.json', ['size' => 1200]),
            mkfile('data', ['size' => 8200]),
            mkfile('raft', ['size' => 80]),
        ]),
    ]),
    mkfile('hosts', ['size' => 3500]),
    mkfile('resolve', ['size' => 1000]),
]);


print_r(findFilesByName($tree, 'co'));

$tree = mkdir('/', [
    mkdir('etc', [
        mkdir('apache'),
        mkdir('nginx', [
            mkfile('nginx.conf', ['size' => 800]),
        ]),
        mkdir('consul', [
            mkfile('config.json', ['size' => 1200]),
            mkfile('data', ['size' => 8200]),
            mkfile('raft', ['size' => 80]),
        ]),
    ]),
    mkfile('hosts', ['size' => 3500]),
    mkfile('resolve', ['size' => 1000]),
]);

print_r(findFilesByName($tree, 'data'));
