<?php

namespace Hexlet\Php;

function makeFlattenTree($tree, $flattenList, $parent = null)
{
    [$nameCity] = $tree;
    $branches = $tree[1] ?? [];
    if ($branches === []) {
        $flattenList[$nameCity] = [$parent];
        return $flattenList;
    }
    $children = array_map(fn($child) => $child[0], $branches);
    $newAcc = array_merge($flattenList, [$nameCity => [$parent, $children]]);
    return array_reduce($branches, fn($iAcc, $child) => makeFlattenTree($child, $iAcc, $nameCity), $newAcc);
}
function findPathToRoot($list, $node, $oldRoot)
{
    $parentNode = $list[$node][0];
    if ($parentNode !== $oldRoot) {
        $acc[] = $parentNode;
        $acc[] = findPathToRoot($list, $parentNode, $oldRoot);
    } else {
        return $node;
    }
    return $acc;
}

function transform($tree, $node)
{
    $list = makeFlattenTree($tree, [], null);
    $oldRoot = $tree[0];
    $acc[] = $node;
    $acc[] = findPathToRoot($list, $node, $oldRoot);

    return $acc;
}

/*$tree = ['A', [
              ['B', [
                    ['D'],
                    ]
              ],
              ['C', [
                    ['E'],
                    ['F'],
                    ]
              ],
              ]
        ];


$expected = ['B', [
                  ['A', [
                        ['C', [
                              ['E'],
                              ['F'],
                              ]
                        ],
                        ]
                  ],
                  ['D'],
                  ]
            ];

            //
var_dump(transform($tree, 'B') === $expected);
print_r(transform($tree, 'B'));*/

$tree = ['A', [
    ['B', [
        ['D', [
            ['H'],
        ]],
        ['E'],
    ]],
    ['C', [
        ['F', [
            ['I', [
                ['M'],
            ]],
            ['J', [
                ['N'],
                ['O'],
            ]],
        ]],
        ['G', [
            ['K'],
            ['L'],
        ]],
    ]],
  ]];
$expected1 = ['F', [
            ['C', [
                ['A', [
                    ['B', [
                        ['D', [
                            ['H'],
                        ]],
                        ['E'],
                    ]],
                ]],
                ['G', [
                    ['K'],
                    ['L'],
                ]],
            ]],
            ['I', [
                ['M'],
            ]],
            ['J', [
                ['N'],
                ['O'],
            ]],
        ]];
//var_dump(transform($tree, 'F') === $expected1);
print_r(transform($tree, 'F'));

/*$expected2 = ['I', [
    ['F', [
        ['C', [
            ['A', [
                ['B', [
                    ['D', [
                        ['H'],
                    ]],
                    ['E'],
                ]],
            ]],
            ['G', [
                ['K'],
                ['L'],
            ]],
        ]],
        ['J', [
            ['N'],
            ['O'],
        ]],
    ]],
    ['M'],
]];

var_dump(transform($tree, 'I') === $expected2);
print_r(transform($tree, 'I'));*/
