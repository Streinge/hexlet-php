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


function countSizeFiles($tree)
{
    if (isDirectory($tree)) {
        $children = getChildren($tree);
        return array_sum(array_map(fn($child) => countSizeFiles($child), $children));
    } else {
        return getMeta($tree)['size'];
    }

}
function du($tree)
{
    
    $children = getChildren($tree);
    $result = array_map(fn($child) => [getName($child), countSizeFiles($child)], $children);
    usort($result, fn($a, $b) => $b[1] <=> $a[1]);
    return $result;
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


print_r(du($tree));

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

print_r(du(getChildren($tree)[0]));
