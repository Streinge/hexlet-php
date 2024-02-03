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

function buildsNewBranch($listBranchBase, $branchConnected)
{

    $rootOld = array_key_first($branchConnected);
    $newParent = $branchConnected[$rootOld][1][0];
    
    $keysBase = array_keys($listBranchBase);



    # меняю присоединяемую ветку
    $modifiedBranchConnected = array_reduce(array_keys($branchConnected), function ($acc, $key) use ($branchConnected, $newParent, $keysBase) {

        $parent = $branchConnected[$key][0];
        $children = $branchConnected[$key][1] ?? [];
        # формирую новых детей
        $newKids = function ($children) use ($keysBase) {

            $result = array_map(function ($child) use ($keysBase) {
            # если детей из присоединяемой ветки нет в базовом, то
            # их беру - других нет
                if (!in_array($child, $keysBase)) {
                    return $child;
                }
            }, $children);
            $result = array_filter($result, fn($kid) => !is_null($kid));
            sort($result);
            return $result;
        };
        $kids = $newKids($children);

        # обрабатываю корень присоединяемой ветки
        if (empty($parent)) {

            # устанавливаю ему родителя - новый корень и отфильтрованных детей
            $acc[$key] = (empty($kids)) ? [$newParent] : [$newParent, $kids];

            # если в присоединяемой ветке нет узла с корнем, как у базовой ветки
            # то добавляю его в дети ему добавляю бывший корень, чтобы потом при обработке
            # базовой ветки его можно было добавить в результат
            if (empty($branchConnected[$newParent])) {
                $acc[$newParent] = [null, [$key]];
            } else {
                $childrenOther = $branchConnected[$newParent][1] ?? [];
                # если этот узел есть, то просто в дети к ниму добавляю бывший корень.
                $childrenOther[] = $key;

                $otherKids = $newKids($childrenOther);

                sort($otherKids);
                $acc[$newParent] = ($otherKids === []) ? [$branchConnected[$newParent][0]] : [$branchConnected[$newParent][0], $otherKids];
            }
            return $acc;
        } elseif (!empty($acc[$key])) {
            return $acc;
        }
        $acc[$key] = (empty($kids)) ? [$branchConnected[$key][0]] : [$branchConnected[$key][0], $kids];
        return $acc;
    }, []);

    
    /*$modifiedBranchConnected = array_reduce(array_keys($modifiedBranchConnected), function ($acc, $key) use ($listBranchBase, $modifiedBranchConnected) {
        $parent = ((array_key_exists($key, $listBranchBase)) ? $key : array_key_first($listBranchBase));

        $acc[$key] = empty($modifiedBranchConnected[$key][1]) ? [$parent] : [$parent, $modifiedBranchConnected[$key][1]];
        return $acc;
    }, []);*/


    $matchingKeys = array_intersect(array_keys($listBranchBase), array_keys($modifiedBranchConnected));

    $changedBaseBranch = array_reduce(array_keys($listBranchBase), function ($acc, $key) use ($listBranchBase, $modifiedBranchConnected, $matchingKeys) {
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
    }, []);

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
    //$listBranch = makeFlattenTree($branches, [], null);
    //$listNewBranch = buildsNewBranch($listBranchBase, $listBranch);

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
var_dump(combine($branch3, $branch2, $branch1) === $expected4);
//print_r(combine($branch2, $branch3));
/*$actual1 = combine($branch1, $branch2, $branch3);
$actual2 = combine($branch2, $branch1, $branch3);
$actual3 = combine($branch3, $branch2, $branch1);
$actual4 = combine($branch2, $branch3);

$this->assertEquals($expected1, sortTree($actual1));
$this->assertEquals($expected2, sortTree($actual2));
$this->assertEquals($expected3, sortTree($actual3));
$this->assertEquals($expected4, sortTree($actual4));*/
