<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function Php\Immutable\Fs\Trees\trees\isFile;
use function Php\Immutable\Fs\Trees\trees\getChildren;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\getMeta;

function downcaseFileNames(array $tree)
{
    $name = getName($tree);
    $meta = getMeta($tree);
    
    if (isFile($tree)) {
        return mkfile(strtolower($name), $meta);
    }

    $children = getChildren($tree);

    $newChildren = array_map(function ($child) {
        return downcaseFileNames($child);
    }, $children);
    
    return mkdir($name, $newChildren, $meta);
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

print_r(downcaseFileNames($tree));
