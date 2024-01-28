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

function combine($branch1, $branch2)
{
    $listBranch1 = makeFlattenTree($branch1, [], null);
    $listBranch2 = makeFlattenTree($branch2, [], null);
    $keys1 = array_keys($listBranch1);
    $keys2 = array_keys($listBranch2);
    $result = array_reduce($keys1, function ($acc, $key) use ($keys2, $listBranch1, $listBranch2) {
        if (!in_array($key, $keys2)) {
            $acc[$key] = $listBranch1[$key];
        } else {
            
        }
    }, []);
    return;
}

$branch1 = ['A', [
    ['B', [
        ['C'],
        ['D'],
    ]],
]];

$branch2 = ['B', [
    ['D', [
        ['E'],
        ['F'],
    ]],
]];

$branch3 = ['I', [
    ['A', [
        ['B', [
            ['C'],
            ['H'],
        ]],
    ]],
]];

$expected1 = ['A', [
    ['B', [
        ['C'],
        ['D', [
            ['E'],
            ['F'],
        ]],
        ['H'],
    ]],
    ['I'],
]];

$expected2 = ['B', [
    ['A', [
        ['I'],
    ]],
    ['C'],
    ['D', [
        ['E'],
        ['F'],
    ]],
    ['H'],
]];

$expected3 = ['I', [
    ['A', [
        ['B', [
            ['C'],
            ['D', [
                ['E'],
                ['F'],
            ]],
            ['H'],
        ]],
    ]],
]];

$expected4 = ['B', [
    ['A', [
        ['I'],
    ]],
    ['C'],
    ['D', [
        ['E'],
        ['F'],
    ]],
    ['H'],
]];

print_r(combine($branch1, $branch2));
