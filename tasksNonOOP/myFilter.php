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

function filter($funcFirst, $tree)
{

    /*$newNode = ($funcFirst($tree)) ? $tree : [];
    $children = $tree['children'] ?? [];

    $newChildren = [];
    foreach ($children as $node) {
        if ($funcFirst($node)) {
            $newChildren[] = filter($funcFirst, $node);
        }
    }

    if (!empty($newNode['children'])) {
        $newNode['children'] = $newChildren;
    }
    ksort($newNode);*/

    if ($funcFirst($tree)) {
        $newNode = $tree;
    } else {
        return null;
    }

    $children = $tree['children'] ?? [];

    if (isDirectory($tree)) {
        $new = array_map(fn($node) => filter($funcFirst, $node), $children);

        $newChilren = array_values(array_filter($new, fn($child) => !empty($child)));

        $newNode['children'] = $newChilren;
    }

    ksort($newNode);

    return $newNode;
}

$tree = mkdir('/', [
                   mkdir('etc', [
                                mkdir('nginx', [
                                               mkdir('conf.d'),
                                               ]),
                                mkdir('consul', [
                                                mkfile('config.json'),
                                                ]),
                                ]),
                   mkfile('hosts'),
                   ]);

$actual = filter(fn($node) => isDirectory($node), $tree);

$expected = [
    'children' => [
      [
        'children' => [
          [
            'children' => [[
              'children' => [],
              'meta' => [],
              'name' => 'conf.d',
              'type' => 'directory',
            ]],
            'meta' => [],
            'name' => 'nginx',
            'type' => 'directory',
          ],
          [
            'children' => [],
            'meta' => [],
            'name' => 'consul',
            'type' => 'directory',
          ],
        ],
        'meta' => [],
        'name' => 'etc',
        'type' => 'directory',
      ],
    ],
    'meta' => [],
    'name' => '/',
    'type' => 'directory',
];
//var_dump($expected === $actual);
//print_r($actual);
//print_r($children);


$tree = mkdir('/', [
                   mkdir('etc', [
                                mkdir('nginx', [
                                               mkdir('conf.d'),
                                               ]),
                                mkdir('consul', [
                                                mkfile('config.json'),
                                                ]),
                                ]),
      mkfile('hosts'),
]);

$names = ['/', 'hosts', 'etc', 'consul'];
$actual = filter(fn($node) => in_array(getName($node), $names), $tree);

$expected = [
  'children' => [
    [
      'children' => [
        [
          'children' => [],
          'meta' => [],
          'name' => 'consul',
          'type' => 'directory',
        ],
      ],
      'meta' => [],
      'name' => 'etc',
      'type' => 'directory',
    ],
    [
        'meta' => [],
        'name' => 'hosts',
        'type' => 'file',
    ],
  ],
  'meta' => [],
  'name' => '/',
  'type' => 'directory',
];
//var_dump($expected === $actual);
//print_r($tree);
//print_r($actual);
$tree = mkdir('/', [
    mkdir('etc', [
        mkdir('nginx', [
            mkdir('conf.d'),
        ]),
        mkdir('consul', [
            mkfile('config.json'),
        ]),
      ]),
      mkfile('hosts'),
  ]);

$actual = filter(fn($node) => !isDirectory($node), $tree);

$expected = null;
var_dump($expected === $actual);
//print_r($actual);
