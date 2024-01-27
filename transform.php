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

function reverseСonversionChild($children, $list)
{
    $result = array_reduce($children, function ($acc, $child) use ($list) {

        $kids = $list[$child][1] ?? [];

        $acc[] = ($kids === []) ? [$child] : [$child, [...reverseСonversionChild($kids, $list)]];

        return $acc;
    }, []);

    return $result;
}

function goingUpTree($parent, $node, $list)
{
    $newParent = $list[$parent][0];
    $children = $list[$parent][1];
    $filtered = array_filter($children, fn($child) => ($child !== $node));
    if ($newParent) {
        return [goingUpTree($newParent, $parent, $list), ...reverseСonversionChild($filtered, $list)];
    } else {
        return [$parent, reverseСonversionChild($filtered, $list)];
    }
}

function transform($tree, $node)
{
    $list = makeFlattenTree($tree, [], null);
    [$parent, $children] = $list[$node];
    $newChildren = reverseСonversionChild($children, $list);
    $childrenFromParent = goingUpTree($parent, $node, $list);
    $children = [$childrenFromParent, ...$newChildren];
    $result = [$node, $children];

    return $result;
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
var_dump(transform($tree, 'F') === $expected1);
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
