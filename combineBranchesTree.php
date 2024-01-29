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

    $diff = array_intersect_key($listBranch1, $listBranch2);
    $keysDiff = array_keys($diff);

    $filteredKeysDiff = array_filter($keysDiff, function ($key) use ($listBranch1, $listBranch2) {
        $children1 = $listBranch1[$key][1] ?? [];
        $children2 = $listBranch2[$key][1] ?? [];
        return empty(array_intersect($children1, $children2));

    });

    $newListBranch1 = array_map(function ($node) use ($filteredKeysDiff, $listBranch1) {
        if (!in_array($key, $filteredKeysDiff)) {
            acc[$key] = $listBranch1[$key];
        }
    })
    return $filteredKeysDiff;
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
