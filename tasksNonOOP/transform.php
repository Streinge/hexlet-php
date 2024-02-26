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
function findPathToRoot($list, $node, $oldRoot, &$acc = [])
{
    [$parentNode] = $list[$node];
    if ($node !== $oldRoot) {
        $acc[] = $node;
        findPathToRoot($list, $parentNode, $oldRoot, $acc);
    } else {
        $acc[] = $node;
    }
    return $acc;
}

function reverseConverted($children, $list)
{
    if (!$children) {
        return;
    }
    $result = array_reduce($children, function ($acc, $child) use ($list) {
        $newChildren = $list[$child][1] ?? [];
        $acc[] = ($newChildren === []) ? [$child] : [$child, reverseConverted($newChildren, $list)];
        return $acc;
    }, []);

    return $result;
}

function transform($tree, $node)
{
    $list = makeFlattenTree($tree, [], null);
    [$oldRoot] = $tree;
    
    $pathRoot = findPathToRoot($list, $node, $oldRoot);

    $newList = array_reduce($pathRoot, function ($acc, $key) use ($list) {
        [$parent, $children] = $list[$key];
        $flattenArray = [$parent, ...$children];
        $filteredFlattenArray = array_filter($flattenArray, fn($child) => (!empty($child)));
        $acc[$key] = $filteredFlattenArray;
        return $acc;
    }, []);

    $newNode = $node;

    $changedList = array_reduce(array_keys($newList), function ($acc, $key) use ($newList, &$newNode) {
        $children = $newList[$key];
        $filteredChildren = array_filter($children, fn($child) => ($child !== $newNode));
        $acc[$key] = ($key === $newNode) ? [null, $children] : [$newNode, $filteredChildren];
        $newNode = $key;
        return $acc;
    }, []);

    $keysChangedItems = array_keys($changedList);

    $filteredList = array_filter($list, fn($key) => !in_array($key, $keysChangedItems), ARRAY_FILTER_USE_KEY);

    $transformList = array_merge($changedList, $filteredList);

    $result = [$node, reverseConverted($transformList[$node][1], $transformList)];

    return $result;
}

$tree = ['A', [
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
//var_dump(transform($tree, 'B') === $expected);
//print_r(transform($tree, 'B'));

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
//print_r(transform($tree, 'F'));

$expected2 = ['I', [
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
print_r(transform($tree, 'I'));
