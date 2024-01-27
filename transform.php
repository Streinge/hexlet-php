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

    echo "Это children на входе в функцию \n";
    print_r($children);
    echo "\n";

    $result = array_reduce($children, function ($acc, $child) use ($list) {
        echo "Это child  \n";
        print_r($child);
        echo "\n";
        $parent = $list[$child][0];
        echo "Это parent  \n";
        print_r($parent);
        echo "\n";
        $kids = $list[$child][1] ?? [];
        echo "Это kids  \n";
        print_r($kids);
        echo "\n";
        $acc[] = ($kids === []) ? [$child] : [$child, [...reverseСonversionChild($kids, $list)]];
        echo "Это АККУМУЛЯТОР  \n";
        print_r($acc);
        echo "\n";
        return $acc;
    }, []);

    return $result;
}

function goingUpTree($parent, $node, $list)
{
    echo "Это parent на входе в функцию Вверх по дереву \n";
    print_r($parent);
    echo "\n";

    if (!$parent) {
        return;
    }

    $newParent = $list[$parent][0];
    echo "Это newParent на входе в функцию Вверх по дереву \n";
    print_r($newParent);
    echo "\n";
    $children = $list[$parent][1];
    echo "Это children в функции Вверх по дереву \n";
    print_r($children);
    echo "\n";
    $filtered = array_filter($children, fn($child) => ($child !== $node));
    $result = reverseСonversionChild($filtered, $list);
    return goingUpTree($newParent, $parent, $list);

}

function transform($tree, $node)
{
    $list = makeFlattenTree($tree, [], null);
    // 1. находим элемент $list c ключом $node и берем значение родителя и детей
    [$parent, $children] = $list[$node];
    // 2. для каждого списка детей запускаем рекурсивную функцию передаем в нее список названий узлов
    //$newChildren = reverseСonversionChild($children, $list);
    $childrenFromParent = goingUpTree($parent, $node, $list);

    //$result = [$node, $newChildren];

    return $list;
}

$tree = ['A', [                              //     A
              ['B', [                        //    / \
                    ['D', [                  //   B   C
                          ['G'],            //   /   / \
                          ['I'],           //   D   E   F
                          ]              //    / \        
                    ]                   //    G   I 
                    ]
              ],                 
              ['C', [                       
                    ['E'],     
                    ['F'],               
                    ]
              ],
              ]
        ];


print_r(transform($tree, 'B'));

$tree = ['A', [
              ['B', [
                    ['D', [
                          ['H'],
                          ]
                    ],
                    ['E'],
                    ]
              ],
              ['C', [
                    ['F', [
                          ['I', [
                                ['M'],
                                ]
                          ],
                          ['J', [
                                ['N'],
                                ['O'],
                                ]
                          ],
                          ]
                    ],
                    ['G', [
                          ['K'],
                          ['L'],
                          ]
                    ],
                    ]
              ],
              ]
         ];
