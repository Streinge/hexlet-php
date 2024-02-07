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
    $newNode = ($funcFirst($tree)) ? $tree : [];
    $children = $tree['children'] ?? [];
    $newChildren = array_filter($children, function ($node) use ($funcFirst) {
        var_dump($node['name']);
        return $funcFirst($node);
    });

    return $newChildren;
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
var_dump($expected === $actual);
print_r($actual);

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
        'name' => 'hosts',
        'meta' => [],
        'type' => 'file',
    ],
  ],
  'meta' => [],
  'name' => '/',
  'type' => 'directory',
];
//var_dump($expected == $actual);
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
//var_dump($expected === $actual);
//print_r($actual);
