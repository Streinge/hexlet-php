<?php

namespace Hexlet\Php;

require_once __DIR__ . '/vendor/autoload.php';

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function Php\Immutable\Fs\Trees\trees\isFile;
use function Php\Immutable\Fs\Trees\trees\getChildren;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\getMeta;

// BEGIN (write your solution here)
function compressImages(array $tree)
{
    $children = getChildren($tree);
    $newChildren = array_map(function ($child) {
        if (isFile($child) && str_ends_with(getName($child), '.jpg')) {
            $newMeta = ['size' => getMeta($child)['size'] / 2];
            return mkfile(getName($child), $newMeta);
        } else {
            return $child;
        }
    }, $children);

    return mkdir(getName($tree), $newChildren, getMeta($tree));
}
// END

$tree = mkdir(
    'my documents', [
        mkfile('avatar.jpg', ['size' => 100]),
        mkfile('passport.jpg', ['size' => 200]),
        mkfile('family.jpg',  ['size' => 150]),
        mkfile('addresses',  ['size' => 125]),
        mkdir('presentations')
    ]
);

print_r($tree);

print_r(compressImages($tree));
