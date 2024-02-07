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


function map($funcFirst, $tree)
{
    $newNode = $funcFirst($tree);
    $children = $tree['children'] ?? [];

    if (isDirectory($tree)) {
        $newChildren = array_map(fn($node) => map($funcFirst, $node), $children);
        $newNode['children'] = $newChildren;
        ksort($newNode);
        return $newNode;
    }
    ksort($newNode);
    return $newNode;
}

function filter($funcFirst, $tree)
{

    $newNode = ($funcFirst($tree)) ? $tree : [];
    $children = $tree['children'] ?? [];

    $newChildren = [];
    foreach ($children as $node) {
        if ($funcFirst($node)) {
            $newChildren[] = filter($funcFirst, $node);
        }
    }

    $newNode['children'] = $newChildren;

    ksort($newNode);

    return $newNode;
}

$tree = mkdir('/', [
                   mkdir('eTc', [
                                mkfile('config.json')
                                ]),
]);

//print_r($tree);

$tree1 = [
         'name' => '/',
         'children' => [
                       [
                        'name' => 'eTc',
                        'children' => [
                                      [
                                        'name' => 'config.json',
                                        'meta' => [],
                                        'type' => 'file'
                                      ]
                                      ],
                        'meta' => [],
                        'type' => 'directory'
                        ]
                        ],
         'meta' => [],
         'type' => 'directory'
         ];

$treeTest =  [
            'name' => '/',
            'type' => 'directory',
            'meta' => [],
            'children' => [
                [
                'name' => 'eTc',
                'type' => 'directory',
                'meta' => [],
                'children' => [],
                ],
            ],
        ];

$tree = mkdir('/', [
    mkdir('eTc', [
        mkdir('NgiNx'),
        mkdir('CONSUL', [
        mkfile('config.json'),
        ]),
    ]),
    mkfile('hOsts'),
    ]);

$expected = [
'children' => [
    [
    'children' => [
        [
        'children' => [],
        'meta' => [],
        'name' => 'NGINX',
        'type' => 'directory',
        ],
        [
        'children' => [['meta' => [], 'name' => 'CONFIG.JSON', 'type' => 'file']],
        'meta' => [],
        'name' => 'CONSUL',
        'type' => 'directory',
        ],
    ],
    'meta' => [],
    'name' => 'ETC',
    'type' => 'directory',
    ],
    ['meta' => [], 'name' => 'HOSTS', 'type' => 'file'],
],
'meta' => [],
'name' => '/',
'type' => 'directory',
];


//$actual = map(fn($node) => array_merge($node, ['name' => strtoupper(getName($node))]), $tree);

//var_dump($actual === $expected);

//print_r(map(fn($node) => array_merge($node, ['name' => strtoupper(getName($node))]), $tree));

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
var_dump($expected === $actual);
print_r($actual);
//var_dump(filter(fn($node) => isDirectory($node), $tree) === $treeTest);
//var_dump(['name' => '/', 'type' => 'directory', 'meta' => [], 'children' => ['a', 'b']] === ['type' => 'directory', 'name' => '/', 'meta' => [], 'children' => ['a', 'b']]);
