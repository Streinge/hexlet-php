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

function changesConnectBranch($branchConnected, $rootBase)
{
    $key = array_key_first($branchConnected);
    $parent = $branchConnected[$key][0];
    $children = $branchConnected[$key][1] ?? [];
    if ($key !== $rootBase) {
        $newParent = array_shift($children);
        array_shift($branchConnected);
        if (!empty($parent)) {
            $children[] = $parent;
        }
        $branchConnected[$key] = (!empty($children)) ? [$newParent, $children] : [$newParent];

        return changesConnectBranch($branchConnected, $rootBase);
    } else {
        $newParent = null;
        $children[] = $parent;
        array_shift($branchConnected);
        $branchConnected[$key] = (!empty($children)) ? [$newParent, $children] : [$newParent];
        return array_reverse($branchConnected);
    }
}

function buildsNewBranch($listBranchBase, $branchConnected)
{
    $rootOld = array_key_first($branchConnected);
    $rootNew = array_key_first($listBranchBase);
    $keysBase = array_keys($listBranchBase);
    if (!in_array($rootOld, $keysBase)) {
        $modifiedBranchConnected = changesConnectBranch($branchConnected, $rootNew);
    } else {
        $modifiedBranchConnected = $branchConnected;
    }
    $matchingKeys = array_intersect(array_keys($listBranchBase), array_keys($modifiedBranchConnected));
    $changedBaseBranch = array_reduce(
        array_keys($listBranchBase),
        function ($acc, $key) use ($listBranchBase, $modifiedBranchConnected, $matchingKeys) {
            if (in_array($key, $matchingKeys)) {
                $kidsBase = $listBranchBase[$key][1] ?? [];
                $kidsConnect = $modifiedBranchConnected[$key][1] ?? [];
                $diff = array_diff($kidsConnect, $kidsBase);
                $kidsBase = [...$kidsBase, ...$diff];
                sort($kidsBase);
                $acc[$key] = !empty($kidsBase) ? [$listBranchBase[$key][0], $kidsBase] : [$listBranchBase[$key][0]];
            } else {
                $acc[$key] = $listBranchBase[$key];
            }
            return $acc;
        },
        []
    );
    $diffNodes = array_diff_key($modifiedBranchConnected, $changedBaseBranch);
    $result = [...$changedBaseBranch, ...$diffNodes,];
    return $result;
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

function combine($branchBase, ...$branches)
{
    $listBranchBase = makeFlattenTree($branchBase, [], null);
    foreach ($branches as $branch) {
        $listBranch = makeFlattenTree($branch, [], null);
        $listBranchBase = buildsNewBranch($listBranchBase, $listBranch);
    }
    $root = array_key_first($listBranchBase);
    $children = $listBranchBase[$root][1];
    $new = [$root, reverseConverted($children, $listBranchBase)];
    return $new;
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
                               ]
                         ],
                         ['H'],
                         ]
                   ],
                   ['I'],
                   ]
             ];

$expected2 = ['B', [
                   ['A', [
                         ['I'],
                         ]
                   ],
                   ['C'],
                   ['D', [
                         ['E'],
                         ['F'],
                         ]
                   ],
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

var_dump(combine($branch1, $branch2, $branch3) === $expected1);
var_dump(combine($branch2, $branch1, $branch3) === $expected2);
var_dump(combine($branch3, $branch2, $branch1) === $expected3);
var_dump(combine($branch2, $branch3) === $expected4);
//print_r(combine($branch2, $branch1, $branch3));
