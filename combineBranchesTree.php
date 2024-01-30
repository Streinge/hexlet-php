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

function buildsNewBranch(&$listBranchBase, $branchConnected)
{
    $matchingList = array_intersect_key($listBranchBase, $branchConnected);
    $keysMatch = array_keys($matchingList);
    //echo "Ключи, которые совпадают = \n";
    //print_r($keysMatch);
    //echo "\n";

    $filteredKeysMatch = array_filter($keysMatch, function ($key) use ($listBranchBase, $branchConnected) {
        //echo "Ключ = \n";
        //print_r($key);
        //echo "\n";

        $children1 = $listBranchBase[$key][1] ?? [];
        $children2 = $branchConnected[$key][1] ?? [];
        //echo "children1 = \n";
        //print_r($children1);
        //echo "\n";
        //echo "children2 = \n";
        //print_r($children2);
        //echo "\n";
        return  !empty(array_diff($children2, $children1));
    });
    //echo "отфильтрованные ключи = \n";
    //print_r($filteredKeysMatch);
    //echo "\n";
    //print_r($filteredKeysDiff);
    // !array_key_exists('1', $branchConnected[$key]
    $newListBranch1 = array_reduce(array_keys($listBranchBase), function ($acc, $key) use ($filteredKeysMatch, $listBranchBase, $branchConnected) {
        if (!in_array($key, $filteredKeysMatch) || !array_key_exists('1', $branchConnected[$key])) {
            //echo "Это кеу = " . $key . "\n";
            $acc[$key] = $listBranchBase[$key];
            //echo "А это дети = \n";
            // print_r($listBranchBase[$key]);
            //echo "\n";
        } else {
            [$parent1] = $listBranchBase[$key];
            $children1 = $listBranchBase[$key][1] ?? [];
            $children2 = $branchConnected[$key][1] ?? [];
            $newChildren = array_values(array_unique([...$children1, ...$children2]));
            $acc[$key] = [$parent1, $newChildren];
        }
        return $acc;
    }, []);

    $newListBranchBase = $newListBranch1 + $branchConnected;
    return $newListBranchBase;
}


function combine($branchBase, ...$branches)
{
    $listBranchBase = makeFlattenTree($branchBase, [], null);

    $result = array_reduce($branches, function ($acc, $branch) use ($listBranchBase) {
        $listBranchConnected = makeFlattenTree($branch, [], null);
        $acc[] = buildsNewBranch($listBranchBase, $listBranchConnected);
        return $acc;
    }, []);

    return $result;
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

print_r(combine($branch1, $branch2, $branch3));
